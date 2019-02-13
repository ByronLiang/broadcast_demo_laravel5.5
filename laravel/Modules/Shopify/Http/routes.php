<?php

Route::group(['middleware' => 'web', 'prefix' => 'api/shopify', 'namespace' => 'Modules\Shopify\Http\Controllers'], function()
{
    Route::get('/oauth', 'ShopifyAuthController@getOauth');
    Route::get('/', 'ShopifyController@index');
    Route::get('/checkouts/create', 'ShopifyCheckoutsController@create');
    Route::get('/checkouts/charge', 'ShopifyCheckoutsController@store');
    Route::get('/checkouts/show/{token}', 'ShopifyCheckoutsController@show');
    Route::get('/refunds/order/{id}', 'ShopifyRefundController@index');
    Route::get('/refunds/create/{id}', 'ShopifyRefundController@create');
    Route::get('/refunds/finish', 'ShopifyRefundController@store');
    Route::get('/test', 'ShopifyTestController@index');
});
