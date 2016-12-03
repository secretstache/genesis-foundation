<?php
/**
 * This is the default template file.
 *
 * @package  Genesis-Foundation
 * @since    1.0.0
 */

add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
add_action('genesis_before_content', 'ssm_do_featured_image');
add_action('genesis_entry_content', 'ssm_insert_content_blocks');

genesis_lite();