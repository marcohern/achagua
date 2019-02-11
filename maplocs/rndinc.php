<?php

ini_set('display_errors', '1');
require_once('../wp-plugin/achagua/bk/constants.php');
req('/lib/header.php');
req('/lib/error.php');
req('/lib/database.php');
req('/lib/states.php');
req('/lib/cities.php');
req('/lib/incidents.php');

$db = (object) req('/config/db.php');
$my = db_connect($db);


$types = [
    'VIOLENCIA_PSICOLOGICA'          , 'VIOLENCIA_SEXUAL'       ,
    'VIOLENCIA_PATRIMONIAL_ECONOMICA', 'VIOLENCIA_SIMBOLICA'    ,
    'ACOSO_HOSTIGAMIENTO'            , 'VIOLENCIA_DOMESTICA'    ,
    'VIOLENCIA_LABORAL'              , 'VIOLENCIA_OBSTETRICA'   ,
    'VIOLENCIA_MEDIATICA'            , 'VIOLENCIA_INSTITUCIONAL'
];

$types_count = count($types);

$ystart = 1994;
$yend = 2018;

$dlat = 0;
$dlng = 0;

$cities = cities_browse($my);
$cities_count = count($cities);

$n = 500;
$r = 40;

echo "Begin\n";

for ($i=0;$i<$r;$i++) {
    $incidents = [];
    for ($j=0;$j<$n;$j++) {

        $rtype = rand(0, $types_count-1);
        $ryear = rand($ystart, $yend);
        $rcity = rand(0, $cities_count-1);
        $city = $cities[$rcity];
        $rjustice = rand(0,1);

        $inc = new stdClass;
        $inc->vbg = $types[$rtype];
        $inc->event_date = "$ryear-01-01";
        $inc->country_id = 57;
        $inc->state_id = $city->state_id;
        $inc->city_id = $city->id;
        $inc->lat = $city->lat;
        $inc->lng = $city->lng;
        $inc->justice = ($rjustice) ? true:false;
        $incidents[] = $inc;
    }
    $res = incidents_bulk($my, $incidents);
    foreach ($incidents as $incident) {
        incident_inc($my, $incident);
    }
    $id=$res['id'];
    $am=$res['amount'];
    echo "($id,$am),";
}

echo "Finished\n";
$my->close();

?>