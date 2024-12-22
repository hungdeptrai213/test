<?php

use App\Database\Database;


class App
{
    private $__controller, $__action, $__params, $__route;
    private   $__db;

    function __construct()
    {
        global $routes;
        $this->__route = new Route();
        $this->__controller = $routes['default_controller'];
        $this->__action = 'index';
        $this->__params = [];
        $this->handleUrl();
       

       
       
    }

   
    public static function getUrl()
    {
      
        if (!empty($_SERVER['PATH_INFO'])) {
            $url = $_SERVER['PATH_INFO'];
        } else {
            $url = '/';
        }

        return $url;
    }


    public function handleUrl()
    {
        if(class_exists('Databases')){
           
            $this->__db = new Databases();
        }
        //var_dump($this->__db);

        $url = $this->getUrl();
       $this->__route->handleRoute($url);
       $hugn = $this->__route->getUrl();
    
       $this->handleRouteMiddleware($hugn, $this->__db);
      // $this -> paramRouteMiddleware();

        $urlArr = array_filter(explode('/', $url));
        $urlArr = array_values($urlArr);

        $path='';

        // Xử lý controllers
        $adminCheck = false;
        if (!empty($urlArr[0])) {
            if ($urlArr[0] == 'admin') {
                array_shift($urlArr);
                $adminCheck = true;
            }

            $this->__controller = ucfirst($urlArr[0]);
        } else {
            $this->__controller = ucfirst($this->__controller);
        }

        if ($adminCheck) {
            $path = 'app/controllers/admin/' . $this->__controller . '.php';
        } else {
            $path = 'app/controllers/' . $this->__controller . '.php';
        }

      
        if (file_exists($path)) {
            require_once $path;
            $this->__controller = new $this->__controller();

            unset($urlArr[0]);
        } else {
            $this->loadError();
        }


        // Xử lý action
        if (!empty($urlArr[1])) {
            $this->__action = $urlArr[1];
            unset($urlArr[1]);
        }

        // Xử lý params
        $this->__params = array_values($urlArr);

        if (method_exists($this->__controller, $this->__action)) {
            call_user_func_array([$this->__controller, $this->__action], $this->__params);
        } else {
            require_once 'errors/404.php';
        }
    }

    public function loadError($name = '404')
    {
        require_once 'errors/' . $name . '.php';
    }

    public function handleRouteMiddleware($routeKey, $db){
        global $config;
      
;       
        $routeKey = trim($routeKey);
        if(!empty($config['app']['routeMiddleware'])){
            $routeMiddleWareArr = $config['app']['routeMiddleware'];
            foreach ($routeMiddleWareArr as $key => $middleWareValue){
    
                if($routeKey == trim($key) && file_exists('app/middlewares/'.$middleWareValue.'.php')){
                    
                    require_once 'app/middlewares/'.$middleWareValue.'.php';
                 
                    if(class_exists($middleWareValue)){
                      
                        $middleWareObject = new $middleWareValue();
                      
                        if(!empty($db)){
                          
                            $middleWareObject->db= $db;
                        }

                        $middleWareObject -> handle();
                       
                    }
                }
            }
        }
    }

    public function paramRouteMiddleware(){
        global $config;
     
        if(!empty($config['app']['globalMiddleware'])){
            $globalMiddlewareArr = $config['app']['globalMiddleware'];
            foreach ($globalMiddlewareArr as $key => $middleWareValue){
                if( file_exists('app/middlewares/'.$middleWareValue.'.php')){
                   
                    require_once 'app/middlewares/'.$middleWareValue.'.php';
                    if(class_exists($middleWareValue)){
                
                        $middleWareObject = new $middleWareValue();
                        $middleWareObject -> handle();
                    }
                }
            }
        }
    }

}
