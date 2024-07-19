<?php

namespace App\Http\Traits;

trait ApiResponseTrait{
    public function apiSuccessResponse($message, $data = [], $status = 200){
        return response() -> json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $status);
    }
    public function apiErrorResponse($message, $status = 422, $data = []){
        return response() -> json([
            'status' => 'error',
            'message' => $message,
            'data' => $data,
        ], $status);
    }
}

