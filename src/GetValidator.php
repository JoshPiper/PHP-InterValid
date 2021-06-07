<?php

namespace Internet\InterValid;

/**
 * The Get Validator class is an extension of the List Validator, which automatically operates on the $_GET supervariable.
 * @package Internet\InterValid
 */
class GetValidator extends ListValidator {
	public function __construct(){
		parent::__construct($_GET);
	}
}
