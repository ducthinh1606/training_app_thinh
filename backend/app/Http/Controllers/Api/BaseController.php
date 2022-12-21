<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ResponseApiHandle;
use Illuminate\Http\JsonResponse;

class BaseController extends Controller
{
    use ResponseApiHandle;

    /**
     * @param $result
     * @param $message
     * @return JsonResponse
     */
    protected function sendSuccess($data = null, $message = null): JsonResponse
    {
        return $this->responseSuccess($data, $message);
    }

    protected function sendSuccessNoData($code = 200, $message = null): JsonResponse
    {
        return $this->responseSuccessNoData($code, $message);
    }

    protected function sendError($code = 5000, $statusCode = 500, $message = null): JsonResponse
    {
        return $this->responseError($code, $statusCode, $message);
    }
}
