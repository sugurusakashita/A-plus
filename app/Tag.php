<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

	protected $table = "tags";
	protected $filable = ["class_id","tag_name"];

}
