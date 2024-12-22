<?php
require_once '../config.php';
require_once '../includes/Database.php';
require_once '../includes/Business.php';
require_once './Users.php';

use App\Database\Database;
use App\Database\Users;

$usser = new Users();

$dataa = [
    'name' => ' hung new',
    'phone' => '1900343',
    'status' => 2,
    'create_at' => date('y:m:d h:i:s')
];

$usser -> insert($dataa);
