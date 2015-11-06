<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model {

	//
	protected $table = 'classes';
	protected $primaryKey = 'class_id';

	public function teachers(){
		return $this->belongsToMany('App\Teacher','tr_classes_teachers','class_id','teacher_id');
	}
	
	public function classes_detail(){
		return $this->hasMany('App\Classes_detail','class_id');
	}

}
