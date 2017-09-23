<?php



function responseApi($success = true ,$data = array('data' => 'empty'),$message = "" ,$status = 201)
{
    return response()->json(array('success' => $success, 'data' => $data,'message' => $message), $status);
}