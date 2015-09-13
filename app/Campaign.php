<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model {

	protected $primaryKey = "camp_id";
	protected $fillable = ["user_id","camp_type"];
}
