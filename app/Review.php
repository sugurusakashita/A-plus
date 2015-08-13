<?php namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Review extends Model {

	protected $table = 'reviews';
	protected $fillable = ['class_id','user_id','grade','year','review_comment','stars','unit_stars','grade_stars','fulfill_stars','final_evaluation','attendance','bring'];
	protected $primaryKey = 'review_id';

	public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function classes()
    {
        return $this->belongsTo('App\Classes','class_id');
    }

    // その授業のレビュー全てを取得する
    public function reviews($id)
    {
        return $this->where('class_id','=',$id)->get();
    }

    public function attendance($id)
    {
        return $this->select(DB::raw('attendance, count(attendance) as total'))->where('class_id','=',$id)->groupBy('attendance')->get();
    }

    public function bring($id)
    {
        return $this->select(DB::raw('bring, count(bring) as total'))->where('class_id','=',$id)->groupBy('bring')->get();
    }
    public function final_evaluations($id)
    {
        return $this->select(DB::raw('final_evaluation, count(final_evaluation) as total'))->where('class_id','=',$id)->groupBy('final_evaluation')->get();
    }

    // そのユーザーはレビューを書いているか否か
    public function wrote_review($class_id, $user_id)
    {
        $count = count($this->where('class_id',$class_id)->where('user_id',$user_id)->get());

        // そのユーザーのレビュー件数が0なら
        if (0 === $count) {
            return false;
        } else {
            return true;
        }
    }


}
