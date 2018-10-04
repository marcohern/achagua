<?php

class AchaguaShortcode {
    public function __construct() {

    }

    public function display() {

    }
}

function achagua_shortcode_base() {
    $obj_id = get_queried_object_id();
    $current_url = get_permalink( $obj_id );
?>
    <base href='<?= $current_url ?>'>
<?php
}

function achuaga_shortcode_scripts() {
?>    
    <script type="text/javascript" src="/wp-content/plugins/achagua/app/runtime.a66f828dca56eeb90e02.js"></script>
    <script type="text/javascript" src="/wp-content/plugins/achagua/app/polyfills.2f4a59095805af02bd79.js"></script>
    <script type="text/javascript" src="/wp-content/plugins/achagua/app/main.4bc5fa6174b3e834cea6.js"></script>
<?php
}

function achagua_shortcode_func( $atts ){
    
    wp_enqueue_style('achagua-bootstrap','https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
    wp_enqueue_style('achagua-bs-datepicker','https://unpkg.com/ngx-bootstrap/datepicker/bs-datepicker.css');

    wp_enqueue_style('achagua-css','/wp-content/plugins/achagua/app/styles.34c57ab7888ec1573f9c.css');
    
    add_action('wp_footer', 'achuaga_shortcode_scripts');
	return "<app-root></app-root>";//require(ACHAGUA_PLUGIN_DIR.'tpl.php');
}

add_action('wp_head','achagua_shortcode_base' );
add_shortcode( 'achagua', 'achagua_shortcode_func' );