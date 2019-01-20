<?php
/*
 * @Author: Tidusvn05 
 * @Date: 2017-06-22 15:40:37 
 * @Last Modified by: Tidusvn05
 * @Last Modified time: 2017-06-22 22:41:51
 */

namespace Tidusvn05\StaticMap;

class StaticMap {

	const MIN_ZOOM = 1;
	const MAX_ZOOM = 21;
	const URL_MAX_LENGTH = 2046;
	const FORMAT = ['png8', 'png', 'png32', 'jpg', 'gif', 'jpg-baseline'];
	const MAP_TYPE = ['roadmap', 'satellite', 'hybrid', 'terrain'];
	const DOMAIN = 'https://maps.googleapis.com';
	const BASE_URL = '/maps/api/staticmap?';

	protected $center;
	protected $zoom;
	protected $size = '400x400'; // size of image
	protected $scale;
	protected $maptype; //default roadmap
	protected $markers = [];
	protected $paths = [];
	protected $language = 'en';
	protected $key;
	protected $urlSigningSecret;
	protected $format; // default: png
	protected $region;
	protected $fill_color;

	private $color;
	private $styleds = [];

	public function getColor() {
		return $this->color;
	}

	public function setColor($color) {
		$this->color = $color;
		return $this;
	}

	public function getFillColor() {
		return $this->fill_color;
	}

	public function setFillColor($fill_color) {
		$this->fill_color = $fill_color;
		return $this;
	}

	public function getCenter() {
		return $this->center;
	}

	public function setCenter($center) {
		$point = new Point($center);
		$this->center = $point;
		return $this;
	}

	public function getZoom() {
		return $this->zoom;
	}

	public function setZoom($zoom) {
		$this->zoom = $zoom;
		return $this;
	}

	public function getPaths() {
		return $this->paths;
	}

	public function setPaths($paths) {
		$this->paths = $paths;
		return $this;
	}

	// @param $path is intance of \Tidusvn05\StaticMap\Path
	public function addPath($path) {
		$this->paths[] = $path;

		return $this;
	}

	public function getregion() {
		return $this->region;
	}

	public function setRegion($region) {
		$this->region = $region;
		return $this;
	}

	public function getSize() {
		return $this->size;
	}

	public function setSize($size) {
		$this->size = $size;
		return $this;
	}

	public function getScale() {
		return $this->scale;
	}

	public function setScale($scale) {
		$this->scale = $scale;
		return $this;
	}

	public function getMaptype() {
		return $this->maptype;
	}

	public function setMaptype($maptype) {
		$this->maptype = $maptype;
		return $this;
	}

	public function getMarkers() {
		return $this->markers;
	}

	public function setMarkers($markers) {
		$this->markers = $markers;
		return $this;
	}

	// marker: [lat, lng]
	public function addMarker($marker) {
		$this->markers[] = $marker;
		return $this;
	}

	public function getLanguage() {
		return $this->language;
	}

	public function setLanguage($language) {
		$this->language = $language;
		return $this;
	}

	public function getKey() {
		return $this->key;
	}

	public function setKey($key) {
		$this->key = $key;
		return $this;
	}

	public function getFormat() {
		return $this->format;
	}

	public function setFormat($format) {
		$this->format = $format;
		return $this;
	}

	public function generateUrl() {
		$url = self::BASE_URL;

		$params = [];
		//key
		if (($key = $this->getKey()) !== null) {
			$params['key'] = $key;
		}

		//center
		if (($center = $this->getCenter()) !== null) {
			$params['center'] = $center->getLat().','.$center->getLng();
		}

		//maptype
		if (($maptype = $this->getMaptype()) !== null) {
			$params['maptype'] = $maptype;
		}

		//maptype
		if (($zoom = $this->getZoom()) !== null) {
			$params['zoom'] = $zoom;
		}

		//size
		if (($size = $this->getSize()) !== null) {
			$params['size'] = $size;
		}

		//scale
		if (($scale = $this->getScale()) !== null) {
			$params['scale'] = $scale;
		}

		//language
		if (($language = $this->getLanguage()) !== null) {
			$params['language'] = $language;
		}

		//format
		if (($format = $this->getFormat()) !== null) {
			$params['format'] = $format;
		}

		//region
		if (($region = $this->getRegion()) !== null) {
			$params['region'] = $region;
		}
		$url .= http_build_query($params);

		if ($styleds = $this->getStyleds()) {
			foreach ($styleds as $k => $styled) {
				$url .= '&'.$styled->build_encoded_query();
			}
		}

		if ($markers = $this->getMarkers()) {
			foreach ($markers as $marker) {
				$url .= '&'.$marker->build_encoded_query();
			}
		}

		if ($paths = $this->getPaths()) {
			foreach ($paths as $path) {
				$url .= '&'.$path->build_encoded_query();
			}
		}

		//https://gist.github.com/MattKetmo/6897944
		if ($this->urlSigningSecret) {
			$decodedKey = base64_decode(str_replace(['-', '_'], ['+', '/'], $this->urlSigningSecret));
			// Create a signature using the private key and the URL-encoded
			// string using HMAC SHA1. This signature will be binary.
			$signature = hash_hmac('sha1', $url, $decodedKey, true);
			$encodedSignature = str_replace(['+', '/'], ['-', '_'], base64_encode($signature));
			$url .= '&signature='.$encodedSignature;
		}

		return self::DOMAIN.$url;
	}

	public function generateImg($img_file) {
		$url = $this->generateUrl();

		try {
			$image = file_get_contents($url);

			$fp = fopen($img_file, 'w+');
			fputs($fp, $image);
			fclose($fp);
			unset($image);

			return true;
		}
		catch (\Exception $e) {
			return false;
		}
	}

	public function getStyleds() {
		return $this->styleds;
	}

	public function AddStyled($styled) {
		$this->styleds[] = $styled;

		return $this;
	}

	public function AddStyledsfromJson($json_path) {
		try {
			$json = file_get_contents($json_path);
			$styles_list = json_decode($json);
			//var_dump($styles_list);
			foreach ($styles_list as $k => $style) {
				$styled = new Styled();
				$styled->setFeature($style->featureType);
				$styled->setElement($style->elementType);
				$styled->importStylers($style->stylers);

				$this->styleds[] = $styled;
			}
		}
		catch (\Exception $e) {
			throw new Exception\BadInputException('Error parsing json file');
		}

		return $this;
	}

	/**
	 * @return string
	 */
	public function getUrlSigningSecret() {
		return $this->urlSigningSecret;
	}

	/**
	 * @param string $urlSigningSecret
	 */
	public function setUrlSigningSecret($urlSigningSecret) {
		$this->urlSigningSecret = $urlSigningSecret;
		return $this;
	}
}
