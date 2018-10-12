<?php

$vr = 1;
$br = 0;

define('APP_ROOT',dirname(__FILE__));

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    define('DS','\\');
} else {
    define('DS','/');
}

$file = APP_ROOT.DS.'build.txt';
$wpfile = APP_ROOT.DS.'wp-plugin'.DS.'achagua'.DS.'achagua.php';

$bl = 0;
if (file_exists($file)) {
    $bl = 0 + file_get_contents($file);
}

$version = "$vr.$br.$bl";
echo "Current Version: $version\n";

$bl += 1;

$plugin = file_get_contents($wpfile);



echo "Updating version in file: $wpfile\n";

$version = "$vr.$br.$bl";
$plugin = preg_replace('/Version: \d+.\d+.\d+/',"Version: $version",$plugin);


file_put_contents($wpfile, $plugin);
file_put_contents($file, $bl);


echo "Version Updated: $version\n";