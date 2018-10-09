<?php

include_once('database.php');

function states_browse($mysqli, $country_id = null, $name = null) {
    $sql = "SELECT * FROM states WHERE 1=1";
    if (!is_null($country_id)) {
        $n = 0 + $country_id;
        $sql.= " AND country_id = $n";
    }
    if (!is_null($name)) {
        $nn = addslashes($name);
        $sql .= " AND name LIKE '$name'";
    }
    return db_query($mysqli, $sql);
}