<?php namespace App\Http\Controllers;

use App\Classes;
use App\Review;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Input;

class ClassesController extends Controller {

	protected $classes;
	protected $review;


	public function __construct(Classes $classes,Review $review){
		$this->classes = $classes;
		$this->review = $review;
	}
	/**
	 * 授業詳細データ表示
	 *
	 * @param int 
	 * @author shalman
	 * @return null
	 *
	 */

	public function getIndex($id){

		$classes = $this->classes;

		$data['review'] = $this->returnReviewDetailByClassId($id);
		$data['detail'] = $classes->find($id);
		
		return view('classes/index')->with('data',$data);
	}

	public function getReview($id){

		$classes = $this->classes;

		$data['detail'] =  $classes->find($id);

		return view('classes/review')->with('data',$data);
	}

	public function postConfirm(Request $request){

		$data = $request->all();

		return view('classes/confirm')->with('data',$data);

	}

	public function postComplete(Request $request){

		$review = $this->review;

		$data = $request->all();
		$review->fill($data);
    	$review->save();

		return view('classes/complete');
	}

	public function getEdit(Request $request){

		$data['all'] = $request->all();
		$id = $data['all']['review_id'];
		$data['detail'] = $this->returnReviewDetailByReviewId($id);

		return view('classes/edit')->with('data',$data);
	}

	public function postEditconfirm(Request $request){

		$data = $request->all();

		return view('classes/editconfirm')->with('data',$data);

	}

	public function postEditcomplete(Request $request){
				
		$id = $request->review_id;
		$review = $this->review->find($id);

		$data = $request->all();

		$review->fill($data);
    	$review->save();

		return view('classes/editcomplete');
	}

	public function postDeleteconfirm(Request $request){

		$data = $request->all();
		$id = $data['review_id'];
		$data['detail'] = $this->returnReviewDetailByReviewId($id);

		return view('classes/deleteconfirm')->with('data',$data);

	}

	public function postDeletecomplete(Request $request){
				
		$id = $request->review_id;
		$review = $this->review->find($id);

		$review->delete();

		return view('classes/deletecomplete');
	}

	/**
	 * レビュー詳細をclass_idからリスト化してget
	 *
	 * @param int
	 * @author shalman
	 * @return object(many)
	 *
	 */

	function returnReviewDetailByClassId($id){

		$review = $this->review;

		$data = $review->where('class_id',$id)->orderBy('updated_at','desc')->get();
		return $data;
	}

	/**
	 * レビュー詳細をreview_idから1つだけget
	 *
	 * @param int
	 * @author shalman
	 * @return object
	 *
	 */
	function returnReviewDetailByReviewId($id){
		$review = $this->review;

		$data = $review->find($id);
		return $data;
	}
}
