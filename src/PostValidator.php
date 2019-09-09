<?php

namespace Internet\InterValid;

class PostValidator extends ListValidator {
	public function __construct(){
		parent::__construct($_POST);
	}
}