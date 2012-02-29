<?php

	/**
	 * Email_Validator.php
	 * 
	 * @author Josh Frankel
	 * @version 0.1
	 *
	 **/
	class Email_Validator extends AbstractValidator{


	    public function validate($val) {
	        return filter_var($val, FILTER_VALIDATE_EMAIL);
	    }

	    public function sanitize($val) {
	        return filter_var($val, FILTER_VALIDATE_EMAIL);
	    }

		
	}

?>