<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use LaravelBook\Ardent\Ardent;

class User extends Ardent implements UserInterface, RemindableInterface {

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
	protected $hidden = array('password', 'remember_token');

    /**
     * The attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = array(
        'username', 'email', 'password', 'password_confirmation'
    );

    /**
     * The rules to use for validating this model (used by Ardent).
     *
     * @var array
     */
    public static $rules = array(
        'username' => 'required|unique:users',
        'email'    => 'required|unique:users|email',
    );

    /**
     * The rules to use for validating the password.  This is not included
     * in the model rules, because we don't want to require a confirmed
     * password every time we change the User's data.
     *
     * @var array
     */
    public static $passwordRules = array(
        'password' => 'required|min:6|confirmed',
    );

    /**
     * passwordValid accepts an array with 'password' and
     * 'password_confirmation' elements and returns true if they pass the
     * password validation rules.
     * 
     * @param mixed $inputs 
     * @static
     * @access public
     * @return void
     */
    public function passwordValid($inputs) {
        $passValidator = Validator::make($inputs, self::$passwordRules);
        if ($passValidator->fails()) {
            $this->errors()->merge($passValidator->messages()->toArray());
            return false;
        }

        return true;
    }

    /**
     * passwordEmptyOrValid accepts an array with 'password' and
     * 'password_confirmation' keys and returns true if the password in 
     * $inputs is empty or valid.  If it's non-empty and valid, this user's
     * password is set to the one in the Inputs.
     * 
     * @param Array $passInputs
     * @access private
     * @return boolean
     */
    public function passwordEmptyOrValid($inputs) {
        if (!empty($inputs['password']) && !$this->passwordValid($inputs))
        {
            return false;
        }

        $this->password = $inputs['password'];
        return true;
    }

    /**
     * Tell Ardent to hash the password field before storing to the database.
     */
    public $autoHashPasswordAttributes = true;
    public static $passwordAttributes = array('password');

    /**
     * Tell Ardent to remove the password_confirmation field before storing
     * to the database.
     */
    public $autoPurgeRedundantAttributes = true;

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
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param string $value
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

   	/**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    /**
     * items returns this user's items list.
     * 
     * @access public
     * @return an Eloquent collection
     */
    public function items()
    {
        return $this->hasMany('Item');
    }

}
