<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Input;
use DB;

class top extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$res = DB::select(DB::raw('select * from classes'));

		return view('input')->with('data',$res);
	}

	public function res(){
		$day = Input::get('day');
		$period = Input::get('period');

		//夏期集中
		if($day == '夏季'){
			$period = '00';
		}
		//指定なし 
		$query = 'select * from classes where 1 ';
		$class_week =  'AND class_week ="'.$day.'" ';
		$class_period = 'AND class_period ="'.$period.'" ';

		$query .= $day === '0'? "":$class_week;
		$query .= $period === '0'? "":$class_period; 
		$query .= "order by class_period asc, class_week desc";

		$data['classes'] = DB::select(DB::raw($query));
		
		return view('res')->with('data',$data);
//var_dump($query);
		//return $res;
		//return view('form');
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
	public function store()
	{
		//
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
		//
	}

}
