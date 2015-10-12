<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

	protected $table = "tags";
	protected $filable = ["class_id","tag_name"];
	protected $primaryKey = "tag_id";


    /**
    *
    * 授業IDから紐付いているタグを返す
    *
    * @author shalman
    * @param int
    * @return obj
    *
    **/

	public function tagsByClassId($id)
	{
		return $this->where("class_id","=",$id)->get();
	}
}
