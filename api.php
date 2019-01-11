<?php

require_once './vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('./html');
  $twig = new Twig_Environment($loader, array(
    //'cache' => './compilation_cache';
    // Can add cache after finished development for faster loading times
  ));

$data = [];

$url = "http://api.sehavniva.no/tideapi.php?lat=58.974339&lon=5.730121&fromtime=2019-01-11T00%3A00&totime=2019-01-12T00%3A00&datatype=obs&refcode=msl&place=&file=&lang=nb&interval=10&dst=0&tzone=&tide_request=locationdata";
//$xml = simplexml_load_file($url);

$xmlDoc = new DOMDocument();
$xmlDoc->load($url);

$waterlevels = $xmlDoc->getElementsByTagName("waterlevel");

$data['levels'] = [];
foreach ($waterlevels as $waterlevel) {
     array_push($data['levels'], $waterlevel->getAttribute('value'));
}

echo $twig->render('index.html', $data);