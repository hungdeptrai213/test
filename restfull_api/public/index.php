<?php 
  
require_once "../vendor/autoload.php";
use Pecee\SimpleRouter\SimpleRouter as Route;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// Start the routing
Route::start();