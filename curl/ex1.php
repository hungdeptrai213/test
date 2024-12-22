<?php

$url = 'https://online.hienu.vn/dang-nhap';

$userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.0.3112.113 Safari/537.36.';

$data = [
    'email' => 'hungngoc1996@gmail.com',
    'password' => 'Hungdaigia3@'

];


// Khởi tạo CURL
$ch = curl_init();

// Cấu hình CURL
curl_setopt($ch, CURLOPT_URL, $url); //set url cần requets
curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Trả về kết quả (giống hàm có return)


curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // tắt ssl
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // tắt ssl
curl_setopt($ch, CURLOPT_TIMEOUT, 30);

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);


curl_setopt($ch, CURLOPT_COOKIEFILE, './logs/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, './logs/cookie.txt');
 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);


// Thực thi CURL
$rul = curl_exec($ch);

// Hiển thị lỗi
$errors = curl_error($ch);

// Đóng CURL
curl_close($ch);

 var_dump($rul);

// $header = getallheaders();

// echo '<pre>';
// print_r($header);
// echo '</pre>';

// echo $_SERVER['REQUEST_METHOD'];

// echo '<h3>Phương thức GET</h3>';
// echo '<pre>';
// print_r($_GET);
// echo '</pre>';

// echo '<h3>Phương thức POST</h3>';
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';