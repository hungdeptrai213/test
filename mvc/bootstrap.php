<?php



define('_DIR_ROOT_', __DIR__);

$doct = str_replace('/', '\\', $_SERVER['DOCUMENT_ROOT']);
$ht = str_replace(strtolower($doct), '', strtolower(_DIR_ROOT_));
$root = $_SERVER['HTTP_HOST'];

define('_WEB_ROOT_', $root.$ht);
define('HOST_ROOT', $_SERVER['HTTP_HOST'].'/php_ad/mvc/');

$db_config = scandir('config');

if(!empty($db_config)){
    foreach($db_config as $item){
        if(($item !== '.') && ($item !== '..')){
            require_once "config/$item";
        }
    }
}


// Load all service
if(!empty($config['app']['service'])){
    $allServices = $config['app']['service'];
    if(!empty($allServices)){
        foreach($allServices as $serviceName){
            if(file_exists('app/core/'.$serviceName.'.php')){
               
                require_once 'app/core/'.$serviceName.'.php';
            }
        }
    }
}

if(!empty($config['database'])){
    $db_config = $config['database'];
    if(!empty($db_config)){
        require_once 'core/Connection.php';
        require_once 'core/QueryBuilder.php';
        require_once 'core/Database.php';
        
        
    }
}

require_once 'core/Middlewares.php';

require_once 'core/Session.php';
require_once 'core/Route.php';
require_once 'app/App.php';






require_once 'core/Helper.php';


$db_helper = scandir('app/helper');


if(!empty($db_helper)){
    foreach($db_helper as $item){
        if(($item !== '.') && ($item !== '..')){
            require_once "app/helper/$item";
        }
    }
}

require_once 'core/Model.php';
require_once 'core/Controller.php';
require_once 'core/Request.php';
require_once 'core/Response.php';
