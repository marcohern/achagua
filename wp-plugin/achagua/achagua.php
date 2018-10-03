<?php

/**
 * @package Achagua
 */
/*
Plugin Name: Achagua Form
Plugin URI: https://github.com/marcohern/achagua
Description: A form for inserting incidents
Version: 1.0.0
Author: Marco Hernandez
Author URI: https://marcohern.com
License: GPLv2 or later
Text Domain: achagua
*/

//defined(ABSPATH) or die('Access Denied');
if ( !function_exists( 'add_action' ) ) {
	echo 'Access Denied';
	exit;
}

class Achagua {

    public function activate() {
        flush_rewrite_rules();
    }

    public function deactivate() {
        flush_rewrite_rules();
    }
}

$achagua = new Achagua();

register_activation_hook  (__FILE__, [$achagua, 'activate'  ]);
register_deactivation_hook(__FILE__, [$achagua, 'deactivate']);

