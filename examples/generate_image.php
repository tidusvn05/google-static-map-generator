<?php
/*
 * @Author: Tidusvn05 
 * @Date: 2017-06-22 15:55:23 
 * @Last Modified by: Tidusvn05
 * @Last Modified time: 2017-06-23 09:29:02
 */

require_once __DIR__ . '/../vendor/autoload.php';

use Tidusvn05\StaticMap\StaticMap;
use Tidusvn05\StaticMap\Marker;

$sm = new StaticMap();
$url = $sm->setKey('AIzaSyCdSA4UthyZnc34U-D3qa99jDZmWncwnYo')
  ->setCenter([9.851040, 106.422389])
  ->setZoom(8);

$marker = new Marker();
$marker->addLocation([9.856045, 106.410052])
  ->addLocation([9.904829, 105.333493])
  ->setAnchor('center')
  ->setIcon("https://cdn0.iconfinder.com/data/icons/glyphpack/68/phone-64.png");

$sm->addMarker($marker);

$marker2 = new Marker();
$marker2->addLocation([10.359861, 106.065469])
  ->setAnchor('center')
  ->setIcon("https://cdn2.iconfinder.com/data/icons/city-basic-people/240/basicman03-64.png");

$sm->addMarker($marker2);


$sm->generateImg("examples/sample.png");

?>