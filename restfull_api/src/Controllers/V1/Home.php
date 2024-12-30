<?php 

namespace App\Controllers\V1;
use Error;


use App\Models\User;
use Rakit\Validation\Validator;

class Home {
    public function index(){
        $datas = ["User 1", "User 2"];
        // return successResponse(
        //     data: $data,

        // );
        return errorResponse(
            status: 500,
            message: 'Server Error'
        );
    }

    public function find($id){
        return successResponse(data:[$id] );
    }

    public function potche(){
        $validator = new Validator;

        $validator->setMessages([
            'required' => ':attribute là bắt buộc',
            
            // etc
        ]);

        $validation = $validator->make($_POST, [
            'name'      => 'required',
           
            'password'  => 'required|min:6',
            'status'    => [function($value){
                if($value == 'true' || $value == 'false'){
                    return true;
                }
                return ':attribute không hợp lệ';
            }]
        ]);

        // Attribute Alias 
        $validation->setAliases([
            'name' => 'Tên',
          
            'password' => 'Mật khẩu',
            'status' => 'Trạng thái'
        ]);

    

        $validation->validate();

       

        $data =[
            'name' => input('name'),
           
            'password'=> password_hash(input('password'), PASSWORD_DEFAULT),
            'status' => input('status') == 'true',
            'create_at' => date('Y:m:d H:i:s')
        ];

        if ($validation->fails()) {
            // handling errors
            $errors = $validation->errors();
            return errorResponse(
                status: 400,
                message: 'Bad Request',
                errors: $errors->firstOfAll()
            );
        } else {
            // validation passes
            $user = new User() ;
           $hung =  $user -> getUser($data);
            
            return successResponse(data:$hung);
        }
     
       
    }
}