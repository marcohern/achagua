<?php

function db_connect($db) {
    //echo json_encode(['db'=>$db,'msg'=>'Arrived', 'dbs' => [$db->host, $db->user, $db->pwd, $db->schema]]);exit(0);
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
        error("Error querying: ".$mysqli->error,'db');
    }

    $result = [];
    foreach ($records as $r) {
        $ar = (object) $r;
        $result[] = $ar;
    }
    $records->close();
    return $result;
}

function db_first($mysqli, $sql) {
    $result = db_query($mysqli, $sql);
    if (count($result) > 0) return $result[0];
    else err_not_found("No records found: $sql",'db');
}

function db_execute($mysqli, $sql) {
    $records = $mysqli->query($sql, MYSQLI_USE_RESULT);
    if (!$records) {
        error("Error querying: ".$mysqli->error,'db');
    }
    return $records;
}