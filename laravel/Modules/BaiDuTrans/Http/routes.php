<?php

Route::group(['middleware' => 'web', 'prefix' => 'baidutrans', 'namespace' => 'Modules\BaiDuTrans\Http\Controllers'], function()
{
    Route::get('/', 'BaiDuTransController@index');
});
