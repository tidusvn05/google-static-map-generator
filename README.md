
# google-static-map-generator
A tool to generate google static map image for Php, laravel.

- support multiple markers with multiple locaions on every maker.
- support polygon path to draw shape: circle, polygon.


# Installation
`composer require tidusvn05/google-static-map-generator`

# Usage

##### 1. Simple

    require_once __DIR__ . '/../vendor/autoload.php';
    
     use Tidusvn05\StaticMap\StaticMap;
    
     $sm = new StaticMap();
     $sm->setKey('Your google map static api key')
     ->setZoom(10)
      ->setCenter([9.851040, 106.422389]);
     $sm->generateUrl();

=> result is: 
`https://maps.googleapis.com/maps/api/staticmap?key=AIzaSyAxAoi14Kkehkv2vE2RVHitCTcPC3BarBw&center=9.85104%2C106.422389&size=400x400&language=en`

##### 2. With marker

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

	echo $sm->generateUrl();


#### 3. Polygon Shape
	$points = [
	  [34.75966612466248, 134.2529296875],
	  [32.491230287947594, 134.31884765625],
	  [32.39851580247402, 138.36181640625],
	  [35.083955579276434, 137.548828125],
	  [35.3340712150252, 135.7339782068741],
	  [34.75966612466248, 134.2529296875],
	];
	$path = new Path();
	$path->setBorderColor("0xe8dd10")
		->setFillColor("0x1f0fd8")
		->setPath($points);
	
	$sm->addPath($path);
	
	//can add more path object.

	// https://maps.googleapis.com/maps/api/staticmap?key=AIzaSyCdSA4UthyZnc34U-D3qa99jDZmWncwnYo&size=400x400&language=en&path=fillcolor:0x1f0fd8|color:0xe8dd10|enc:}~csEyglrXv`zL_{KlbQqstW_okOdx}Cezo@xmaJ~doBpg`H

#### 4. Generate Img

	$sm->generateImg("examples/sample.png");

#### 5. With Styled Map

	->AddStyledsfromJson("./examples/styledmap.json")



# Author
Tidusvn05 (tidusvn05@gmail.com)


# License
GNU


