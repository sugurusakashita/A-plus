<?php namespace App\Services;

use App\User;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;
use Session;
use App\Services\CropAvatar;
use Image;
use File;


class Registrar implements RegistrarContract {

	public function saveAvatar(array $data){
		//保存PATH
		$path = NULL;
		$type = $data['radioAvatarType'];
		$file;
		$extension = '';

		switch ($type) {
			//デフォルト
			case '0':
				if(isset($data["avatar"])) {
					unset($data["avatar"]);
				}
				if(isset($data["avatar_url"])) {
					unset($data["avatar_url"]);
				}
				$data['path'] = $path;
				return $data;
				break;
			//アップロード
			case '1':
				//アバターの保存
				if(isset($data["avatar"])) {
					if($file = $data["avatar"]){
						$extension = $data["avatar"]->getClientOriginalExtension();
					}
				}
				break;
			//SNS画像
			case '2':
				if(isset($data["avatar"])) {
					unset($data["avatar"]);
				}

				if(isset($data["avatar_url"])){
					$file = $data["avatar_url"];
					$extension = pathinfo($file, PATHINFO_EXTENSION);
				}
				break;
			default:
				return redirect()->to('/');
				break;
		}


		//アバター保存
		//ユニークID付与
		$name = uniqid(rand());
		$cropData = json_decode(stripslashes($data['croppedAvatar']));

		//クロップデータ
		$x = (int)round($cropData->x);
		$y = (int)round($cropData->y);
		$width = (int)round($cropData->width);
		$height = (int)round($cropData->height);
		$rotate = round($cropData->rotate);
		//IntervensionImageでのrotateは反時計回りが正。
		$rotate = (float)"-".$rotate;

		$fileName = $name.'.'.$extension;
		$dirPath = public_path('avatar/'.$fileName);
		$path = '/avatar/'.$fileName;

		$img = Image::make($file);
		$img->rotate($rotate)->crop($width,$height,$x,$y)->resize(100,100)->save($dirPath);

		$data['path'] = $path;

		return $data;
	}

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
			'radioAvatarType'	=>	'required',
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
		//通常登録用
		if(!isset($data['social_id'])){
			$data['social_id'] = NULL;
		}
		//GreetingMessage
		$message = "初めまして！".$data['name']."さん！<br>A+plusを使って賢く大学生活を過ごしましょう！";
		Session::put("top_message",$message);

		return User::create([
			'avatar' => $data['path'],
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
