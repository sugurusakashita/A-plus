<?php namespace App\Http\Controllers;

use App\Classes;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Input;

class ClassesController extends Controller {

	protected $classes;


	public function __construct(Classes $classes){
		$this->classes = $classes;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index($id){
		$data['detail'] = $this->getClassDetailById($id); 
		
		return view('classes/classes')->with('data',$data);
	}

	public function classes_list($day,$period,$term){

		$data = $this->classes;

		//夏期集中
		if($day == '夏季'){
			$period = '00';
		}

		$data = $day === '0'? $data:$data->where('class_week','=',$day);
		$data = $period === '0'? $data:$data->where('class_period','=',$period);


		return $data->where('term','=',$term)->orderBy('class_period','asc')->orderBy('class_week','desc')->get();
	}

	public function getClassDetailById($id){

		$data = $this->classes;

		return $data->find($id);
	}

	public function test(){
		$data = $this->classes;

		var_dump($data->find(4)->get());
	}

}
