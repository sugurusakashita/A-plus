<?php namespace App\Http\Controllers;

use App\Classes;
use App\Review;
use App\Pv;
use App\Teacher;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Input;
use Session;
use DB;

class ClassesController extends Controller {

	protected $classes;
	protected $review;
	protected $ranking;
	protected $teacher;


	public function __construct(Classes $classes,Review $review,Teacher $teacher,RankingController $ranking){
		$this->classes = $classes;
		$this->review = $review;
		$this->ranking = $ranking;
		$this->teacher = $teacher;

	}

	/**
	 * 授業詳細データ表示
	 *
	 * @param int (URI segment),Pv
	 * @author shalman
	 * @return view
	 *
	 */

	public function getIndex($id,Pv $pv,TagController $tag,Request $request){

		$classes = $this->classes;

		$data['review'] = $this->returnReviewDetailByClassId($id);
		$data['detail'] = $classes->find($id);
		$data['tag']['list'] 	= $tag->returnTagNamesByClassId($id); 
		$data['tag']['add_result'] = $request;
		$data['teacher'] = $this->returnTeachersNameByClassId($id);
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

	public function postIndex($id,TagController $tag,Request $request){
		$get_str　= "";
		if($request->add_tag_name){
			$result = $tag->addTag($id,$request->add_tag_name);
			$get_str = "?added_tag=".$result;
		}
		if($request->delete_tag_name){
			$result = $tag->deleteTag($id,$request->delete_tag_name);
			$get_str = "?deleted_tag=".$result;
		}

		return redirect()->to("/classes/index/".$id.$get_str);
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

	public function postEditConfirm(Request $request){

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

	public function postEditComplete(Request $request){
				
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

	public function postDeleteConfirm(Request $request){

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

	public function postDeleteComplete(Request $request){
				
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

	/**
	 * 講師名をclass_idからget
	 *
	 * @param string
	 * @author shalman
	 * @return array
	 *
	 */

	function returnTeachersNameByClassId($class_id){

		$classes = $this->classes;
		$teacher = $this->teacher;

		//例外処理
		//$teacher_ids = $classes->select("teacher_ids")->where("id",$class_id)->first()->teacher_ids;
		$teacher_ids = $classes->find($class_id)->teacher_ids;
		if(!$teacher_ids){
			return null;
		}
		$array_ids = explode(",",$teacher_ids);
		foreach ($array_ids as $teacher_id) {
			//$result[] = $teacher->select("teacher_name")->where("id",$teacher_id)->first()->teacher_name;
			$result[] = $teacher->find($teacher_id)->teacher_name;
		}
/*
		$sql = DB::pretend(function(){

		});
*/		
		return $result;
		
	}
}
