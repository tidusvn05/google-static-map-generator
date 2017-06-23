<?php
/*
 * @Author: Tidusvn05 
 * @Date: 2017-06-22 15:40:37 
 * @Last Modified by: Tidusvn05
 * @Last Modified time: 2017-06-22 22:41:51
 */

namespace Tidusvn05\StaticMap;
use Tidusvn05\StaticMap\Generators\UrlGenerator;
use Tidusvn05\StaticMap\Generators\ImgGenerator;


class StaticMap{
  const MIN_ZOOM = 1;
  const MAX_ZOOM = 21;
  const URL_MAX_LENGTH = 2046;
  const FORMAT = ['png8', 'png', 'png32', 'jpg', 'gif', 'jpg-baseline'];
  const MAP_TYPE = ['roadmap', 'satellite', 'hybrid', 'terrain'];

  protected $center;
  protected $zoom;
  protected $size = "400x400"; // size of image
  protected $scale;
  protected $maptype; //default roadmap
  protected $markers = [];
  protected $path = [];
  protected $language = 'en';
  protected $key;
  protected $format; // default: png
  protected $region;
	private $color;
	private $fill_color;


  public function getColor(){
		return $this->color;
	}

	public function setColor($color){
		$this->color = $color;
		return $this;
	}

  public function getFillColor(){
		return $this->fill_color;
	}

	public function setFillColor($fill_color){
		$this->fill_color = $fill_color;
		return $this;
	}

  public function getCenter(){
		return $this->center;
	}

	public function setCenter($center){
		$point = new Point($center);
		$this->center = $point;
		return $this;
	}

	public function getZoom(){
		return $this->zoom;
	}

	public function setZoom($zoom){
		$this->zoom = $zoom;
		return $this;
	}

	public function getPath(){
		return $this->path;
	}

	public function setPath($path){
		$this->path = $path;
		return $this;
	}

	public function getregion(){
		return $this->region;
	}

	public function setRegion($region){
		$this->region = $region;
		return $this;
	}

	public function getSize(){
		return $this->size;
	}

	public function setSize($size){
		$this->size = $size;
		return $this;
	}

	public function getScale(){
		return $this->scale;
	}

	public function setScale($scale){
		$this->scale = $scale;
		return $this;
	}

	public function getMaptype(){
		return $this->maptype;
	}

	public function setMaptype($maptype){
		$this->maptype = $maptype;
		return $this;
	}

	public function getMarkers(){
		return $this->markers;
	}

	public function setMarkers($markers){
		$this->markers = $markers;
		return $this;
	}

  // marker: [lat, lng]
  public function addMarker($marker){
    $this->markers[] = $marker;
		return $this;
  }

	public function getLanguage(){
		return $this->language;
	}

	public function setLanguage($language){
		$this->language = $language;
		return $this;
	}

	public function getKey(){
		return $this->key;
	}

	public function setKey($key){
		$this->key = $key;
		return $this;
	}

	public function getFormat(){
		return $this->format;
	}

	public function setFormat($format){
		$this->format = $format;
		return $this;
	}
  
  public function generateUrl(){
    $generator = new UrlGenerator($this);
    return $generator->generate();
  }

	public function generateImg($img_file){
		$url_generator = new UrlGenerator($this);
		$url = $url_generator->generate();

		//generate img from static url
		$img_generator = new ImgGenerator($url, $img_file);
		$img_generator->generate();
	}





}