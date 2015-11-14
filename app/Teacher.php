<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model {

	protected $table = "teachers";
	protected $primaryKey = "teacher_id";
	//
	public function classes(){
		return $this->belongsToMany('App\Classes','tr_classes_teachers','teacher_id','class_id');
	}

}
