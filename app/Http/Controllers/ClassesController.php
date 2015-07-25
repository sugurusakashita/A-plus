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

	// 公式シラバスURL用
	protected static $url_year = "2015";
	protected static $dep_name = "19";
	protected static $w_syllabus_url = "https://www.wsl.waseda.jp/syllabus/JAA104.php?pKey=";

	const REVIEW_POST_SESSION = 'review_post_session';
	const AUTH_LOGIN_REDIRECT_ID = 'auth_login_redirect_id';

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

		$data = array(
			'review'  => $this->review->reviews($id),
			'detail'  => $this->classes->find($id),
			'teacher' => $this->classes->find($id)->teachers,
			'tag' 	  => array(
					'list' 			 => $tag->returnTagNamesByClassId($id),
					'add_result' => $request
				),
			'search_ranking' => $this->ranking->returnSearchRankingList(),
			'access_ranking' => $this->ranking->returnAccessRankingList()
		);

		$data['attendance_pie'] 			= $this->makeJsonForPie($this->review->attendance($id),"attendance");
		$data['final_evaluation_pie'] = $this->makeJsonForPie($this->review->final_evaluations($id),"final_evaluation");
		$data['actual_syllabus_url']  = $this->makeActualSyllabusUrl($data['detail']);

		// ユニークPVカウント
		// 正しく動くかわからない…
		$this->countUniqueAccount($pv,$id);

		return view('classes/index')->with('data',$data);
	}

	/**
	 * 本家シラバス用のurlを作成
	 *
	 * @param array
	 * @author b-kaxa
	 * @return string
	 *
	 */

	public function makeActualSyllabusUrl($data){

		return self::$w_syllabus_url . $data['class_code'] . $data['class_no'] . self::$url_year . $data['class_code'] . self::$dep_name . "&pLng=jp";

	}

	/**
	 * 円グラフ用jsonに変換
	 *
	 * @param array, string
	 * @author shalman
	 * @return json
	 *
	 */

	public function makeJsonForPie($data,$type){
		$color = ["#e74c3c","#16a085","#2c3e50","#258cd1"];

		$result = NULL;
		for ($i=0; $i < $data->count(); $i++) {
		 	$type_name = $data[$i]->$type;
		 	$count = $data[$i]->total;

		 	$result[$i]["legend"] = $type_name;
		 	$result[$i]["value"] = $count;
		 	$result[$i]["color"] = $color[$i];
		}

		 if(is_null($result)){
		 	return null;
		 }
		 $result = json_encode($result, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE );

		 return $result;

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
		//ログインチェック
		if (!Auth::check()){
			Session::put(self::AUTH_LOGIN_REDIRECT_ID, $id);
			return redirect()->to("/auth/login");
		}

		// 二重投稿確認用
		Session::put(self::REVIEW_POST_SESSION, csrf_token());

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

		// 二重投稿のチェック
		if(!Session::get(self::REVIEW_POST_SESSION)){
			return redirect()->back()->withInput();
		}

		$data = $request->all();
		$data['detail'] = $this->classes->find($request->class_id);
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
	 * ユニークアカウントをカウント
	 *
	 * @param pv, id
	 * @author shalman
	 * @return none
	 *
	 */

	public function countUniqueAccount($pv,$id){
		if(!Session::has($id.'_pv')){
			if(is_null($record = $pv->where('class_id','=',$id)->first())){
				$pv['class_id'] = $id;
				$pv->save();
			}else{
				$record->increment('pv');
			}
			Session::put($id.'_pv',true);
		}
	}

	/**
	 * 総合評価度の平均値を返す
	 *
	 * @param id
	 * @author b-kaxa
	 * @return int
	 *
	 */

	public function getStarsAverage($id, Request $request){

		$sum = 0;
		$all_data = $this->review->reviews($id);

		// 全ての単位の取りやすさの値を合計する
		foreach ($all_data as $v) {
			$sum += $v['stars'];
		}

		// 平均値を返す
		return number_format($sum / count($all_data),1);
	}

	/**
	 * GPの取りやすさの平均値を返す
	 *
	 * @param id
	 * @author b-kaxa
	 * @return int
	 *
	 */

	public function getGradeAverage($id, Request $request){

		$sum = 0;
		$all_data = $this->review->reviews($id);

		// 全てのGPの取りやすさの値を合計する
		foreach ($all_data as $v) {
			$sum += $v['grade_stars'];
		}

		// 平均値を返す
		return number_format($sum / count($all_data),1);
	}

	/**
	 * 単位の取りやすさの平均値を返す
	 *
	 * @param id
	 * @author b-kaxa
	 * @return int
	 *
	 */

	public function getCreditAverage($id, Request $request){

		$sum = 0;
		$all_data = $this->review->reviews($id);

		// 全ての単位の取りやすさの値を合計する
		foreach ($all_data as $v) {
			$sum += $v['unit_stars'];
		}

		// 平均値を返す
		return number_format($sum / count($all_data),1);
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
