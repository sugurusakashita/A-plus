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
/*
Route::get('/', 'WelcomeController@index');
*/

Route::get('/', 'TopController@index');
Route::get('classes/{id}', 'ClassesController@index');
//Route::get('test', 'ClassesController@test');
Route::get('search','SearchController@index');



Route::get('input','top@index');
Route::post('res', 'top@res');



Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
