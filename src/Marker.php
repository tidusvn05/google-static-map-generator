<?php
/*
 * @Author: Tidusvn05 
 * @Date: 2017-06-22 15:40:37 
 * @Last Modified by: Tidusvn05
 * @Last Modified time: 2017-06-22 19:39:32
 */

namespace Tidusvn05\StaticMap;

class Marker{
	const SIZE = ['tiny', 'mid', 'small'];

  private $size; // default normal size: mid
  private $color; // 24 bit color: 0xff0011
  private $label;
  private $anchor;
  private $icon;
	private $locations = [];
  
  
  public function setLocations($locations){
		$this->locations = $locations;

		return $this;
  }

	public function getLocations(){
		return $this->locations;
	}

	public function addLocation($location){
		$point = new Point($location);
		$this->locations[] = $point;
		return $this;
	}

	public function getSize(){
		return $this->size;
	}

	public function setSize($size){
		$this->size = $size;
		return $this;
	}

	public function getColor(){
		return $this->color;
	}

	public function setColor($color){
		$this->color = $color;
		return $this;
	}

	public function getLabel(){
		return $this->label;
	}

	public function setLabel($label){
		$this->label = $label;
		return $this;
	}

	public function getAnchor(){
		return $this->anchor;
	}

	public function setAnchor($anchor){
		$this->anchor = $anchor;
		return $this;
	}

	public function getIcon(){
		return $this->icon;
	}

	public function setIcon($icon){
		$this->icon = $icon;
		return $this;
	}



}