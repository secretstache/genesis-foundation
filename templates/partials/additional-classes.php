<?php

global $cb_i;

$even_odd = 0 == $cb_i % 2 ? 'even' : 'odd';

$inline_classes = get_sub_field('html_classes');

if ( get_sub_field('column_list') ) {
  $column_count = count(get_sub_field('column_list'));
}

if ( get_sub_field('media_type') ) {
  $media_type = sanitize_title_with_dashes( get_sub_field('media_type') );
}

$section_id_classes = '';
$wrapper_id_classes = '';

if ( $html_id = get_sub_field('html_id') ) {
  $html_id = sanitize_html_class(strtolower($html_id));
  $section_id_classes .= ' id="' . $html_id . '" class="content-block row-' . $cb_i . ' row-' . $even_odd;
  $wrapper_id_classes .= ' id="' . $html_id . '" class=" section-wrapper';
} else { 
  $section_id_classes .= ' class="content-block row-' . $cb_i . ' row-' . $even_odd;
  $wrapper_id_classes .= ' class="section-wrapper';
}

if ( get_row_layout() == 'visual_editor' ) {
  $section_id_classes .= ' visual-editor';
}

if ( get_row_layout() == 'headline' ) {
  $section_id_classes .= ' headline';
  if ( get_sub_field('include_cta') == 'Yes') {
    $section_id_classes .= ' headline-with-cta';
  }
}

if ( get_row_layout() == 'media' ) {
  $section_id_classes .= ' media ' . $media_type;
}

if ( get_row_layout() == 'columns') {
  $section_id_classes .= ' cols has-' . $column_count . '-cols';
}

if ( get_row_layout() == 'blog_posts' ) {
  $section_id_classes .= ' blog-posts';
}

if ( get_row_layout() == 'accordion' ) {
  $section_id_classes .= ' accordion';
}

if ( get_row_layout() == 'tabs' ) {
  $section_id_classes .= ' tabs';
}

if ( get_row_layout() == 'form' ) {
  $section_id_classes .= ' form';
}

if ( get_row_layout() == 'html_code_block' ) {
  $section_id_classes .= ' custom-html';
}

if ( $inline_classes != NULL ) {
  $section_id_classes .= ' ' . $inline_classes;
  $wrapper_id_classes .= ' ' . $inline_classes;
}

$section_id_classes .= '"';
$wrapper_id_classes .= '"';