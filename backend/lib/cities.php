<?php

include_once('database.php');

function cities_browse($mysqli, $state_id = null, $name = null) {
    $sql = "SELECT * FROM cities WHERE 1=1";
    if (!is_null($state_id)) {
        $n = 0 + $state_id;
        $sql.= " AND state_id = $n";
    }
    if (!is_null($name)) {
        $nn = addslashes($state_id);
        $sql.= " AND state_id LIKE '$nn'";
    }
    return db_query($mysqli, $sql);
}