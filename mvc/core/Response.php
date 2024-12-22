<?php
class Response {
    public function redirect($uri=''){
        // if(preg_match('~^(https|http)~is', $uri)){
        //     $url = $uri;
        // } else {
        //     $url = HOST_ROOT.'ok/'.$uri;
        // }
        // echo $url;
        header("Location:". $uri);
        exit;
    }
}