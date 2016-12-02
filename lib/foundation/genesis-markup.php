<?php

// add foundation classes
// add_filter( 'genesis_attr_site-header',         'ssm_add_markup_class', 10, 2 );
add_filter( 'genesis_attr_title-area',         'ssm_add_markup_class', 10, 2 );
// add_filter( 'genesis_attr_site-container',      'ssm_add_markup_class', 10, 2 );
// add_filter( 'genesis_attr_content-sidebar-wrap','ssm_add_markup_class', 10, 2 );
add_filter( 'genesis_attr_content',             'ssm_add_markup_class', 10, 2 );
add_filter( 'genesis_attr_sidebar-primary',     'ssm_add_markup_class', 10, 2 );
// add_filter( 'genesis_attr_archive-pagination',  'ssm_add_markup_class', 10, 2 );
// add_filter( 'genesis_attr_site-footer',         'ssm_add_markup_class', 10, 2 );

function ssm_add_markup_class( $attr, $context ) {
    // default classes to add
    $classes_to_add = apply_filters ('ssm-classes-to-add',
        // default foundation markup values
        array(
            //'site-header'       		=> 'row',
            'title-area'                => array('small-6', 'medium-3', 'column'),
            // 'site-container'       		=> array('inner-wrap', 'off-canvas-content'),
            //'site-footer'       		=> 'row',
            //'content-sidebar-wrap'      => 'row',
            //'content'           		=> array('small-12', 'medium-9', 'column'),
			'sidebar-primary'   		=> array('small-12', 'medium-3', 'column'),
            // 'archive-pagination'		=> 'clearfix',
        ),
        $context,
        $attr
    );

	// populate $classes_array based on $classes_to_add	
	$value = isset( $classes_to_add[ $context ] ) ? $classes_to_add[ $context ] : array();
	
	if ( is_array( $value ) ) {
		$classes_array = $value;
	} else {
		$classes_array = explode( ' ', (string) $value );
	}

    // apply any filters to modify the class	
	$classes_array = apply_filters( 'ssm-add-class', $classes_array, $context, $attr );
	
	$classes_array = array_map( 'sanitize_html_class', $classes_array );

    // append the class(es) string (e.g. 'small-12', 'medium-7', 'large-8', 'column')
    $attr['class'] .= ' ' . implode( ' ', $classes_array);

    return $attr;
}

/* Modify the foundation Classes being applied
 * based on the Genesis template chosen
 */

// modify foundation classes based on genesis_site_layout
add_filter('ssm-classes-to-add', 'ssm_modify_classes_based_on_template', 10, 3);

function ssm_layout_options_modify_classes_to_add( $classes_to_add ) {

    $layout = genesis_site_layout();

    // content-sidebar          // default

    // full-width-content       // supported
    // if ( 'full-width-content' === $layout ) {
    //     $classes_to_add['content'] = array('small-12', 'column');
    // }

    // sidebar-content
    // - same markup as content-sidebar with css modifications rather than markup

    // content-sidebar-sidebar  // not yet supported

    // sidebar-sidebar-content  // not yet supported

    // sidebar-content-sidebar  // not yet supported

    return $classes_to_add;
};

function ssm_modify_classes_based_on_template( $classes_to_add, $context, $attr ) {
    $classes_to_add = ssm_layout_options_modify_classes_to_add( $classes_to_add );

    return $classes_to_add;
}