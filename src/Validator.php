<?php

namespace Internet\InterValid;

/**
 * Interface Validator The validator interface is used for fetching variables from mixed (poss. unsafe) sources.
 * @package Bolt\Validation
 */
interface Validator {
	/** Check if the validator contains a given key.
	 * @param $key string Input key.
	 * @return bool If the key exists in the data store.
	 */
	public function has($key);

	/** Fetch a raw value from the input.
	 * @param $name string Name of the input to fetch.
	 * @return mixed
	 */
	public function raw($name);

	/** Fetch an integer from the input.
	 * @param $name string Input key.
	 * @param bool|integer $def Default value if key validation fails, or false for none.
	 * @param bool|integer $min Minimum value or false for none.
	 * @param bool|integer $max Maximum value, or false for none.
	 * @return integer|null Filtered input as integer, or null if filter fails and default is not set.
	 */
	public function int($name, $def = false, $min = false, $max = false);

	/** Fetch a boolean from input.
	 * @param $name string Input key.
	 * @return boolean Booelean value from input.
	 */
	public function bool($name);

	/** Return an array from a comma separated input.
	 * @param $name string Input key
	 * @return string[]
	 */
	public function commaList($name);

	/** Bulk var collection.
	 * See https://www.php.net/manual/en/function.filter-var-array.php
	 * @param $arr array Settings array
	 * @param bool $add If missing array keys should be added.
	 * @return array
	 */
	public function bulk($arr, $add = false);

	/** Return all data stored within the validator representation.
	 * @return array
	 */
	public function data();
}