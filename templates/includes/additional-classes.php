<?php

global $cb_i;

$html_id 		= get_sub_field('html_id');
$html_classes 	= sanitize_html_classes(get_sub_field('class_options'));
$even_odd 		= 0 == $cb_i % 2 ? 'even' : 'odd';

//Animation Classes
$headline_animation 		= 	sanitize_html_classes(get_sub_field('headline_animation'));
$subheadline_animation 		= 	sanitize_html_classes(get_sub_field('subheadline_animation'));
$visual_editor_animation 	= 	sanitize_html_classes(get_sub_field('visual_editor_animation'));
$media_item_animation 		= 	sanitize_html_classes(get_sub_field('media_item_animation'));
$button_animation 			= 	sanitize_html_classes(get_sub_field('button_animation'));
$column_list_animation 		= 	sanitize_html_classes(get_sub_field('column_list_animation'));
$icon_animation 			= 	sanitize_html_classes(get_sub_field('icon_animation'));
$blog_posts_list_animation 	= 	sanitize_html_classes(get_sub_field('blog_posts_list_animation'));
$accordion_list_animation 	= 	sanitize_html_classes(get_sub_field('accordion_list_animation'));
$tab_list_animation 		= 	sanitize_html_classes(get_sub_field('tab_list_animation'));
$form_animation 			= 	sanitize_html_classes(get_sub_field('form_animation'));