<?php

ini_set('display_errors', '1');
require_once('../wp-plugin/achagua/bk/constants.php');
req('/lib/states.php');

$country = 'Colombia';
$apikey = 'AIzaSyBV-6ds73oQP_OTbVylTpvhz3rY6RHpOF8';
$endpoint = "https://maps.googleapis.com/maps/api/geocode/json";
    //"address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&";
    //"key=YOUR_API_KEY";

$db = (object) req('/config/db.php');
$my = db_connect($db);
echo "Begin\n";

$states = states_browse($my);

foreach ($states as $state) {
    $sn = urlencode($state->name);
    $url = "$endpoint?address=$sn%2C%20$country&key=$apikey";

    $content = file_get_contents($url);
    $json = json_decode($content);
    $loc = $json->results[0]->geometry->location;
    $lat = number_format($loc->lat,8,',','');
    $lng = number_format($loc->lng,8,',','');
    echo "{$state->id},\"{$state->name}\",\"{$lat}\",\"{$lng}\"\n";
}

echo "Finished\n";
$my->close();

?>