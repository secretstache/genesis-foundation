<?php


// Force full width layout */
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

add_action('genesis_before_content', 'ssm_do_featured_image');
/*
 * Add featured image above title
 *
 */
function ssm_do_featured_image() {

	include('templates/partials/featured-image.php');
	
}

add_action('genesis_entry_content', 'ssm_insert_content_blocks');
/*
 * Includes the content blocks to build the page layout 
 *
 */
function ssm_insert_content_blocks() {

	include('templates/layout-builder/content-blocks.php');

}

genesis(); 