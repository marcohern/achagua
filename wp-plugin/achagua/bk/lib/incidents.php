<?php

include_once('database.php');


function incidents_browse($mysqli, $limit=10, $offset=0) {
    $sql = "SELECT * FROM incidents";
    $sql.= " LIMIT $offset, $limit";
    return db_query($mysqli, $sql);
}

function incidents_year_count_by_city($mysqli, $city_id) {
    $cid = 0 + $city_id;
    $sql = "SELECT YEAR(i.event_date) AS year, "
          ."COUNT(*) AS incidents "
          ."FROM incidents i "
          ."INNER JOIN cities c ON c.id = i.city_id "
          ."INNER JOIN states s ON s.id = c.state_id "
          ."WHERE c.id = $cid "
          ."GROUP BY year "
          ."ORDER BY year DESC "
          ."LIMIT 10";
    return db_query($mysqli, $sql);
}

function incidents_city_count_by_state_year($mysqli, $state_id, $year) {
    $sid = 0 + $state_id;
    $yr = 0 + $year;
    $sql = "SELECT YEAR(i.event_date) AS year, "
          ."i.city_id AS cid, c.name AS city, "
          ."i.lat AS lat, i.lng AS lng, "
          ."COUNT(*) AS incidents "
          ."FROM incidents i "
          ."INNER JOIN cities c ON c.id = i.city_id "
          ."INNER JOIN states s ON s.id = c.state_id "
          ."WHERE i.state_id = $sid AND i.event_date = '$yr-01-01' "
          ."GROUP BY year, cid, city, lat, lng";
    return db_query($mysqli, $sql);
}

function incidents_city_count_by_state($mysqli, $state_id) {
    $sid = 0 + $state_id;
    $sql = "SELECT i.city_id AS cid, c.name AS city, COUNT(*) AS incidents
FROM incidents i
INNER JOIN cities c ON c.id = i.city_id
INNER JOIN states s ON s.id = c.state_id
WHERE i.state_id = $sid
GROUP BY cid, city";
    return db_query($mysqli, $sql);
}

function incidents_year_count_by_state($mysqli, $state_id) {
    $sid = 0 + $state_id;
    $sql = "SELECT YEAR(i.event_date) AS year, COUNT(*) AS incidents
FROM incidents i
INNER JOIN states s ON s.id = i.state_id
WHERE s.id = $sid
GROUP BY year";
    return db_query($mysqli, $sql);
}

function incidents_state_count_by_year($mysqli, $year) {
    $yr = 0 + $year;
    $sql = "SELECT YEAR(i.event_date) AS year, i.state_id AS sid, s.name AS state, COUNT(*) AS incidents
FROM incidents i
INNER JOIN states s ON s.id = i.state_id
WHERE i.event_date = '$yr-01-01'
GROUP BY sid, state
ORDER BY year DESC
LIMIT 10";
    return db_query($mysqli, $sql);
}

function incidents_state_count($mysqli) {
    $sql = "SELECT i.state_id AS sid, s.name AS state, COUNT(*) AS incidents
FROM incidents i
INNER JOIN states s ON s.id = i.state_id
GROUP BY sid, state";
    return db_query($mysqli, $sql);
}

function incidents_count_any($mysqli, $state_id, $city_id, $year, $stateDetails='cities') {
    if (!is_null($city_id)) {
        return incidents_year_count_by_city($mysqli, $city_id);
    } else if (!is_null($state_id)) {
        if (!is_null($year)) {
            return incidents_city_count_by_state_year($mysqli, $state_id, $year);
        } else {
            if ($stateDetails == 'cities') {
                return incidents_city_count_by_state($mysqli, $state_id);
            } else {
                return incidents_year_count_by_state($mysqli, $state_id);
            }
        }
    } else if(!is_null($year)) {
        return incidents_state_count_by_year($mysqli, $year);
    } else {
        err_bad_request("Parameters values not allowed.",'report');
    }
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
