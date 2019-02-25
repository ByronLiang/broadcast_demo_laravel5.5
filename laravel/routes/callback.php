<?php
/**
 * 回调通知路由，url前缀 callback
 */

//Route::get('/', function () {
//    return view('welcome');
//});

Route::any('/pay/{channel}', 'PayController@callback')->name('AggregationPayHook');
Route::any('/pay/return', 'PayController@returnCallback');
Route::any('/shopify', 'ShopifyController@index');
