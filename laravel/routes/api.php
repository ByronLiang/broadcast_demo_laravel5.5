<?php
/**
 * API路由，url前缀 api
 */

Route::group(['middleware' => 'auth:api,web'], function () {

});
Route::get('type', 'TypeController@getIndex');
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
