<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model {

	protected $table = 'review';
	protected $fillable = ['class_id','reviewer_id','grade','year','review_comment','stars','diff_teacher'];
}
