<?php

declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Internet\InterValid\ListValidator;

final class ListValidatorTest extends TestCase {
	public $testList = [
		"MY_VAR" => "hello, world",
		"MY_INT" => 12,
		"MY_FLOAT" => 15.7,
		"MY_BOOL" => false,
		"MY_BOOL_STR" => "yes"
	];

	public function testCanBeCreated(): void{
		$this->expectNotToPerformAssertions();
		$validator = new ListValidator($this->testList);
	}

	public function testHasReturnsTrueIfExists(): void{
		$validator = new ListValidator($this->testList);
		$this->assertTrue($validator->has("MY_VAR"));
	}

	public function testHasReturnsFalseIfNotExists(): void{
		$validator = new ListValidator($this->testList);
		$this->assertFalse($validator->has("BAD_KEY"));
	}

	public function testIntReturnsIntegers(): void{
		$validator = new ListValidator($this->testList);
		$this->assertEquals(12, $validator->int("MY_INT"));
		$this->assertFalse($validator->int("MY_FLOAT"));

		$this->assertEquals(20, $validator->int("MY_FLOAT", 20));
		$this->assertFalse($validator->int("MY_INT", 0, 1, 10));
	}
}