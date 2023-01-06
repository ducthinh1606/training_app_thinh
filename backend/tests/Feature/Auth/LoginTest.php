<?php

namespace Tests\Feature\Auth;

use App\Enums\ErrorType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    // Test if User login successful
    public function testIfUserLoginSuccess()
    {
        $response = $this->post('/api/login', [
            'username' => self::USERNAME_TEST_ACCOUNT,
            'password' => self::PASSWORD_TEST_ACCOUNT
        ]);

        $response->assertJsonStructure([
            'data' => [
                'token',
                'token_type',
                'expires_in'
            ],
            'message'
        ])
            ->assertOk();
    }

    // Test if username is missing
    public function testIfTheUsernameIsMissing()
    {
        $response = $this->post('/api/login', [
            'username' => '',
            'password' => self::PASSWORD_TEST_ACCOUNT
        ]);

        $response->assertJsonStructure(self::THROW_ERROR_STRUCTURE)
            ->assertStatus(ErrorType::STATUS_4220);
    }

    // Test if username is too short
    public function testIfTheUsernameLengthIsLessThanTheExpectation()
    {
        $response = $this->post('/api/login', [
            'username' => self::VERY_SHORT_STRING,
            'password' => self::PASSWORD_TEST_ACCOUNT
        ]);

        $response->assertJsonStructure(self::THROW_ERROR_STRUCTURE)
            ->assertStatus(ErrorType::STATUS_4220);
    }

    // Test if username is too long
    public function testIfTheUsernameLengthIsLongerThanTheExpectation()
    {
        $response = $this->post('/api/login', [
            'username' => self::LONGER_THAN_255_CHARACTER_STRING,
            'password' => self::PASSWORD_TEST_ACCOUNT
        ]);

        $response->assertJsonStructure(self::THROW_ERROR_STRUCTURE)
            ->assertStatus(ErrorType::STATUS_4220);
    }

    // Test if password is missing
    public function testIfThePasswordIsMissing()
    {
        $response = $this->post('/api/login', [
            'username' => self::USERNAME_TEST_ACCOUNT,
            'password' => ''
        ]);

        $response->assertJsonStructure(self::THROW_ERROR_STRUCTURE)
            ->assertStatus(ErrorType::STATUS_4220);
    }

    // Test if password is too short
    public function testIfThePasswordLengthIsLessThanTheExpectation()
    {
        $response = $this->post('/api/login', [
            'username' => self::USERNAME_TEST_ACCOUNT,
            'password' => self::VERY_SHORT_STRING
        ]);

        $response->assertJsonStructure(self::THROW_ERROR_STRUCTURE)
            ->assertStatus(ErrorType::STATUS_4220);
    }

    // Test if password is too long
    public function testIfThePasswordLengthIsLongerThanTheExpectation()
    {
        $response = $this->post('/api/login', [
            'username' => self::USERNAME_TEST_ACCOUNT,
            'password' => self::LONGER_THAN_255_CHARACTER_STRING
        ]);

        $response->assertJsonStructure(self::THROW_ERROR_STRUCTURE)
            ->assertStatus(ErrorType::STATUS_4220);
    }

    // Test if username wrong or does not exist
    public function testIfTheUsernameWrong()
    {
        $response = $this->post('/api/login', [
            'username' => 'wrong_username',
            'password' => self::PASSWORD_TEST_ACCOUNT
        ]);

        $response->assertJsonStructure(self::THROW_ERROR_STRUCTURE)
            ->assertUnauthorized();
    }

    // Test if password is wrong
    public function testIfThePasswordWrong()
    {
        $response = $this->post('/api/login', [
            'username' => self::USERNAME_TEST_ACCOUNT,
            'password' => 'wrong_password'
        ]);

        $response->assertJsonStructure(self::THROW_ERROR_STRUCTURE)
            ->assertUnauthorized();
    }
}
