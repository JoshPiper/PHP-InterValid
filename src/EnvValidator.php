<?php

namespace Internet\InterValid;

/**
 * The Environment Validator class is an extension of the List Validator, which automatically operates on the $_ENV supervariable.
 * @package Internet\InterValid
 */
class EnvValidator extends ListValidator {
	public function __construct(){
		parent::__construct($_ENV);
	}
}
