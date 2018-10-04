<?php

$db = (object) require_once('./config/db.php');

$mysqli = new mysqli($db->host, $db->user, $db->pwd, $db->schema);
if ($mysqli->connect_error) {
    die("(".$mysqli->connect_errno.") ".$mysqli->connect_error);
}

$records = $mysqli->query("SELECT * FROM states", MYSQLI_USE_RESULT);

if (!$records) {
    die("Error querying: ".$mysqli->error);
}

$result = [];
foreach ($records as $r) {
    $ar = (object) $r;
    $result[] = $ar;
}

$records->close();

$mysqli->close();

echo json_encode($result);
?>