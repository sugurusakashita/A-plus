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

		return Validator::make($data,[
			'avatar' => 'max:2000|image|mimes:jpeg,jpg,gif,png',
			'avatar_url' => 'string|url',
			'name' => 'required|max:20|unique:users',
			'entrance_year' => 'required',
			'faculty' => 'required',
			'sex'	=>	'required',
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
		//保存PATH
		$path ="";

		//GreetingMessage
		$message = "初めまして！".$data['name']."さん！<br>A+plusを使って賢く大学生活を過ごしましょう！";

		if(isset($data["avatar_url"])){
			$path = $data["avatar_url"];
		}


		//アバターの保存
		if(isset($data["avatar"])) {
			if($data["avatar"]){
				//ユニークID付与
				$name = uniqid(rand());
				$file_name = $name.".".$data["avatar"]->guessClientExtension();
				$file = $data["avatar"]->move("avatar",$file_name);
				$path = asset("avatar/".$file_name);
			}
		}

		//通常ログイン用
		if(!isset($data['social_id'])){
			$data['social_id'] = NULL;
		}
		//メッセージ仕込み
		Session::put("top_message",$message);
		return User::create([
			'avatar' => $path,
			'name' => $data['name'],
			'email' => $data['email'],
			'entrance_year' => $data['entrance_year'],
			'faculty' => $data['faculty'],
			'sex'	=>	$data['sex'],
			'social_id' => $data['social_id'],
			'password' => bcrypt($data['password']),
		]);
	}

}
