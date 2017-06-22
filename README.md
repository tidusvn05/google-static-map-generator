
# google-static-map-generator
A tool to generate google static map image for Php, laravel.

- support multiple markers with multiple locaions on every maker.
- support polygon path to draw shape: circle, polygon.


# Installation
`composer require tidusvn05/google-static-map-generator`

# Usage
> require_once __DIR__ . '/../vendor/autoload.php';
>
> use Tidusvn05\StaticMap\StaticMap;
>
> $sm = new StaticMap();
> $sm->setKey('AIzaSyAxAoi14Kkehkv2vE2RVHitCTcPC3BarBw')
> ->setZoom(10)
  ->setCenter([9.851040, 106.422389]);
> $sm->generateUrl();

=> result is: 
`https://maps.googleapis.com/maps/api/staticmap?key=AIzaSyAxAoi14Kkehkv2vE2RVHitCTcPC3BarBw&center=9.85104%2C106.422389&size=400x400&language=en`


# License
GNU
