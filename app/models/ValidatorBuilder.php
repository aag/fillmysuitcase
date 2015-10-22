<?php

/**
 *  This is a trait to that creates a standardized way to do validation
 *  in classes.
 */
trait ValidatorBuilder
{
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
     * getValidationRules returns an array containing the validation rules
     * for this class. Each class using this trait must implement this method.
     * 
     * @abstract
     * @access public
     * @return array
     */
    abstract public function getValidationRules();
}
