<?php
/*
 * @Author: Tidusvn05 
 * @Date: 2017-06-22 16:26:44 
 * @Last Modified by: Tidusvn05
 * @Last Modified time: 2017-06-22 22:40:04
 */

namespace Tidusvn05\StaticMap;

class Point {

	private $lat;
	private $lng;

	function __construct($input) {
		$this->parse($input);
	}

	/**
	 * Parse input obj to StaticMap obj coordinate
	 * @param []|stdClass $obj is array[lat, lng] or Google coordinate obj
	 * @return Point obj with lat & lng
	 * @throws Exception\BadInputException
	*/
	function parse($input) {
		if (is_array($input)) {
			$this->parse_as_array($input);
		} else {
			if (is_object($input) && method_exists($input, 'getLatitude')) {
				// coordinate obj
				$this->parse_as_obj($input);
			} else {
				//not support
				throw new Exception\BadInputException();
			}
		}

		return $this;
	}

	private function parse_as_array($arr) {
		$this->lat = $arr[0];
		$this->lng = $arr[1];
	}

	private function parse_as_obj($obj) {
		$this->lat = $obj->getLatitude();
		$this->lng = $obj->getLongitude();
	}

	public function getLat() {
		return $this->lat;
	}

	public function getLng() {
		return $this->lng;
	}

}

?>
