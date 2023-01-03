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

    public function getListTask($filters)
    {
        $query = $this->model->where('user_id', auth()->user()->id);

        foreach ($filters as $key => $filter) {
            if (!$filter['query']) {
                continue;
            }

            if ($filter['type'] == 'like') {
                $query = $query->where($key, $filter['type'], "%" . $filter['query'] . '%');
            }

            if ($filter['type'] == '=') {
                $query = $query->where($key, $filter['query']);
            }
        }

        return $query->get();
    }
}
