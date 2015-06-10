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
	public function getAdd($id){
		$tag = $this->tag;

		$data['tag_names'] = $this->returnTagNames();
		$data['detail'] = $this->classes->find($id);
		$data['search_ranking'] = $this->ranking->returnSearchRankingList();
		$data['access_ranking'] = $this->ranking->returnAccessRankingList();

		return view('tag/index')->with('data',$data);
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

	public function addTag($class_id,$tag_name){
		$tag = $this->tag;

		$tag->class_id = $class_id;
		$tag->tag_name = $tag_name;

		$result = $tag->save();
		return $result;
	}

	public function deleteTag($class_id,$tag_name){
		$tag = $this->tag;

		$record = $tag->where("class_id",$class_id)->where("tag_name",$tag_name)->first();
		$result = $record->delete();

		return $result;
	}

}