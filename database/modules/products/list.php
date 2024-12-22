<?php
require_once '../../config.php';
require_once '../../includes/Database.php';
require_once '../../includes/Business.php';
require_once './ProductCategory.php';

use App\Database\Database;
use App\Database\Business;
use App\Database\ProductCategory;

$usser = new ProductCategory();

// var_dump($usser);

$dataa = [
    'name' => ' hung new',
    'create_at' => date('y:m:d h:i:s')
];

$usser -> insert($dataa);
