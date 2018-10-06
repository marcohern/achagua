<?php

include_once('database.php');

function countries_browse($mysqli) {
    return db_query($mysqli, "SELECT * FROM countries");
}