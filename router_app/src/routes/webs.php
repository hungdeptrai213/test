<?php

use Pecee\SimpleRouter\SimpleRouter as Route;


use App\Controllers\Home;

define('_VIEW_PATH__', dirname(__DIR__).'/views');




//  $hung = new HomeC();
// echo $hung;

Route::get('/', [Home::class, 'index']);

// Route::get('/',function(){
//     return "Home đại ca";
// });


// // Start the routing
// Route::start();