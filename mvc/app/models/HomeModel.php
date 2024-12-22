<?php
class HomeModel extends Model{
    protected $_table = 'users';
    public function getList(){
    //    $data = $this->db->query("SELECT * FROM $this->_table", '',  true)->fetchAll(PDO::FETCH_ASSOC);
        $data = $this -> all();
        return $data;
    }

    public function tableFill(){
        return 'users';
    }

    public function fieldFill(){
        return '*';
    }

    public function primaryKey(){
        return 'id';
    }

    public function getInforDb(){
        $hung = $this->db->table('users')->whereLike('name', '%hung%')->get();
        echo '<pre>';
        print_r($hung);
        echo '</pre>';
    }

    public function getDetail(){
        // $hung = $this->lastID();
        // echo '<pre>';
        // print_r($hung);
        // echo '</pre>';
    }

    public function getInssert($data){
        return $this->db->table('users')->insert($data);
    }

    public function getUpdate($data){
        return $this->db->table('users')->where('id', '=', 2)->update($data);
    }

    public function getDelete($id){
        return $this->db->table('users')->where('id', '=', $id)->delete();
    }
}