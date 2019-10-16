<?php

declare(strict_types=1);

namespace Internet\InterValid\Tests;

use PHPUnit\Framework\TestCase;
use Internet\InterValid\ListValidator;

class ListValidatorTest extends TestCase {
	/** @var array */
	public static $data;
	/** @var ListValidator */
	public $validator;
	/** @var string Class under test. */
	public static $class = 'Internet\\InterValid\\ListValidator';

	static function setUpBeforeClass(): void{
		static::$data = [
			"MY_VAR" => "hello, world",
			"MY_INT" => 12,
			"MY_FLOAT" => 15.7,
			"MY_BOOL" => false,
			"MY_BOOL_STR" => "yes",
			"MY_LIST" => "a,b,c,d"
		];
	}

	protected function setUp(): void{
		$this->validator = new static::$class(static::$data);
	}

	public function testCanBeCreated(): void{
		$this->expectNotToPerformAssertions();
		new static::$class();
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
		$this->assertEquals(10, $this->validator->int("MY_INT", 0, 1, 10));
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
		$this->assertEquals(static::$data, $this->validator->data());
	}

	public function testBulkRaw(): void{
		$this->assertEquals(static::$data, $this->validator->bulk(array_fill_keys(array_keys(static::$data), FILTER_UNSAFE_RAW)));
		$this->assertEquals(static::$data, $this->validator->bulk(FILTER_UNSAFE_RAW));
	}

	public function testRawReturnsNothing(): void{
		$this->assertNull($this->validator->raw('NON_EXISTANT'));
	}
}