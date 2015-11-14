<?php namespace App\Http\Controllers;

use App\Classes;
use App\Query;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Teacher;
use App\Review;
use App\Tag;
use App\Classes_detail;
use App\Pv;

use Illuminate\Http\Request;
use Input;
use Session;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchController extends Controller {

	protected $classes;
	protected $queries;
	protected $review;
	protected $tag;



	public function __construct(Classes $classes,Query $queries,Review $review,Tag $tag,Pv $pv){
		$this->classes = $classes;
		$this->queries = $queries;
		$this->pv = $pv;
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
		$search_session = array(
			'q'		=>	'',
			'day' 	=> '',
			'period'=> '',
			'term' 	=> '',
			'faculty'	=>	'',
			'_token' =>	'');

		//検索からinputしたら
		if($token = $request->_token){
			//検索オプション定義、サニタイズ
			$day	 	= htmlspecialchars($request->day,ENT_QUOTES);
			$period 	= htmlspecialchars($request->period,ENT_QUOTES);
			$term 		= htmlspecialchars($request->term,ENT_QUOTES);
			$query 		= htmlspecialchars(Input::get('q'),ENT_QUOTES);
			$faculty 	= htmlspecialchars($request->faculty,ENT_QUOTES);

			//夏期集中orオンデマ
			if($day == '無その他' || $day == '無フルOD'){
				$period = '';
			}
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
									'faculty'	=>	$faculty,
									'_token' =>	$token);

			Session::put("search_session",$search_session);

		//pagenationなどはセッションから取得
		}else if(Session::has("search_session")){
			$search_session = Session::get("search_session");
		}

		//ページネーション用変数
		$page = Input::get("page");
		$limit = 10;
		$page_num = is_null($page)? 1:$page;
		$offset = ($limit * $page_num) - $limit;
		$data['classes'] = $this->classes->search($search_session);

		$total = $data['classes']->count();

		$options = array(
			'path'=>'search',
			'query'	=>	$search_session
		);
		//ページネーター作成
		$data['classes'] = new LengthAwarePaginator($data['classes']->skip($offset)->take($limit)->get(),$total,$limit,$page,$options);

		$data['res_string'] = $this->genSearchTitle($search_session);
		$data['get'] = $search_session;
		$data['review'] = $this->review;
		$data['tag'] = $this->tag;

		$data{'access_ranking'} = $this->pv->classPvRanking();

		return view('search/index',$data);
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
	 * 検索結果の表示テキストを生成。
	 *
	 * @param array
	 * @author shalman
	 * @return string
	 *
	 */

	function genSearchTitle($data){
		$res = "";

		if(!empty($data["faculty"])){
			$res .= $data["faculty"]." ";
		}
		if($data["term"] !== ""){
			$res .= $data["term"]." ";
		}
		if(!empty($data["day"])){
			$res .= $data["day"];
			if($data["day"] !== "無その他" && $data["day"] !== "無フルOD"){
				$res .= "曜日";
			}
			$res .= " ";
		}
		if(!empty($data["period"])){
			$res .= $data["period"]."限 ";
		}

		$res .= "「".$data["q"]."」の検索結果 ";

		return $res;
	 }

}
