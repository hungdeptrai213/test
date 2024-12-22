<?php
$routes['default_controller'] = 'home';
$routes['trang-chu'] = 'home';

$routes['san-pham'] = 'product/index';
$routes['trang-chu'] = 'home';
$routes['tin-tuc/(.+)'] = 'news/category/$1';