<?php

Route::group([
    'middleware' => 'web', 
    'prefix' => 'api/redis/hash', 
    'namespace' => 'Modules\RedisTask\Http\Controllers'], function() {
        Route::get('/', 'RedisHashController@index');
        Route::get('/create', 'RedisHashController@create');
});
