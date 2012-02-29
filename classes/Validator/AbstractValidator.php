<?php

/**
 * 
 */
abstract class AbstractValidator {

	/**
	 * validate abstract function
	 * 
	 * @param  mixed $val The input value
	 * @return bool
	 */
	public abstract function validate($val);

	/**
	 * sanitize abstract function
	 * 
	 * @param  mixed $val The input value
	 * @return mixed
	 */
	public abstract function sanitize($val);



 	///////////////////
	// COMMON METODS //
 	///////////////////
 	
	public function isEqual($val1, $val2) {
		return ($val1 === $val2 ? TRUE : FALSE);
	}

	public function validateByRegex() {

	}
}

?>