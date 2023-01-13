<?php

namespace Tests\Feature\Task;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetListTaskTest extends TestCase
{
    // Test if get all list task success
    public function testGetAllListTaskSuccess()
    {
        $response = $this->get('/api/tasks', $this->createToken());

        $response->assertJsonStructure(self::THROW_SUCCESS_WITH_DATA_STRUCTURE)
            ->assertOk();
    }

    // Test if get list task with task name
    public function testGetListTaskWithTaskName()
    {
        $response = $this->get('/api/tasks?task_name=' . self::TASK_NAME_TEST, $this->createToken());

        $response->assertJsonStructure(self::THROW_SUCCESS_WITH_DATA_STRUCTURE)
            ->assertOk();
    }

    // Test if get list task with task status id
    public function testGetListTaskWithTaskStatusId()
    {
        $response = $this->get('/api/tasks?task_status_id=1', $this->createToken());

        $response->assertJsonStructure(self::THROW_SUCCESS_WITH_DATA_STRUCTURE)
            ->assertOk();
    }

    // Test if get list task with all params
    public function testGetListWithAllFilterParams()
    {
        $response = $this->get('/api/tasks?task_status_id=1&task_name='  . self::TASK_NAME_TEST, $this->createToken());

        $response->assertJsonStructure(self::THROW_SUCCESS_WITH_DATA_STRUCTURE)
            ->assertOk();
    }

    // Test if missing header Bearer token
    public function testIfMissingBearerToken()
    {
        $response = $this->get('/api/tasks', self::HEADER_ACCEPT_APPLICATION_JSON);

        $response->assertJsonStructure(self::THROW_ERROR_STRUCTURE)
            ->assertUnauthorized();
    }
}
