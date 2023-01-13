<?php

namespace Tests\Feature\Task;

use App\Enums\ErrorType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateTaskTest extends TestCase
{
    // Test if update task successful
    public function testIfUpdateTaskSuccessful()
    {
        $task = \App\Models\Task::factory()->create();

        $response = $this->put('/api/tasks/' . $task->id, [
            'task_name' => 'Edited task name',
            'estimate' => date_create('+1 day')->format(self::ESTIMATE_FORMAT),
            'task_status_id' => 1
        ], $this->createToken());

        $response->assertJsonStructure(self::THROW_SUCCESS_STRUCTURE)
            ->assertOk();
    }

    // Test if missing header Bearer token
    public function testIfMissingBearerToken()
    {
        $task = \App\Models\Task::factory()->create();

        $response = $this->delete('/api/tasks/' . $task->id, [], self::HEADER_ACCEPT_APPLICATION_JSON);

        $response->assertJsonStructure(self::THROW_ERROR_STRUCTURE)
            ->assertUnauthorized();
    }

    // Test if missing task name
    public function testIfCreateTaskIsMissingTaskName()
    {
        $task = \App\Models\Task::factory()->create();

        $response = $this->put('/api/tasks/' . $task->id, [
            'task_name' => null,
            'estimate' => date_create('+1 day')->format(self::ESTIMATE_FORMAT),
            'task_status_id' => 1
        ], $this->createToken());

        $response->assertJsonStructure(self::THROW_ERROR_STRUCTURE)
            ->assertStatus(ErrorType::STATUS_4220);
    }

    // Test if missing task status id
    public function testIfCreateTaskIsMissingTaskStatusId()
    {
        $task = \App\Models\Task::factory()->create();

        $response = $this->put('/api/tasks/' . $task->id, [
            'task_name' => 'Edited task name',
            'estimate' => date_create('+1 day')->format(self::ESTIMATE_FORMAT),
            'task_status_id' => null
        ], $this->createToken());

        $response->assertJsonStructure(self::THROW_ERROR_STRUCTURE)
            ->assertStatus(ErrorType::STATUS_5004);
    }

    // Test if estimate time is wrong format
    public function testIfTheEstimateTimeIsWrongFormat()
    {
        $task = \App\Models\Task::factory()->create();

        $response = $this->put('/api/tasks/' . $task->id, [
            'task_name' => 'Edited task name',
            'estimate' => date_create('+1 day')->format('Y-m-d H:i:s'),
            'task_status_id' => 1
        ], $this->createToken());

        $response->assertJsonStructure(self::THROW_ERROR_STRUCTURE)
            ->assertStatus(ErrorType::STATUS_4220);
    }

    // Test if task name is too long
    public function testIfTaskNameLengthIsLongerThanTheExpectation()
    {
        $task = \App\Models\Task::factory()->create();

        $response = $this->put('/api/tasks/' . $task->id, [
            'task_name' => self::LONGER_THAN_255_CHARACTER_STRING,
            'estimate' => date_create('+1 day')->format(self::ESTIMATE_FORMAT),
            'task_status_id' => 1
        ], $this->createToken());

        $response->assertJsonStructure(self::THROW_ERROR_STRUCTURE)
            ->assertStatus(ErrorType::STATUS_4220);
    }

    // Test if task status id does not exist
    public function testIfTaskStatusIdDoesNotExist()
    {
        $task = \App\Models\Task::factory()->create();

        $response = $this->put('/api/tasks/' . $task->id, [
            'task_name' => 'Edited task name',
            'estimate' => date_create('+1 day')->format(self::ESTIMATE_FORMAT),
            'task_status_id' => 999
        ], $this->createToken());

        $response->assertJsonStructure(self::THROW_ERROR_STRUCTURE)
            ->assertStatus(ErrorType::STATUS_5004);
    }

    // Test if estimate time before now
    public function testIfTheEstimateTimeBeforeNow()
    {
        $task = \App\Models\Task::factory()->create();

        $response = $this->put('/api/tasks/' . $task->id, [
            'task_name' => 'Edited task name',
            'estimate' => date_create('-1 day')->format(self::ESTIMATE_FORMAT),
            'task_status_id' => 1
        ], $this->createToken());

        $response->assertJsonStructure(self::THROW_ERROR_STRUCTURE)
            ->assertStatus(ErrorType::STATUS_4220);
    }
}
