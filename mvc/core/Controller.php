<?php

class Controller {
    public function model($model) {
      
        if(file_exists(_DIR_ROOT_.'/app/models/'.$model.'.php')){
            require_once _DIR_ROOT_.'/app/models/'.$model.'.php';
           
            if(class_exists($model)){
                $model = new $model();
                return $model;
            }
        }
        return false;
    }

    public function render($view, $datazz=[]){
        extract($datazz);
        if(file_exists(_DIR_ROOT_.'/app/views/'.$view.'.php')){
            require_once _DIR_ROOT_.'/app/views/'.$view.'.php';
        }
    }
}