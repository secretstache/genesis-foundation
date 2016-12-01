<?php
/**
 * This is the homepage template file.
 *
 * @package  Genesis-Starter-Child-Theme
 * @since    1.0.0
 */

/** Force full width layout */
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

/** Remove Entry Header */
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );


add_action('genesis_entry_content', 'ssm_insert_content_blocks');
/*
 * Includes the content blocks to build the page layout 
 *
 */
function ssm_insert_content_blocks() {

  include('templates/layout-builder/content-blocks.php');

}

genesis_lite();