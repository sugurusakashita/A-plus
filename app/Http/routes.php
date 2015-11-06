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
	'help'		=>	'HelpController',
	'about'		=>	'AboutController',
	'campaign'	=>	'CampaignController',
	'api'		=>	'ApiController',

]);