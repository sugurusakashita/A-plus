<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassRegistered extends Model {

	//
	protected $table = 'class_registered';
	protected $primaryKey = 'class_registered_id';
	protected $fillable = ['user_id','class_name','faculty','credit','category','textbook','year','term'];

	public function users(){
		return $this->belongsTo('App\User', 'user_id');
	}

	public function class_registered_detail(){
		return $this->hasMany('App\ClassRegisteredDetail', 'class_registered_id');
	}

	public function classes(){
		return $this->belongsTo('App\Classes', 'class_name');
	}	

}
