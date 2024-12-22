<?php
class Home extends Controller{
    private $model;
    private $data;


    public function __construct()
    {
        $this->model = new Controller();
        $this->model = $this->model->model('HomeModel');
        // $this->db = new Databases();
        // var_dump($this->db);
    }

    public function index(){
    //    $this->model->getList();
    //    $this->data['so1'] =  $this->model->getInforDb();

    $data =[
        'name' => 'trang 1997',
        'phone' => 970000,
        'status' => 1,
        'create_at' => date('Y:m:d H:i:s')
    ];
       $hungdaica =  $this->model->getDetail();
       echo $hungdaica;
       $this->data['title'] = 'Template Layout';
    //    $this->render('layouts/client-layout', $this->data);
     
    }

    public function detail(){
        echo 'detail_home';
    }

    public function getMethod(){
        // $request = new Request();
        // $hung = $request -> getFields();
        // echo '<pre>';
        // print_r($hung);
        // echo '</pre>';
     
        $this->render('categories/add');

        // $ses = new Session();
       // $yhung= Session::data('test key 2', ' valiu 2');
      // $hugn = Session::flash('flash','Giá trị flash');
    //   $hugn = Session::flash('flash');
    //   echo $hugn;
    //     echo '<pre>';
    //     print_r($_SESSION);
    //     echo '</pre>';

        

    }

    public function get_user(){
      
       
       
            $this->render('categories/add');

     
       
    }

    public function postMethod(){
        $request = new Request();
       
        if($request->isPost()){
            $request->rules([
                'fullname' => 'required|min:5|max:30',
                'email' => 'required|email|min:6',
                'password' => 'required|min:6',
                'confirm_password' => 'required|match:password'
            ]);
    
            $request -> message([
                'fullname.required' => 'Họ tên không được để trống.',
                'fullname.min' => 'Họ tên phải lớn hơn 5 ký tự.',
                'fullname.max' => 'Họ tên phải nhỏ hơn 30 ký tự.',
                'email.required' => 'Email không được để trống.',
                'email.email' => 'Email không đúng định dạng.',
                'email.min' => 'Email phải lớn hơn 6 ký tự.',
                'password.required' => 'Mật khẩu không được để trống.',
                'password.min' => 'Mật khẩu tối thiểu 6 kí tự.',
                'confirm_password.required' => 'Bạn chưa nhâp lại mật khẩu.',
                'confirm_password.match' => 'Mật khẩu bạn nhập không khớp.'
            ]);
    
            $validate = $request -> validate();
            // if(!$validate){
            //     // Session::flash('errors', $request->errors());
            //     // Session::flash('msg', 'Đã có lỗi xảy ra, vui lòng kiểm tra lại.');
            //     // Session::flash('old', $request->getFields());

                


            // } 
            
           // $sessionKey = Session::isInvalid();

            // $this->data = [
               
            //     'old' => Session::flash($sessionKey.'_old'),
            //     'errors' => Session::flash($sessionKey.'_errors')
               
            // ];


            $response = new Response();
            $response->redirect('get_user');


           
     
        }else {
            
            $response = new Response();
            $response->redirect('getMethod');
        }
     
       
    }


}