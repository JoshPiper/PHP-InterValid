<?php

namespace Internet\InterValid;

class EnvValidator extends ListValidator {
	public function __construct(){
		parent::__construct($_ENV);
	}
}