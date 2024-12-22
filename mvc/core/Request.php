<?php 
class Request {
    protected $__rules, $__messages;
    protected $__errors=[];

    public function getMethod(){
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isPost(){
        if($this->getMethod() == 'post'){
            return true;
        }
        return false;
    }

    public function isGet(){
        if($this->getMethod() == 'get'){
            return true;
        }
        return false;
    }

    public function getFields(){
        $dataFields = [];
        
        if($this->isGet()){
            //   Xử lý lấy dữ liệu với phương thức get
            if(!empty($_GET)){
                foreach($_GET as $key => $value){
                    if(is_array($value)){
                        $dataFields[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    }else {
                        $dataFields[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        }
      
        if($this->isPost()){
            //   Xử lý lấy dữ liệu với phương thức get
            if(!empty($_POST)){
                foreach($_POST as $key => $value){
                    if(is_array($value)){
                        $dataFields[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    }else {
                        $dataFields[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        }

        return $dataFields;

    }

    // set rule
    public function rules($rules=[]){
        $this->__rules = $rules;
    }

    // set message
    public function message($message){
        $this->__messages = $message;
    }

    // run validate
    public function validate(){
        $this->__rules = array_filter($this->__rules);
     
        $dataFields = $this->getFields();
        $checkValidate = true;

        if(!empty($this->__rules)){
            foreach ($this->__rules as $fieldName => $ruleItem){
      
                $rulesItemArr = explode('|', $ruleItem);
                foreach ($rulesItemArr as $rules){
                    $ruleName = null;
                    $ruleValue = null;

                    $rulesArr = explode(':', $rules);
                    $ruleName = reset($rulesArr);

                    if(count($rulesArr)>1){
                        $ruleValue = end($rulesArr);
                    }

                    if($ruleName == 'required'){
                        if(empty($dataFields[$fieldName])){
                           $this->setErrors($fieldName, $ruleName);
                           $checkValidate = false;
                        }
                    }

                    if($ruleName == 'min'){
                        if(strlen($dataFields[$fieldName]) < $ruleValue){
                            $this->setErrors($fieldName, $ruleName);
                            $checkValidate = false;
                        }
                    }

                    if($ruleName == 'max'){
                        if(strlen($dataFields[$fieldName]) > $ruleValue){
                            $this->setErrors($fieldName, $ruleName);
                            $checkValidate = false;
                        }
                    }

                    if($ruleName == 'email'){
                        if(!filter_var($dataFields[$fieldName],FILTER_VALIDATE_EMAIL)){
                            $this->setErrors($fieldName, $ruleName);
                            $checkValidate = false;
                        }
                    }

                    if($ruleName == 'match'){
                        if($dataFields[$fieldName] != $dataFields[$ruleValue]){
                            $this->setErrors($fieldName, $ruleName);
                            $checkValidate = false;
                        }
                    }

                }
               
            }   
        }

        $sessionKey = Session::isInvalid();
        Session::flash($sessionKey.'_errors', $this->errors());
        Session::flash($sessionKey.'_old', $this->getFields());
       

        return $checkValidate;
    }

    // get errors
    public function errors($fieldName=''){
        if(!empty($this->__errors)){
            if(empty($fieldName)){
                $errors = [];
                foreach($this->__errors as $key => $item){
                    $errors[$key] = reset($item);
                }
       
                 return  $errors;
            }
            else {
                return reset($this->__errors[$fieldName]);
            }
        }
    }

    // set errors
    public function setErrors($fieldName, $ruleName){
        $this->__errors[$fieldName][$ruleName] = $this->__messages[$fieldName.'.'.$ruleName];
    }

}