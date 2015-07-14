<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model {

	protected $table = 'reviews';
	protected $fillable = ['class_id','user_id','grade','year','review_comment','stars','unit_stars','grade_stars','final_evaluation','attendance','bring','diff_teacher'];
	protected $primaryKey = 'review_id';

	public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function classes()
    {
        return $this->belongsTo('App\Classes','class_id');
    }

}
