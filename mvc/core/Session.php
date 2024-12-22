<?php
class Session {
    static public function data($key='', $value=''){
        $sessionKey = self::isInvalid();

        if(!empty($value)){
            $_SESSION[$sessionKey][$key] = $value; // set session
        }else {
            if(isset($_SESSION[$sessionKey][$key])){
                return  $_SESSION[$sessionKey][$key]; //get session
            }
        }
    }


    static public function delete($key=''){
        $sessionKey = self::isInvalid();
        if(!empty($key)){
            if(isset($_SESSION[$sessionKey][$key])){
                unset($_SESSION[$sessionKey][$key]);
                return true;
            }
            return false;
        }else {
            unset($_SESSION[$sessionKey]);
            return true;
        }
        return false;
    }

    static public function flash($key='', $value=''){
        $dataFlash = self::data($key, $value);
        if(empty($value)){
            self::delete($key);
        }
        return $dataFlash;
    }

    static public function showErrors($message){
        $data = ['message' => $message];
        $app = new App();
        $app -> loadError('exception', $data);
        die();
    }


    static function isInvalid(){
        global $config;
        if(!empty($config['session'])){
            $sessionConfig = $config['session'];
            if(!empty($sessionConfig['session_key'])){
                $sessionKey = $sessionConfig['session_key'];
                return $sessionKey;
            }else {
                self::showErrors('Thiếu cấu hình session_key. Vui lòng kiểm tra lại.');
            }
        }else {
            self::showErrors('Thiếu cấu hình session. Vui lòng kiểm tra lại.');
        }
    }


}