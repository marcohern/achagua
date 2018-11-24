<?php

include_once('database.php');


function incidents_browse($mysqli, $limit=10, $offset=0) {
    $sql = "SELECT * FROM incidents";
    $sql.= " LIMIT $limit, $offset";
    return db_query($mysqli, $sql);
}

function incidents_get($mysqli, $id) {
    return db_first($mysqli, "SELECT * FROM incidents WHERE id = $id");
}

function incidents_create($mysqli, $data) {
    $sql = "INSERT INTO incidents (vbg, event_date, lat, lng, country_id, state_id, city_id, justice, created, updated) VALUES ";
    $vbg = "'".addslashes($data->vbg)."'";
    $event_date = "'{$data->event_date}'";
    $lat = $data->lat;
    $lng = $data->lng;
    $country_id = $data->country_id;
    $state_id = $data->state_id;
    $city_id = $data->city_id;
    $justice = ($data->justice) ? 1 : 0;
    $sql .= "($vbg,$event_date,$lat,$lng,$country_id,$state_id,$city_id,$justice,NOW(), NULL)";
    $result = db_execute($mysqli, $sql);
    $sql2 = "SELECT LAST_INSERT_ID() AS id ";
    $id = db_first($mysqli, $sql2)->id;
    return ['success' => $result, 'id' => 0+$id ];
}

function incidents_bulk($mysqli, $records) {
    $sql = "INSERT INTO incidents (vbg, event_date, lat, lng, country_id, state_id, city_id, justice, created, updated) VALUES ";
    $i=0;
    foreach ($records as $data) {
        if ($i>0) { $sql .= ","; }
        $vbg = "'".addslashes($data->vbg)."'";
        $event_date = "'{$data->event_date}'";
        $lat = $data->lat;
        $lng = $data->lng;
        $country_id = $data->country_id;
        $state_id = $data->state_id;
        $city_id = $data->city_id;
        $justice = ($data->justice) ? 1 : 0;
        $sql .= "($vbg,$event_date,$lat,$lng,$country_id,$state_id,$city_id,$justice,NOW(), NULL)";
        $i++;
    }
    $result = db_execute($mysqli, $sql);
    $sql2 = "SELECT LAST_INSERT_ID() AS id ";
    $id = db_first($mysqli, $sql2)->id;
    return ['success' => $result, 'id' => 0+$id,'amount' => $i ];
}

function incidents_update($mysqli, $id, $data) {
    $sql = "UPDATE incidents";
    $vbg = "'".addslashes($data->vbg)."'";
    $event_date = "'{$data->event_date}'";
    $lat = $data->lat;
    $lng = $data->lng;
    $country_id = $data->country_id;
    $state_id = $data->state_id;
    $city_id = $data->city_id;
    $justice = ($data->justice) ? 1 : 0;

    $sql .= " SET vbg = $vbg, event_date = $event_date, lat = $lat, lng = $lng,"
         ." country_id = $country_id, state_id = $state_id, city_id = $city_id,"
         ."justice = $justice, updated = NOW() WHERE id = $id";
    $result = db_execute($mysqli, $sql);
    
    return ['success' => $result];
}

function incidents_delete($mysqli, $id) {
    $sql = "DELETE FROM incidents WHERE id = $id";
    $result = db_execute($mysqli, $sql);
    return ['success' => $result ];
}

function incidents_validate($data) {
    $errors = [];
    return $errors;
}
