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
    <script type="text/javascript" src="/wp-content/plugins/achagua/app/main.6c4957d8ccb582c79fcf.js"></script>
<?php
}

function achagua_shortcode_func( $atts ){
    
    wp_enqueue_style('achagua-bootstrap','https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
    wp_enqueue_style('achagua-bs-datepicker','https://unpkg.com/ngx-bootstrap/datepicker/bs-datepicker.css');

    wp_enqueue_style('achagua-css','/wp-content/plugins/achagua/app/styles.a474c4b2064489e33e1b.css');
    
    add_action('wp_footer', 'achuaga_shortcode_scripts');
	return "<app-root></app-root>";
}



function achuaga_map_shortcode_scripts() {
?>
    <script type="text/javascript" src="/wp-content/plugins/achagua/map/runtime.a66f828dca56eeb90e02.js"></script>
    <script type="text/javascript" src="/wp-content/plugins/achagua/map/polyfills.2f4a59095805af02bd79.js"></script>
    <script type="text/javascript" src="/wp-content/plugins/achagua/map/main.e238b91ac33f99fc8490.js"></script>
<?php
}

function achagua_map_shortcode_func($attrs) {
    wp_enqueue_style('achagua-bootstrap','https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
    wp_enqueue_style('achagua-bs-datepicker','https://unpkg.com/ngx-bootstrap/datepicker/bs-datepicker.css');

    wp_enqueue_style('achagua-css','/wp-content/plugins/achagua/map/styles.a474c4b2064489e33e1b.css');
    
    add_action('wp_footer', 'achuaga_map_shortcode_scripts');
	return "<br><br><br><br><br><br><br><br><app-root></app-root>";
}

add_action('wp_head','achagua_shortcode_base' );
add_shortcode( 'achagua', 'achagua_shortcode_func' );
add_shortcode( 'achagua_map', 'achagua_map_shortcode_func' );