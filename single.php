<?php 

// Force full width layout */
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar' );

genesis_lite();