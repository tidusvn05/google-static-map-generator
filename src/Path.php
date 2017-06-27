<?php
/*
 * @Author: Tidusvn05 
 * @Date: 2017-06-22 15:40:37 
 * @Last Modified by: Tidusvn05
 * @Last Modified time: 2017-06-22 19:39:32
 */

namespace Tidusvn05\StaticMap;

class Path {
	use \emcconville\Polyline\GoogleTrait;

  private $border_color; // 24 bit color: 0xff0011
  private $fill_color;
	private $path = [];
  
	// convert to hexdecimal color
	public function setFillColor($color){
		if(strpos($color, "#") === 0){
			$this->fill_color = str_replace("#", "0x", $color);
		}else if(strpos($color, "0x") === 0){
			$this->fill_color = $color;
		}else{
			throw new \Exception("Only allow hex or hexadecimal color style.");
		}
		
		return $this;
	}

	// convert to hexdecimal color
	public function setBorderColor($color){
		if(strpos($color, "#") === 0){
			$this->border_color = str_replace("#", "0x", $color);
		}else if(strpos($color, "0x") === 0){
			$this->border_color = $color;
		}else{
			throw new \Exception("Only allow hex or hexadecimal color style.");
		}

		return $this;
	}

	public function setPath($path){
		$path = $this->convert_to_polyline_encoder_path($path);
		$this->path = $path;
		return $this;
	}


	public function build_encoded_query(){
    if (count($this->path) > 0) {
      $encoded_str = $this->encodePoints($this->path);
      $query = "path=fillcolor:". $this->fill_color."|color:". $this->border_color."|enc:".$encoded_str;
      return $query;
    }

    return "";
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


}