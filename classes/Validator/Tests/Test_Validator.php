<?php

/**
 * Test_String_Validator.php
 * 
 * @author Joshua Frankel <joshmfrankel@gmail.com>
 * @copyright 2011-2012, All Rights Reserved
 * @license MIT License http://www.opensource.org/licenses/mit-license.php
 * @see http://www.joshmfrankel.com
 * @version 0.8
 **/

require_once '../ValidatorAbstract.php';
require_once '../Validator_String.php';
require_once '../Validator_Array.php';


class Test_Validator extends PHPUnit_Framework_TestCase {

	protected $fixture;
	protected $fixture_array;
	
	protected function setUp() {
		$this->fixture       = new Validator_String();
		$this->fixture_array = new Validator_Array();
	}

	public function testArrayValidate() {
		$test[0] = "hi"; 
		$this->assertTrue($this->fixture_array->validate($test));

		$test = array();
		$this->assertFalse($this->fixture_array->validate($test));

		$test = '';
		$this->assertFalse($this->fixture_array->validate($test));
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