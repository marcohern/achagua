<?php

include_once('database.php');

$incident_types = [
    "VIOLENCIA_PSICOLOGICA",
    "VIOLENCIA_SEXUAL",
    "VIOLENCIA_PATRIMONIAL_ECONOMICA",
    "PAREJA_SIMBOLICA",
    "ACOSO_HOSTIGAMIENTO",
    "VIOLENCIA_DOMESTICA",
    "VIOLENCIA_LABORAL",
    "VIOLENCIA_OBSTETRICA",
    "VIOLENCIA_MEDIATICA",
    "VIOLENCIA_INSTITUCIONAL",
];

function incidents_browse($mysqli, $limit=10, $offset=0) {
    $sql = "SELECT * FROM incidents";
    $sql.= " LIMIT $offset, $limit";
    return db_query($mysqli, $sql);
}

function incident_get_sql_filter($i, $filter) {
    return ($i>0) ?
        "AND $filter " :
        "WHERE $filter ";
}

function incident_get_filters($st=0, $year=null, $vbg=null, $justice=null) {
    $i=$st;
    $sql = '';
    if (!empty($year   )) $sql .= incident_get_sql_filter(++$i, "YEAR(i.event_date) = $year");
    if (!empty($vbg    )) {
        switch($vbg) {
            case "VIOLENCIA_PSICOLOGICA":
                $sql .= incident_get_sql_filter(++$i, "i.v_ps > 0");
                break;
            case "VIOLENCIA_SEXUAL":
                $sql .= incident_get_sql_filter(++$i, "i.v_sx > 0");
                break;
            case "VIOLENCIA_PATRIMONIAL_ECONOMICA":
                $sql .= incident_get_sql_filter(++$i, "i.v_pe > 0");
                break;
            case "PAREJA_SIMBOLICA":
                $sql .= incident_get_sql_filter(++$i, "i.v_si > 0");
                break;
            case "ACOSO_HOSTIGAMIENTO":
                $sql .= incident_get_sql_filter(++$i, "i.v_ah > 0");
                break;
            case "VIOLENCIA_DOMESTICA":
                $sql .= incident_get_sql_filter(++$i, "i.v_do > 0");
                break;
            case "VIOLENCIA_LABORAL":
                $sql .= incident_get_sql_filter(++$i, "i.v_lb > 0");
                break;
            case "VIOLENCIA_OBSTETRICA":
                $sql .= incident_get_sql_filter(++$i, "i.v_ob > 0");
                break;
            case "VIOLENCIA_MEDIATICA":
                $sql .= incident_get_sql_filter(++$i, "i.v_me > 0");
                break;
            case "VIOLENCIA_INSTITUCIONAL":
                $sql .= incident_get_sql_filter(++$i, "i.v_in > 0");
                break;
            default:
                break;
        }
    }
    if (!empty($justice)) {
        $sql .= incident_get_sql_filter(++$i, "i.justice > 0");
    }
    return $sql;
}

function incidents_year_count_by_city($mysqli, $city_id, $year=null, $vbg=null, $justice=null) {
    $cid = 0 + $city_id;
    $sql = "SELECT YEAR(i.event_date) AS year, 
SUM(i.amount) AS incidents, SUM(i.mult) AS mult, SUM(i.violencia_psicologica) AS v_ps, SUM(i.violencia_sexual) AS v_sx, 
SUM(i.violencia_patrimonial_economica) AS v_pe, SUM(i.violencia_simbolica) AS v_si, SUM(i.acoso_hostigamiento) AS v_ah,
SUM(i.violencia_domestica) AS v_do, SUM(i.violencia_laboral) AS v_lb, SUM(i.violencia_obstetrica) AS v_ob, SUM(i.violencia_mediatica) AS v_me,
SUM(i.violencia_institucional) AS v_in, SUM(i.justice) AS justice
FROM incidents_summary i 
INNER JOIN cities c ON c.id = i.city_id 
INNER JOIN states s ON s.id = c.state_id 
WHERE c.id = $cid ";
$sql .= incident_get_filters(1, $year, $vbg, $justice);
$sql .= "GROUP BY year ORDER BY year ASC";
    
    return db_query($mysqli, $sql);
}

function incidents_city_count_by_state_year($mysqli, $state_id, $year, $vbg=null, $justice=null) {
    $sid = 0 + $state_id;
    $yr = 0 + $year;
    $sql = "SELECT YEAR(i.event_date) AS year,
	i.city_id AS cid, c.name AS city,
SUM(i.amount) AS incidents, SUM(i.mult) AS mult, SUM(i.violencia_psicologica) AS v_ps, SUM(i.violencia_sexual) AS v_sx, 
SUM(i.violencia_patrimonial_economica) AS v_pe, SUM(i.violencia_simbolica) AS v_si, SUM(i.acoso_hostigamiento) AS v_ah,
SUM(i.violencia_domestica) AS v_do, SUM(i.violencia_laboral) AS v_lb, SUM(i.violencia_obstetrica) AS v_ob, SUM(i.violencia_mediatica) AS v_me,
SUM(i.violencia_institucional) AS v_in, SUM(i.justice) AS justice
FROM incidents_summary i 
INNER JOIN cities c ON c.id = i.city_id 
INNER JOIN states s ON s.id = c.state_id 
WHERE i.state_id = $sid AND i.event_date = '$yr-01-01' ";
$sql .= incident_get_filters(2, null, $vbg, $justice);
$sql .= "GROUP BY year, cid, city";
    return db_query($mysqli, $sql);
}

function incidents_city_count_by_state($mysqli, $state_id, $year=null, $vbg=null, $justice=null) {
    $sid = 0 + $state_id;
    $sql = "SELECT i.city_id AS cid, c.name AS city,
    SUM(i.amount) AS incidents, SUM(i.mult) AS mult, SUM(i.violencia_psicologica) AS v_ps, SUM(i.violencia_sexual) AS v_sx, 
    SUM(i.violencia_patrimonial_economica) AS v_pe, SUM(i.violencia_simbolica) AS v_si, SUM(i.acoso_hostigamiento) AS v_ah,
    SUM(i.violencia_domestica) AS v_do, SUM(i.violencia_laboral) AS v_lb, SUM(i.violencia_obstetrica) AS v_ob, SUM(i.violencia_mediatica) AS v_me,
    SUM(i.violencia_institucional) AS v_in, SUM(i.justice) AS justice
FROM incidents_summary i
INNER JOIN cities c ON c.id = i.city_id
INNER JOIN states s ON s.id = c.state_id
WHERE i.state_id = $sid ";
$sql .= incident_get_filters(1, $year, $vbg, $justice);
$sql .= "GROUP BY cid, city";
    return db_query($mysqli, $sql);
}

function incidents_year_count_by_state($mysqli, $state_id, $year=null, $vbg=null, $justice=null) {
    $sid = 0 + $state_id;
    $sql = "SELECT YEAR(i.event_date) AS year, i.state_id AS sid, s.name AS state, 
    SUM(i.amount) AS incidents, SUM(i.mult) AS mult, SUM(i.violencia_psicologica) AS v_ps, SUM(i.violencia_sexual) AS v_sx, 
    SUM(i.violencia_patrimonial_economica) AS v_pe, SUM(i.violencia_simbolica) AS v_si, SUM(i.acoso_hostigamiento) AS v_ah,
    SUM(i.violencia_domestica) AS v_do, SUM(i.violencia_laboral) AS v_lb, SUM(i.violencia_obstetrica) AS v_ob, SUM(i.violencia_mediatica) AS v_me,
    SUM(i.violencia_institucional) AS v_in, SUM(i.justice) AS justice
FROM incidents_summary i
INNER JOIN states s ON s.id = i.state_id
WHERE s.id = $sid ";
$sql .= incident_get_filters(1, $year, $vbg, $justice);
$sql .= "GROUP BY year";
    return db_query($mysqli, $sql);
}

function incidents_state_count_by_year($mysqli, $year, $vbg=null, $justice=null) {
    $yr = 0 + $year;
    $sql = "SELECT YEAR(i.event_date) AS year, i.state_id AS sid, s.name AS state, 
SUM(i.amount) AS incidents, SUM(i.mult) AS mult, SUM(i.violencia_psicologica) AS v_ps, SUM(i.violencia_sexual) AS v_sx, 
SUM(i.violencia_patrimonial_economica) AS v_pe, SUM(i.violencia_simbolica) AS v_si, SUM(i.acoso_hostigamiento) AS v_ah,
SUM(i.violencia_domestica) AS v_do, SUM(i.violencia_laboral) AS v_lb, SUM(i.violencia_obstetrica) AS v_ob, SUM(i.violencia_mediatica) AS v_me,
SUM(i.violencia_institucional) AS v_in, SUM(i.justice) AS justice
FROM incidents_summary i
INNER JOIN states s ON s.id = i.state_id
WHERE i.event_date = '$yr-01-01' ";
$sql .= incident_get_filters(1, null, $vbg, $justice);
$sql .= "GROUP BY year, sid, state ORDER BY year DESC";
    return db_query($mysqli, $sql);
}

function incidents_state_count($mysqli, $year=null, $vbg=null, $justice=null) {
    $sql = "SELECT i.state_id AS sid, s.name AS state, 
    SUM(i.amount) AS incidents, SUM(i.mult) AS mult, SUM(i.violencia_psicologica) AS v_ps, SUM(i.violencia_sexual) AS v_sx, 
    SUM(i.violencia_patrimonial_economica) AS v_pe, SUM(i.violencia_simbolica) AS v_si, SUM(i.acoso_hostigamiento) AS v_ah,
    SUM(i.violencia_domestica) AS v_do, SUM(i.violencia_laboral) AS v_lb, SUM(i.violencia_obstetrica) AS v_ob,
    SUM(i.violencia_mediatica) AS v_me, SUM(i.violencia_institucional) AS v_in, SUM(i.justice) AS justice
    FROM states s
    LEFT JOIN incidents_summary i ON s.id = i.state_id ";

    $sql .= incident_get_filters(0, $year, $vbg, $justice);
    $sql .= "GROUP BY sid, state";
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

function incident_inc($mysqli, $incident)  {
    $types = explode(',',$incident->vbg);
    $mult = 0;
    if (count($types) > 1) $mult = 1;
    $sql = "UPDATE incidents_summary SET ";
    foreach ($types as $type) {
        $column = strtolower($type);
        $sql .= "$column = $column + 1, ";
    }
    if ($incident->justice) $sql .= "justice = justice + 1, ";
    $sql .= "amount = amount + 1, "
        ."mult = mult + $mult "
        ."WHERE event_date = '{$incident->event_date}' "
        ."AND state_id = {$incident->state_id} "
        ."AND city_id = {$incident->city_id}";
    $result = db_execute($mysqli, $sql);
    return true;
}

function incident_summ_updt($mysqli, $summ) {
    $sql = "REPLACE INTO incidents_summary SET "
        ."event_date = '{$summ->event_date}', "
        ."state_id = {$summ->state_id}, "
        ."city_id = {$summ->city_id}, "
        ."amount = {$summ->amount}, "

        ."violencia_psicologica = {$summ->violencia_psicologica}, "
        ."violencia_sexual = {$summ->violencia_sexual}, "
        ."violencia_patrimonial_economica = {$summ->violencia_patrimonial_economica}, "
        ."violencia_simbolica = {$summ->violencia_simbolica}, "
        ."acoso_hostigamiento = {$summ->acoso_hostigamiento}, "
        ."violencia_domestica = {$summ->violencia_domestica}, "
        ."violencia_laboral = {$summ->violencia_laboral}, "
        ."violencia_obstetrica = {$summ->violencia_obstetrica}, "
        ."violencia_mediatica = {$summ->violencia_mediatica}, "
        ."violencia_institucional = {$summ->violencia_institucional}, "
        
        ."justice = {$summ->justice}";
        
        $result = db_execute($mysqli, $sql);
        return ['success' => $result];
}

function incident_summ_0bulk($mysqli, $summs) {
    $sql = "INSERT INTO incidents_summary(event_date, state_id, city_id) VALUES ";
    $i = 0;
    foreach ($summs as $summ) {
        $rec = '';
        if ($i>0) $rec = ",";
        $rec .= "('{$summ->event_date}',{$summ->state_id},{$summ->city_id})";
        $sql .= $rec;
        $i++;
    }
    
    $result = db_execute($mysqli, $sql);
    return ['success' => $result];
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
