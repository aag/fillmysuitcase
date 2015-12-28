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

    public function testLongUtfPasswordWorks()
    {
        // Bcrypt won't actually use the whole string when hashing, but make
        // sure the system accepts really long passwords.
        $longPass = '☺♘✓"V:%§!$&@€()[]{}\/#*+~FrK;?s6F:=-L\BG$L\w*96l-c-o^$2R\'~rDzo#diWSR=l5*59~WoVfS/gq1aLTykRGP-J3iw;07}ate*Nd>gvnj$[EEDepDwz;mVud4/OL7g\'*)xM.E+5RvWzHH4';

        $validAttribs = array(
            'username' => 'TestUser',
            'email' => 'test@example.com',
            'password' => bcrypt($longPass),
            'remember_token' => 'REMEMBERME',
        );
        $validUser = new User($validAttribs);

        $this->assertTrue(app('hash')->check($longPass, $validUser->password));
    }
}
