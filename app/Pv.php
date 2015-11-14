<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Pv extends Model {
	protected $table = "pvs";
	protected $primaryKey = "pv_id";

	public function classes(){
		return $this->belongsTo('App\classes','class_id');
	}

	/**
	 * 授業ランキング
	 *
	 * @author shalman
	 * @return Array
	 */
	public function classPvRanking()
	{
		$res = array();
		foreach ($this->orderBy("pv","desc")->take(10)->get() as $pv) {
			$res[] = $pv->classes()->first();
		}
		return $res;
	}

}
