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
		if (!$this->has($name)){return $def !== false ? $def : null;}

		$opts = [];
		if ($def !== false){$opts['default'] = $def;}
		$val = filter_var($this->raw($name), FILTER_VALIDATE_INT, ['options' => $opts]);

		if ($max !== false){$val = min($max, $val);}
		if ($min !== false){$val = max($min, $val);}

		return $val;
	}

	/** {@inheritDoc} */
	public function bool($name){
		if (!$this->has($name)){return null;}

		return filter_var($this->raw($name), FILTER_VALIDATE_BOOLEAN);
	}

	/** {@inheritDoc} */
	public function bulk($filter, $add = false){
		return filter_var_array($this->data, $filter, $add);
	}

	/** {@inheritDoc} */
	public function commaList($name){
		if (!$this->has($name)){return null;}

		return array_filter(array_map("trim", explode(',', $this->raw($name) ?: '')));
	}

	/** {@inheritDoc} */
	public function raw($name){
		if (!$this->has($name)){return null;}

		return filter_var($this->data[$name], FILTER_UNSAFE_RAW);
	}

	/** {@inheritDoc} */
	public function data(){
		return filter_var_array($this->data, FILTER_UNSAFE_RAW);
	}
}