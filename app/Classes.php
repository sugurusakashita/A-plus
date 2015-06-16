<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model {

	//
	protected $table = 'classes';
	protected $primaryKey = 'class_id';

	public function teachers(){
		return $this->belongsToMany('App\teacher','tr_classes_teachers','class_id','teacher_id');
	}

}
