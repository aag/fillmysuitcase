<?php

namespace Tests\Unit;

use App\User;

class UnitTest extends \Tests\TestCase {

    public function testValidUserCreation()
    {
        $validAttribs = array(
            'username' => 'TestUser',
            'email' => 'test@example.com',
            'password' => bcrypt('testpass'),
            'remember_token' => 'REMEMBERME',
        );
        $validUser = new User($validAttribs);

        $this->assertEquals('TestUser', $validUser->username);
        $this->assertEquals('test@example.com', $validUser->email);
        $this->assertTrue(app('hash')->check('testpass', $validUser->password));
    }
}
