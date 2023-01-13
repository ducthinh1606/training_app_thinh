<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    const USERNAME_TEST_REGISTER_ACCOUNT = 'testAccount';
    const USERNAME_TEST_ACCOUNT = 'admin';
    const PASSWORD_TEST_ACCOUNT = '12345678';
    const LONGER_THAN_255_CHARACTER_STRING = 'DFVevmb3NhPfq2Bne47NAcZd5GSG72RDTX4uGV2Efe9UREYDjdFbFuZTvG7vhZ0yhSMCgfriRcSOT3suJn6NTR98lTtH4CJ9vinzE9Z9T5wvWuPf7fkn4jtJ2PS3rLpLAA2BcQataSWdPAD6oxDN4ilBxi6QQueskwBMTxh9DzQTAsRb4DIWfZ4AUYXXaMQDN9v7OGiyXGn1LdeOFSECrIiLjLdu2RnOiqgn1Gu0smqycLxII7LJMquaPKuCG0Z7';
    const VERY_SHORT_STRING = 'a';
    const TASK_NAME_TEST = 'Task name';
    const ESTIMATE_FORMAT = 'Y-m-d\TH:i';
    const THROW_SUCCESS_WITH_DATA_STRUCTURE = ['data', 'message'];
    const THROW_SUCCESS_STRUCTURE = ['code', 'message'];
    const THROW_ERROR_STRUCTURE = ['error' => ['code', 'message']];

    const HEADER_ACCEPT_APPLICATION_JSON = ['Accept' => 'application/json'];

    public function setUp():void
    {
        parent::setUp();
        Artisan::call('migrate');
        // Create user with ['username' => 'admin', 'password' => '12345678']
        Artisan::call('db:seed');
    }

    public function tearDown():void
    {
        Artisan::call('migrate:rollback');
        parent::tearDown();
    }

    // Create header with Bearer token
    protected function createToken(): array
    {
        $user = $this->post('/api/login', [
            'username' => self::USERNAME_TEST_ACCOUNT,
            'password' => self::PASSWORD_TEST_ACCOUNT
        ]);

        return ['Authorization' => 'Bearer ' . $user['data']['token'], self::HEADER_ACCEPT_APPLICATION_JSON];
    }
}
