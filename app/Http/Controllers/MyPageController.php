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

class MyPageController extends Controller {

	protected $user;
	protected $review;


	public function __construct(User $user,Request $request,Review $review){
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
		if (!Auth::check()){
			//ログインチェック
			return redirect()->to("/auth/login");   
		}
		$data['user'] = $this->user;
		$data['reviews'] = $this->review;

		return view('mypage/index')->with('data',$data);

	}
	public function postIndex(Request $request)
	{
		if (!Auth::check()){
			//ログインチェック
			return redirect()->to("/auth/login");   
		}

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
/*
	public function getChangePassword(){
		if (!Auth::check()){
			//ログインチェック
			return redirect()->to("/auth/login");   
		}

		$data['user'] = $this->user;
		$data['reviews'] = $this->review;

		return view('mypage/password')->with('data',$data);
	}

	public function postChangePasswordComplete(Guard $auth,Request $request){
		if (!Auth::check()){
			//ログインチェック
			return redirect()->to("/auth/login");   
		}


		if(Hash::check($request->old_password,$this->user->password)){
			echo "yes";
			return null;
		}
		echo "no";
		return null;


		$this->validate($request,[
				'_token' => 'required',
				'old_password' => 'required|exists:users,password',
				'password' => 'required|confirmed|min:6',
			]);


		return view('mypage/passwordcomplete')->with('data',$data);
	}
	*/
}
