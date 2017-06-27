<?php
/*
 * @Author: Tidusvn05 
 * @Date: 2017-06-22 15:55:23 
 * @Last Modified by: Tidusvn05
 * @Last Modified time: 2017-06-23 08:58:21
 */

require_once __DIR__ . '/../vendor/autoload.php';

use Tidusvn05\StaticMap\StaticMap;
use Tidusvn05\StaticMap\Path;

//polygon path
$path = [
  [34.75966612466248, 134.2529296875],
  [32.491230287947594, 134.31884765625],
  [32.39851580247402, 138.36181640625],
  [35.083955579276434, 137.548828125],
  [35.3340712150252, 135.7339782068741],
  [34.75966612466248, 134.2529296875],
];

$arr_path2 = [
  [35.349892, 139.477623],
  [35.530610, 138.315545],
  [34.202905, 137.273204],
  [35.349892, 139.477623],
];

$arr_path3 = [
  [35.082709, 133.518713],
  [33.075634, 134.155635],
  [34.895047, 135.673555],
  [35.082709, 133.518713],
];

$sm = new StaticMap();
$sm->setKey('AIzaSyCdSA4UthyZnc34U-D3qa99jDZmWncwnYo');

$path1 = new Path();
$path1->setPath($path)
  ->setBorderColor("#f442e5")
  ->setFillColor("0x1f0fd8");

$path2 = new Path();
$path2->setPath($arr_path2)
  ->setBorderColor("#f442e5")
  ->setFillColor("#f442e5");

$path3 = new Path();
$path3->setPath($arr_path3)
  ->setBorderColor("#f442e5")
  ->setFillColor("#83f442");

$url =  $sm->AddPath($path1)
  ->addPath($path2)
  ->addPath($path3)
//  ->setZoom(8)  // not set mean that is auto fit to zoom.
  ->generateUrl();

echo $url;
// => https://maps.googleapis.com/maps/api/staticmap?key=AIzaSyCdSA4UthyZnc34U-D3qa99jDZmWncwnYo&size=400x400&language=en&path=fillcolor:0x1f0fd8|color:0xe8dd10|enc:}~csEyglrXv`zL_{KlbQqstW_okOdx}Cezo@xmaJ~doBpg`H

?>