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
  ->setCenter([9.851040, 106.422389])
  ->setZoom(8)
  ->generateUrl();

echo $url;
// => https://maps.googleapis.com/maps/api/staticmap?key=AIzaSyCdSA4UthyZnc34U-D3qa99jDZmWncwnYo&center=9.85104%2C106.422389&zoom=8&size=400x400&language=en

?>