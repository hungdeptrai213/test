<?php

namespace App\Database;

use \PDO;
use \Exception;

class Database
{
    private $drive = _DRIVE;
    private $host = _HOST;
    private $user = _USER;
    private $pass = _PASS;
    private $db = _DB;
    private static $conn = null;
    private $sql = null;

    function __construct()
    {
        try {
            if (class_exists('PDO')) {
                $dsn = $this->drive . ':dbname=' . $this->db . '; host=' . $this->host;
                $option = [
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ];

                if (self::$conn == null) {
                    self::$conn = new PDO($dsn, $this->user, $this->pass, $option);
                }
            }
        } catch (Exception $exception) {
            echo $exception->getMessage();
            die();
        }
    }

    public function query($sql, $data = [], $statementStatus = false)
    {
        $query = false;
        $this->sql = $sql;
      
        try {
         
            $statement = self::$conn->prepare($this->sql);
     
            if (empty($data)) {
               
                $query = $statement->execute();
            } else {
                
                $query = $statement->execute($data);
            }
        } catch (Exception $exception) {
            echo $exception->getMessage() . '</br>';
            echo '<b>SQL QUERY: </b><i style ="color:red;">' .  $this->sql . ' </i>';
            die();
        }
      
        if ($statementStatus && $query) {
            return $statement;
        }

        return $query;
    }

    // Phương thức lấy tất cả bản ghi
    public function getRaw($sql)
    {
        $statement = $this->query($sql, $data = [], true);

        if (is_object($statement)) {
            $dataFetch = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $dataFetch;
        }

        return false;
    }

    // Phương thức lấy bản ghi đầu tiên
    public function firstRaw($sql)
    {
        $statement = $this->query($sql, $data = [], true);

        if (is_object($statement)) {
            $dataFetch = $statement->fetch(PDO::FETCH_ASSOC);
            return $dataFetch;
        }

        return false;
    }

    // Hàm thêm
    public function insertData($table, $dataInsert){
      
        $keyArr = array_keys($dataInsert);
        $filedStr = implode(', ', $keyArr);
        $valueStr = ':'.implode(', :',$keyArr);

       
        $sql = 'INSERT INTO '. $table . ' ('. $filedStr . ')'. ' VALUES ('. $valueStr .')';
       
        return $this->query($sql, $dataInsert);
    }

    // Hàm sửa
    public function updateData($table, $dataUpdate, $condition=''){
        $updateStr = '';
        foreach ($dataUpdate as $key => $value){
            $updateStr .= $key .'=:' .$key.',';
        }
        $updateStr = rtrim($updateStr,',');
        if(!empty($condition)){ 
            $sql = 'UPDATE '. $table . ' SET '. $updateStr . ' WHERE ' . $condition;
        }else {
            $sql = 'UPDATE '. $table . ' SET '. $updateStr ;
        }

        return $this->query($sql,$dataUpdate);
    }

    // Hàm xoá
    public function deleteData($table, $condition=''){
        if(!empty($condition)){ 
            $sql = "DELETE FROM " . $table . ' WHERE ' . $condition;
        }else{
            $sql = "DELETE FROM " . $table ;
        }
        return $this -> query($sql);
    }

    // Hàm đếm số dòng của câu lệnh truy vấn
    public function getRows($sql){
        $statement = $this->query($sql, [], true);

        if(!empty($statement)){
            return $statement -> rowCount();
        }

        return 0;
    }

    // Hàm trả về ID vừa insert
    public function insertId(){
        return self::$conn -> lastInsertId();
    }

    public function getPdo(){
        return self::$conn;
    }
}
