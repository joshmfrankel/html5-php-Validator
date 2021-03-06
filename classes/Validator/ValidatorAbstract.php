<?php

/**
 * Abstract Validator
 * 
 * An abstract base class for all validator classes
 * 
 * @author Joshua Frankel <joshmfrankel@gmail.com>
 * @copyright 2011-2012, All Rights Reserved
 * @license MIT License http://www.opensource.org/licenses/mit-license.php
 * @see http://www.joshmfrankel.com
 * @version 0.8
 */
abstract class ValidatorAbstract {

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
     * of input to validate.  Is declared as static final
     * to allow usage anywhere in the application while also
     * preventing inheriting classes from overriding the logic.
     * 
     * @static
     * @final
     * @param  string $className The class name or type of input to validate
     * @return Validator class of specified type
     */
    public static final function factory($className) {

        //prefix
        $prefix = 'Validator_';

        //Manually set the class name if there is no specific
        //class file
        switch ($className) {

            case 'string':
            case 'search':

                $className = 'Text';

                break;

            case 'tel':
            case 'telephone':
            case 'phone':

                /**
                 * @todo  Add a class for telephone numbers.
                 *        Should extend Number_Validator
                 */
                $className = 'Text';

                break;
                
            case 'radio':
            case 'checkbox':

                /**
                 * @todo  Add a class for checkboxes and radio buttons
                 */
                $className = 'Text';

                break;

            case 'range':

                $className = 'Number';

                break;


            case 'file':
                break;

            case 'date':
            case 'datetime':
            case 'datetime-local':
            case 'month':
            case 'time':
            
                break;
            default:

                break;
        }

        //prefix the class name
        $className = $prefix . $className;


        /**
         * @todo Exception Handling if there is no valid class file
         */
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