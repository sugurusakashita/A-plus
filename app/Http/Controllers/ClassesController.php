<?php namespace App\Http\Controllers;

use App\Classes;
use App\Review;
use App\Pv;
use App\Teacher;
use App\Classes_detail;

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
	protected static $dep_name = array(
			"人間科学部"	=> "19",
			"スポーツ科学部"	=> "20",
			"政治経済学部" => "11",
			"教育学部" => "15",
			"商学部" => "16",
			"社会科学部" => "18",
			"法学部" => "12",
			// "文学部" => "24",
			// "文化構想学部" =>
		);
	protected static $w_syllabus_url = "https://www.wsl.waseda.jp/syllabus/JAA104.php?pKey=";

	protected $color = ["#16a085","#91C5E6","#e74c3c","#258cd1"];

	const REVIEW_POST_SESSION = 'review_post_session';

	//const AUTH_LOGIN_REDIRECT_ID = 'auth_login_redirect_id';

	public function __construct(Classes $classes,Review $review,Teacher $teacher,RankingController $ranking,Classes_detail $classes_detail){
		$this->classes = $classes;
		$this->review = $review;
		$this->ranking = $ranking;
		$this->teacher = $teacher;
		$this->classes_detail = $classes_detail;

		//Authフィルタのホワイトリスト
		$this->middleware("auth",["only" => ['postAjaxReview']]);
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
			'detail_wpr' => $this->classes_detail->where('class_id','=',$id)->first(),
			'teacher' => $this->classes->find($id)->teachers,
			'tag' 	  => array(
					'list' 			 => $tag->returnTagNamesByClassId($id),
					'add_result' => $request
				),
			'search_ranking' => $this->ranking->returnSearchRankingList(),
			'access_ranking' => $this->ranking->returnAccessRankingList()
		);



		// ユーザーのログイン状態によってレビューするボタンを出し分ける
		if (Auth::check()) {
			$data['wrote_review'] = $this->review->wrote_review($id, $request->user()->user_id);
		} else {
			$data['wrote_review'] = false;
		}
		$data['evaluation'] = $this->makeEvaluationData($data['detail']); 
		$data['attendance_data'] 	  = $this->makeAvarageData($this->review->attendance($id),"attendance");
		$data['bring_data'] 	  = $this->makeAvarageData($this->review->bring($id),"bring");
		//$data['final_evaluation_pie'] = $this->makeAvarageData($this->review->final_evaluations($id),"final_evaluation");
		$data['actual_syllabus_url']  = $this->makeActualSyllabusUrl($data['detail']);

		// ユニークPVカウント
		$this->countUniqueAccount($pv,$id);

		return view('classes/index',$data);
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

		return self::$w_syllabus_url . $data['class_code'] . $data['class_no'] . self::$url_year . $data['class_code'] . self::$dep_name[$data["faculty"]] . "&pLng=jp";

	}

	/**
	 * レビューデータから平均値を含むJSONを作成
	 *
	 * @param array, string
	 * @author shalman
	 * @return json
	 *
	 */

	public function makeAvarageData($data,$type){

		$result = NULL;
		for ($i=0; $i < $data->count(); $i++) {
		 	$type_name = $data[$i]->$type;
		 	$count = $data[$i]->total;

		 	$result[$i]["legend"] = $type_name;
		 	$result[$i]["value"] = $count;
		 	$result[$i]["color"] = $this->color[$i];
		}

		 if(is_null($result[0]["legend"])){
		 	return null;
		 }
		 $result = json_encode($result, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE );

		 return $result;

	}

	/**
	 * makeEvaluationData
	 * 成績評価を授業データから配列に変換
	 *
	 * @param mixed
	 * @author shalman
	 * @return array
	 *
	 */

	public function makeEvaluationData($data){
		//公式の総合評価法全て
		$col = array(
			"exam" => "試験",
			"report" => "レポート",
			"attitude" => "平常点評価",
			"other" => "その他");
		$result = null;

		for ($i=0; $i < count($col); $i++) {

			//exam,report,attitude,otherのいずれか
			$value = array_keys($col)[$i];
			//試験,レポート,,のいずれか
			$legend = array_values($col)[$i];

			if(!$data->$value){
				// 0%だった場合パス
				continue;
			}
			$result[$i]["legend"]	=	$legend;
			$result[$i]["value"]	= 	$data->$value; 
			$result[$i]["color"] 	=	$this->color[$i];
		}

		if(is_null($result)){
			return null;
		}
		//配列リセット
		$result = array_values($result);
		//JSON変換
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

	public function getStarsAverage($id){

		return $this->calcAverage($id, 'stars');
	}

	/**
	 * GPの取りやすさの平均値を返す
	 *
	 * @param id
	 * @author b-kaxa
	 * @return int
	 *
	 */

	public function getGradeAverage($id){

		return $this->calcAverage($id, 'grade_stars');
	}

	/**
	 * 単位の取りやすさの平均値を返す
	 *
	 * @param id
	 * @author b-kaxa
	 * @return int
	 *
	 */

	public function getCreditAverage($id){

		return $this->calcAverage($id, 'unit_stars');
	}

	/**
	 * 平均値を返す
	 *
	 * @param id 授業id
	 * @param key 取得したい項目
	 * @author b-kaxa
	 * @return int
	 *
	 */

	public function calcAverage($id, $key){
		$sum = 0;
		$all_data = $this->review->reviews($id);

		// 全ての単位の取りやすさの値を合計する
		foreach ($all_data as $v) {
			$sum += $v[$key];
		}

		if (0 === $sum) {
			return $sum;
		} else {
			// 平均値を返す
			return number_format($sum / count($all_data),1);
		}
	}

	/**
	 * 授業レビュー投稿完了
	 *
	 * @param Request
	 * @author shalman
	 * @return JSON or null
	 *
	 */

	public function postAjaxReview(Request $request,MyPageController $mypage){
		//ajax以外のアクセスを禁止
		if(!$request->ajax()){
 			return null;
		}

		//レビューバリデーション
		$mypage->reviewValidation($request);

		$user = Auth::user();
		$request["user_id"] = $user->user_id;

		$review = $this->review;

		$req = $request->all();

		if(empty($req['attendance'])){
			$req['attendance'] = NULL;
		}
		if(empty($req['bring'])){
			$req['bring'] = NULL;
		}

		$review->fill($req);
		if($review->save()){
			$data["success"] = true;
			$data["message"] = "レビューが完了しました！<br>ありがとうございます！";
		}else{
			$data["success"] = false;
			$data["message"] = "レビューの登録に失敗しました。";
		}

		$data["name"] = $user->name;
		$data["avatar"] = $user->avatar;

		return json_encode($data);

	}

}
