<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Campaign;
use App\Review;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\ResetsPasswords;

use Illuminate\Http\Request;
use Auth;
use Hash;
use Session;

class MyPageController extends Controller {

	protected $user;
	protected $review;

	const CAMP_TYPE = 2;

	public function __construct(User $user,Request $request,Review $review){

		//ミドルウェアでゲストユーザをフィルタ
		$this->middleware('auth');
		if (!Auth::check()){
			//ログインチェック
			return redirect()->to("/auth/login");
		}
		//他人のレビューを改竄しようとしたユーザーをフィルタ
		$this->middleware("validReviewer",["only" => ["getEdit","postEditConfirm","postEditComplete","postDeleteConfirm","postDeleteComplete"]]);
		$user_id = $request->user()->user_id;

		$this->user = $user->find($user_id);
		$this->review = $review->where('user_id','=',$user_id)->get();
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex(Campaign $campaign)
	{
		$data['user'] = $this->user;
		$data['reviews'] = $this->review;

		// キャンペーン表示用
		$user = Auth::user();
		//キャンペーン2
		$reviewCount = $user->reviews()->count();

		//STEP2
		//キャンペーンをシェアしているか
		$step2 = false;
		foreach ($user->campaigns()->get() as $camp) {
			if($camp->camp_type == 2){
				$step2 = true;
				break;
			}
		}
		//STEP3
		//レビューは3件以上か
		$step3 = false;
		$data['diffReview'] = 0;
		if($reviewCount >= 3){
			$step3 = true;
		}else{
			$data['diffReview'] = 3 - $reviewCount;
		}

		$isEntry = ($step2 && $step3)? true:false;
		$data['camp2'] = array(
			'isEntry'	=>	$isEntry,
			'step2'	=>	$step2,
			'step3'	=>	$step3
		);


		$data['count'] = $campaign->totalEntry(self::CAMP_TYPE);

		return view('mypage/index')->with('data',$data);

	}
	public function postIndex(Request $request)
	{
		//バリデーション
		$validation = array();
		if(!is_null($request->name)){
			//必須かつ、ユニークかつ、20文字以下	
			$validation["name"] = "required|max:20|unique:users,name,".$request->user()->user_id.",user_id";
		}

		if(!is_null($request->email)){
			//必須かつ、ユニークかつ、255文字以下、メアド準拠
			$validation["email"] = "required|email|max:255|unique:users,email,".$request->user()->email.",email";
		}

		if(!is_null($request->entrance_year)){
			//必須
			$validation["entrance_year"] = "required";
		}	

		if(!is_null($request->faculty)){
			//必須
			$validation["faculty"] = "required";
		}	

		if(!is_null($request->sex)){
			//必須
			$validation["sex"] = "required";
		}

		$this->validate($request,$validation);

		$data['user'] = $this->user;
		$data['reviews'] = $this->review;

		$this->user->fill($request->all());
		$this->user->save();

		return view('mypage/index')->with('data',$data);

	}

	public function getAvatar(){

		$data['user'] = $this->user;

		return view('mypage/avatar')->with('data',$data);
	}
	public function postAvatarComplete(Request $request){

		$message = "プロフィール画像の変更が完了しました。";
		//設定されていない場合、NULL
		$avatar = $request->file('avatar');

		if(is_null($avatar)) {
			$this->user->avatar = NULL;
			$this->user->save();

			return redirect()->to('mypage/index')->withInput(array("message" => $message));
		}

		//例外処理
		if($avatar->getError() > 0){
			// $alert = $avatar->getErrorMessage();
			$alert = "画像が不正か、サイズが大きすぎる場合があります。";
			return redirect()->to('mypage/avatar')->withInput(array("alert" => $alert));
		}

		//バリデーション
		$validation["avatar"] = 'image|mimes:jpeg,jpg,gif,png|max:2000';
		$this->validate($request,$validation);


		//ユニークID付与
		$name = uniqid(rand());

		$file_name = $name.".".$avatar->guessClientExtension();
		$file = $avatar->move("avatar",$file_name);
		$path = asset("avatar/".$file_name);

		//ファイルパスをDBに保存
		$this->user->avatar = $path;
		$this->user->save();


		return redirect()->to('mypage/index')->withInput(array("message" => $message));

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

		$data['detail'] = $this->review->find($request->review_id);
		return view('mypage/edit')->with('data',$data);
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
		$review = $this->review->find($request->review_id);
		$data = $request->all();


		//レビューバリデーション
		$this->reviewValidation($request);

		return view('mypage/editconfirm')->with('data',$data)->with('review',$review);

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

		//戻る
		if(!is_null($request->_return)){
			return redirect()->to("/mypage/edit?review_id=".$request->review_id."&_token=".$request->_token)->withInput();
		}
		$id = $request->review_id;
		$review = $this->review->find($id);
		$req = $request->all();

		if(empty($req['attendance'])){
			$req['attendance'] = NULL;
		}
		if(empty($req['bring'])){
			$req['bring'] = NULL;
		}

		$review->fill($req);
    	$review->save();

    	$data["message"] = "レビューの編集が完了いたしました。";
		return redirect()->to("/mypage/index")->withInput($data);
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
		$data['detail'] = $this->review->find($id);

		return view('mypage/deleteconfirm')->with('data',$data);

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
		$review_id = $request->review_id;
		$review = $this->review->find($review_id);

		$review->delete();

    	$data["message"] = "レビューの削除が完了いたしました。";
		return redirect()->to("/mypage/index")->withInput($data);

	}

	/**
	 * レビューバリデーション
	 *
	 * @param request
	 * @author shalman
	 * @return mixed
	 *
	 */

	public function reviewValidation($request){
		return $this->validate($request,[
			// "grade" => "required",
			"stars" => "required",
			"unit_stars" => "required",
			"grade_stars" => "required",
			"fulfill_stars" => "required",
			"review_comment" => "required|min:10|max:500"
			]);
	}
}
