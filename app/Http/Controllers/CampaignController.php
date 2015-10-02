<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Campaign;
use Auth;
use URL;

use Illuminate\Http\Request;

class CampaignController extends Controller {

	const CAMP_TYPE = 2;

	protected $ranking;
	protected $campaign;

	/**
	 * キャンペーンコンストラクタ
	 *
	 * @author shalman
	 * @return mixed
	 */
	public function __construct(RankingController $ranking,Campaign $campaign){
		$this->ranking = $ranking;
		$this->campaign = $campaign;
		//$this->middleware("auth",["only" => ["postEntry"]]);
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
		$data["twitter_url"] = $this->makeTwitterUrl();
		$data["facebook_url"] = $this->makeFacebookUrl();

		if(Auth::check()){
			$user = Auth::user();
			//キャンペーン2
			$reviewCount = $user->reviews()->count();

			//STEP2
			//キャンペーンをシェアしているか
			$step2 = false;
			foreach ($user->campaigns()->get() as $camp) {
				if($camp->camp_type == 2){
					$step2 = true;
					break;
				}
			}
			//STEP3
			//レビューは3件以上か
			$step3 = false;
			$data['diffReview'] = 0;
			if($reviewCount >= 3){
				$step3 = true;
			}else{
				$data['diffReview'] = 3 - $reviewCount;
			}

			$isEntry = ($step2 && $step3)? true:false;
			$data['camp2'] = array(
				'isEntry'	=>	$isEntry,
				'step2'	=>	$step2,
				'step3'	=>	$step3
			);
		}

		$data['count'] = $this->campaign->totalEntry(self::CAMP_TYPE);
		return view('campaign/camp'.$id)->with("data",$data);
	}

	/**
	 * シェアしてエントリー
	 *
	 * @author shalman
	 * @return mixed
	 */
	public function postEntry(){

		$camp = $this->campaign;

		$user = Auth::user();
		$res["user_id"] = $user->user_id;
		$res["camp_type"] = self::CAMP_TYPE;

		$camp->fill($res);
		$camp->save();
		//return "シェアが完了しました！キャンペーンの条件3を達成！";
		return "";
	}

	/**
	 * TwitterのオリジナルURLを作成
	 *
	 * @author shalman
	 * @return string
	 */
	public function makeTwitterUrl(){
		$base_url = "https://twitter.com/share?";
		$option = array(
			"url" => urlencode(URL::current()),
			"via" => urlencode("waseda_Aplus"),
			"text" => urlencode("早稲田所キャンレビューサイトA+plus 第２弾 会員登録・レビューでAmazonギフト券1000円分プレゼントキャンペーン!!"),
			// "related" => urlencode("waseda_Aplus"),
			"lang" => urlencode("ja"),
			"hashtags" => urlencode("エイプラ"),
		);
		foreach ($option as $k => $v) {
			//クエリパラメータ生成
			$base_url .= $k."=".$v."&";
		}
		return rtrim($base_url,"&");
	}

	/**
	 * FacebookのオリジナルURLを作成
	 *
	 * @author shalman
	 * @return string
	 */
	public function makeFacebookUrl(){
		$base_url = "https://www.facebook.com/sharer/sharer.php?";
		$shared_uri = urlencode(URL::current());

		return $base_url."u=".$shared_uri."&action=recommend";
	}
}
