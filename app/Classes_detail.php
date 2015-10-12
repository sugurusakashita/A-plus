<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes_detail extends Model {

	//
	protected $table = 'classes_detail';
	// protected $primaryKey = 'id';

	// public function teachers(){
	// 	return $this->belongsToMany('App\Teacher','tr_classes_teachers','class_id','teacher_id');
	// }
	public function classes(){
		return $this->belongsTo('App/Classes', 'class_id');
	}

}