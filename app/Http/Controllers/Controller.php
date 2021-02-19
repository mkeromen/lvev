<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    /**
     * @param int $code
     * @param string $message
     * @param $extraData
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    protected function successResponseApi(int $code, string $message, $extraData = null)
    {
        return response([
            'message' => $message,
            'data' => $extraData
        ], $code);
    }
    
    /**
     * @param int $code
     * @param string $message
     * @param $errors
     * @return \Illuminate\Http\Response
     */
    protected function errorResponseApi(int $code, string $message, $errors = null)
    {
        return response([
            'message' => $message,
            'errors' => $errors
        ], $code);
    }
}