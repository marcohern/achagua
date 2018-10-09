<?php
//phpinfo();ext(0);

function w($id) {
    echo "$id:".$_ENV[$id]."\n";
}

require_once('lib/Runner.php');



$runner = new Runner();
$runner->json();