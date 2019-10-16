<?php

declare(strict_types=1);

namespace Internet\InterValid\Tests;

use PHPUnit\Framework\TestCase;
use Internet\InterValid\PostValidator;
use Internet\InterValid\ListValidator;

final class EnvValidatorTest extends ListValidatorTest {
	public static $class = 'Internet\\InterValid\\EnvValidator';
	private static $old_env;

	static function setUpBeforeClass(): void{
		parent::setUpBeforeClass();
		static::$old_env = $_ENV;
		$_ENV = static::$data;
	}

	public static function tearDownAfterClass(): void{
		$_ENV = static::$old_env;
	}
}