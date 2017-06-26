<?php
/*
 * @Author: Tidusvn05 
 * @Date: 2017-06-22 15:37:39 
 * @Last Modified by: Tidusvn05
 * @Last Modified time: 2017-06-23 09:19:28
 */

namespace Tidusvn05\StaticMap\Generators;

class URLGenerator implements GeneratorInterface{
  // use emcconville\Polyline\GoogleTrait;
  use \emcconville\Polyline\GoogleTrait;
  
  const BASE_URL = "https://maps.googleapis.com/maps/api/staticmap?";
  
  private $map;
  private $parameters = [];

  function __construct($map) {
    $this->map = $map;
  }
  
  public function generate(){
    $styleds_query = $this->build_styleds_query();
    $parameters_query = $this->build_paramerters();
    $marker_query = $this->build_markers_query();
    $path = $this->build_encode_path();


    $final_url =  self::BASE_URL;
    if($parameters_query !== '')
      $final_url .= $parameters_query;

    if($styleds_query !== '')
      $final_url .= $styleds_query;

    if($marker_query !== '')
      $final_url .= $marker_query;

    if($path !== '')
      $final_url .= "&".$path;
    
    return $final_url;
  }

  private function init_parameters(){
    //key
    if (($key = $this->map->getKey()) !== null) {
      $this->parameters['key'] = $key;
    }

    //center
    if (($center = $this->map->getCenter()) !== null) {
      $this->parameters['center'] = $center->getLat() . ',' . $center->getLng();
    }

    //maptype
    if (($maptype = $this->map->getMaptype()) !== null) {
      $this->parameters['maptype'] = $this->maptype;
    }

    //maptype
    if (($zoom = $this->map->getZoom()) !== null) {
      $this->parameters['zoom'] = $zoom;
    }

    //size
    if (($size = $this->map->getSize()) !== null) {
      $this->parameters['size'] = $size;
    }

    //scale
    if (($scale = $this->map->getScale()) !== null) {
      $this->parameters['scale'] = $scale;
    }

    //language
    if (($language = $this->map->getLanguage()) !== null) {
      $this->parameters['language'] = $language;
    }

    //format
    if (($format = $this->map->getFormat()) !== null) {
      $this->parameters['format'] = $format;
    }

    //region
    if (($region = $this->map->getRegion()) !== null) {
      $this->parameters['region'] = $region;
    }

  }

  private function build_paramerters(){
    $this->init_parameters();
    return http_build_query($this->parameters, '', '&');
  }

  private function build_encode_path(){
    if (count($path = $this->map->getPath()) > 0) {
      $path = $this->convert_to_polyline_encoder_path($path);
      $encoded_str = $this->encodePoints($path);
      $query = "path=fillcolor:". $this->map->getFillColor()."|color:". $this->map->getColor()."|enc:".$encoded_str;
      return $query;
    }

    return "";
  }

  private function build_markers_query(){
    $query = "";

    if (($markers = $this->map->getMarkers()) !== null) {
      
      foreach($markers as $marker){
        $query .= "&markers=".$this->_build_marker_query($marker);
      }

      return $query;
    }

    return "";
  }

  private function _build_marker_query($marker){
    $params = []; 
    $query = "";

    if (($color = $marker->getColor()) !== null) {
      $params['color'] = $color;
    }

    if (($size = $marker->getSize()) !== null) {
      $params['size'] = $size;
    }

    if (($label = $marker->getLabel()) !== null) {
      $params['label'] = $label;
    }

    if (($icon = $marker->getIcon()) !== null) {
      $params['icon'] = $icon;
    }

    if (($anchor = $marker->getAnchor()) !== null) {
      $params['anchor'] = $anchor;
    }

    if (($anchor = $marker->getAnchor()) !== null) {
      $params['anchor'] = $anchor;
    }

    //build query
    $i = 0;
    foreach($params as $k => $val){
      $q = "$k:$val";
      $separator = "|";
      if($i === 0)
        $separator = "";
      
      $query .= $separator.$q;
      $i++;
    }

    //build locations's query
    if(count($marker->getLocations()) > 0){
      foreach($marker->getLocations() as $k => $location){
        $q = $location->getLat().",".$location->getLng();
        $separator = "|";
        if($query === "")
          $separator = "";
        $query .= $separator.$q;
      }
    }

    return $query;
  }


  /*

    @return list of path array style   [ [41.89084,-87.62386], ...]
  */
  private function convert_to_polyline_encoder_path($path){
    $first = $path[0];
    if(is_array($first) && count($first) == 2){
      return $path;
    }else if(is_object($first) && method_exists($first, 'getLatitude')){
      $ret_path = [];
      foreach($path as $p){
        $ret_path[] = [$p->getLatitude(), $p->getLongitude()];
      }
      return $ret_path;
    }else{
      throw new \Exception("Input path is wrong");
    }
  }

  /**
  * build styleds query from styleds array of staticmap
  */
  private function build_styleds_query(){
    $query = "";
    if (count($styleds = $this->map->getStyleds()) > 0) {
      foreach($styleds as $k => $styled){
        $styled_query = $styled->build_query();
        if($k == 0)
          $query .= $styled_query;
        else  
          $query .= $styled_query;
      }
      
      return $query;
    }

    return "";
  }

}

?>