<?php

/**
 * Abstract Validator
 * 
 * An abstract base class for all validator classes
 * 
 * @author Josh Frankel <joshmfrankel@gmail.com>
 * @abstract
 * @copyright 2011-2012
 * @version 0.8
 */
abstract class AbstractValidator {

	/**
	 * validate abstract function
	 * 
	 * @abstract
	 * @param  mixed $val The input value
	 * @return bool
	 */
	public abstract function validate($val);

	/**
	 * sanitize abstract function
	 * 
	 * @abstract
	 * @param  mixed $val The input value
	 * @return mixed
	 */
	public abstract function sanitize($val);



 	///////////////////
	// COMMON METODS //
 	///////////////////
 	
 	/**
 	 * Factory Pattern method
 	 * 
 	 * Instantiates new validator objects based on the type
 	 * of input to validate
 	 * 
 	 * @static
 	 * @param  string $className The class name or type of input to validate
 	 * @return Validator class of specified type
 	 */
 	public static function factory($className) {


		  switch ($className) {

            case 'text':

            	$className = 'String_Validator';

                break;
            case 'email':

                $className = 'Email_Validator';

                break;

            case 'tel':

                /**
                 * @todo  Add a class for telephone numbers.
                 *        Should extend Number_Validator
                 */
                $className = 'String_Validator';

                break;
                
            case 'radio':
            case 'checkbox':

                /**
                 * @todo  Add a class for checkboxes and radio buttons
                 */
                $className = 'String_Validator';

                break;

            case 'range':
            case 'number':

                $className = 'Number_Validator';

                break;
            
            default:

                break;
        }


        return new $className;
    }
 	
 	/**
 	 * isEqual
 	 * 
 	 * @param  string  $val1 The first value to evaluate
 	 * @param  string  $val2 The second value to evaluate
 	 * @return boolean
 	 */
	public function isEqual($val1, $val2) {
		return ($val1 === $val2 ? TRUE : FALSE);
	}

	/**
	 * validatedByRegex
	 * 
	 * @param  string $regex The regex string to match the value against
	 * @param  string $val   The input string
	 * @return int preg_match will return 1 on match or 0 on no match
	 */
	public function validateByRegex($regex, $val) {
		return preg_match($regex, $val);
	}

	/**
	 * isGreaterThan
	 * 	
	 * @param  int  $min The minimum accepted value
	 * @param  int  $val The input value
	 * @return boolean
	 */
	public function isGreaterThan($min, $val) {
        return ($val > $min ? TRUE : FALSE);
    }

    /**
     * isGreaterThan
     * 
     * @param  int  $max The maximum accepted value
     * @param  int  $val The input value
     * @return boolean
     */
    public function isLessThan($max, $val) {
        return ($val < $max ? TRUE : FALSE);
    }
}

?>