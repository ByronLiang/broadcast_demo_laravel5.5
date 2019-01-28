<?php

Route::group(['middleware' => 'web', 'prefix' => 'shopify', 'namespace' => 'Modules\Shopify\Http\Controllers'], function()
{
    Route::get('/', 'ShopifyController@index');
});
