<?php

namespace Tests\Feature\Task;

use App\Enums\ErrorType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteTaskTest extends TestCase
{
    // Test if delete task successful
    public function testIfDeleteTaskSuccessful()
    {
        $task = \App\Models\Task::factory()->create();

        $response = $this->delete('/api/tasks/' . $task->id, [], $this->createToken());

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

    // Test if task id does not exist
    public function testIfTaskIdDoesNotExist()
    {
        $response = $this->delete('/api/tasks/1', [], $this->createToken());

        $response->assertJsonStructure(self::THROW_ERROR_STRUCTURE)
            ->assertStatus(ErrorType::STATUS_5005);
    }
}
