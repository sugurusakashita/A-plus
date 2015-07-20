<?php namespace App;

use DB;
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

    // こいつらをここに置くのは正しいのか否か
    public function reviews($id)
    {
        return $this->where('class_id','=',$id)->get();
    }

    public function attendance($id)
    {
        return $this->select(DB::raw('attendance, count(attendance) as total'))->where('class_id','=',$id)->groupBy('attendance')->get();
    }

    public function final_evaluations($id)
    {
        return $this->select(DB::raw('final_evaluation, count(final_evaluation) as total'))->where('class_id','=',$id)->groupBy('final_evaluation')->get();
    }


}
