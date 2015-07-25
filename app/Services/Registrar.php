<?php namespace App\Services;

use App\User;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;
use Session;

class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
			'avatar' => 'image|mimes:jpeg,jpg,gif,png|max:1000',
			'name' => 'required|max:10|unique:users',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{	
		$file_name = $data['name']."_avt";
		$file = $data["avatar"]->move("avatar",$file_name);
		//Session::flash("alert","初めまして！".$data['name']."さん！<br>A+plusを使って賢く大学生活を過ごしましょう！");
		return User::create([
			'avatar' => $file_name,
			'name' => $data['name'],
			'email' => $data['email'],
			'entrance_year' => $data['entrance_year'],
			'faculty' => $data['faculty'],
			'sex'	=>	$data['sex'],
			'password' => bcrypt($data['password']),
		]);
	}

}
