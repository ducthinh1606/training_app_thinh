<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enums\ErrorType;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        // API response
        if ($request->is('api/*')) {
            if ($e instanceof AuthenticationException) {
                return $this->toResponse($request, ErrorType::CODE_4010, trans('errors.MSG_4010'), ErrorType::STATUS_4010);
            }

            if ($e instanceof Responsable) {
                return $e->toResponse($request);
            }

            // validation exception
            if ($e instanceof ValidationException) {
                $response = [
                    'error' => [
                        'code' => (int)ErrorType::CODE_4220,
                        'message' => $e->errors()
                    ]
                ];
                return response()->json($response, ErrorType::STATUS_4220);
            }

            if ($e instanceof ThrottleRequestsException) {
                $response = [
                    'error' => [
                        'code' => (int)ErrorType::CODE_4000,
                        'message' => __('errors.MSG_THROTTLE')
                    ]
                ];
                return response()->json($response, ErrorType::STATUS_4000);
            }

            // HTTP Exception
            if ($this->isHttpException($e)) {
                if ($e->getStatusCode() == ErrorType::STATUS_4000) {
                    return $this->toResponse($request, ErrorType::CODE_4000, __('errors.MSG_4000'), $e->getStatusCode());
                }

                if ($e->getStatusCode() == ErrorType::STATUS_4050) {
                    return $this->toResponse($request, ErrorType::CODE_4050, __('errors.MSG_4050'), $e->getStatusCode());
                }
            }

            return $this->toResponse($request, ErrorType::CODE_5001, __('errors.MSG_5001'), ErrorType::STATUS_5001);
        }

        if (!($e instanceof ValidationException)) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(
                    $this->getJsonMessage($e),
                    $this->getExceptionHTTPStatusCode($e)
                );
            }
        }

        return parent::render($request, $e);
    }

    protected function toResponse($request, string $code, string $message, int $status)
    {
        return (new BaseException($code, $message, $status))->toResponse($request);
    }

    protected function getJsonMessage($e)
    {
        // You may add in the code, but it's duplication
        return [
            'status' => 'error',
            'message' => $e->getMessage(),
        ];
    }

    protected function getExceptionHTTPStatusCode($e)
    {
        // Not all Exceptions have a http status code
        // We will give Error 500 if none found
        return method_exists($e, 'getStatusCode') ?
            $e->getStatusCode() : 500;
    }
}
