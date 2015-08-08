<?php namespace App\Http\Controllers;

use App\Classes;
use App\Query;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Teacher;
use App\Review;
use App\Tag;

use Illuminate\Http\Request;
use Input;
use Session;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchController extends Controller {

	protected $classes;
	protected $queries;
	protected $ranking;
	protected $review;
	protected $tag;


	public function __construct(Classes $classes,Query $queries,Review $review,Tag $tag,RankingController $ranking){
		$this->classes = $classes;
		$this->queries = $queries;
		$this->ranking = $ranking;
		$this->review = $review;
		$this->tag = $tag;
	}

	/**
	 * 検索インデックス
	 *
	 * @param void
	 * @author shalman
	 * @return view
	 *
	 */

	public function getIndex(Request $request){

		$search_queries = array();
		$search_session = ["day" =>"0","period" => "0","term" => "2","q" =>""];

		//検索からinputしたら
		if($token = $request->_token){
			//検索オプション定義、サニタイズ
			$day	 	= htmlspecialchars($request->day ?:"0",ENT_QUOTES);
			$period 	= htmlspecialchars($request->period ?:"0",ENT_QUOTES);
			$term 		= htmlspecialchars($request->term ?:"2",ENT_QUOTES);
			$query 		= htmlspecialchars(Input::get('q') ?:"",ENT_QUOTES);

			$search_queries = $this->query2array($query);

			//検索の値をDBに
			if($search_queries){
				$queries = $this->queries;
				foreach ($search_queries as $v) {
					if(!empty($v)){
						if (is_null($target_word = $queries->where('word', '=',$v)->first()) ){
								$queries["word"] = $v;
								$queries->save();
						}else{
							$target_word->increment("count");
						}	
					}
				}
			}
			//検索の値をセッションに
			$search_session = array('q'		=>	$query,
									'day' 	=> $day,
									'period'=> $period,
									'term' 	=> $term,
									'_token' =>	$token);

			Session::put("search_session",$search_session);
			
		//pagenationなどはセッションから取得
		}else{
			if(Session::has("search_session")){
				$search_session = Session::get("search_session");
				
			}


			$day = $search_session['day'] ?:"0";
			$period = $search_session['period'] ?:"0";
			$term = $search_session['term'] ?:"2";
			$query = $search_session['q'] ?:"";

			$search_queries = $this->query2array($query);
		}
		//配列要素は5つまで
		while(count($search_queries) > 5){
			array_pop($search_queries);
		}
		//ページネーション用変数
		$page = Input::get("page");
		$limit = 10;
		$page_num = is_null($page)? 1:$page;
		$offset = ($limit * $page_num) - $limit;
		$data['classes'] = $this->classes_list($day,$period,$term,$search_queries);
		$total = $data['classes']->count();

		//ページネーター作成
		$data['classes'] = new LengthAwarePaginator($data['classes']->skip($offset)->take($limit)->get(),$total,$limit,$page,array("path"=>"search"));

		$data['term'] = ["春学期 ","秋学期 "];
		$data['get'] = $search_session;

		$data['review'] = $this->review;
		$data['tag'] = $this->tag;

		$data['search_ranking'] = $this->ranking->returnSearchRankingList();
		$data{'access_ranking'} = $this->ranking->returnAccessRankingList();

		return view('search/index')->with('data',$data);
	}

	/**
	 * query 2 array
	 * 検索ワードを空白で区切り、配列としてreturnします。
	 *
	 * @param String
	 * @author shalman
	 * @return array	 
	 *
	 */

	function query2array($query){
		$query = urldecode($query);
		//全角空白を半角に
		$query = trim(mb_convert_kana($query,"s"));
		//エンコード
		mb_regex_encoding( "UTF-8" );
		//複数検索ワードを配列に
		$search_queries = mb_split("\s",$query);

		return $search_queries;

	}
	/**
	 * 検索メソッド
	 *
	 * @param String,int,int,String
	 * @author shalman
	 * @return obj
	 *
	 */

	function classes_list($day,$period,$term,$search_queries){

		$data = $this->classes;

		//夏期集中
		if($day == '夏季'){
			$period = '00';
		}
		$data = empty($search_queries)?  $data:$this->getQueryEngine($search_queries);
		//$data = $search_queries == ""?  $data:$data->where("class_name","like","%".$search_queries[0]."%");
		$data = $day == '0'?	$data:$data->where('class_week',$day);
		$data = $period === '0'?$data:$data->where('class_period',$period);
		$data = $term == '2'?	$data:$data->where('term',$term);
		//$data = $query == '0'?  $data:$data->where('class_name','like','%'.$query.'%');


		//return $data->orderBy('class_period','asc')->orderBy('class_week','desc');
		return $data;
	}

	/**
	 * クエリーエンジン
	 * AND検索
	 *
	 * @param array
	 * @author shalman
	 * @return obj
	 *
	 */
	function getQueryEngine($search_queries){
		//マスターデータ
		$data = $this->classes;
		//テスト配列
		//$search_queries = array("データ");

		if(empty($search_queries[0])){
			return $data;
		}
		
		$weight = array();
		//クエリが教師名、授業名、要旨に含まれているものを和集合で取り出す。
		foreach ($search_queries as $query) {
			//クエリに教師名が含まれていれば重みづけ
			if(!is_null($data->teachers()->orWhere('teacher_name','like','%'.$query.'%')->first())) {
				$search_obj = $data->teachers()->orWhere('teacher_name','like','%'.$query.'%')->get();
				//重み処理
				//教師は重み2倍
				foreach ($search_obj as $v) {
					$id = $v["original"]["pivot_class_id"];
					if(!array_key_exists($id,$weight)){
						$weight[$id] = 2;
					}else{
					//2回以降
						$weight[$id] = $weight[$id] + 2;
					}
				}
			}
			else if(!is_null($data->orWhere('class_name','like','%'.$query.'%')->first())){
				$search_obj = $data->orWhere('class_name','like','%'.$query.'%')->get();
				//重み処理
				foreach($search_obj as $v){
					$id = $v->class_id;
					//初めてある授業をカウント
					if(!array_key_exists($id,$weight)){
						$weight[$id] = 1;
					}else{
					//2回以降
						$weight[$id]++;
					}
				}
			}	
			else if(!is_null($data->orWhere('summary','like','%'.$query.'%')->first())) {
				$search_obj = $data->orWhere('summary','like','%'.$query.'%')->get();
				//重み処理
				foreach($search_obj as $v){
					$id = $v->class_id;
					//初めてある授業をカウント
					if(!array_key_exists($id,$weight)){
						$weight[$id] = 1;
					}else{
					//2回以降
						$weight[$id]++;
					}
				}
			}
			
		}
		//$weightはkeyにclass_id,valueに重み(検索した単語の教師名、授業名、要旨におけるヒット回数)の連想配列
		if(empty($weight)){
			return $data->where("class_id","");
		}
		//重みが強いものを先頭に
		arsort($weight);
		//重みを捨ててclass_idだけの配列
		$ids = array_keys($weight);
		//配列の順序通りにDBから引っ張る
		$placeholders = implode(',',array_fill(0, count($ids), '?')); // string for the query

		return $data->whereIn("class_id",$ids)->orderByRaw("field(class_id,{$placeholders})", $ids);

		/*
		SELECT t.teacher_name,c.class_name from classes as c,teachers as t,tr_classes_teachers as tr 
		where t.teacher_id = tr.teacher_id and c.class_id = tr.class_id and 
		(teacher_name like "%田%" or class_name like "%データ%" );
		*/

	}

}
