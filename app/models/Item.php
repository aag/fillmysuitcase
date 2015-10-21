<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use LaravelBook\Ardent\Ardent;

class Item extends Ardent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'items';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('user_id');

    /**
     * The attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = array(
        'user_id', 'name', 'packed'
    );

    /**
     * Default values for attributes that are not set at construction.
     * 
     * @var array
     */
    protected $attributes = array(
        'packed' => false,
    );

    /**
     * The rules to use for validating this model (used by Ardent).
     *
     * @var array
     */
    public static $rules = array(
        'name' => 'required|max:100',
    );

    /**
     * toArray overrides the default toArray implementation so we can
     * convert DB booleans to PHP booleans.
     *
     * This is needed for proper JSON encoding.
     * 
     * @access public
     * @return array
     */
    public function toArray()
    {
        $array = parent::toArray();
        $array['packed'] = (boolean) $this->packed;
        return $array;
    }

}

