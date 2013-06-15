<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

    /**
     * The attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = array('username', 'password', 'email');

    /**
     * The rules to use for validating this model.
     *
     * @var array
     */
    protected static $validationRules = array(
        'username' => 'required|unique:users',
        'password' => 'required|min:6',
        'email'    => 'required|unique:users|email',
    );

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

    /**
     * Makes a validator with the User's validation rules
     *
     * @param array $attribs 
     *
     * @return Validator
     */
    public static function makeValidator($attribs)
    {
        return Validator::make($attribs, User::$validationRules);
    }

    /**
     * setPasswordAttribute is a mutator for the password attribute.  Every
     * time the password is set on the model, it should be hashed before
     * being stored.
     * 
     * @param string $value
     * @access public
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

}
