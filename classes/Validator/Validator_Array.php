<?php

	/**
	 * Text_Validator.php
	 * 
	 * @author Josh Frankel
	 * @version 0.1
	 *
	 **/
	class Validator_Array extends AbstractValidator{
		

		public function validate($val) {
			if(is_array($val) && count($val) > 0) {
				return TRUE;
			}
	    }

	    public function sanitize($val) {
	        return filter_var($val, FILTER_SANITIZE_NUMBER_INT);
	    }

		
	}

?>