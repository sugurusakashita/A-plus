<?php

Route::get('/', 'TopController@index');
Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
	'search'	=>	'SearchController',
	'classes'	=>	'ClassesController',
	'ranking'	=>	'RankingController',
	'tag'		=>	'TagController',
]);




/* 以下API */

// api root
Route::get('/api/', function(){
		return "API root";
});

// 全授業を取得
Route::get('/api/classes/', function(){
		$classes = DB::table('classes')->get();
		return Response::json($classes);
});

Route::get('/api/classes/{class_id}', function($class_id){
		$class = DB::table('classes')->where('class_id', $class_id)->first();
		return Response::json($class);
});
