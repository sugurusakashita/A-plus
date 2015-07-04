<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Review;

use Illuminate\Http\Request;
use Auth;

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
}
