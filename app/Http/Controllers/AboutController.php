<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Pv;

use Illuminate\Http\Request;

class AboutController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	protected $pv;

	public function __construct(Pv $pv){
		$this->pv = $pv;
	}
	public function getIndex()
	{
		$data['access_ranking'] = $this->pv->classPvRanking();
		return view('about/index',$data);
	}
}
