<?php

namespace App;

use App\Models\Item;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The maximum number of items that a single user can have.
     *
     * @var int
     */
    protected static $maxItems = 200;

    /**
     * Note: this should actually be a class constant, but since you can't
     * have arrays as class constants until PHP 5.6, we'll use a private
     * static instead, so we can support PHP 5.5.
     *
     * @var array
     */
    private static $infoValidationRules = [
        'username' => 'required|max:255|unique:users',
        'email' => 'required|email|max:255|unique:users',
    ];

    /**
     * Note: this should actually be a class constant, but since you can't
     * have arrays as class constants until PHP 5.6, we'll use a private
     * static instead, so we can support PHP 5.5.
     *
     * @var array
     */
    private static $passValidationRules = [
        'password' => 'required|confirmed|min:6',
    ];

    /**
     * Returns the validation rules for user info.
     * 
     * @static
     * @access public
     * @return array
     */
    public static function getInfoValidationRules()
    {
        return self::$infoValidationRules;
    }

    /**
     * Returns the validation rules for a user's password.
     * 
     * @static
     * @access public
     * @return array
     */
    public static function getPasswordValidationRules()
    {
        return self::$passValidationRules;
    }

    /**
     * Returns the validation rules for a user info and password.
     * 
     * @static
     * @access public
     * @return array
     */
    public static function getAllValidationRules()
    {
        return array_merge(
            self::$infoValidationRules,
            self::$passValidationRules
        );
    }

   /**
     * Returns this user's items list.
     * 
     * @access public
     * @return an Eloquent collection
     */
    public function items()
    {
        return $this->hasMany('\App\Models\Item');
    }

    /**
     * Returns true if the user already has the maximum number of
     * items allowed.
     * 
     * @access public
     * @return bool
     */
    public function hasMaxItems()
    {
        return ($this->items()->count() >= self::$maxItems);
    }

    /**
     * Returns the maximum number of items that this user can have.
     * 
     * @access public
     * @return int
     */
    public function getNumMaxItems()
    {
        return self::$maxItems;
    }

    /**
     * Accepts an array of property names to values and returns the ones
     * which are different from the current user object.
     * 
     * @param array $properties 
     * @access public
     * @return array
     */
    public function getChangedProperties(array $properties)
    {
        $changed = [];

        foreach ($properties as $name => $value) {
            if (isset($this->$name) && $this->$name !== $value) {
                $changed[$name] = $value;
            }
        }

        return $changed;
    }
}
