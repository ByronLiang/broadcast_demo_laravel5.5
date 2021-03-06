<?php
/**
 * API路由，url前缀 api
 */

Route::group(['middleware' => 'auth:api'], function () {
	Route::resources([
		'follows' => 'FollowController',
	]);
});
Route::get('type', 'TypeController@getIndex');
Route::get('cookie_test', 'TypeController@testCookie');
Route::get('job_test', 'TypeController@testJob');
Route::get('lock', 'TypeController@testLockFile');
Route::get('event', 'TypeController@getEvent');
Route::resources([
    'books' => 'BookController',
    'articles' => 'ArticleController',
]);

// 通知
Route::get('send_mail', 'NotificationController@sendMail');
Route::get('send_sms', 'NotificationController@SmsMessage');
Route::get('send_system_msg', 'NotificationController@systemMessage');
Route::get('check_system_msg', 'NotificationController@checkNotification');
Route::get('custom_redis_msg', 'NotificationController@customNotification');

// Redis
Route::get('basic_key', 'RedisController@getKey');
Route::get('store_key', 'RedisController@storeKey');
Route::get('lock_key', 'RedisController@setLock');
Route::get('slave', 'RedisController@redisSlave');
Route::group(['middleware' => ['web', 'api']], function () {
	Route::post('login', 'AuthController@login');
	Route::get('login_show', 'AuthController@showLoginForm');
	Route::get('auth/oauth/{provider}', 'AuthController@getOauth');
	Route::get('auth/facebook', 'AuthController@facebookLogin');
});

Route::get('pay', 'PayController@pay');
Route::get('stripe', 'StripeController@index');
Route::get('card_token', 'StripeController@creatreToken');
Route::get('refund', 'StripeController@refund');
Route::get('alipay', 'PayController@alipay');

// BaiDuTrans
Route::get('base_trans', 'TransController@index');

\Modules\Shopify\Shopify::shopifyOauth();
