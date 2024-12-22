<?php 

class AuthMiddleware extends Middlewares{
  
    public function handle()
    {
       
      var_dump($this->db);

        // if(Session::data('admin_login') == null){
        //     $respond = new Response();
        //     $respond -> redirect('trang-chu');
        // }
    }
}