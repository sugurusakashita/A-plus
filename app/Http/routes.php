<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Lavavelのスタートページへのrouting
Route::get('/', 'WelcomeController@index');

// pingでのテスト
Route::get('/ping', function(){
	return Response::json('pong');
});

Route::get('home', 'HomeController@index');

Route::controllers([
  'auth' => 'Auth\AuthController',
  'password' => 'Auth\PasswordController',
]);

/* 以下API用のrouting */

// URLセグメントのテスト
// 正規表現してない
Route::get('/api/review/{number?}',
	function($number = 1){
		return "Number:{$number}のレビューです。";
});

// 授業データ
Route::get('/api/classes/', 'ClassesController@index');
Route::get('/api/classes/all', 'ClassesController@all');