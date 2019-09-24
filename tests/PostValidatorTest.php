<?php

declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Internet\InterValid\PostValidator;

final class PostValidatorTest extends TestCase {

	public $data;
	/** @var PostValidator */
	public $validator;
	protected function setUp(): void{
		$this->data = [
			"MY_VAR" => "hello, world",
			"MY_INT" => 12,
			"MY_FLOAT" => 15.7,
			"MY_BOOL" => false,
			"MY_BOOL_STR" => "yes",
			"MY_LIST" => "a,b,c,d"
		];
		$_POST = array_merge($_POST, $this->data);

		$this->validator = new PostValidator();
	}

	public function testCanBeCreated(): void{
		$this->expectNotToPerformAssertions();
		new PostValidator();
	}

	public function testHasReturnsTrueIfExists(): void{
		$this->assertTrue($this->validator->has("MY_VAR"));
	}

	public function testHasReturnsFalseIfNotExists(): void{
		$this->assertFalse($this->validator->has("BAD_KEY"));
	}

	public function testIntReturnsIntegers(): void{
		$this->assertEquals(12, $this->validator->int("MY_INT"));
		$this->assertFalse($this->validator->int("MY_FLOAT"));

		$this->assertEquals(20, $this->validator->int("MY_FLOAT", 20));
		$this->assertFalse($this->validator->int("MY_INT", 0, 1, 10));
	}

	public function testBoolReturnsBooleans(): void{
		$this->assertFalse($this->validator->bool("MY_BOOL"));
		$this->assertTrue($this->validator->bool("MY_BOOL_STR"));
	}

	public function testBoolCSVList(): void{
		$this->assertEquals(['a', 'b', 'c', 'd'], $this->validator->commaList("MY_LIST"));
	}

	public function testRaw(): void{
		$this->assertEquals("a,b,c,d", $this->validator->raw("MY_LIST"));
	}

	public function testData(): void{
		$this->assertEquals($_POST, $this->validator->data());
	}
}