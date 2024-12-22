<?php
require_once 'config.php';
require_once 'includes/Database.php';
require_once 'includes/Business.php';

use App\Database\Database;
use App\Database\Business;

$dtaa = new Business();



$dataa = [
    'name' => ' hung new',
    'phone' => '1900343',
    'status' => 2,
    'create_at' => date('y:m:d h:i:s')
];

$dtaa -> insert($dataa);