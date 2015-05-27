<?php namespace App\Http\Controllers;

use App\Classes;
use App\Query;
use App\PV;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class RankingController extends Controller {


	protected $classes;
	protected $query;
	protected $pv;

	public function __construct(Classes $classes,Query $query,Pv $pv){
		$this->classes = $classes;
		$this->query = $query;
		$this->pv = $pv;

	}
	/**
	 * テスト用
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$result = $this->returnAccessRankingList();


		foreach ($result as $v) {
			echo $v->class_name."<br>";
		}
		return null;
	}

	/**
	 * 検索ランキングリスト
	 *
	 * @param void
	 * @author shalman
	 * @return array
	 *
	 */

	function returnSearchRankingList(){
		$query = $this->query;
		return $query->orderBy("count","desc")->take(10)->get();
	}

	/**
	 * アクセスランキングリスト
	 *
	 * @param void
	 * @author shalman
	 * @return array
	 *
	 */
	function returnAccessRankingList(){
		$pv = $this->pv;
		$classes = $this->classes;
		$class_detail = array();

		$pv_ranking = $pv->orderBy("pv","desc")->take(10)->get();

		foreach ($pv_ranking as $v) {
			$class_id = $v->class_id;
			$class_detail[] = $classes->find($class_id);
		}

		return $class_detail;
	}

}
