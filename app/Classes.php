<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Classes_detail;

class Classes extends Model {

	//
	protected $table = 'classes';
	protected $primaryKey = 'class_id';

	public function teachers(){
		return $this->belongsToMany('App\Teacher','tr_classes_teachers','class_id','teacher_id');
	}

	public function classes_detail(){
		return $this->hasMany('App\Classes_detail','class_id');
	}

	/**
	 * 検索
	 *
	 * @param  Array
	 * @author shalman
	 * @return Response
	 */
	public function search($searchOption)
	{
		$word = $searchOption['q'];
		$day = $searchOption['day'];
		$period = $searchOption['period'];
		$term = $searchOption['term'];
		$faculty = $searchOption['faculty'];

		$searchArray = $this->query2array($word);

		$data = $this;
		$data = empty($searchArray[0])?  $data:$this->queryEngine($searchArray);
		//詳細テーブルから検索
		$detail = new Classes_detail();

		if(!empty($day)){
			$matchIds = $detail->where('class_week',$day)->distinct()->lists('class_id');
			$data = $data->whereIn($this->primaryKey,$matchIds);
		}
		if(!empty($period)){
			$matchIds = $detail->where('class_period',$period)->distinct()->lists('class_id');
			$data = $data->whereIn($this->primaryKey,$matchIds);
		}

		$data = empty($term)?	$data:$data->where('term',$term);
		$data = empty($faculty)?$data:$data->where('faculty',$faculty);

		return $data;
	}

	/**
	 * クエリーエンジン
	 * AND検索
	 *
	 * @param array
	 * @author shalman
	 * @return obj
	 *
	 */
	function queryEngine($search_queries = null){
		//マスターデータ
		$data = $this;
		//テスト配列
		//$search_queries = array("データ");

		if(empty($search_queries[0])){
			return $data;
		}

		$weight = array();
		//クエリが教師名、授業名、要旨に含まれているものを和集合で取り出す。
		foreach ($search_queries as $query) {
			//クエリに教師名が含まれていれば重みづけ
			if(!is_null($data->teachers()->orWhere('teacher_name','like','%'.$query.'%')->first())) {
				$search_obj = $data->teachers()->orWhere('teacher_name','like','%'.$query.'%')->get();
				//重み処理
				//教師は重み2倍
				foreach ($search_obj as $v) {
					$id = $v["original"]["pivot_class_id"];
					if(!array_key_exists($id,$weight)){
						$weight[$id] = 2;
					}else{
					//2回以降
						$weight[$id] = $weight[$id] + 2;
					}
				}
			}
			else if(!is_null($data->orWhere('class_name','like','%'.$query.'%')->first())){
				$search_obj = $data->orWhere('class_name','like','%'.$query.'%')->get();
				//重み処理
				foreach($search_obj as $v){
					$id = $v->class_id;
					//初めてある授業をカウント
					if(!array_key_exists($id,$weight)){
						$weight[$id] = 1;
					}else{
					//2回以降
						$weight[$id]++;
					}
				}
			}
			else if(!is_null($data->orWhere('summary','like','%'.$query.'%')->first())) {
				$search_obj = $data->orWhere('summary','like','%'.$query.'%')->get();
				//重み処理
				foreach($search_obj as $v){
					$id = $v->class_id;
					//初めてある授業をカウント
					if(!array_key_exists($id,$weight)){
						$weight[$id] = 1;
					}else{
					//2回以降
						$weight[$id]++;
					}
				}
			}
		}
		//$weightはkeyにclass_id,valueに重み(検索した単語の教師名、授業名、要旨におけるヒット回数)の連想配列
		if(empty($weight)){
			return $data->where("class_id","");
		}
		//重みが強いものを先頭に
		arsort($weight);
		//重みを捨ててclass_idだけの配列
		$ids = array_keys($weight);
		//配列の順序通りにDBから引っ張る
		$placeholders = implode(',',array_fill(0, count($ids), '?')); // string for the query

		return $data->whereIn("class_id",$ids)->orderByRaw("field(class_id,{$placeholders})", $ids);

	}

	/**
	 * query 2 array
	 * 検索ワードを空白で区切り、配列としてreturnします。
	 *
	 * @param String
	 * @author shalman
	 * @return array
	 *
	 */

	function query2array($query)
	{
		$query = urldecode($query);
		//全角空白を半角に
		$query = trim(mb_convert_kana($query,"s"));
		//エンコード
		mb_regex_encoding( "UTF-8" );
		//複数検索ワードを配列に
		$search_queries = mb_split("\s",$query);

		//配列要素は5つまで
		while(count($search_queries) > 5){
			array_pop($search_queries);
		}
		return $search_queries;

	}
}
