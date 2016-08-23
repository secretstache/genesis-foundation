<?php

add_action('genesis_setup','child_theme_setup', 15);
/**
 * Theme Setup
 * @since 1.0.0
 *
 * This setup function attaches all of the site-wide functions
 * to the correct hooks and filters. All the functions themselves
 * are defined below this setup function.
 *
 */
function child_theme_setup() {

    /****************************************
    Define child theme version
    *****************************************/

    define( 'CHILD_THEME_VERSION', filemtime( get_stylesheet_directory() . '/style.css' ) );


    /****************************************
    Setup Foundation 5 by Zurb
    *****************************************/

    include_once( CHILD_DIR . '/lib/foundation/foundation-walker.php' );
    include_once( CHILD_DIR . '/lib/foundation/genesis-markup.php' );
    include_once( CHILD_DIR . '/lib/foundation/foundation-functions.php' );


    /****************************************
    Setup child theme functions
    *****************************************/

    include_once( CHILD_DIR . '/lib/theme-functions.php' );


    /****************************************
    Backend
    *****************************************/

    // Admin Branding
    include_once( CHILD_DIR . '/lib/admin-branding.php');

    // Image Sizes
    // add_image_size( $name, $width = 0, $height = 0, $crop = false );
    add_image_size( 'featured-image', 9999, 600, TRUE );
    add_image_size( 'square-500', 500, 500, TRUE );
    add_image_size( 'icon', 100, 100, TRUE );

    // add_filter( 'image_size_names_choose', 'ssm_image_size_names_choose' );
    /**
     *
     * Add new image sizes to media size selection menu
     * See: http://wpdaily.co/top-10-snippets/
     *
     */
    function ssm_image_size_names_choose( $sizes ) {
        $sizes['desktop-size'] = 'Desktop';
        return $sizes;
    }

    // Clean up Head
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wp_shortlink_wp_head');

    // Structural Wraps
    // add_theme_support( 'genesis-structural-wraps', array( 'header', 'nav', 'subnav', 'inner', 'footer-widgets', 'footer' ) );

    // Sidebars
    unregister_sidebar( 'header-right' );
    unregister_sidebar( 'sidebar-alt' );

    // add_theme_support( 'genesis-footer-widgets', 4 );

    // Execute shortcodes in widgets
    add_filter('widget_text', 'do_shortcode');

    // Remove Unused Page Layouts
    genesis_unregister_layout( 'content-sidebar-sidebar' );
    genesis_unregister_layout( 'sidebar-sidebar-content' );
    genesis_unregister_layout( 'sidebar-content-sidebar' );
    genesis_unregister_layout( 'sidebar-content' );
    // genesis_unregister_layout( 'content-sidebar' );

    // Remove Unused User Settings
    add_filter( 'user_contactmethods', 'ssm_contactmethods' );
    remove_action( 'show_user_profile', 'genesis_user_options_fields' );
    remove_action( 'edit_user_profile', 'genesis_user_options_fields' );
    remove_action( 'show_user_profile', 'genesis_user_archive_fields' );
    remove_action( 'edit_user_profile', 'genesis_user_archive_fields' );
    remove_action( 'show_user_profile', 'genesis_user_seo_fields' );
    remove_action( 'edit_user_profile', 'genesis_user_seo_fields' );
    remove_action( 'show_user_profile', 'genesis_user_layout_fields' );
    remove_action( 'edit_user_profile', 'genesis_user_layout_fields' );

    // Editor Styles
    add_editor_style( 'editor-style.css' );

    // Remove Genesis Page Templates
    add_filter( 'theme_page_templates', 'ssm_remove_genesis_page_templates' );

    // Remove Genesis Theme Settings Metaboxes
    add_action( 'genesis_theme_settings_metaboxes', 'ssm_remove_genesis_metaboxes' );

    // Reposition Genesis SEO Settings Metabox
    add_action( 'admin_menu', 'ssm_add_inpost_seo_box' );
    remove_action( 'admin_menu', 'genesis_add_inpost_seo_box' );

    // Reposition Genesis Layout Settings Metabox
    add_action( 'admin_menu', 'ssm_add_inpost_layout_box' );
    remove_action( 'admin_menu', 'genesis_add_inpost_layout_box' );

    // Don't update theme
    add_filter( 'http_request_args', 'ssm_dont_update_theme', 5, 2 );

    // Prevent File Modifications
    define ( 'DISALLOW_FILE_EDIT', true );

    // Add support for custom background
    // add_theme_support( 'custom-background' );

    // Add support for custom header
    // add_theme_support( 'genesis-custom-header', array( 'width' => 1140, 'height' => 100 ) );

    // Remove Dashboard Meta Boxes
    add_action('wp_dashboard_setup', 'ssm_remove_dashboard_widgets' );

    // Remove ACF Menu for most users
    add_action('admin_init', 'ssm_remove_acf_menu');

    // Add 2 step verification to remove a content block or repeater field in ACF
    add_action('acf/input/admin_footer', 'ssm_two_step_acf_field_deletion');

    // Remove default link for images
    add_action('admin_init', 'ssm_imagelink_setup', 10);

    // Show Kitchen Sink in WYSIWYG Editor by default
    add_filter( 'tiny_mce_before_init', 'ssm_unhide_kitchensink' );

    // Disable some or all of the default widgets
    add_action('widgets_init', 'ssm_unregister_default_widgets');

    // Modifies the TinyMCE settings array
    add_filter( 'tiny_mce_before_init', 'ssm_tiny_mce_before_init' );

    // Remove <p> tags from around images
    add_filter( 'the_content', 'ssm_remove_ptags_on_images' );

    // Remove the injected styles for the [gallery] shortcode
    add_filter( 'gallery_style', 'ssm_gallery_style' );

    // Automatically make pages named "Home" the front page
    add_action('admin_init', 'ssm_force_home_page_on_front');

    // Replace Category Checkboxes with Radio Buttons
    add_action( 'init', 'ssm_admin_catcher' );

    // Add admin body class to differentiate the home page
    add_filter( 'admin_body_class', 'ssm_home_admin_body_class' );

    // Remove Editor Support on Pages (Replaced with ACF Page Builder)
    add_action( 'init', 'ssm_remove_editor' );


    // Remove unnecessary menu items from add new dropdown
    add_action( 'admin_bar_menu', 'remove_wp_nodes', 999 );


    /****************************************
    Frontend
    *****************************************/

    // Add HTML5 markup structure
    add_theme_support( 'html5' );

    // Add viewport meta tag for mobile browsers
    add_theme_support( 'genesis-responsive-viewport' );

    // HTML5 doctype with conditional classes
    remove_action( 'genesis_doctype', 'genesis_do_doctype' );
    add_action( 'genesis_doctype', 'ssm_html5_doctype' );

    // Load custom favicon to header
    add_filter( 'genesis_pre_load_favicon', 'ssm_custom_favicon_filter' );

    // Load Apple touch icon in header
    add_filter( 'genesis_meta', 'ssm_apple_touch_icon' );

    // Rebuilds Title to create better markup for SEO
    add_filter( 'genesis_seo_title', 'ssm_site_title', 10, 1 );

    // Remove the site description
    remove_action( 'genesis_site_description', 'genesis_seo_site_description' );

    // Load Header Right
    add_action( 'genesis_header', 'ssm_do_header_right', 10 );

    // Remove Edit link
    add_filter( 'genesis_edit_post_link', '__return_false' );

    // Enqueue Scripts
    add_action( 'wp_enqueue_scripts', 'ssm_scripts' );

    // Inline Scripts
    add_action( 'wp_footer', 'ssm_inline_scripts', 99 );

    // Remove Query Strings From Static Resources
    add_filter('script_loader_src', 'ssm_remove_script_version', 15, 1);
    add_filter('style_loader_src', 'ssm_remove_script_version', 15, 1);

    // Remove Read More Jump
    add_filter('the_content_more_link', 'ssm_remove_more_jump_link');

    // Fix GravityForms tabindex conflict
    add_filter( 'gform_tabindex', 'gform_tabindexer', 10, 2 );

    // Remove and Rebuild the Genesis Footer
    remove_action( 'genesis_footer', 'genesis_do_footer');
    add_action( 'genesis_footer', 'ssm_do_footer');

    // Modify the placeholder search text
    add_filter( 'genesis_search_text', 'ssm_modify_search_text' );

    // Adds body class if the page/post has a featured image
    add_action('body_class', 'ssm_if_featured_image_class' );

    // Build Off Canvas Menu
    add_action('genesis_before', 'ssm_do_off_canvas_menu', 11);

}


/****************************************
Misc Theme Functions
*****************************************/

// Unregister the superfish scripts
add_action( 'wp_enqueue_scripts', 'ssm_unregister_superfish' );

// Filter Yoast SEO Metabox Priority
add_filter( 'wpseo_metabox_prio', 'ssm_filter_yoast_seo_metabox' );
