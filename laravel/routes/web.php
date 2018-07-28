<?php
/**
 * 前台路由，默认路由，无前缀
 */
Route::group(['middleware' => ['spa:web']], function () {
	Route::post('login', 'AuthController@postLogin');
	Route::post('register', 'AuthController@postRegister');
	Route::group(['middleware' => 'auth:web'], function () {
		
	});

	// Route::get('/welcome', function () {
	//     return view('welcome');
	// });
	Route::view('{capture?}', 'web')->where(['capture' => '.*']);
});