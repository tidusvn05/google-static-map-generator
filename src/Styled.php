<?php
/*
 * @Author: Tidusvn05 
 * @Date: 2017-06-22 15:40:37 
 * @Last Modified by: Tidusvn05
 * @Last Modified time: 2017-06-22 19:39:32
 */

namespace Tidusvn05\StaticMap;

class Styled{

  private $feature;
  private $element;
	private $stylers = []; // hash of key-values
  
  public function getFeature(){
		return $this->feature;
	}

  public function getElement(){
		return $this->element;
	}

  public function getStylers(){
		return $this->stylers;
	}

	public function setFeature($val){
		$this->feature = $val;
		return $this;
	}

	public function setElement($val){
		$this->element = $val;
		return $this;
	}
	
	public function addStyler($key, $val){
		$this->stylers[$key] = $val;

		return $this;
	}

	public function importStylers($input_stylers){
		foreach($input_stylers as $key => $styler){
			$array = get_object_vars($styler);
			$style_key = array_keys($array)[0];
			$style_value = array_values($array)[0];

			$this->stylers[$style_key] = $style_value;
		}

		return $this;
	}

	public function build_query(){
		$query = "&style=feature:" . $this->feature . "|element:" . $this->element;
		foreach($this->stylers as $key => $value){
			$value = $this->convert_hex_to_hexadecimal($value);
			$query .= "|" . $key . ":". $value;
		}

		return $query;
	}

	private function convert_hex_to_hexadecimal($hex){
		if(strpos($hex, "#") === 0){
			return str_replace("#", "0x", $hex);
		}else{
			return $hex;
		}
	}



}