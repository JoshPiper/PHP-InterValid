<?php

namespace Internet\InterValid;

class ListValidator implements Validator {
	private $data = [];

	/**
	 * InputValidator constructor.
	 * @param array $data Input data for store.
	 */
	public function __construct(&$data = []){
		$this->data = $data;
	}

	public function has($key){
		return isset($this->data[$key]);
	}

	public function int($name, $def = false, $min = false, $max = false){
		$opts = [];
		if ($def){
			$opts['default'] = $def;
		}
		if ($max){
			$opts['max_range'] = $max;
		}
		if ($min){
			$opts['min_range'] = $min;
		}

		return filter_var($this->raw($name), FILTER_VALIDATE_INT, ['options' => $opts]);
	}

	public function bool($name){
		return filter_var($this->raw($name), FILTER_VALIDATE_BOOLEAN);
	}

	public function bulk($filter, $add = false){
		return filter_var_array($this->data, $filter, $add);
	}

	public function commaList($name){
		return array_filter(array_map("trim", explode(',', $this->raw($name) ?: '')));
	}

	public function raw($name){
		return @filter_var($this->data[$name], FILTER_UNSAFE_RAW);
	}

	public function data(){
		return filter_var_array($this->data, FILTER_UNSAFE_RAW);
	}
}