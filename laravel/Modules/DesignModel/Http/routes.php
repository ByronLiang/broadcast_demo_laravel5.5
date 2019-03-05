<?php

Route::group(['middleware' => 'web', 'prefix' => 'designmodel', 'namespace' => 'Modules\DesignModel\Http\Controllers'], function()
{
    Route::get('/', 'DesignModelController@index');
});
