<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tag;
use App\Classes;

use Illuminate\Http\Request;

class TagController extends Controller {

	protected $tag;
	protected $classes;
	protected $ranking;



	public function __construct(Tag $tag,Classes $classes,RankingController $ranking){
		$this->tag = $tag;
		$this->classes = $classes;
		$this->ranking = $ranking;

	}

	/**
	 * タグ一覧ページ
	 *
	 * @param $id(int)
	 * @author shalman
	 * @return view
	 *
	 */

	public function getAdd($id){
		$tag = $this->tag;

		$data['tag_names'] = $this->returnTagNames();
		$data['detail'] = $this->classes->find($id);
		$data['search_ranking'] = $this->ranking->returnSearchRankingList();
		$data['access_ranking'] = $this->ranking->returnAccessRankingList();

		return view('tag/index',$data);
	}

	public function returnTagNamesByClassId($class_id){
		$tag = $this->tag;

		$tag_ids = $tag->where("class_id",$class_id)->get();

		if(!$tag_ids->first()){
			return null;
		}
		foreach ($tag_ids as $v) {
			$tag_names[] = $v;
		}
		
		return $tag_names;
		
	}

	public function returnTagNames(){
		$tag = $this->tag; 

		$tag_names = $tag->distinct()->select('tag_name')->get();
		$result = array();
		foreach ($tag_names as $v) {
			$result[] = $v;
		}

		return $result;
	}

	/**
	 * Ajax用タグ追加メソッド
	 *
	 * @param string
	 * @param string
	 * @author shalman
	 * @return JSON
	 *
	 */

	public function postNew(){
		//ajax以外のアクセスを禁止
		$request = isset($_SERVER['HTTP_X_REQUESTED_WITH']) ? strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) : '';
		if($request !== 'xmlhttprequest') exit;

		header('Content-Type: application/json; charset=UTF-8');

		//ajaxからのリクエスト取得
		$class_id = $_POST["class_id"];
		$tag_name = $_POST["tag_name"];

		$tag = $this->tag;

		// 例外処理系
		//すでにタグが存在する場合
		if($tag->where("class_id","=",$class_id)->where("tag_name","=",$tag_name)->first()){
			$data["success"] = false;
			$data["message"] = "すでにタグが存在します。";
			return json_encode($data);
		}
		//空文字、スペースのみはタグとして認めない
		if(empty(trim($tag_name))){
			$data["success"] = false;
			$data["message"] = "タグが入力されていません。";
			return json_encode($data);			
		}
		//タグは10個まで
		if($tag->where("class_id","=",$class_id)->count() >= 10){
			$data["success"] = false;
			$data["message"] = "タグは10個までです。<br>追加するには、既存のタグを削除してください。";
			return json_encode($data);
		}
		//タグの文字列は20文字以内
		if(mb_strlen($tag_name) > 20){
			$data["success"] = false;
			$data["message"] = "タグは20文字以内で入力してください";
			return json_encode($data);
		}
		//タグ追加
		$tag->class_id = $class_id;
		$tag->tag_name = $tag_name;
		$result = $tag->save();

		$data["success"] = $result;
		$data["message"] = $result == true? "タグを追加しました！":"タグの追加に失敗しました。";

		return json_encode($data);

	}

	/**
	 * Ajax用タグ削除メソッド
	 *
	 * @param string
	 * @param string
	 * @author shalman
	 * @return JSON
	 *
	 */

	public function postDelete(){
		//ajax以外のアクセスを禁止
		$request = isset($_SERVER['HTTP_X_REQUESTED_WITH']) ? strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) : '';
		if($request !== 'xmlhttprequest') exit;

		header('Content-Type: application/json; charset=UTF-8');

		//ajaxからのリクエスト取得
		$class_id = $_POST["class_id"];
		$tag_name = $_POST["tag_name"];

		$tag = $this->tag;

		//タグが存在しない場合
		if(!$record = $tag->where("class_id","=",$class_id)->where("tag_name",$tag_name)->first()){
			$data["success"] = false;
			$data["message"] = "タグが存在しません。すでに削除されている可能性があります。";
			return json_encode($data);
		}
		$result = $record->delete();

		$data["success"] = $result;
		$data["message"] = $result == true? "タグを削除しました。":"タグの削除に失敗しました。";

		return json_encode($data); 

	}

	/**
	 * タグ追加メソッド(リストから)
	 *
	 * @param string
	 * @param string
	 * @author shalman
	 * @return enum(0,1)
	 *
	 */
	public function addTag($class_id,$tag_name){
		$tag = $this->tag;

		if($tag->where("class_id","=",$class_id)->where("tag_name","=",$tag_name)->first()){
			return NULL;
		}

		$tag->class_id = $class_id;
		$tag->tag_name = $tag_name;

		$result = $tag->save();
		return $result;
	}
/*
	public function deleteTag($class_id,$tag_name){
		$tag = $this->tag;

		if($record = $tag->where("class_id",$class_id)->where("tag_name",$tag_name)->first()){
			return NULL;
		}
		$result = $record->delete();

		return $result;
	}
 */
}