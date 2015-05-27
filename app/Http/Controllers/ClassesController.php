<?php namespace App\Http\Controllers;

use App\Classes;
use App\Review;
use App\Pv;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Input;
use Session;

class ClassesController extends Controller {

	protected $classes;
	protected $review;
	protected $ranking;


	public function __construct(Classes $classes,Review $review,RankingController $ranking){
		$this->classes = $classes;
		$this->review = $review;
		$this->ranking = $ranking;

	}

	/**
	 * 授業詳細データ表示
	 *
	 * @param int (URI segment),Pv
	 * @author shalman
	 * @return view
	 *
	 */

	public function getIndex($id,Pv $pv){

		$classes = $this->classes;

		$data['review'] = $this->returnReviewDetailByClassId($id);
		$data['detail'] = $classes->find($id);
		$data['search_ranking'] = $this->ranking->returnSearchRankingList();
		$data['access_ranking'] = $this->ranking->returnAccessRankingList();
		//ユニークPVカウント
		if(!Session::has($id.'_pv')){
			if(is_null($record = $pv->where('class_id','=',$id)->first())){
				$pv['class_id'] = $id;
				$pv->save();
			}else{
				$record->increment('pv');
			}
			Session::put($id.'_pv',true);
		}

		return view('classes/index')->with('data',$data);
	}

	/**
	 * 授業レビュー投稿
	 *
	 * @param int (URI segment)
	 * @author shalman
	 * @return view
	 *
	 */

	public function getReview($id){

		$classes = $this->classes;

		$data['detail'] =  $classes->find($id);

		return view('classes/review')->with('data',$data);
	}

	/**
	 * 授業レビュー投稿確認
	 *
	 * @param Request
	 * @author shalman
	 * @return view
	 *
	 */

	public function postConfirm(Request $request){

		$data = $request->all();

		return view('classes/confirm')->with('data',$data);

	}

	/**
	 * 授業レビュー投稿完了
	 *
	 * @param Request
	 * @author shalman
	 * @return view
	 *
	 */

	public function postComplete(Request $request){

		$review = $this->review;

		$data = $request->all();
		$review->fill($data);
    	$review->save();

		return view('classes/complete');
	}

	/**
	 * 授業レビュー再編集
	 *
	 * @param Request
	 * @author shalman
	 * @return view
	 *
	 */

	public function getEdit(Request $request){

		$data['all'] = $request->all();
		$id = $data['all']['review_id'];
		$data['detail'] = $this->returnReviewDetailByReviewId($id);

		return view('classes/edit')->with('data',$data);
	}


	/**
	 * 授業レビュー再編集確認
	 *
	 * @param Request
	 * @author shalman
	 * @return view
	 *
	 */

	public function postEditconfirm(Request $request){

		$data = $request->all();

		return view('classes/editconfirm')->with('data',$data);

	}


	/**
	 * 授業レビュー再編集完了
	 *
	 * @param Request
	 * @author shalman
	 * @return view
	 *
	 */

	public function postEditcomplete(Request $request){
				
		$id = $request->review_id;
		$review = $this->review->find($id);

		$data = $request->all();

		$review->fill($data);
    	$review->save();

		return view('classes/editcomplete');
	}


	/**
	 * 授業レビュー削除
	 *
	 * @param Request
	 * @author shalman
	 * @return view
	 *
	 */

	public function postDeleteconfirm(Request $request){

		$data = $request->all();
		$id = $data['review_id'];
		$data['detail'] = $this->returnReviewDetailByReviewId($id);

		return view('classes/deleteconfirm')->with('data',$data);

	}

	/**
	 * 授業レビュー削除完了
	 *
	 * @param Request
	 * @author shalman
	 * @return view
	 *
	 */

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
