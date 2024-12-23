<?php 

namespace App\Controllers;

use Error;

class Home {
    public function index(){
        $data = ["User 1", "User 2"];
        // return successResponse(
        //     data: $data,

        // );
        return errorResponse(
            status: 500,
            message: 'Server Error'
        );
    }
}