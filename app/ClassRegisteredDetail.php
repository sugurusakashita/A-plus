<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassRegisteredDetail extends Model {

	//
	protected $table = 'class_registered_detail';
	protected $primaryKey = 'id';
	protected $fillable = ['class_registered_id','class_week','class_period','room_name'];

	public function class_registered(){
		return $this->belongsTo('App\ClassRegistered', 'class_registered_id');
	}
}
