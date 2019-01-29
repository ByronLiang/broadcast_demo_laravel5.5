<?php

Route::group(['middleware' => 'web', 'prefix' => 'api/shopify', 'namespace' => 'Modules\Shopify\Http\Controllers'], function()
{
    Route::get('/oauth', 'ShopifyAuthController@getOauth');
    Route::get('/', 'ShopifyController@index');
    Route::get('/checkouts/create', 'ShopifyCheckoutsController@create');
});
