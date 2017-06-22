<?php
/*
 * @Author: Tidusvn05 
 * @Date: 2017-06-22 15:55:23 
 * @Last Modified by: Tidusvn05
 * @Last Modified time: 2017-06-22 15:59:32
 */

require_once __DIR__ . '/../vendor/autoload.php';

use Tidusvn05\StaticMap\StaticMap;

$sm = new StaticMap();
$sm->setKey('AIzaSyAxAoi14Kkehkv2vE2RVHitCTcPC3BarBw')
  ->setCenter([9.851040, 106.422389]);
echo $sm->generateUrl();

?>