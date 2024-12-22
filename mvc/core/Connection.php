<?php 
class Connection {
    private static $_instance = null, $conn=null; 
    private function __construct($config)
    {
        // Kết nối database
        try {
            if (class_exists('PDO')) {
                $dsn = $config['drive'] . ':dbname=' . $config['db'] . '; host=' .  $config['host'];
             
                $option = [
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ];

                $con = new PDO($dsn,  $config['user'], $config['pass'], $option);
                self::$conn = $con;
                
            }
        } catch (Exception $exception) {
            echo $exception->getMessage();
            die();
        }
    }

    public static function getInstance($config)
    {
      
        if (self::$_instance == null) {
             $connect = new Connection($config);
            self::$_instance = self::$conn;
           
        }
        return self::$_instance;
    }

}