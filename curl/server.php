<?php

echo "<h1>Trang Server</h1>";


$header = getallheaders();

echo '<pre>';
print_r($header);
echo '</pre>';

echo $_SERVER['REQUEST_METHOD'];

echo '<h3>Phương thức GET</h3>';
echo '<pre>';
print_r($_GET);
echo '</pre>';

echo '<h3>Phương thức POST</h3>';
echo '<pre>';
print_r($_POST);
echo '</pre>';