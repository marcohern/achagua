<?php

class AchaguaShortcode {
    public function __construct() {

    }

    public function display() {

    }
}

//[foobar]
function achagua_shortcode_func( $atts ){
    wp_enqueue_style('achagua-bootstrap','https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
    wp_enqueue_style('achagua-bs-datepicker','https://unpkg.com/ngx-bootstrap/datepicker/bs-datepicker.css');
	return require(ACHAGUA_PLUGIN_DIR.'tpl.php');
}
add_shortcode( 'achagua', 'achagua_shortcode_func' );