<?php namespace App\Http\Controllers;

use App\Classes;
use App\Review;
use App\Pv;
use App\Teacher;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

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
		/*
		DB::enableQueryLog();
		$sql = DB::pretend(function(){
			Classes::find(512)->teachers;
		});
		*/
		//$classes->find(512);
		
		/*
		DB::listen(function($sql,$binding,$time){

			var_dump($sql);
		});
		*/

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

		$data['review'] = $this->review->where('class_id','=',$id)->get();
		$data['detail'] = $classes->find($id);
		$data['tag']['list'] 	= $tag->returnTagNamesByClassId($id); 
		$data['tag']['add_result'] = $request;
		$data['teacher'] = $this->classes->find($id)->teachers;
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
		if (!Auth::check()){
			//ログインチェック
			return redirect()->to("/auth/login");   
		}

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
		if (!Auth::check()){
			//ログインチェック
			return redirect()->to("/auth/login");   
		}
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
		if (!Auth::check()){
			//ログインチェック
			return redirect()->to("/auth/login");   
		}
		$review = $this->review;
		$data['id'] = $request->class_id;
		$req = $request->all();
		$req['user_id'] = $request->user()->user_id;
		$review->fill($req);
    	$review->save();


		return view('classes/complete')->with('data',$data);
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
		if (!Auth::check()){
			//ログインチェック
			return redirect()->to("/auth/login");   
		}
		$data['all'] = $request->all();
		$id = $data['all']['review_id'];
		$data['detail'] = $this->review->find($id);
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
		if (!Auth::check()){
			//ログインチェック
			return redirect()->to("/auth/login");   
		}
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
		if (!Auth::check()){
			//ログインチェック
			return redirect()->to("/auth/login");   
		}				
		$id = $request->review_id;
		$review = $this->review->find($id);

		$req = $request->all();

		$review->fill($req);
    	$review->save();

    	$data['id'] = $request->class_id;

		return view('classes/editcomplete')->with('data',$data);
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
		if (!Auth::check()){
			//ログインチェック
			return redirect()->to("/auth/login");   
		}
		$data = $request->all();
		$id = $data['review_id'];
		$data['detail'] = $this->review->find($id);

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
		if (!Auth::check()){
			//ログインチェック
			return redirect()->to("/auth/login");   
		}				
		$review_id = $request->review_id;
		$review = $this->review->find($review_id);

		$review->delete();

		$data['id'] = $request->class_id;
		return view('classes/deletecomplete')->with('data',$data);
	}

	/**
	 * レビュー詳細をclass_idからリスト化してget
	 *
	 * @param int
	 * @author shalman
	 * @return object(many)
	 *
	 */
/*
	function returnReviewDetailByClassId($id){

		$review = $this->review;

		$data = $review->where('class_id',$id)->orderBy('updated_at','desc')->get();
		return $data;
	}
*/

	/**
	 * 講師名をclass_idからget
	 *
	 * @param string
	 * @author shalman
	 * @return array
	 *
	 */
/*
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
	
		return $result;
		
	}
*/
}
