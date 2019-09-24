<?php

declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Internet\InterValid\CommandValidator;

final class CommandValidatorTest extends TestCase {

	public $data;
	/** @var CommandValidator */
	public $validator;
	protected function setUp(): void{
		$this->data = [
			"verbose" => true,
			"v" => 3,
			"q" => true,
			"option" => "value",
			"bool" => "no",
			"csv" => "this,is,stupid"
		];

		$this->validator = new CommandValidator($this->data);
	}

	public function testCanBeCreated(): void{
		$this->expectNotToPerformAssertions();
		new CommandValidator($this->data);
	}

	public function testHasReturnsTrueIfExists(): void{
		$this->assertTrue($this->validator->has("verbose"));
	}

	public function testHasReturnsFalseIfNotExists(): void{
		$this->assertFalse($this->validator->has("bad"));
	}

	public function testIntReturnsIntegers(): void{
		$this->assertEquals(3, $this->validator->int("v"));
		$this->assertFalse($this->validator->int("bad"));

		$this->assertEquals(20, $this->validator->int("verb", 20));
		$this->assertFalse($this->validator->int("bad", 0, 1, 10));
	}

	public function testBoolReturnsBooleans(): void{
		$this->assertFalse($this->validator->bool("bool"));
		$this->assertTrue($this->validator->bool("verbose"));
	}

	public function testBoolCSVList(): void{
		$this->assertEquals(['this', 'is', 'stupid'], $this->validator->commaList("csv"));
	}

	public function testRaw(): void{
		$this->assertEquals("this,is,stupid", $this->validator->raw("csv"));
	}

	public function testData(): void{
		$this->assertEquals($this->data, $this->validator->data());
	}

	public function testOptions(): void{
		$this->assertEquals(true, $this->validator->option("verbose", "v"));
		$this->assertEquals(true, $this->validator->option("verbose", false));
		$this->assertEquals(3, $this->validator->option("v", "verbose"));
	}

	public function testIntegerOptions(): void{
		$this->assertEquals(1, $this->validator->intOption("verbose", "v"));
		$this->assertEquals(1, $this->validator->intOption("verbose", false));
		$this->assertEquals(3, $this->validator->intOption("v", "verbose"));
	}

	public function testBooleanOptions(): void{
		$this->assertEquals(true, $this->validator->boolOption("quiet"));
	}
}