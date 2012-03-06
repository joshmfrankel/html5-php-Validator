<?php

/**
 * Text_Validator.php
 * 
 * @author Joshua Frankel <joshmfrankel@gmail.com>
 * @copyright 2011-2012, All Rights Reserved
 * @license MIT License http://www.opensource.org/licenses/mit-license.php
 * @see http://www.joshmfrankel.com
 * @version 0.8
 */
class Validator_Number extends ValidatorAbstract{
	

	public function validate($val) {
    	return filter_var($val, FILTER_VALIDATE_INT);
    }

    public function sanitize($val) {
        return filter_var($val, FILTER_SANITIZE_NUMBER_INT);
    }

	
}

?>