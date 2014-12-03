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

        // Bcrypt won't actually use the whole string when hashing, but make
        // sure the system accepts really long passwords.
        $goodPass = '☺♘✓"V:%§!$&@€()[]{}\/#*+~FrK;?s6F:=-L\BG$L\w*96l-c-o^$2R\'~rDzo#diWSR=l5*59~WoVfS/gq1aLTykRGP-J3iw;07}ate*Nd>gvnj$[EEDepDwz;mVud4/OL7g\'*)xM.E+5RvWzHH4';
        $this->validAttribsLongPassword = array(
            'username' => 'unittestuser',
            'email'    => 'ut@test.com',
            'password' => $goodPass,
            'password_confirmation' => $goodPass,
        );
        $this->validUserLongPassword = new User($this->validAttribsLongPassword);
    }

    public function tearDown()
    {
        $this->validUser->delete();
        $this->validUserLongPassword->delete();
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

    // Make sure really long passwords with strange characters work
    public function testLongComplicatedPassword()
    {
        $user = $this->validUserLongPassword;
        $attrs = $this->validAttribsLongPassword;
        $this->assertTrue($user->validate() && $user->passwordValid($attrs));

        // Make sure the hashing works too
        $user->save();
        $this->assertTrue($user->isPassword($this->validAttribsLongPassword['password']));
    }

}
