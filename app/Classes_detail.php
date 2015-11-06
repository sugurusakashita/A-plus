<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes_detail extends Model {

	//
	protected $table = 'classes_detail';
	protected $primaryKey = 'id';

	public function classes(){
		return $this->belongsTo('App\Classes', 'class_id');
	}

}