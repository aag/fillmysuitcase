<?php

class UserTest extends TestCase {

    public function setUp()
    {
        parent::setUp();

        $this->validAttribs = array(
            'username' => 'unittestuser',
            'email'    => 'ut@test.com',
            'password' => 'unittestpass',
            'password_confirmation' => 'unittestpass',
        );
        $this->validUser = new User($this->validAttribs);

        $this->validAttribs2 = array(
            'username' => 'unittestuser2',
            'email'    => 'ut2@test.com',
            'password' => 'unittestpass2',
            'password_confirmation' => 'unittestpass2',
        );
    }

    public function tearDown()
    {
        $this->validUser->delete();
    }

    public function testUserCreation()
    {
        $this->assertEquals($this->validAttribs['username'], $this->validUser->username);
        $this->assertEquals($this->validAttribs['email'], $this->validUser->email);
    }

    public function testValidUserValidation()
    {
        $user = $this->validUser;
        $attrs = $this->validAttribs;
        $this->assertTrue($user->validate() && $user->passwordValid($attrs));
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
        $this->assertFalse($user->validate() && $user->passwordValid($attrs));
    }

    public function testShortPasswordIsInvalid()
    {
        $attrs = $this->validAttribs;
        $attrs['password'] = 'abcde';

        $user = new User($attrs);
        $this->assertFalse($user->validate() && $user->passwordValid($attrs));
    }

    public function testUnconfirmedPasswordIsInvalid()
    {
        $attrs = $this->validAttribs;
        $attrs['password_confirmation'] = '';

        $user = new User($attrs);
        $this->assertFalse($user->validate() && $user->passwordValid($attrs));
    }

    public function testNonMatchingPasswordIsInvalid()
    {
        $attrs = $this->validAttribs;
        $attrs['password'] = 'abcdef';
        $attrs['password_confirmation'] = 'ghijkl';

        $user = new User($attrs);
        $this->assertFalse($user->validate() && $user->passwordValid($attrs));
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

    public function testIsPassword()
    {
        // Make Ardent hash the password
        $this->validUser->save();

        $this->assertTrue($this->validUser->isPassword($this->validAttribs['password']));
        $this->assertFalse($this->validUser->isPassword(''));
        $this->assertFalse($this->validUser->isPassword(' '));
        $this->assertFalse($this->validUser->isPassword(' ' . $this->validAttribs['password']));
    }

}
