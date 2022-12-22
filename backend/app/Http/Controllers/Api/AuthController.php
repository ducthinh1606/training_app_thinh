<?php

namespace App\Http\Controllers\Api;

use App\Enums\ErrorType;
use App\Enums\SuccessType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\UserService;

class AuthController extends BaseController
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(LoginRequest $request)
    {
        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        $user = $this->userService->getUser($credentials['username']);

        if (!$user) return $this->sendError(ErrorType::CODE_4010, ErrorType::STATUS_4010, trans('errors.MSG_4010'));

        if (!$token = auth()->attempt($credentials)) {
            return $this->sendError(ErrorType::CODE_4010, ErrorType::STATUS_4010, trans('errors.MSG_4010'));
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        $data = [
            'token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth()->factory()->getTTL()
        ];

        return $this->sendSuccess($data, trans('response.success'));
    }

    public function register(RegisterRequest $request)
    {
        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        $register = $this->userService->register($credentials);

        if (!$register) {
            return $this->sendError(ErrorType::CODE_4091, ErrorType::STATUS_4091, trans('errors.MSG_4091'));
        }

        return $this->sendSuccessNoData(SuccessType::CODE_201, trans('response.success'));
    }

    public function logout()
    {
        auth()->logout();

        return $this->sendSuccessNoData(SuccessType::CODE_200, trans('response.success'));
    }
}
