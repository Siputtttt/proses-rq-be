<?php

namespace App\Helpers;

class ApiResponse
{
    public static function success($data = null, $message = 'Operation successful', int $statusCode = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
            'errors' => null
        ], $statusCode);
    }

    public static function error($errors = null, $message = 'Operation failed', int $statusCode = 400)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => null,
            'errors' => $errors
        ], $statusCode);
    }
}
