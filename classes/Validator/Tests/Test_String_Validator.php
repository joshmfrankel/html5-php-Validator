<?php

	/**
	 * Test_String_Validator.php
	 * 
	 * @author Josh Frankel
	 * @version 0.1
	 *
	 **/

	require_once '../AbstractValidator.php';
    require_once '../string_validator.php';
    

	class Test_String_Validator extends PHPUnit_Framework_TestCase {

		protected $fixture;
		
		protected function setUp() {
			$this->fixture = new String_Validator();
		}

		public function testValidate() {

			/**
			 * TRUE
			 */
			$this->assertTrue($this->fixture->validate('temp'));
			$this->assertTrue($this->fixture->validate('0'));
			$this->assertTrue($this->fixture->validate(TRUE));
			$this->assertTrue($this->fixture->validate(234));

			/**
			 * FALSE
			 */
			$this->assertFalse($this->fixture->validate(''));
			$this->assertFalse($this->fixture->validate(NULL));
		}
		
	}

?>