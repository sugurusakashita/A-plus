<?php namespace App\Http\Controllers;

use App\Classes;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Input;

class SearchController extends Controller {

	protected $classes;


	public function __construct(Classes $classes){
		$this->classes = $classes;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */


	public function getIndex(){
		$day = urldecode(Input::get('day'));
		$period = Input::get('period');
		$term = Input::get('term');
		$query = urldecode(Input::get('q'));
		$token = Input::get('_token');

		//$data = $this->classes;

		$res['classes'] = $this->classes_list($day,$period,$term,$query);

		$res['get'] = array('q'	=>	$query,
							'day' => $day,
							'period'=> $period,
							'term' => $term,
							'_token' =>	$token);

		return view('search/search')->with('data',$res);
	}


	public function classes_list($day,$period,$term,$query){

		$data = $this->classes;

		//夏期集中
		if($day == '夏季'){
			$period = '00';
		}

		$data = $day == '0'? $data:$data->where('class_week',$day);
		$data = $period === '0'? $data:$data->where('class_period',$period);
		$data = $query == '0'? $data:$data->where('class_name','like','%'.$query.'%');


		return $data->where('term',$term)->orderBy('class_period','asc')->orderBy('class_week','desc')->paginate(20);

	}


}
