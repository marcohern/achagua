<?php

ini_set('display_errors', '1');
require_once('../wp-plugin/achagua/bk/constants.php');
req('/lib/database.php');

$country = 'Colombia';
$apikey = 'AIzaSyBV-6ds73oQP_OTbVylTpvhz3rY6RHpOF8';
$endpoint = "https://maps.googleapis.com/maps/api/geocode/json";
    //"address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&";
    //"key=YOUR_API_KEY";

$db = (object) req('/config/db.php');
$my = db_connect($db);
echo "Begin\n";

$sql = "SELECT c.id AS cid, c.name AS city, s.id AS sid, s.name AS state FROM cities c INNER JOIN states s ON s.id = c.state_id";

$cities = db_query($my, $sql);

foreach ($cities as $c) {
    $city = (object) $c;
    $cn = urlencode($city->city);
    $sn = urlencode($city->state);
    $url = "$endpoint?address=$cn%2C%20$sn%2C%20$country&key=$apikey";

    $content = file_get_contents($url);
    $json = json_decode($content);
    $loc = $json->results[0]->geometry->location;
    $lat = number_format($loc->lat,8,',','');
    $lng = number_format($loc->lng,8,',','');

    echo "{$city->cid},\"{$city->city}\",{$city->sid},\"{$city->state}\",\"{$lat}\",\"{$lng}\"\n";
}

echo "Finished\n";
$my->close();

?>