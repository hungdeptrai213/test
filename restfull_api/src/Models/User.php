<?php 
namespace App\Models;

use System\Core\Model;

class User extends Model {
    public function getUser($data =[]){
       $this -> __db->table('users')->insert($data);
       $id = $this -> __db -> getLastId();
      return $this->__db -> table('users')-> where('id',$id)-> first();
    
    }
}
