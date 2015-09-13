<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Campaign;
use Auth;
use URL;

use Illuminate\Http\Request;

class CampaignController extends Controller {


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
		if($id == 1){
			return view("campaign/index")->with("data",$data);
		}else{
			return redirect()->to("/");
		}
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
		$res["camp_type"] = 1;

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
			"via" => urlencode("waseda_Aplus"),
			"text" => urlencode("早稲田所キャンレビューサイトA+plus 会員登録・レビューでAmazonギフト券1000円分プレゼントキャンペーン!!"),
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
