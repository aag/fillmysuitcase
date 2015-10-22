<?php

use Illuminate\Support\MessageBag;

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
     * isValid returns true if the given data is valid for this object. If it
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
            $this->messages = $validator->messages();
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
    public function messages()
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
