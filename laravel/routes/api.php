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
]);

// 通知
Route::get('send_mail', 'NotificationController@sendMail');
Route::get('send_sms', 'NotificationController@SmsMessage');
