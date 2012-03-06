<?php

	/**
	 * Text_Validator.php
	 * 
	 * @author Josh Frankel
	 * @version 0.1
	 *
	 **/
	class Validator_String extends ValidatorAbstract{
		

		public function validate($val) {
			return (!is_null($val) && strlen($val) != 0 ? TRUE : FALSE);
	    }

	    public function sanitize($val) {
	        return filter_var($val, FILTER_SANITIZE_STRING);
	    }
		
	}

?>