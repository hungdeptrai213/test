<?php 
namespace App\Models;

use App\Core\Model;

class Users extends Model {
    public static function getUser(){
        $db = new Model();
        $dbc = $db->__db;
        $result = $dbc->from('users')->all();
        return $result;
    
    }
}
