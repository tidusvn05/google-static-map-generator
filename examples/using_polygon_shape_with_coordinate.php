<?php
/*
 * @Author: Tidusvn05 
 * @Date: 2017-06-22 15:55:23 
 * @Last Modified by: Tidusvn05
 * @Last Modified time: 2017-06-23 09:20:24
 */

require_once __DIR__ . '/../vendor/autoload.php';

use Tidusvn05\StaticMap\StaticMap;
use Tidusvn05\StaticMap\Path;
use League\Geotools\Coordinate\Coordinate;


//polygon path
$path = [
  [34.75966612466248, 134.2529296875],
  [32.491230287947594, 134.31884765625],
  [32.39851580247402, 138.36181640625],
  [35.083955579276434, 137.548828125],
  [35.3340712150252, 135.7339782068741],
  [34.75966612466248, 134.2529296875],
];

//convert to coordinate object (use for geotool, google coordinate,..)
$coordinate_path = [];
foreach($path as $p){
  $coordinate = new Coordinate($p[0] . ", " . $p[1]);
  $coordinate_path[] = $coordinate;
}

$path = new Path();
$path->setPath($coordinate_path)
  ->setBorderColor("0xe8dd10")
  ->setFillColor("0x1f0fd8");

$sm = new StaticMap();
$url = $sm->setKey('AIzaSyCdSA4UthyZnc34U-D3qa99jDZmWncwnYo')
  ->addPath($path)

//  ->setZoom(8)  // not set mean that is auto fit to zoom.
  ->generateUrl();

echo $url;
// => https://maps.googleapis.com/maps/api/staticmap?key=AIzaSyCdSA4UthyZnc34U-D3qa99jDZmWncwnYo&size=400x400&language=en&path=fillcolor:0x1f0fd8|color:0xe8dd10|enc:}~csEyglrXv`zL_{KlbQqstW_okOdx}Cezo@xmaJ~doBpg`H

?>