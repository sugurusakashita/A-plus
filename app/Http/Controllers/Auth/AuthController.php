<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Session;

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

}
