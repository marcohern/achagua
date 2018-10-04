<?php

class AchaguaWidget extends WP_Widget {
    // Main constructor
	public function __construct() {
        parent::__construct(
            'achagua_widget',
            __( 'Achagua Form Widget', 'text_domain' ),
            array(
                'customize_selective_refresh' => true,
            )
        );
	}

	// The widget form (for the backend )
	public function form( $instance ) {
        //echo "<label>Achagua Widget Form</label>";
    }

	// Update widget settings
	public function update( $new_instance, $old_instance ) {
		//return $old_instance;
	}

	// Display the widget
	public function widget( $args, $instance ) {
        //extract( $args );
        //echo $before_widget;
        require(ACHAGUA_PLUGIN_DIR.'tpl.php');
        //echo $after_widget;
	}
}

function achagua_register_widgets() {
	register_widget( 'AchaguaWidget' );
}

add_action( 'widgets_init', 'achagua_register_widgets' );