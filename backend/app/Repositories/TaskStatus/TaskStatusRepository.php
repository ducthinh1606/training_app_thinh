<?php

declare(strict_types=1);

namespace App\Repositories\TaskStatus;

use App\Repositories\BaseRepository;
use Mockery\Exception;

class TaskStatusRepository extends BaseRepository implements TaskStatusRepositoryInterface
{
    /**
     * get model.
     * @return string
     */
    public function getModel()
    {
        return \App\Models\TaskStatus::class;
    }
}
