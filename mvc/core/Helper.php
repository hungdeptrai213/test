<?php 

$sessionKey = Session::isInvalid();
$errors = Session::flash($sessionKey.'_errors');
$old = Session::flash($sessionKey.'_old');



if(!function_exists('form_error')){
    function form_error($fileName, $before='', $after=''){
        global $errors;
       

        if(!empty($errors) && array_key_exists($fileName, $errors)){
          
            return $before. $errors[$fileName] . $after;
        }
       return false;
    }
}



if(!function_exists('old')){
    function old($fileName, $defaul=''){
        global $old;
        if(!empty($old[$fileName])){
            return $old[$fileName];
        }
       return $defaul;
    }
}

