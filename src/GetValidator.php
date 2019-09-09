<?php

namespace Internet\InterValid;

class GetValidator extends ListValidator {
	public function __construct(){
		parent::__construct($_GET);
	}
}