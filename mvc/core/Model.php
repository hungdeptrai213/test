<?php 
abstract class Model extends Databases {
    protected $db;

    public function __construct()
    {
        $this->db = new Databases();
    }

    abstract function tableFill();
    abstract function fieldFill();
    abstract function primaryKey();


    public function all(){
        $tableName = $this -> tableFill();
        $fieldName= $this -> fieldFill();    
        if(empty($fieldName)){
            $fieldName = '*';
        }
        $sql = "SELECT $fieldName FROM $tableName";
        $query = $this->db->query($sql,'', true);
        if(!empty($query)){
            return  $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return false;
    }

    public function find($id){
        $tableName = $this -> tableFill();
        $fieldName= $this -> fieldFill();    
        $primary = $this->primaryKey();
        if(empty($fieldName)){
            $fieldName = '*';
        }
        $sql = "SELECT $fieldName FROM $tableName WHERE $primary=$id";
        echo $sql;
        $query = $this->db->query($sql,'', true);
        if(!empty($query)){
            return  $query->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }
}