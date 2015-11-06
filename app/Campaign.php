<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model {

	protected $primaryKey = 'camp_id';
	protected $fillable = ['user_id','camp_type'];

	public function users(){
		return $this->belongsTo('App\User');
	}
	/**
	*
	* キャンペーンエントリー数
	* 重複は認めないユーザー数
 	* @param int
	* @return int
	*
	**/
	public function totalEntry($id){
		return $this->distinct()->select('user_id')->where('camp_type','=',$id)->get()->count();
	}
}
