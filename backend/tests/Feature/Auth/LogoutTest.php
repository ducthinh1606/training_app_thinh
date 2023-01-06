<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    // Test if user logout successful
    public function testIfUserLogoutSuccessful()
    {
        $response = $this->post('/api/logout', [], $this->createToken());

        $response->assertJsonStructure(self::THROW_SUCCESS_STRUCTURE)
            ->assertOk();
    }

    // Test if missing header Bearer token
    public function testIfMissingBearerToken()
    {
        $response = $this->post('/api/logout', [], self::HEADER_ACCEPT_APPLICATION_JSON);

        $response->assertJsonStructure(self::THROW_ERROR_STRUCTURE)
            ->assertUnauthorized();
    }
}
