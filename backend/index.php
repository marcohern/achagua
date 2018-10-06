<?php

function w($id) {
    echo "$id:".$_ENV[$id]."\n";
}

require_once('lib/Runner.php');

//phpinfo();exit(0);

$runner = new Runner();
$runner->json();