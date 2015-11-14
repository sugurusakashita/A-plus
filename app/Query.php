<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Query extends Model {

	protected $table = "queries";
	protected $fillable = array("word","count");
	protected $primaryKey = "query_id";
	//

	/**
	 * ランキングリスト
	 *
	 * @param void
	 * @author shalman
	 * @return array
	 *
	 */

	function returnSearchRankingList(){
		return $this->orderBy("count","desc")->take(10)->get();
	}

}
