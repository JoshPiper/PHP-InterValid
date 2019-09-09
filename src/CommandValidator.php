<?php

namespace Internet\InterValid;

class CommandValidator extends ListValidator {
	/** Fetch a command option from the internal data store.
	 * @param string $long The option long name.
	 * @param bool|string $short The short name, true for the first letter of long or false for none.
	 * @param mixed $default The default value if none is found.
	 * @return mixed The found option value.
	 */
	public function option($long, $short = true, $default = null){
		$short = $short === true ? substr($long, 0, 1) : $short;

		$v = $default;
		if ($this->has($long)){
			$v = $this->raw($long);
		} elseif ($short && $this->has($short)){
			$v = $this->raw($short);
		}

		if (is_numeric($v)){
			return floatval($v);
		} else {
			return $v;
		}
	}

	/** Fetch an integer from the data store.
	 * @param $long string Option long name.
	 * @param bool|string $short The short name, true for the first letter of long or false for none.
	 * @param mixed $def The default value if none is found.
	 * @param bool|integer $min Minimum value to return.
	 * @param bool|integer $max Maximum value to return.
	 * @return integer|null
	 */
	public function intOption($long, $short = true, $def = null, $min = false, $max = false){
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

		return filter_var($this->option($long, $short), FILTER_VALIDATE_INT, ['options' => $opts]);
	}

	/** Fetch a boolean from the command option store.
	 * @param $long string Option long name.
	 * @param bool|string $short The short name, true for the first letter of long or false for none.
	 * @return boolean
	 */
	public function boolOption($long, $short = true){
		return filter_var($this->option($long, $short), FILTER_VALIDATE_BOOLEAN);
	}
}