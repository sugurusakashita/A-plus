<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Classes;
use App\Campaign;
use App\Classes_detail;
use App\Inquiry;
use App\Query;
use App\Review;
use App\Tag;
use App\Teacher;
use App\User;

class ApiController extends Controller {

	protected $classes,$campaign,$classes_detail,$inquiry,$query,$review,$tag,$teacher,$user;

	public function __construct(Classes $classes,Campaign $campaign,Classes_detail $classes_detail,Inquiry $inquiry,Query $query,Review $review,Tag $tag,Teacher $teacher,User $user){
		//TODO:middlewareでAPI以外のアクセス禁止
		$this->classes = $classes;
		$this->campaign = $campaign;
		$this->classes_detail = $classes_detail;
		$this->inquiry = $inquiry;
		$this->query = $query;
		$this->review = $review;
		$this->tag = $tag;
		$this->teacher = $teacher;
		$this->user = $user;
	}

	/**
	 * ApiRoot
	 *
	 * @author shalman
	 * @return Response
	 */
	public function getIndex()
	{
		//
		echo "API ROOT";
	}

	/**
	 * 授業IDから授業情報を取得
	 *
	 * @param  int
	 * @author shalman
	 * @return Response
	 */
	public function getClasses($class_id = null){
		$classes = $this->classes;
		if($class_id){
			return json_encode($classes->find($class_id));
		}
		return json_encode($classes->get());
	}

	/**
	 * 授業IDから紐づくレビューを取得
	 *
	 * @param  int
	 * @author shalman
	 * @return Response
	 */
	public function getReviews($class_id = null){
		$review = $this->review;
		dd($review->get());
		if($class_id){
			return json_encode($review->reviews($class_id));
		}
		return json_encode($review->get());
	}
	/**
	 * 検索
	 *
	 * @param  String
	 * @param  String
	 * @param  String
	 * @param  String
	 * @param  String
	 * @author shalman
	 * @return Response
	 */
	public function getSearch(Request $req){

		//テスト変数
		// $word = "玉城 java";
		// $faculty = "人間科学部";
		// $day = null;
		// $period = null;
		// $term = null;

		dd($this->classes->search($word,$faculty)->get());
	}
// // 簡易検索
// Route::get('/api/search/{word}', function($word){
// 		$classes = DB::table('classes')
// 			->where('class_name', 'LIKE', '%'.$word.'%')->get();
// 		return Response::json($classes);
// });


}
