<?php 
/**
 * This is the default single post file.
 *
 * @package  Genesis-Foundation
 * @since    1.0.0
 */

add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar' );

add_action('genesis_before_content', 'ssm_open_row');

function ssm_open_row() {
  echo '<div class="row">';
}

add_action('genesis_before_footer', 'ssm_close_row');

function ssm_close_row() {
  echo '</div>';
}


genesis_lite();