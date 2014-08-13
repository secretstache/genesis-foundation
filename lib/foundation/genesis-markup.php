<?php

// add foundation classes
add_filter( 'genesis_attr_site-header',         'ssfg_add_markup_class', 10, 2 );
add_filter( 'genesis_attr_site-inner',          'ssfg_add_markup_class', 10, 2 );
add_filter( 'genesis_attr_content-sidebar-wrap','ssfg_add_markup_class', 10, 2 );
add_filter( 'genesis_attr_content',             'ssfg_add_markup_class', 10, 2 );
add_filter( 'genesis_attr_sidebar-primary',     'ssfg_add_markup_class', 10, 2 );
add_filter( 'genesis_attr_archive-pagination',  'ssfg_add_markup_class', 10, 2 );
add_filter( 'genesis_attr_site-footer',         'ssfg_add_markup_class', 10, 2 );

function ssfg_add_markup_class( $attr, $context ) {
    // default classes to add
    $classes_to_add = apply_filters ('ssfg-classes-to-add',
        // default foundation markup values
        array(
            'site-header'       		=> 'row',
            'site-inner'       			=> 'inner-wrap',
            'site-footer'       		=> 'row',
            'content-sidebar-wrap'      => 'row',
            'content'           		=> 'small-12 medium-7 large-8 column',
            'sidebar-primary'   		=> 'small-12 medium-5 large-4 column',
            'archive-pagination'		=> 'clearfix',
        ),
        $context,
        $attr
    );

    // lookup class from $classes_to_add
    $class = isset( $classes_to_add[ $context ] ) ? $classes_to_add[ $context ] : '';

    // apply any filters to modify the class
    $class = apply_filters( 'ssfg-add-class', $class, $context, $attr );

    // append the class(es) string (e.g. 'span9 custom-class1 custom-class2')
    $attr['class'] .= ' ' . sanitize_html_class( $class );

    return $attr;
}

/* Modify the foundation Classes being applied
 * based on the Genesis template chosen
 */

// modify foundation classes based on genesis_site_layout
add_filter('ssfg-classes-to-add', 'ssfg_modify_classes_based_on_template', 10, 3);

function ssfg_layout_options_modify_classes_to_add( $classes_to_add ) {

    $layout = genesis_site_layout();

    // content-sidebar          // default

    // full-width-content       // supported
    if ( 'full-width-content' === $layout ) {
        $classes_to_add['content'] = 'small-12';
    }

    // sidebar-content          // not yet supported
    // - same markup as content-sidebar with css modifications rather than markup

    // content-sidebar-sidebar  // not yet supported

    // sidebar-sidebar-content  // not yet supported

    // sidebar-content-sidebar  // not yet supported

    return $classes_to_add;
};

function ssfg_modify_classes_based_on_template( $classes_to_add, $context, $attr ) {
    $classes_to_add = ssfg_layout_options_modify_classes_to_add( $classes_to_add );

    return $classes_to_add;
}
