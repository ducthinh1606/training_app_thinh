<?php

declare(strict_types=1);

namespace App\Repositories\Task;

use App\Repositories\BaseRepository;

class TaskRepository extends BaseRepository implements TaskRepositoryInterface
{
    /**
     * get model.
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Task::class;
    }
}
