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

    public function responseSuccessNoData($code = 200, $message = null)
    {
        $response = [
            'code' => $code,
            'message' => $message,
        ];

        return response()->json($response, $code);
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
