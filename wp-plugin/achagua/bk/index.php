<?php
//phpinfo();ext(0);

ini_set('display_errors', '1');

function w($id) {
    echo "$id:".$_ENV[$id]."\n";
}

require_once('constants.php');
req('/lib/error.php');
req('/lib/Runner.php');

$runner = new Runner();
$runner->run();