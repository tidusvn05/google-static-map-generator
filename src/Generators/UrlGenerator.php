<?php
/*
 * @Author: Tidusvn05 
 * @Date: 2017-06-22 15:37:39 
 * @Last Modified by: Tidusvn05
 * @Last Modified time: 2017-06-23 09:19:28
 */

namespace Tidusvn05\StaticMap\Generators;

class URLGenerator implements GeneratorInterface {

	// use emcconville\Polyline\GoogleTrait;

	const BASE_URL = "https://maps.googleapis.com/maps/api/staticmap?";

	private $map;
	private $parameters = [];

	function __construct($map) {
		$this->map = $map;
	}

	public function generate() {
	}

	private function init_parameters() {

	}

	private function build_paramerters() {
		$this->init_parameters();
		return http_build_query($this->parameters, '', '&');
	}

}

?>
