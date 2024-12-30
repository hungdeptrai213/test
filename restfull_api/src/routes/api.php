<?php

use Pecee\SimpleRouter\SimpleRouter as Route;


//use App\Controllers\V1\Home;


Route::group(['prefix' => 'api'], function () {
    Route::group(['prefix' => 'v1', 'namespace'=> '\App\Controllers\V1'], function () {
        Route::get('/user', 'Home@index');
        Route::get('/user/{id}', 'Home@find');
        Route::post('/user', 'Home@potche');
    });
});
