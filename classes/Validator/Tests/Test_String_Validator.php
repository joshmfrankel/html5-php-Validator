<?php

	/**
	 * Test_String_Validator.php
	 * 
	 * @author Josh Frankel
	 * @version 0.1
	 *
	 **/

	require_once '../ValidatorAbstract.php';
    require_once '../Validator_String.php';
    

	class Test_String_Validator extends PHPUnit_Framework_TestCase {

		protected $fixture;
		
		protected function setUp() {
			$this->fixture = new Validator_String();
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

		public function testSanitize() {
			$this->assertEquals($this->fixture->sanitize('Jimbo'), 'Jimbo');
			$this->assertEquals($this->fixture->sanitize("Josh's"), "Josh&#39;s");
			$this->assertEquals($this->fixture->sanitize("<strong>Monkey Love</strong>"), "Monkey Love");
		}

		public function testValidateByRegex() {
			$this->assertEquals($this->fixture->validateByRegex("(\d+)", "90210 15648"), 1);
			$this->assertEquals($this->fixture->validateByRegex("(\d{6})", "90210 15648"), 0);
		}

		public function testIsEqual() {

			/**
			 * TRUE
			 */
			$this->assertTrue($this->fixture->isEqual('t', 't'));
			$this->assertTrue($this->fixture->isEqual(5, 5));
			$this->assertTrue($this->fixture->isEqual(TRUE, TRUE));

			/**
			 * FALSE
			 */
			$this->assertFalse($this->fixture->isEqual('t', 'a'));
			$this->assertFalse($this->fixture->isEqual(0, '0'));
			$this->assertFalse($this->fixture->isEqual(TRUE, FALSE));
		}
		
	}

?>