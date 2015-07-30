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
	'mypage'	=>	'MyPageController',
	'term'		=>	'TermController',
	
]);




/* 以下API */
// TODO : status codeを返す

// api root
Route::get('/api/', function(){
		return "API root";
});

// 全授業を取得
Route::get('/api/classes/', function(){
		$classes = DB::table('classes')->get();
		return Response::json($classes);
});

// 一授業のみを取得
Route::get('/api/classes/{class_id}', function($class_id){
		$class = DB::table('classes')
			->where('class_id', $class_id)->first();
		return Response::json($class);
});

// 一授業のコメントを取得
Route::get('/api/classes/{class_id}/reviews/', function($class_id){
		$class = DB::table('review')
			->where('class_id', $class_id)->get();
		return Response::json($class);
});

// 一授業の特定の１コメントを取得
Route::get('/api/classes/{class_id}/reviews/{rev_id}', function($class_id, $rev_id){
		$class = DB::table('review')
			->where('class_id', $class_id)
			->where('review_id', $rev_id)->get();
		return Response::json($class);
});
