<?php

$db = null;

include_once('lib/countries.php');
include_once('lib/states.php');
include_once('lib/cities.php');

$db = (object) require_once('config/db.php');

$mysqli = db_connect($db);

$states = states_browse($mysqli, null, "Ma%");
$cities = cities_browse($mysqli, 47);

$mysqli->close();

echo json_encode(['states'=>$states,'cities'=>$cities]);

?>