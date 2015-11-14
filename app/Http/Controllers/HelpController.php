<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Inquiry;
use App\Pv;
use Illuminate\Http\Request;

class HelpController extends Controller {

	protected $ranking;
	protected $inquiry;

	public function __construct(Pv $pv,Inquiry $inquiry){
		$this->pv = $pv;
		$this->inquiry = $inquiry;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$data['access_ranking'] = $this->pv->classPvRanking();
		return view('help/index',$data);
	}

	/**
	 * 問い合わせページ
	 *
	 * @return Response
	 * @author shalman
	 */
	public function getInquiry(){

		$data['access_ranking'] = $this->pv->classPvRanking();
		return view("help/inquiry",$data);
	}

	/**
	 * 問い合わせ処理
	 *
	 * @param Request
	 * @return Response
	 * @author shalman
	 *
	 */
	public function postInquiry(Request $request){
		//お問い合わせバリデーション
		$this->inquiryValidation($request);

		$model = $this->inquiry;

		$model->fill($request->all());
		//DB登録失敗
		if(!$model->save()){
			return redirect()->To("/");
		}

		$data["top_message"] = "送信に成功しました。<br>ありがとうございます！";
		return redirect()->To("/")->withInput($data);
		
	}

	/**
	 * マニュアルページ
	 *
	 * @param void
	 * @return Response
	 * @author shalman
	 *
	 */
	public function getManual(){

		$data['access_ranking'] = $this->pv->classPvRanking();
		return view("help/manual",$data);
	}

	/**
	 * お問い合わせバリデーション
	 *
	 * @param Request
	 * @return Response
	 * @author shalman
	 *
	 */
	public function inquiryValidation($request){
		return $this->validate($request,[
				"category" => "required",
				"inquiry_text" => "required|max:1000",
				"email"	=>	"required|email",
			]);
	}

}
