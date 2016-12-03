<?php 
/**
 * This is the default single post file.
 *
 * @package  Genesis-Foundation
 * @since    1.0.0
 */

add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar' );

genesis_lite();