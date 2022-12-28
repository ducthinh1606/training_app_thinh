<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\TaskStatus\TaskStatusRepositoryInterface;
use Exception;

class TaskStatusService
{
    protected $taskStatusRepository;

    public function __construct(TaskStatusRepositoryInterface $taskStatusRepository)
    {
        $this->taskStatusRepository = $taskStatusRepository;
    }

    public function getList()
    {
        try {
            return $this->taskStatusRepository->all();
        } catch (Exception $exception) {
            return false;
        }
    }

    public function store($data)
    {
        try {
            return $this->taskStatusRepository->create($data);
        } catch (Exception $exception) {
            return false;
        }
    }

    public function update($id, $data)
    {
        try {
            return $this->taskStatusRepository->update($id, $data);
        } catch (Exception $exception) {
            return false;
        }
    }

    public function delete($id)
    {
        try {
            return $this->taskStatusRepository->delete($id);
        } catch (Exception $exception) {
            return false;
        }
    }
}
