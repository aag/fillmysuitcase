<?php

class UserTest extends TestCase {

    public function setUp()
    {
        $username = 'unittestuser';
        $password = 'unittestpass';
        $email    = 'ut@test.com';

        $this->validAttribs = array(
            'username' => $username,
            'password' => $password,
            'email'    => $email,
        );

    }

	public function testUserCreation()
	{
        $user = new User($this->validAttribs);

		$this->assertEquals($this->validAttribs['username'], $user->username);
		$this->assertEquals($this->validAttribs['email'], $user->email);
        $this->assertStringStartsWith('$2y$08$', $user->password);
        $this->assertTrue(Hash::check($this->validAttribs['password'], $user->password));
	}

    public function testValidUserValidation()
    {
        $validator = User::makeValidator($this->validAttribs);
        $this->assertFalse($validator->fails());
    }

}
