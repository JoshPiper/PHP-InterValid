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

	/** {@inheritDoc} */
	public function has($key){
		return isset($this->data[$key]);
	}

	/** {@inheritDoc} */
	public function int($name, $def = false, $min = false, $max = false){
		$opts = [];
		if ($def){
			$opts['default'] = $def;
		}

		$val = filter_var($this->raw($name), FILTER_VALIDATE_INT, ['options' => $opts]);
		if ($max){$val = min($max, $val);}
		if ($min){$val = max($min, $val);}

		return $val;
	}

	/** {@inheritDoc} */
	public function bool($name){
		return filter_var($this->raw($name), FILTER_VALIDATE_BOOLEAN);
	}

	/** {@inheritDoc} */
	public function bulk($filter, $add = false){
		return filter_var_array($this->data, $filter, $add);
	}

	/** {@inheritDoc} */
	public function commaList($name){
		return array_filter(array_map("trim", explode(',', $this->raw($name) ?: '')));
	}

	/** {@inheritDoc} */
	public function raw($name){
		return @filter_var($this->data[$name], FILTER_UNSAFE_RAW);
	}

	/** {@inheritDoc} */
	public function data(){
		return filter_var_array($this->data, FILTER_UNSAFE_RAW);
	}
}