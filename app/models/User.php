<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {
    use SelfValidator;

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
     * The maximum number of items that a single user can have.
     *
     * @var int
     */
    protected static $maxItems = 200;

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
     * The rules to use for validating this model.
     *
     * @var array
     */
    public function getValidationRules()
    {
        return [
            'username' => 'required|unique:users|max:64',
            'email'    => 'required|unique:users|email',
        ];
    }

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
     * isPassword returns true if the given string is the user's current
     * password, else returns false.
     * 
     * @param mixed $password 
     * @access public
     * @return void
     */
    public function isPassword($password)
    {
        return Hash::check($password, $this->getAuthPassword());
    }

    /**
     * When setting the password, hash it before setting it on the model.
     * 
     * @param string $password 
     * @access public
     * @return void
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

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

    /**
     * hasMaxItems returns true if the user already has the maximum number of
     * items allowed.
     * 
     * @access public
     * @return bool
     */
    public function hasMaxItems()
    {
        return ($this->items()->count() >= self::$maxItems);
    }

}
