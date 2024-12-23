<?php
function successResponse($status = '200', $data=[], $meta=[]){
    return response()->httpCode($status)->json([
        'statussss' => $status,
        'message' => 'Success',
        'data' => $data,
        'meta' => $meta
    ]);
}


function errorResponse($status = '200', $message, $errors=[], $meta=[]){
    return response()->httpCode($status)->json([
        'statussss' => $status,
        'message' => $message,
        'errors' => $errors,
        'meta' => $meta
    ]);
}