<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Task\TaskRepositoryInterface;
use Exception;

class TaskService
{
    protected $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function getListTask($params)
    {
        try {
            $filters = [
                'task_name' => [
                    'query' => $params['task_name'] ?? "",
                    'type' => 'like'
                ],
                'task_status_id' => [
                    'query' => $params['task_status_id'] ?? "",
                    'type' => '='
                ]
            ];

            return $this->taskRepository->getListTask($filters);
        } catch (Exception $exception) {
            return false;
        }
    }

    public function store($data)
    {
        try {
            $data['user_id'] = auth()->user()->id;

            return $this->taskRepository->create($data);
        } catch (Exception $exception) {
            return false;
        }
    }

    public function update($id, $data)
    {
        try {
            return $this->taskRepository->update($id, $data);
        } catch (Exception $exception) {
            return false;
        }
    }

    public function delete($id)
    {
        try {
            return $this->taskRepository->delete($id);
        } catch (Exception $exception) {
            return false;
        }
    }

    public function show($id)
    {
        try {
            return $this->taskRepository->find($id);
        } catch (Exception $exception) {
            return false;
        }
    }
}
