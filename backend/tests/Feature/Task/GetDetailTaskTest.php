<?php

namespace Tests\Feature\Task;

use App\Enums\ErrorType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetDetailTaskTest extends TestCase
{
    // Test if get detail task successful
    public function testGetDetailTaskSuccess()
    {
        $task = \App\Models\Task::factory()->create();

        $response = $this->get('/api/tasks/' . $task->id, $this->createToken());

        $response->assertJsonStructure(self::THROW_SUCCESS_WITH_DATA_STRUCTURE)
            ->assertOk();
    }

    // Test if task id does not exist
    public function testGetDetailTaskIfTaskIdDoesNotExist()
    {
        $response = $this->get('/api/tasks/1', $this->createToken());

        $response->assertJsonStructure(self::THROW_ERROR_STRUCTURE)
            ->assertStatus(ErrorType::STATUS_5002);
    }

    // Test if missing header Bearer token
    public function testIfMissingBearerToken()
    {
        $task = \App\Models\Task::factory()->create();

        $response = $this->get('/api/tasks/'  . $task->id, self::HEADER_ACCEPT_APPLICATION_JSON);

        $response->assertJsonStructure(self::THROW_ERROR_STRUCTURE)
            ->assertUnauthorized();
    }
}
