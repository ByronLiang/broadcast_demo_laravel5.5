<?php
/**
 * API路由，url前缀 api
 */

Route::group(['middleware' => 'auth:api,web'], function () {

});
Route::get('type', 'TypeController@getIndex');
