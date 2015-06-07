<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tag;
use App\Classes;

use Illuminate\Http\Request;

class TagController extends Controller {

	protected $tag;
	protected $classes;

	public function __construct(Tag $tag,Classes $classes){
		$this->tag = $tag;
		$this->classes = $classes;

	}
	public function getIndex(){
		$test = $this->returnTagNamesByClassId(4);
		foreach ($test as $v) {
			var_dump($v[0]->tag_name);
		}
		//var_dump($test);
		
	}

	public function returnTagNamesByClassId($class_id){
		$classes = $this->classes;
		$tag = $this->tag;

		$tag_ids = $classes->select('tag_ids')->where("id",'=',$class_id)->get()[0];
		//配列化
		preg_match_all('/\d/',$tag_ids,$tag_ids);

		$tag_names = array();
		foreach ($tag_ids[0] as $id) {
			$tag_names[] = $tag->select('tag_name')->where('id',$id)->get();
		}
		
		return $tag_names;
		
		

	}
}