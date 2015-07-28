<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Session;
use Socialize;
use Illuminate\Http\Request;

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

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
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
	 * Twitter API OAuth 新規登録処理
	 * 
	 * @author shalman
	 * @return void
	 */
	public function getTwitterOauth(){

    	return Socialize::with('twitter')->redirect();

	}

	/**
	 * Twitter API Callback 新規登録処理
	 *
	 * @author shalman
	 * @return void
	 */
	public function getTwitterCallback(){

		$data = array();
		$social =  Socialize::with('twitter')->user();
		
		$data['message'] = "Twitterからの情報を取得しました";


		$data["social_id"] = $social->getId();
		$data["name"] = $social->getName();
		//TwitterAPIではEmail情報が取れないらしい。
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
			 return redirect()->to("/")->withInput($data);
		 }
		
		//更新しても消えないようにフラッシュに入れる
		//Session::put("callback",old("callback"));
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
