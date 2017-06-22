<?php
/*
 * @Author: Tidusvn05 
 * @Date: 2017-06-22 15:37:39 
 * @Last Modified by: Tidusvn05
 * @Last Modified time: 2017-06-22 16:24:02
 */

namespace Tidusvn05\StaticMap\Generators;

class ImgGenerator implements GeneratorInterface{
  private $url;
  private $destination_file;

  function __construct($url, $destination_file) {
    $this->url = $url;
    $this->destination_file = $destination_file;
  }

  function generate(){
    try{
      $image = file_get_contents($this->url); 
      $fp  = fopen($this->destination_file, 'w+'); 
      
      $r = fputs($fp, $image); 
      fclose($fp); 
      unset($image);

      return true;
    }catch(Exception $e){
      return false;
    } 

  }


}


?>