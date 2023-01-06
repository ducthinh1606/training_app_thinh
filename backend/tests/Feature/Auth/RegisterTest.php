<?php

namespace Tests\Feature\Auth;

use App\Enums\ErrorType;
use App\Enums\SuccessType;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    // Test if user register successful
    public function testIfUserRegisterSuccess()
    {
        $response = $this->post('/api/register', [
            'username' => self::USERNAME_TEST_REGISTER_ACCOUNT,
            'password' => self::PASSWORD_TEST_ACCOUNT,
            'password_confirmation' => self::PASSWORD_TEST_ACCOUNT
        ]);

        $response->assertJsonStructure(self::THROW_SUCCESS_STRUCTURE)
            ->assertCreated();
    }

    // Test if username is too short
    public function testIfTheUsernameLengthIsLessThanTheExpectation()
    {
        $response = $this->post('/api/register', [
            'username' => self::VERY_SHORT_STRING,
            'password' => self::PASSWORD_TEST_ACCOUNT,
            'password_confirmation' => self::PASSWORD_TEST_ACCOUNT
        ]);

        $response->assertJsonStructure(self::THROW_ERROR_STRUCTURE)
            ->assertStatus(ErrorType::STATUS_4220);
    }

    // Test if username is too long
    public function testIfTheUsernameLengthIsLongerThanTheExpectation()
    {
        $response = $this->post('/api/register', [
            'username' => self::LONGER_THAN_255_CHARACTER_STRING,
            'password' => self::PASSWORD_TEST_ACCOUNT,
            'password_confirmation' => self::PASSWORD_TEST_ACCOUNT
        ]);

        $response->assertJsonStructure(self::THROW_ERROR_STRUCTURE)
            ->assertStatus(ErrorType::STATUS_4220);
    }

    // Test if username is missing
    public function testIfTheUsernameIsMissing()
    {
        $response = $this->post('/api/register', [
            'username' => '',
            'password' => self::PASSWORD_TEST_ACCOUNT,
            'password_confirmation' => self::PASSWORD_TEST_ACCOUNT
        ]);

        $response->assertJsonStructure(self::THROW_ERROR_STRUCTURE)
            ->assertStatus(ErrorType::STATUS_4220);
    }

    // Test if password is too short
    public function testIfThePasswordLengthIsLessThanTheExpectation()
    {
        $response = $this->post('/api/register', [
            'username' => self::USERNAME_TEST_REGISTER_ACCOUNT,
            'password' => self::VERY_SHORT_STRING,
            'password_confirmation' => self::VERY_SHORT_STRING
        ]);

        $response->assertJsonStructure(self::THROW_ERROR_STRUCTURE)
            ->assertStatus(ErrorType::STATUS_4220);
    }

    // Test if password is too long
    public function testIfThePasswordLengthIsLongerThanTheExpectation()
    {
        $response = $this->post('/api/register', [
            'username' => self::USERNAME_TEST_REGISTER_ACCOUNT,
            'password' => self::LONGER_THAN_255_CHARACTER_STRING,
            'password_confirmation' => self::LONGER_THAN_255_CHARACTER_STRING
        ]);

        $response->assertJsonStructure(self::THROW_ERROR_STRUCTURE)
            ->assertStatus(ErrorType::STATUS_4220);
    }

    // Test if password is missing
    public function testIfThePasswordIsMissing()
    {
        $response = $this->post('/api/register', [
            'username' => self::USERNAME_TEST_REGISTER_ACCOUNT,
            'password' => '',
            'password_confirmation' => ''
        ]);

        $response->assertJsonStructure(self::THROW_ERROR_STRUCTURE)
            ->assertStatus(ErrorType::STATUS_4220);
    }

    // Test if password confirmation is difference password
    public function testIfThePasswordConfirmationIsDifferencePassword()
    {
        $response = $this->post('/api/register', [
            'username' => self::USERNAME_TEST_REGISTER_ACCOUNT,
            'password' => self::PASSWORD_TEST_ACCOUNT,
            'password_confirmation' => 'difference_password'
        ]);

        $response->assertJsonStructure(self::THROW_ERROR_STRUCTURE)
            ->assertStatus(ErrorType::STATUS_4220);
    }

    // Test if username has already taken
    public function testIfUsernameHasAlreadyBeenTaken()
    {
        $response = $this->post('/api/register', [
            'username' => self::USERNAME_TEST_ACCOUNT,
            'password' => self::PASSWORD_TEST_ACCOUNT,
            'password_confirmation' => self::PASSWORD_TEST_ACCOUNT
        ]);

        $response->assertJsonStructure(self::THROW_ERROR_STRUCTURE)
            ->assertStatus(ErrorType::STATUS_4220);
    }
}
