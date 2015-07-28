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
			//2MBを超えるアップロードだと、バリデーションが効かない？
			//サーバー側が500エラーで保存はされない。要検証。
			'avatar' => 'max:1500|image|mimes:jpeg,jpg,gif,png',
			'avatar_url' => 'string|url', 
			'name' => 'required|max:20|unique:users',
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

		if(isset($data["avatar_url"])){
			$path = $data["avatar_url"];
		}

		//アバターの保存
		if(isset($data["avatar"])) {
			if($data["avatar"]){
				//念のためサニタイズ
				$name = htmlspecialchars($data['name'],ENT_QUOTES);
				$file_name = $name."_avt.".$data["avatar"]->guessClientExtension();
				$file = $data["avatar"]->move("avatar",$file_name);	
				$path = asset("avatar/".$file_name);
			}
		}
	
		//Session::flash("alert","初めまして！".$data['name']."さん！<br>A+plusを使って賢く大学生活を過ごしましょう！");
		return User::create([
			'avatar' => $path,
			'name' => $data['name'],
			'email' => $data['email'],
			'entrance_year' => $data['entrance_year'],
			'faculty' => $data['faculty'],
			'sex'	=>	$data['sex'],
			'password' => bcrypt($data['password']),
		]);
	}

}
