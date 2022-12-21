<?php

namespace App\Traits;

trait ResponseApiHandle {

    public function responseSuccess($data = null, $message = null)
    {
        $response = [
            'data' => $data,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    public function responseError($code = 5000, $statusCode = 500, $message = null)
    {
        $response = [
            'error' => [
                'code' => (int)$code,
                'message' => $message,
            ],
        ];

        return response()->json($response, $statusCode);
    }
}
