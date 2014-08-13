<?php
// Priority 15 ensures it runs after Genesis itself has setup.
add_action( 'genesis_setup', 'bsg_bootstrap_markup_setup', 15 );

function bsg_bootstrap_markup_setup() {

    // add bootstrap classes
    add_filter( 'genesis_attr_site-header',         'bsg_add_markup_class', 10, 2 );
    add_filter( 'genesis_attr_site-inner',          'bsg_add_markup_class', 10, 2 );
    add_filter( 'genesis_attr_content-sidebar-wrap','bsg_add_markup_class', 10, 2 );
    add_filter( 'genesis_attr_content',             'bsg_add_markup_class', 10, 2 );
    add_filter( 'genesis_attr_sidebar-primary',     'bsg_add_markup_class', 10, 2 );
    add_filter( 'genesis_attr_archive-pagination',  'bsg_add_markup_class', 10, 2 );
    add_filter( 'genesis_attr_site-footer',         'bsg_add_markup_class', 10, 2 );

} // bsg_bootstrap_markup_setup()

function bsg_add_markup_class( $attr, $context ) {
    // default classes to add
    $classes_to_add = apply_filters ('bsg-classes-to-add', 
        // default bootstrap markup values
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
    $class = apply_filters( 'bsg-add-class', $class, $context, $attr );

    // append the class(es) string (e.g. 'span9 custom-class1 custom-class2')
    $attr['class'] .= ' ' . sanitize_html_class( $class );

    return $attr;
}

/* Modify the Bootstrap Classes being applied
 * based on the Genesis template chosen
 */

// modify bootstrap classes based on genesis_site_layout
add_filter('bsg-classes-to-add', 'bsg_modify_classes_based_on_template', 10, 3);

function bsg_layout_options_modify_classes_to_add( $classes_to_add ) {

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

function bsg_modify_classes_based_on_template( $classes_to_add, $context, $attr ) {
    $classes_to_add = bsg_layout_options_modify_classes_to_add( $classes_to_add );

    return $classes_to_add;
}
