<?php 
  
require_once "../vendor/autoload.php";
use Pecee\SimpleRouter\SimpleRouter as Route;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// Start the routing
Route::start();

// use Pecee\SimpleRouter\SimpleRouter as Route;
// Route::setDefaultNamespace('\App\Controllers');

// Route::get('/',function(){
//     return "Home đại ca";
// });


// Route::get('/user', function(){
//     return "Danh sách người dùng";
// })->name('useroke');

// Route::get('/user/them', function(){
//     $view = <<<EOT
//         <form method="post">
//             <input type="text" name="name">
//             <button type ="submit">Gửi</button>

//         </form>
//     EOT;
//     return $view;
// })->name('useradd');

// Route::post('/user/them',function(){
//     return input('name');
// });




// Route::get('/san-pham/{id}', function($id){
//    $url = url('useradd');
//    $view = <<<EOT
//         <p>{$url}</p>
//         <h1>Người dùng {$id}</h1>
//    EOT;
//    return $view;
// });

// // Start the routing
// Route::start();