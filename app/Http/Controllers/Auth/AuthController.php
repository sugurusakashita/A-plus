<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Session;
use Socialize;
use Illuminate\Http\Request;
use App\User;
use Auth;

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

	//const AUTH_LOGIN_REDIRECT_ID = 'auth_login_redirect_id';

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

		$this->middleware('guest', ['except' => ['getLogout','getDeleteAccount','postDeleteAccount']]);
		$this->middleware('auth', ['only' => ['getDeleteAccount','postDeleteAccount']]);
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
		$data['message'] = "Twitterから情報を取得しました";
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

		$data['message'] = "facebookから情報を取得しました";
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
		//更新してもフラッシュデータ保持
		Session::reflash();
		//例外処理
		if(!old("social_id")){
			$data["top_alert"] = "登録がタイムアウト、またはSNSサービス内のエラーです。<br>お手数ですが、もう一度登録しなおしてください。";
			return redirect()->to($this->redirectTo)->withInput($data);
		 }
		$data['message'] = old("message");

		return view("auth/socialregister")->with("data",$data);
	}

	/**
	 * 退会ページ
	 *
	 * @author shalman
	 * @return void
	 */
	public function getDeleteAccount(){
		//誤動作で削除しないように、(authからのリダイレクトなど)セッションで確認。
		Session::flash("delete_flg",1);

		return view("/auth/deleteaccount");
	}

	/**
	 * 退会処理
	 *
	 * @author shalman
	 * @return void
	 */
	public function postDeleteAccount(){
		if(!session("delete_flg")){
			$data["top_alert"] = "不正な手続きを検知しました。<br>退会処理は完了していませんので、もう一度お手続きをしてください。";
			return redirect()->To($this->redirectTo)->withInput($data);
		}

		// user_id取得
		$id = Auth::user()->user_id;

		//削除
		if($this->user->find($id)->delete()){
			$data["top_message"] = "退会が完了いたしました。<br>ご利用ありがとうございました。";
		}else{
			$data["top_alert"] = "退会処理の途中でエラーが発生しました。";
		}

		return redirect()->To($this->redirectTo)->withInput($data);

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
