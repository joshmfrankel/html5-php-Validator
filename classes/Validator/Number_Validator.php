<?php

	/**
	 * Text_Validator.php
	 * 
	 * @author Josh Frankel
	 * @version 0.1
	 *
	 **/
	class Number_Validator extends AbstractValidator{
		

		public function validate($val) {
        	return filter_var($val, FILTER_VALIDATE_INT);
	    }

	    public function sanitize($val) {
	        return filter_var($val, FILTER_SANITIZE_NUMBER_INT);
	    }

		
	}

?>