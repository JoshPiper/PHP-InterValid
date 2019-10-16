<?php

declare(strict_types=1);

namespace Internet\InterValid\Tests;

use PHPUnit\Framework\TestCase;
use Internet\InterValid\ListValidator;
use Internet\InterValid\CommandValidator;

final class CommandValidatorTest extends ListValidatorTest {
	public static $class = 'Internet\\InterValid\\CommandValidator';

	static function setUpBeforeClass(): void{
		static::$data = [
			"MY_VAR" => "hello, world",
			"MY_INT" => 12,
			"MY_FLOAT" => 15.7,
			"MY_BOOL" => false,
			"MY_BOOL_STR" => "yes",
			"MY_LIST" => "a,b,c,d",
			"verbose" => true,
			"v" => 3,
			"q" => true,
			"option" => "value",
			"bool" => "no",
			"csv" => "this,is,stupid"
		];
	}

	public function testOptions(): void{
		$this->assertEquals(true, $this->validator->option("verbose", "v"));
		$this->assertEquals(true, $this->validator->option("verbose", false));
		$this->assertEquals(3, $this->validator->option("v", "verbose"));
		$this->assertEquals("this,is,stupid", $this->validator->option("csv", false));
	}

	public function testIntegerOptions(): void{
		$this->assertEquals(1, $this->validator->intOption("verbose", "v"));
		$this->assertEquals(1, $this->validator->intOption("verbose", false));
		$this->assertEquals(3, $this->validator->intOption("v", "verbose"));

		$this->assertEquals(0, $this->validator->intOption("fake", true, 0, 1, 10));
		$this->assertEquals(0, $this->validator->intOption("verbose", true, 0, 5, 10));

		$this->assertEquals(1, $this->validator->intOption("verbose", true, 1, 5, 10));
	}

	public function testBooleanOptions(): void{
		$this->assertEquals(true, $this->validator->boolOption("quiet"));
		$this->assertEquals(false, $this->validator->boolOption("quiet", false));
		$this->assertEquals(true, $this->validator->boolOption("q", false));
	}
}