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

$ystart = 1994;
$yend = 2050;

$types = [
    'VIOLENCIA_PSICOLOGICA'          , 'VIOLENCIA_SEXUAL'       ,
    'VIOLENCIA_PATRIMONIAL_ECONOMICA', 'VIOLENCIA_SIMBOLICA'    ,
    'ACOSO_HOSTIGAMIENTO'            , 'VIOLENCIA_DOMESTICA'    ,
    'VIOLENCIA_LABORAL'              , 'VIOLENCIA_OBSTETRICA'   ,
    'VIOLENCIA_MEDIATICA'            , 'VIOLENCIA_INSTITUCIONAL'
];


echo "Begin\n";

$cities = cities_browse($my);

for($y = $ystart; $y<=$yend; $y++) {
    echo "$y, ";
    $summs = [];
    foreach ($cities as $city) {
        $summ = new stdClass;
        $summ->event_date = "$y-01-01 00:00:00";
        $summ->state_id = $city->state_id;
        $summ->city_id = $city->id;
        $summ->amount = 0;

        $summ->violencia_psicologica = 0;
        $summ->violencia_sexual = 0;
        $summ->violencia_patrimonial_economica = 0;
        $summ->violencia_simbolica = 0;
        $summ->acoso_hostigamiento = 0;
        $summ->violencia_domestica = 0;
        $summ->violencia_laboral = 0;
        $summ->violencia_obstetrica = 0;
        $summ->violencia_mediatica = 0;
        $summ->violencia_institucional = 0;

        $summ->justice = 0;
        $summs[] = $summ;
    }
    incident_summ_0bulk($my, $summs);
}

echo "Finished\n";
$my->close();