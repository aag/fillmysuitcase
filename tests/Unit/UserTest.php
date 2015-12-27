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
        $validItem = new User($validAttribs);

        $this->assertEquals('TestUser', $validItem->username);
    }

}
