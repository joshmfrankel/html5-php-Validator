<?php

/**
 * 
 */
interface iValidator {

	public function isEmpty();

	public function validateByRegex();

	public function validate();

	public function sanitize();
}

?>