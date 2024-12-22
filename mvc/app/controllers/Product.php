<?php
class Product extends Controller{
    private $model;

    public function __construct()
    {
        $this->model = new Controller();
        $this->model = $this->model->model('ProductModal');
    }

    public function index(){
        $this->render('categories/add');
   
    }
    public function get_user(){
      
       
       
       

}
  

}