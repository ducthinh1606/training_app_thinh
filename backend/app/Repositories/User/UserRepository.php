<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\Repositories\BaseRepository;
use Mockery\Exception;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * get model.
     * @return string
     */
    public function getModel()
    {
        return \App\Models\User::class;
    }

    public function getUser($username)
    {
        return $this->model->where('username', $username)->first();
    }

    public function register($credentials)
    {
        try {
            return $this->model->create($credentials);
        } catch (Exception $exception) {
            return $exception;
        }
    }
}
