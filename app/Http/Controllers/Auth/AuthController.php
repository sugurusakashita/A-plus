<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Session;
use Socialize;
use Illuminate\Http\Request;
use App\User;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	// デフォルトのリダイレクト先
	protected $redirectTo = '/';

	const AUTH_LOGIN_REDIRECT_ID = 'auth_login_redirect_id';

	//ソーシャルログイン用userデータ
	protected $user;
	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar,User $user)
	{
		$this->user = $user;
		$this->auth = $auth;
		$this->registrar = $registrar;

		// ユーザーが授業をレビューしようと思ってログイン処理を要求されたとき、
		// その授業レビューページへリダイレクトする
		if($id = Session::get(self::AUTH_LOGIN_REDIRECT_ID)){
			$this->redirectTo = '/classes/review/' . $id;
		}

		$this->middleware('guest', ['except' => 'getLogout']);
	}

	/**
	 * Twitter API OAuth リダイレクト処理
	 * 
	 * @author shalman
	 * @return void
	 */
	public function getTwitterOauth(){

    	return Socialize::with('twitter')->redirect();

	}

	/**
	 * Twitter API Callback 新規登録/ログイン処理
	 *
	 * @author shalman
	 * @return void
	 */
	public function getTwitterCallback(){

		$data = array();
		$user = $this->user;
		$social =  Socialize::with('twitter')->user();
		
		$data["social_id"] = $social->getId();
		//ログイン
		if($user = $user->where("social_id",'=',$data["social_id"])->first()){
			$this->auth->loginUsingId($user->user_id);
			return redirect()->intended($this->redirectTo);
		}
		$data['message'] = "Twitterからの情報を取得しました";
		$data["name"] = $social->getName();
		//TwitterAPIではEmail情報が取れないらしい。
		$data["email"] = $social->getEmail();
		$data["avatar_url"] = $social->getAvatar();
		//return view("auth/socialregister")->with("data",$data);
		return redirect()->to('/auth/social-register')->withInput($data);
		//return redirect()->to('/auth/register')->withInput($data);
	}

	/**
	 * Facebook API OAuth リダイレクト処理
	 * 
	 * @author shalman
	 * @return void
	 */
	public function getFacebookOauth(){

    	return Socialize::with('facebook')->redirect();

	}

	/**
	 * Facebook API Callback 新規登録/ログイン処理
	 *
	 * @author shalman
	 * @return void
	 */
	public function getFacebookCallback(){

		$data = array();
		$user = $this->user;
		$social =  Socialize::with('facebook')->user();
		$data["social_id"] = $social->getId();

		//ログイン
		if($user = $user->where("social_id",'=',$data["social_id"])->first()){
			$this->auth->loginUsingId($user->user_id);
			return redirect()->intended($this->redirectTo);
		}
		$data['message'] = "facebookからの情報を取得しました";
		$data["name"] = $social->getName();
		$data["email"] = $social->getEmail();
		$data["avatar_url"] = $social->getAvatar();
		//return view("auth/socialregister")->with("data",$data);
		return redirect()->to('/auth/social-register')->withInput($data);
		//return redirect()->to('/auth/register')->withInput($data);
	}
	/**
	 * ソーシャル登録フォーム
	 *
	 * @author shalman
	 * @return void
	 */
	public function getSocialRegister(){
		Session::reflash();
		var_dump(old());
		//例外処理
		if(!old("social_id")){
			$data["alert"] = "不正な手続きを検知しました。<br>お手数ですが、もう一度登録しなおしてください。";
			 return redirect()->to($this->redirectTo)->withInput($data);
		 }		
		$data['message'] = old("message");

		return view("auth/socialregister")->with("data",$data);
	}

	/**
	 * ソーシャル連携登録処理
	 *
	 * @author shalman
	 * @return void
	 */
	// public function postSocialRegister(Request $request){

	// 	$validator = $this->registrar->validator($request->all());
	// 	if ($validator->fails())
	// 	{
	// 		$this->throwValidationException(
	// 			$request, $validator
	// 		);
	// 	}
	// }
}
