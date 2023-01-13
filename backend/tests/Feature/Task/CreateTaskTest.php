<?php

namespace Tests\Feature\Task;

use App\Enums\ErrorType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateTaskTest extends TestCase
{
    // Test if create task successful with no estimate time
    public function testIfCreateTaskSuccessfulWithNoEstimate()
    {
        $response = $this->post('/api/tasks', [
            'task_name' => self::TASK_NAME_TEST
        ], $this->createToken());

        $response->assertJsonStructure(self::THROW_SUCCESS_STRUCTURE)
            ->assertCreated();
    }

    // Test if create task successful with estimate time
    public function testIfCreateTaskSuccessfulWithEstimate()
    {
        $response = $this->post('/api/tasks', [
            'task_name' => self::TASK_NAME_TEST,
            'estimate' => date_create('+1 day')->format(self::ESTIMATE_FORMAT)
        ], $this->createToken());

        $response->assertJsonStructure(self::THROW_SUCCESS_STRUCTURE)
            ->assertCreated();
    }

    // Test if missing header Bearer token
    public function testIfMissingBearerToken()
    {
        $response = $this->post('/api/tasks', [], self::HEADER_ACCEPT_APPLICATION_JSON);

        $response->assertJsonStructure(self::THROW_ERROR_STRUCTURE)
            ->assertUnauthorized();
    }

    // Test if missing task name
    public function testIfCreateTaskIsMissingTaskName()
    {
        $response = $this->post('/api/tasks', [
            'estimate' => date_create('+1 day')->format(self::ESTIMATE_FORMAT)
        ], $this->createToken());

        $response->assertJsonStructure(self::THROW_ERROR_STRUCTURE)
            ->assertStatus(ErrorType::STATUS_4220);
    }

    // Test if task name is too long
    public function testIfTaskNameLengthIsLongerThanTheExpectation()
    {
        $response = $this->post('/api/tasks', [
            'task_name' => self::LONGER_THAN_255_CHARACTER_STRING,
            'estimate' => date_create('+1 day')->format(self::ESTIMATE_FORMAT)
        ], $this->createToken());

        $response->assertJsonStructure(self::THROW_ERROR_STRUCTURE)
            ->assertStatus(ErrorType::STATUS_4220);
    }

    // Test if estimate time is wrong format
    public function testIfTheEstimateTimeIsWrongFormat()
    {
        $response = $this->post('/api/tasks', [
            'task_name' => self::TASK_NAME_TEST,
            'estimate' => date_create('+1 day')->format('Y-m-d H:i:s')
        ], $this->createToken());

        $response->assertJsonStructure(self::THROW_ERROR_STRUCTURE)
            ->assertStatus(ErrorType::STATUS_4220);
    }

    // Test if Estimate time before now
    public function testIfTheEstimateTimeBeforeNow()
    {
        $response = $this->post('/api/tasks', [
            'task_name' => self::TASK_NAME_TEST,
            'estimate' => date_create('-1 day')->format(self::ESTIMATE_FORMAT)
        ], $this->createToken());

        $response->assertJsonStructure(self::THROW_ERROR_STRUCTURE)
            ->assertStatus(ErrorType::STATUS_4220);
    }
}
