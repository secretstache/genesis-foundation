<?php
/**
 * This is the homepage template file.
 *
 * @package  Genesis-Foundation
 * @since    1.0.0
 */

add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

add_action('genesis_entry_content', 'ssm_insert_content_blocks');

genesis_lite();