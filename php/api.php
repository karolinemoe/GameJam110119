<?php

require_once '../vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('../html');
  $twig = new Twig_Environment($loader, array(
    //'cache' => './compilation_cache';
    // Can add cache after finished development for faster loading times
  ));

$data = [];
$data['content'] = "content 123 hehe";

$url = "http://api.sehavniva.no/tideapi.php?lat=63.4305&lon=10.3951&fromtime=2019-01-11T00%3A00&totime=2019-01-12T00%3A00&datatype=all&refcode=msl&place=&file=&lang=nn&interval=60&dst=0&tzone=&tide_request=locationdata";
$data['api'] = simplexml_load_file($url);
//print_r($data['api']);
$data['test'] = "testing";


echo $twig->render('index.html', $data);
