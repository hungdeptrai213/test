<?php
class ParamsMiddleware extends Middlewares{
    public function handle()
    {
        echo 'vaO-PẢAM';
        if(!empty($_SERVER['QUERY_STRING'])){
            echo Route::getFullUrl();
            $response = new Response();
           // $response->redirect(Route::getFullUrl());
        }
    }
}