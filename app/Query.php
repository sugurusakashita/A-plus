<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Query extends Model {

	protected $table = "queries";
	protected $fillable = array("word","count");
	protected $primaryKey = "query_id";
	//

}
