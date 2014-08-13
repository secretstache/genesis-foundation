<?php

class Smart_Widget extends WP_Widget { // Change Smart_Widget to something representative to what your smart widget will do, using namespacing to avoid conflicts (ie SSM_Resources)
	
	function __construct() {
		
		parent::__construct(
			'widget-id', // (ie ssm-resources)
			'Widget Title', // (ie Resources)
			array(
				'class'			=>	'widget-class', // (ie ssm-resources)
				'description'	=>	'This is the Widget Description.' // (ie Inserts a conditional list of resources into the sidebar.)
			)
		);
		
		// Register stylesheets
		add_action( 'admin_print_styles', array( $this, 'register_admin_styles') );
	
	}
	
	function form( $instance ) {
		
		$instance = wp_parse_args(
			(array)$instance,
			array(
				'title' => ''
			)
		);
		
		include( get_stylesheet_directory() . '/path/to/widget/views/admin.php' ); // Be sure to update path
		
	}
	
	function update( $new_instance, $old_instance ) {
		
		$old_instance['title'] = strip_tags( stripslashes( $new_instance['title'] ) );
		
		return $old_instance;
		
	}
	
	function widget( $args, $instance ) {
		
		extract( $args, EXTR_SKIP );
		
		echo $before_widget;
		
		include( get_stylesheet_directory() . '/path/to/widget/views/widget.php' ); // Be sure to update path

		echo $after_widget;
		
	}
	
	function register_admin_styles() {
		wp_enqueue_style( 'widget-namespace-admin', get_bloginfo('stylesheet_directory') . '/includes/widgets/resources/admin.css'); // (ie ssm-resources-admin) + Be sure to update path
	}
	
}
add_action( 'widgets_init', create_function( '', 'register_widget("Smart_Widget");' ) ); // Replace Smart_Widget with the ID you passed on line 3