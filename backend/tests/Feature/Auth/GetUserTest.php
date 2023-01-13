<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetUserTest extends TestCase
{
    // Test get information of logging in user successful
    public function testIfGetUserInformationOfLoggingInUserSuccessful()
    {
        $response = $this->get('/api/info-user', $this->createToken());

        $response->assertJsonStructure(self::THROW_SUCCESS_WITH_DATA_STRUCTURE)
            ->assertOk();
    }

    // Test if missing header Bearer token
    public function testIfMissingBearerToken()
    {
        $response = $this->get('/api/info-user', self::HEADER_ACCEPT_APPLICATION_JSON);

        $response->assertJsonStructure(self::THROW_ERROR_STRUCTURE)
            ->assertUnauthorized();
    }
}
