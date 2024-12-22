<?php
require_once 'config.php';
require_once 'includes/Database.php';

use App\Database\Database;

$cla = new Database();
//  $sql = "SELECT * FROM users";

// // $statement = $dat -> firstRaw($sql, $dat = [], true);

$in = [
    'name' => 'Ten 6',
    'phone' => 'sua',
    'status' => 1,
    'create_at' => date('y-m-d H-y-s')
];

$cla -> insertData('users', $in);

// echo $cla -> insertId();

// echo '<pre>';
// print_r($statement);
// echo '</pre>';