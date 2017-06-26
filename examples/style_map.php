<?php
/*
 * @Author: Tidusvn05 
 * @Date: 2017-06-22 15:55:23 
 * @Last Modified by: Tidusvn05
 * @Last Modified time: 2017-06-23 08:44:01
 */

require_once __DIR__ . '/../vendor/autoload.php';

use Tidusvn05\StaticMap\StaticMap;

$sm = new StaticMap();
$url = $sm->setKey('AIzaSyCdSA4UthyZnc34U-D3qa99jDZmWncwnYo')
  ->setCenter([10.740563, 106.718353])
  ->setZoom(8)
  ->AddStyledsfromJson("./examples/styledmap.json")
  ->generateUrl();
echo $url ;
//echo $url;
// => https://maps.googleapis.com/maps/api/staticmap?key=AIzaSyCdSA4UthyZnc34U-D3qa99jDZmWncwnYo&center=10.740563%2C106.718353&zoom=8&size=400x400&language=en&style=feature:all|element:labels.text.fill|saturation:36|color:0x000000|lightness:40&style=feature:all|element:labels.text.stroke|visibility:on|color:0x000000|lightness:16&style=feature:all|element:labels.icon|visibility:off&style=feature:administrative|element:geometry.fill|color:0x000000|lightness:20&style=feature:administrative|element:geometry.stroke|color:0x000000|lightness:17|weight:1.2&style=feature:landscape|element:geometry|color:0x000000|lightness:20&style=feature:poi|element:geometry|color:0x000000|lightness:21&style=feature:road.highway|element:geometry.fill|color:0x000000|lightness:17&style=feature:road.highway|element:geometry.stroke|color:0x000000|lightness:29|weight:0.2&style=feature:road.arterial|element:geometry|color:0x000000|lightness:18&style=feature:road.local|element:geometry|color:0x000000|lightness:16&style=feature:transit|element:geometry|color:0x000000|lightness:19&style=feature:water|element:geometry|color:0x000000|lightness:17



?>
