<?php

Route::group(['middleware' => 'web', 'prefix' => 'baidutranslator', 'namespace' => 'Modules\BaiDuTranslator\Http\Controllers'], function()
{
    Route::get('/', 'BaiDuTranslatorController@index');
});
