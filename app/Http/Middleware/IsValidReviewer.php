<?php namespace App\Http\Middleware;

use Closure;
use App\Review;


class IsValidReviewer {

	protected $review;

	/**
	 * IsValidReviewer
	 * 不正なユーザーをフィルタする
	 *
	 * @param  App\Review $review
	 * @return void
	 */

	public function __construct(Review $review)
	{
		$this->review = $review;
	}
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request,Closure $next)
	{
		//アクセスしている授業ID
		$review_id = $request->review_id;
		//リクエストしたユーザーのID
		$login_user_id = $request->user()->user_id;
		//レビューからレビューしたユーザーのIDを取得
		$reviewer_id = $this->review->find($review_id)->users()->first()->user_id;


		//一致しなければ不正アクセス
		if($reviewer_id !== $login_user_id){
			$data["top_alert"] = "不正なアクセスを検知しました。";
 			return redirect()->to("/")->withInput($data);
		}

		return $next($request);
	}

}
