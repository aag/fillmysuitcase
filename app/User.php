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
        'name', 'email', 'password',
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
     * @var array
     */
    const INFO_VALIDATION_RULES = [
        'name' => 'required|max:255|unique:users',
        'email' => 'required|email|max:255|unique:users',
    ];

    /**
     * @var array
     */
    const PASS_VALIDATION_RULES = [
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
        return self::INFO_VALIDATION_RULES;
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
        return self::PASS_VALIDATION_RULES;
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
            self::INFO_VALIDATION_RULES,
            self::PASS_VALIDATION_RULES
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
