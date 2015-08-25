<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
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


	public function __construct(User $user,Request $request,Review $review){

		//ミドルウェアでゲストユーザをフィルタ
		$this->middleware('auth');	
		if (!Auth::check()){
			//ログインチェック
			return redirect()->to("/auth/login");
		}
		$user_id = $request->user()->user_id;

		$this->user = $user->find($user_id);
		$this->review = $review->where('user_id','=',$user_id)->get();
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$data['user'] = $this->user;
		$data['reviews'] = $this->review;

		//$data['message'] = $request->message;
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

		$data['user'] = $this->user;
		$data['reviews'] = $this->review;
		$message = "プロフィール画像の変更が完了しました。";

		//設定されていない場合、NULL
		$avatar = $request->file('avatar');


		if(is_null($avatar)) {
			$data['user']->avatar = NULL;
			$data['user']->save();

			return redirect()->to('mypage/index')->withInput(array("message" => $message));
		}


		//バリデーション
		$validation["avatar"] = 'image|mimes:jpeg,jpg,gif,png|max:1500';
		$this->validate($request,$validation);

		//念のためサニタイズとSHA-1でハッシュ化
		$name = sha1(htmlspecialchars($data['user'],ENT_QUOTES));
		$file_name = $name.".".$avatar->guessClientExtension();
		$file = $avatar->move("avatar",$file_name);
		$path = asset("avatar/".$file_name);

		//ファイルパスをDBに保存
		$data['user']->avatar = $path;
		$this->user->save();


		return redirect()->to('mypage/index')->withInput(array("message" => $message));

	}
}
