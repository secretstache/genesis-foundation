<?php 

if ( have_rows('content_blocks') ) {

	global $cb_i;
	$cb_i = 1;

	while ( have_rows('content_blocks') ) { 
	
	the_row();
	
		if ( get_row_layout() == 'wrapper_open' ) {
		
			get_template_part('templates/partials/wrapper-open');

		} elseif ( get_row_layout() == 'visual_editor' ) {

			get_template_part('templates/partials/visual-editor');

		} elseif ( get_row_layout() == 'headline' ) {

			get_template_part('templates/partials/headline');

		} elseif ( get_row_layout() == 'media' ) {

			get_template_part('templates/partials/media');

		} elseif ( get_row_layout() == 'columns' ) {

			get_template_part('templates/partials/columns');

		} elseif ( get_row_layout() == 'blog_posts' ) {

			get_template_part('templates/partials/blog-posts');

		} elseif ( get_row_layout() == 'accordion' ) {

			get_template_part('templates/partials/accordion');

		} elseif ( get_row_layout() == 'tabs' ) {

			get_template_part('templates/partials/tabs');

		} elseif ( get_row_layout() == 'form' ) {

			get_template_part('templates/partials/form');

		} elseif ( get_row_layout() == 'wrapper_close' ) {

			get_template_part('templates/partials/wrapper-close');

		}

		$wrapper_open = get_row_layout() == 'wrapper_open';
		$wrapper_close = get_row_layout() == 'wrapper_close';

		if ( !$wrapper_open && !$wrapper_close ) {

			$cb_i++;

		}
	
	} // endwhile have_rows('content_blocks')

} // endif have_rows('content_blocks')