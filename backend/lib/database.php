<?php

function db_connect($db) {
    $mysqli = new mysqli($db->host, $db->user, $db->pwd, $db->schema);
    if ($mysqli->connect_error) {
        die("(".$mysqli->connect_errno.") ".$mysqli->connect_error);
    }

    if (!$mysqli->set_charset("utf8")) {
        die("can't set charset utf8");
    }
    return $mysqli;
}

function db_query($mysqli, $sql) {
    $records = $mysqli->query($sql, MYSQLI_USE_RESULT);
    if (!$records) {
        die("Error querying: ".$mysqli->error);
    }

    $result = [];
    foreach ($records as $r) {
        $ar = (object) $r;
        $result[] = $ar;
    }
    $records->close();
    return $result;
}

function db_execute($mysqli, $sql) {
    $records = $mysqli->query($sql, MYSQLI_USE_RESULT);
    if (!$records) {
        die("Error querying: ".$mysqli->error);
    }
}