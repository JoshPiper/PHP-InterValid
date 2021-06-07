<?php

namespace Internet\InterValid;

/**
 * The Post Validator class is an extension of the List Validator, which automatically operates on the $_POST supervariable.
 * @package Internet\InterValid
 */
class PostValidator extends ListValidator {
	public function __construct(){
		parent::__construct($_POST);
	}
}
