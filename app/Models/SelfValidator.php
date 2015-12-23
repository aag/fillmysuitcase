<?php

namespace App\Models;

use Illuminate\Support\MessageBag;
use Validator;

/**
 *  This is a trait to that creates a standardized way to do validation
 *  in classes.
 */
trait SelfValidator
{
    private $messages;

    /**
     * getValidator returns a validator object with the given data and the
     * rules for this class already configured.
     * 
     * @param array $data 
     * @access public
     * @return Validator
     */
    public function getValidator($data)
    {
        return Validator::make($data, $this->getValidationRules());
    }

    /**
     * Get a Validator for the attributes in the given array that are different
     * from the existing data in the object.
     * 
     * @param array $data 
     * @access public
     * @return Validator
     */
    public function getUpdateValidator($data)
    {
        $updateRules = [];
        foreach ($this->getValidationRules() as $name => $rule) {
            if ($this->attributes[$name] !== $data[$name]) {
                $updateRules[$name] = $rule;
            }
        }

        return Validator::make($data, $updateRules);
    }

    /**
     * Returns true if the given data is valid for this object. If it
     * is not valid, the error messages from the validator are stored in the
     * object.
     * 
     * @param array $data 
     * @access public
     * @return bool
     */
    public function isValid($data)
    {
        $validator = $this->getValidator($data);
        if ($validator->fails()) {
            $this->errors()->merge($validator->messages()->toArray());
            return false;
        }

        return true;
    }

    /**
     * Returns true if the given data is valid update data for this object. If
     * it is not valid, the error messages from the validator are stored in the
     * object.
     *
     * This function is especially useful if you have unique constraints in
     * your class. With this method, the unique validation will not fail if
     * the unique attributes are not being changed.
     * 
     * @param array $data 
     * @access public
     * @return bool
     */
    public function isValidUpdate($data)
    {
        $validator = $this->getUpdateValidator($data);
        if ($validator->fails()) {
            $this->errors()->merge($validator->messages()->toArray());
            return false;
        }

        return true;
    }

    /**
     * Returns a MessageBag of the object's validation messages, if
     * there are any.
     * 
     * @access public
     * @return MessageBag
     */
    public function errors()
    {
        if (is_null($this->messages)) {
            $this->messages = new MessageBag();
        }

        return $this->messages;
    }

    /**
     * getValidationRules returns an array containing the validation rules
     * for this class. Each class using this trait must implement this method.
     * 
     * @abstract
     * @access public
     * @return array
     */
    abstract public function getValidationRules();
}
