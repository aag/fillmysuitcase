<?php

class UserTest extends TestCase {

    public function setUp()
    {
        $this->validAttribs = array(
            'username' => 'unittestuser',
            'password' => 'unittestpass',
            'email'    => 'ut@test.com',
        );
        $this->validUser = new User($this->validAttribs);

        $this->validAttribs2 = array(
            'username' => 'unittestuser2',
            'password' => 'unittestpass2',
            'email'    => 'ut2@test.com',
        );
    }

    public function tearDown()
    {
    }

	public function testUserCreation()
	{
		$this->assertEquals($this->validAttribs['username'], $this->validUser->username);
		$this->assertEquals($this->validAttribs['email'], $this->validUser->email);
	}

    public function testValidUserValidation()
    {
        $this->assertTrue($this->validUser->validate());
    }

    public function testEmptyUsernameIsInvalid()
    {
        $attrs = $this->validAttribs;
        unset($attrs['username']);

        $user = new User($attrs);
        $this->assertFalse($user->validate());
    }

    public function testEmptyPasswordIsInvalid()
    {
        $attrs = $this->validAttribs;
        unset($attrs['password']);

        $user = new User($attrs);
        $this->assertFalse($user->validate());
    }

    public function testShortPasswordIsInvalid()
    {
        $attrs = $this->validAttribs;
        $attrs['password'] = 'abcde';

        $user = new User($attrs);
        $this->assertFalse($user->validate());
    }

    public function testEmptyEmailIsInvalid()
    {
        $attrs = $this->validAttribs;
        unset($attrs['email']);

        $user = new User($attrs);
        $this->assertFalse($user->validate());
    }

    public function testNonEmailIsInvalid()
    {
        $attrs = $this->validAttribs;
        $attrs['email'] = 'mail';

        $user = new User($attrs);
        $this->assertFalse($user->validate());
    }




}
