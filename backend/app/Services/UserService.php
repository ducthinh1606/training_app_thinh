<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\User\UserRepositoryInterface;
use Exception;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUser($email)
    {
        try {
            return $this->userRepository->getUser($email);
        } catch (Exception) {
            return false;
        }
    }

    public function register($credentials)
    {
        try {
            return $this->userRepository->register($credentials);
        } catch (Exception) {
            return false;
        }
    }
}
