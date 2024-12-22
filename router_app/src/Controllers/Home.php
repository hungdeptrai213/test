<?php 

namespace App\Controllers;
use App\Models\Users;

class Home {
    public function index(){
         $user = Users::getUser();
        
        return view('index', $user);
    }
}