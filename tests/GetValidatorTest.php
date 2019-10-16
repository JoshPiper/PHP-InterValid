<?php

declare(strict_types=1);

namespace Internet\InterValid\Tests;

use PHPUnit\Framework\TestCase;
use Internet\InterValid\PostValidator;
use Internet\InterValid\ListValidator;

final class GetValidatorTest extends ListValidatorTest {
	public static $class = 'Internet\\InterValid\\GetValidator';

	static function setUpBeforeClass(): void{
		parent::setUpBeforeClass();
		$_GET = static::$data;
	}
}