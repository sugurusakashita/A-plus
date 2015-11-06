<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model {

	protected $table = "inquiries";
	protected $fillable = ["email","category","inquiry_text"];
	protected $primaryKey = "inquiries_id";

}
