<?php

/**
 * @package Achagua
 */
/*
Plugin Name: Achagua Form
Plugin URI: https://github.com/marcohern/achagua
Description: A form for inserting incidents
Version: 1.0.47
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

define('ACHAGUA_PLUGIN_DIR', plugin_dir_path( __FILE__ ));

class Achagua {

    public function __construct() {
        add_action('init', [$this, 'addCustomPostType']);
    }

    public function addCustomPostType() {
        //register_post_type('achagua',['public' => true, 'label' => 'Achagua']);
    }

    public function activate() {
        flush_rewrite_rules();
    }

    public function deactivate() {
        flush_rewrite_rules();
    }


}

//require_once( ACHAGUA_PLUGIN_DIR . 'achagua-widget.php' );
require_once( ACHAGUA_PLUGIN_DIR . 'achagua-shortcode.php' );

$achagua = new Achagua();

register_activation_hook  (__FILE__, [$achagua, 'activate'  ]);
register_deactivation_hook(__FILE__, [$achagua, 'deactivate']);

//wp_enqueue_style('achagua-styles','https://unpkg.com/ngx-bootstrap/datepicker/bs-datepicker.css');

