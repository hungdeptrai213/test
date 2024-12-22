<?php

namespace App\Core;

use PDO;
use Requtize\QueryBuilder\Connection;
use Requtize\QueryBuilder\ConnectionAdapters\PdoBridge;
use Requtize\QueryBuilder\QueryBuilder\QueryBuilderFactory;



class Model
{
    protected  $__db;

    public function __construct()
    {
        $host = env('DB_HOST');
        $user = env('DB_USERNAME');
        $pass = env('DB_PASS');
        $data = env('DB_DATABASE');
        $drive = env('DB_DRIVE');
        $port = env('DB_PORT');

  

        // Somewhere in our application we have created PDO instance
        $dns = "$drive:host=$host;dbname=$data;port=$port";
        $pdo = new PDO($dns, $user, $pass);

        // Build Connection object with PdoBridge ad Adapter
        $conn = new Connection(new PdoBridge($pdo));

        // Pass this connection to Factory
        $this->__db = new QueryBuilderFactory($conn);

       
      
    }
}
