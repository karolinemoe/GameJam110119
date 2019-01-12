<?php

require_once '../vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('../html');
  $twig = new Twig_Environment($loader, array(
    //'cache' => './compilation_cache';
    // Can add cache after finished development for faster loading times
  ));

$data = [];

if(isset($_POST['harbor'])) {
    $data['harbor'] = $_POST['harbor'];

    $data['lat'] = "";
    $data['lon'] = "";

    $fromTime = date('Y-m-d') . "T00%3A00" . "\n";
    $nextday = time()+(1*24*60*60);
    $toTime = date('Y-m-d', $nextday) . "T00%3A00" . "\n";

    //$fromTime = "2019-01-11T00%3A00";
    //$toTime = "2019-01-12T00%3A00";

    switch ($_POST['harbor']) {
        case 'Andenes':
            $data['lat'] = "69.316078";
            $data['lon'] = "16.120228";
            break;
        case 'Bergen':
            $data['lat'] = "60.391262";
            $data['lon'] = "5.322054";
            break;
        case 'Bodø':
            $data['lat'] = "67.279999";
            $data['lon'] = "14.405010";
            break;
        case 'Hammerfest':
            $data['lat'] = "70.662323";
            $data['lon'] = "23.682751";
            break;
        case 'Harstad':
            $data['lat'] = "68.797997";
            $data['lon'] = "16.532850";
            break;
        case 'Helgeroa':
            $data['lat'] = "58.995180";
            $data['lon'] = "9.862460";
            break;
        case 'Honningsvåg':
            $data['lat'] = "70.976021";
            $data['lon'] = "25.983061";
            break;
        case 'Kabelvåg':
            $data['lat'] = "68.209419";
            $data['lon'] = "14.474460";
            break;
        case 'Kristiansund':
            $data['lat'] = "63.110336";
            $data['lon'] = "7.728079";
            break;
        case 'Måløy':
            $data['lat'] = "61.937271";
            $data['lon'] = "5.113580";
            break;
        case 'Narvik':
            $data['lat'] = "68.438499";
            $data['lon'] = "17.427261";
            break;
        case 'Ny-Ålesund':
            $data['lat'] = "78.9235";
            $data['lon'] = "11.9099";
            break;
        case 'Oscarsborg':
            $data['lat'] = "57.604390";
            $data['lon'] = "13.363100";
            break;
        case 'Oslo':
            $data['lat'] = "59.913868";
            $data['lon'] = "10.752245";
            break;
        case 'Rørvik':
            $data['lat'] = "64.861710";
            $data['lon'] = "11.238420";
            break;
        case 'Stavanger':
            $data['lat'] = "58.964432";
            $data['lon'] = "5.726250";
            break;
        case 'Tregde':
            $data['lat'] = "58.009910";
            $data['lon'] = "7.559670";
            break;
        case 'Tromsø':
            $data['lat'] = "69.649208";
            $data['lon'] = "18.955324";
            break;
        case 'Trondheim':
            $data['lat'] = "63.430515";
            $data['lon'] = "10.395053";
            break;
        case 'Vardø':
            $data['lat'] = "70.369690";
            $data['lon'] = "31.106501";
            break;
        case 'Viker':
            $data['lat'] = "59.189630";
            $data['lon'] = "10.877430";
            break;
        case 'Ålesund':
            $data['lat'] = "62.470940";
            $data['lon'] = "6.154640";
            break;
    }

    //print $data['lat'] . "    " . $data['lon'];
    $url = "http://api.sehavniva.no/tideapi.php?lat=" . $data['lat'] . "&lon=" . $data['lon'] . "&fromtime=" . $fromTime . "&totime=" . $toTime . "&datatype=obs&refcode=msl&place=&file=&lang=nb&interval=10&dst=0&tzone=&tide_request=locationdata";

    $xmlDoc = new DOMDocument();
    $xmlDoc->load($url);

    $waterlevels = $xmlDoc->getElementsByTagName("waterlevel");

    $levels = [];
    foreach ($waterlevels as $waterlevel) {
        array_push($levels, $waterlevel->getAttribute('value'));
    }

    $data['currentLevel'] = end($levels);
}

echo $twig->render('index.html', $data);