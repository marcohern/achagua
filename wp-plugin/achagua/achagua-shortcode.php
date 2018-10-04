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

    wp_enqueue_style('achagua-css','/wp-content/plugins/achagua/app/styles.34c57ab7888ec1573f9c.css');

    wp_enqueue_script('achagua-polyfills','/wp-content/plugins/achagua/app/polyfills.2f4a59095805af02bd79.js');
    wp_enqueue_script('achagua-runtime'  ,'/wp-content/plugins/achagua/app/runtime.a66f828dca56eeb90e02.js');
    wp_enqueue_script('achagua-main'     ,'/wp-content/plugins/achagua/app/main.63a64c7177ed01086f01.js');

	return "<h2>Achagua Template</h2>";//require(ACHAGUA_PLUGIN_DIR.'tpl.php');
}
add_shortcode( 'achagua', 'achagua_shortcode_func' );