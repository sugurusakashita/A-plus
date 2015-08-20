<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class CampaignController extends Controller {


	protected $ranking;

	public function __construct(RankingController $ranking){
		$this->ranking = $ranking;
	}

	/**
	 * キャンペーンインデックスページ
	 *
	 * @author shalman
	 * @return mixed
	 */
	public function getIndex($id){

		$data['search_ranking'] = $this->ranking->returnSearchRankingList();
		$data['access_ranking'] = $this->ranking->returnAccessRankingList();
		if($id == 1){
			return view("campaign/index")->with("data",$data);
		}else{
			return redirect()->to("/");
		}
	}


}
