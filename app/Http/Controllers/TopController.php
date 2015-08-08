<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Session;

class TopController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data["message"] = old("top_message") ?: Session::pull("top_message");

 		//不正アクセスアラートを受け取る
  		$data["alert"] = old("top_alert");

		return view('top/index')->with("data",$data);

	}


}
