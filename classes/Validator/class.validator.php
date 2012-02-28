<?php

/**
 * Validator
 * 
 * A validator class for html5 forms
 *
 * @author Joshua Frankel <joshmfrankel@gmail.com>
 * @see http://www.joshmfrankel.com
 * @copyright 2012
 * @version 0.1a
 * 
 */
class Validator {
    
    
    /**
     * Constructor
     */
    public function __construct() {
        
    }
    
    /**
     * Number Validation and Sanitization
     * 
     * Returns a boolean value to show if TRUE or FALSE
     * 
     * @param int $val 
     * @return boolean 
     */
    public function validateNumber($val) {
        return filter_var($val, FILTER_VALIDATE_INT);
    }

    public function validateMinNumber($val, $min) {
        return ($val > $min ? TRUE : FALSE);
    }
    public function validateMaxNumber($val, $max) {
        return ($val < $max ? TRUE : FALSE);
    }

    public function sanitizeNumber($val) {
        return filter_var($val, FILTER_SANITIZE_NUMBER_INT);
    }

    /**
     * Email Validation and Sanitization
     * 
     * @param int $val 
     * @return boolean 
     */
    public function validateEmail($val) {
        return filter_var($val, FILTER_VALIDATE_EMAIL);
    }

    public function sanitizeEmail($val) {
        return filter_var($val, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Text Validation and Sanitization
     * @note yes they use the same method for a reason
     */
    public function validateText($val) {
        return filter_var($val, FILTER_SANITIZE_STRING);
    }

    public function sanitizeText($val) {
        return filter_var($val, FILTER_SANITIZE_STRING);
    }

    /**
     * @todo  Compare function for passwords
     *        and hidden pasphrases
     */
    

}

?>
