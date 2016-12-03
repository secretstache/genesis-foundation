<?php
/**
 * This is the landing page template file.
 * Template Name: Landing Page
 *
 * @package  Genesis-Foundation
 * @since    1.0.0
 */

//* 

add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

add_filter( 'body_class', 'ssm_landing_page_class' );
/*
 * Add body class
 *
 */
function ssm_landing_page_class( $classes ) {
	
	$classes[] = 'landing-page';
	// return the $classes array
	return $classes;
}

add_action('get_header', 'ssm_maybe_show_title');
/*
 * Use ACF radio button to determine whether or not to show the title
 *
 */
function ssm_maybe_show_title() {

	global $post;

	if ( get_field('include_title_on_page') == 'No') {

		remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
		remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
		remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

	}

}

add_action('genesis_entry_content', 'ssm_insert_content_blocks');
remove_action( 'genesis_header', 'ssm_do_header_right' );
remove_action( 'genesis_after_header', 'ssm_do_primary_navigation' );

genesis_lite();