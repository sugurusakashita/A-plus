<?php namespace App\Http\Controllers;

use App\Classes;
use App\Query;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Input;
use Session;

class SearchController extends Controller {

	protected $classes;
	protected $queries;
	protected $ranking;


	public function __construct(Classes $classes,Query $queries,RankingController $ranking){
		$this->classes = $classes;
		$this->queries = $queries;
		$this->ranking = $ranking;
	}

	/**
	 * 検索インデックス
	 *
	 * @param void
	 * @author shalman
	 * @return view
	 *
	 */

	public function getIndex(){

		//検索からinputしたら
		if($token = Input::get('_token')){


			$day = htmlspecialchars(Input::get('day'),ENT_QUOTES);
			$period = Input::get('period');
			$term = Input::get('term');
			$query = htmlspecialchars(Input::get('q'),ENT_QUOTES);
			$query = trim(mb_convert_kana($query,"s"));

			$search_queries = mb_split("/\s/",$query);

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

			$search_session = array('q'	=>	$query,
							'day' => $day,
							'period'=> $period,
							'term' => $term,
							'_token' =>	$token);

			Session::put("search_session",$search_session);
		//pagenationなどはセッションから取得
		}else{
			$search_session = Session::get("search_session");
			
			$day = $search_session['day'];
			$period = $search_session['period'];
			$term = $search_session['term'];
			$query = $search_session['q'];
			
		}


		$data['classes'] = $this->classes_list($day,$period,$term,$query)->paginate(20);
		$data['get'] = $search_session;
		$data['search_ranking'] = $this->ranking->returnSearchRankingList();
		$data{'access_ranking'} = $this->ranking->returnAccessRankingList();

		return view('search/index')->with('data',$data);
	}

	/**
	 * 検索メソッド
	 *
	 * @param String,int,int,String
	 * @author shalman
	 * @return obj
	 *
	 */

	function classes_list($day,$period,$term,$query){

		$data = $this->classes;

		//夏期集中
		if($day == '夏季'){
			$period = '00';
		}

		$data = $day == '0'?	$data:$data->where('class_week',$day);
		$data = $period === '0'?$data:$data->where('class_period',$period);
		$data = $term == '2'?	$data:$data->where('term',$term);
		$data = $query == '0'?  $data:$data->where('class_name','like','%'.$query.'%');


		return $data->orderBy('class_period','asc')->orderBy('class_week','desc');

	}


}
