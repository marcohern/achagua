<?php

include_once('database.php');

function countries_browse($mysqli) {
    return db_query($mysqli, "SELECT * FROM countries");
}

function countries_get($mysqli, $id) {
    return db_first($mysqli, "SELECT * FROM countries WHERE id = $id");
}