<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AboutController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	protected $ranking;

	public function __construct(RankingController $ranking){
		$this->ranking = $ranking;
	}
	public function getIndex()
	{
		$data['search_ranking'] = $this->ranking->returnSearchRankingList();
		$data['access_ranking'] = $this->ranking->returnAccessRankingList();
		return view('about/index',$data);
	}
}
