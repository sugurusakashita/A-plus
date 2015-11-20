<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Classes;
use App\User;
use App\Classes_detail;
use App\ClassRegistered;
use App\ClassRegisteredDetail;

use Illuminate\Http\Request;

class ClassRegisteredController extends Controller {

	protected $class_registered;
	protected $class_registered_detail;
	protected $classes;
	protected $classes_detail;
	protected $users;

	public function __construct(ClassRegistered $class_registered,ClassRegisteredDetail $class_registered_detail,Classes $classes,User $users,Classes_detail $classes_detail){
		
		$this->classes = $classes;
		$this->classes_detail = $classes_detail;
		$this->users = $users;
		$this->class_registered = $class_registered;
		$this->class_registered_detail = $class_registered_detail;
		
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postNew()
	{
		//ajax以外のアクセスを禁止
		$request = isset($_SERVER['HTTP_X_REQUESTED_WITH']) ? strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) : '';
		if($request !== 'xmlhttprequest') exit;

		//ajaxからのリクエスト取得
		$class_id = $_POST["class_id"];
		$user_id  = $_POST["user_id"];
		$year     = $_POST["year"];

		// $data['success'] = false;
		// $data['message'] = array($class_id, $user_id, $year);
		// return json_encode($data);

		$class = $this->classes->where("class_id","=",$class_id)->first();
		$classes_detail = $this->classes_detail->where("class_id","=",$class_id)->get();
		$class_registered = $this->class_registered;
		$class_registered_detail = $this->class_registered_detail;

		// 既に履修しているリストに登録していたらエラー吐く
		if($class_registered->where("user_id","=",$user_id)->where("class_name","=",$class->class_name)->where("faculty","=",$class->faculty)->first())
		{
			$data["success"] = false;
			$data["message"] = "既に履修済リストに登録されています。";
			return json_encode($data);
		}



		// 年度,学期,曜日,時限が被っているデータがあった場合、エラーを吐く
		$user_registered_classes = $this->class_registered->where("user_id","=",$user_id)->get();

		foreach($user_registered_classes as $user_class)
		{	
			$user_registered_details = $this->class_registered_detail->where("class_registered_id","=",$user_class->class_registered_id)->get();

			foreach($user_registered_details as $user_class_detail)
			{
				foreach ($classes_detail as $class_detail)
				{
					// echo "user_class: " . $user_class . "\n";
					// echo "user_class_detail: " . $user_class_detail . "\n";
					// echo "class_detail: " . $class_detail . "\n";
					if($user_class->year == $year && $user_class_detail->term == $class_detail->term && $user_class_detail->class_week == $class_detail->class_week && $user_class_detail->class_period == $class_detail->class_period)
					{
						// 履修登録
						$class_registered->user_id    = $user_id;
						$class_registered->class_name = $class->class_name;
						$class_registered->faculty    = $class->faculty;
						$class_registered->credit     = $class->credit;
						$class_registered->category   = $class->category;
						$class_registered->textbook   = $class->textbook;
						$class_registered->year       = $year;
						$class_registered->term       = "秋学期"; // DB対応後消す
						$class_registered->save();

						$data["success"] = false;
						$data["message"] = "年度、学期、曜日、時限が一致している授業が既に登録されているため\n登録はされますが時間割には表示されません。";
						return json_encode($data);
					}
				}
			}
		}

		// 履修登録
		$class_registered->user_id    = $user_id;
		$class_registered->class_name = $class->class_name;
		$class_registered->faculty    = $class->faculty;
		$class_registered->credit     = $class->credit;
		$class_registered->category   = $class->category;
		$class_registered->textbook   = $class->textbook;
		$class_registered->year       = $year;
		$class_registered->term       = "秋学期"; //DB対応後消す
		$class_registered->save();

		// 直前のsaveで入った最新のidを取得
		$class_registered_id = $class_registered->orderBy('class_registered_id','desc')->first()->class_registered_id;

		// class_registered_detailにinsert
		foreach($classes_detail as $class_detail)
		{
			echo $class_detail;
			$result = $class_registered_detail->insert([
				'class_registered_id' => $class_registered_id,
				'class_week'          => $class_detail->class_week,
				'class_period'        => $class_detail->class_period,
				'room_name'           => $class_detail->room_name,
				'term'                => $class_detail->term,
			]);

			if($result != 1){
				$data["success"] = false;
				$data["message"]  = "履修済リストへの登録に失敗しました。";
				return json_encode($data);
			}
		}
		
		$data["success"] = true;
		$data["message"] = "履修済リストに登録しました。";
		return json_encode($data);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

	}

}
