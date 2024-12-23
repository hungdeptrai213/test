<?php

use Pecee\SimpleRouter\SimpleRouter as Route;


use App\Controllers\Home;



Route::get('/', [Home::class, 'index']);
