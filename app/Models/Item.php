<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {
    use SelfValidator;

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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'packed' => 'boolean',
    ];

    /**
     * The rules to use for validating this model.
     *
     * @var array
     */
    public function getValidationRules()
    {
        return [
            'name' => 'required|max:100',
        ];
    }

}

