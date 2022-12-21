<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Contracts\Support\Responsable;
use RuntimeException;

class BaseException extends RuntimeException implements Responsable
{
    /**
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var int
     */
    protected $status;

    /**
     * BaseException constructor.
     *
     * @param string $code
     * @param string $message
     * @param int $status
     */
    public function __construct(string $code = '', string $message = '', int $status = 500)
    {
        $this->code = $code;
        $this->message = $message;
        $this->status = $status;
    }

    /**
     * @param string $code
     */
    public function setErrorCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getErrorCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $message
     */
    public function setErrorMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->message;
    }

    /**
     * @param int $status
     */
    public function setStatusCode(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->status;
    }

    public function toResponse($request)
    {
        return response()->json(
            $this->getBasicResponse(),
            $this->getStatusCode()
        );
    }

    protected function getBasicResponse()
    {
        return ['error' => [
            'code' => $this->getErrorCode(),
            'message' => $this->getErrorMessage(),
        ],
        ];
    }
}
