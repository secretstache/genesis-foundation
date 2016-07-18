<?php

/****************************************
Backend Functions
*****************************************/

/**
 * Customize Contact Methods
 * @since 1.0.0
 *
 * @author Bill Erickson
 * @link http://sillybean.net/2010/01/creating-a-user-directory-part-1-changing-user-contact-fields/
 *
 * @param array $contactmethods
 * @return array
 */
function ssm_contactmethods( $contactmethods ) {
  unset( $contactmethods['aim'] );
  unset( $contactmethods['yim'] );
  unset( $contactmethods['jabber'] );

  return $contactmethods;
}

/* Remove Genesis Page Templates
 *
 * @author Bill Erickson
 * @link http://www.billerickson.net/remove-genesis-page-templates
 *
 * @param array $page_templates
 * @return array
 */
function ssm_remove_genesis_page_templates( $page_templates ) {
  unset( $page_templates['page_archive.php'] );
  unset( $page_templates['page_blog.php'] );
  return $page_templates;
}

/**
 * Remove Unnecessary User Roles
 */
remove_role( 'subscriber' );
remove_role( 'contributor' );

/**
 * Remove Genesis Theme Settings Metaboxes
 */
function ssm_remove_genesis_metaboxes( $_genesis_theme_settings_pagehook ) {
  //remove_meta_box( 'genesis-theme-settings-feeds',      $_genesis_theme_settings_pagehook, 'main' );
  //remove_meta_box( 'genesis-theme-settings-header',     $_genesis_theme_settings_pagehook, 'main' );
  //remove_meta_box( 'genesis-theme-settings-nav',        $_genesis_theme_settings_pagehook, 'main' );
  //remove_meta_box( 'genesis-theme-settings-breadcrumb', $_genesis_theme_settings_pagehook, 'main' );
  //remove_meta_box( 'genesis-theme-settings-comments',   $_genesis_theme_settings_pagehook, 'main' );
  //remove_meta_box( 'genesis-theme-settings-posts',      $_genesis_theme_settings_pagehook, 'main' );
  //remove_meta_box( 'genesis-theme-settings-blogpage',   $_genesis_theme_settings_pagehook, 'main' );
  //remove_meta_box( 'genesis-theme-settings-scripts',    $_genesis_theme_settings_pagehook, 'main' );
}

/**
 * Reposition Genesis Layout Metabox
 */
function ssm_add_inpost_layout_box() {
  if ( ! current_theme_supports( 'genesis-inpost-layouts' ) )
    return;
  foreach ( (array) get_post_types( array( 'public' => true ) ) as $type ) {
    if ( post_type_supports( $type, 'genesis-layouts' ) )
      add_meta_box( 'genesis_inpost_layout_box', __( 'Layout Settings', 'genesis' ), 'genesis_inpost_layout_box', $type, 'normal', 'low' );
  }
}

/**
 * Don't Update Theme
 * @since 1.0.0
 *
 * If there is a theme in the repo with the same name,
 * this prevents WP from prompting an update.
 *
 * @author Mark Jaquith
 * @link http://markjaquith.wordpress.com/2009/12/14/excluding-your-plugin-or-theme-from-update-checks/
 *
 * @param array $r, request arguments
 * @param string $url, request url
 * @return array request arguments
 */
function ssm_dont_update_theme( $r, $url ) {
  if ( 0 !== strpos( $url, 'http://api.wordpress.org/themes/update-check' ) )
    return $r; // Not a theme update request. Bail immediately.
  $themes = unserialize( $r['body']['themes'] );
  unset( $themes[ get_option( 'template' ) ] );
  unset( $themes[ get_option( 'stylesheet' ) ] );
  $r['body']['themes'] = serialize( $themes );
  return $r;
}

/**
 * Remove Dashboard Meta Boxes
 */
function ssm_remove_dashboard_widgets() {
  global $wp_meta_boxes;
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
  //unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
  //unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
}

/**
 * Hide Advanced Custom Fields to Users
 */

function remove_acf_menu(){
    // provide a list of usernames who can edit custom field definitions here
    $admins = array( 'admin', 'jrstaatsiii', 'brian');

    // get the current user
    $current_user = wp_get_current_user();

    // match and remove if needed
    if( !in_array( $current_user->user_login, $admins ) ) {
        remove_menu_page('edit.php?post_type=acf');
    }
}

/**
 * Remove default link for images
 */
function ssm_imagelink_setup() {
  $image_set = get_option( 'image_default_link_type' );
  if ($image_set !== 'none') {
    update_option('image_default_link_type', 'none');
  }
}

/**
 * Show Kitchen Sink in WYSIWYG Editor
 */
function ssm_unhide_kitchensink($args) {
  $args['wordpress_adv_hidden'] = false;
  return $args;
}

/**
 * Disable some or all of the default widgets.
 */
function ssm_unregister_default_widgets() {

  unregister_widget( 'WP_Widget_Pages' );
  unregister_widget( 'WP_Widget_Calendar' );
  // unregister_widget( 'WP_Widget_Archives' );
  unregister_widget( 'WP_Widget_Meta' );
  // unregister_widget( 'WP_Widget_Search' );
  // unregister_widget( 'WP_Widget_Text' );
  // unregister_widget( 'WP_Widget_Categories' );
  unregister_widget( 'WP_Widget_Recent_Posts' );
  unregister_widget( 'WP_Widget_Recent_Comments' );
  unregister_widget( 'WP_Widget_RSS' );
  unregister_widget( 'WP_Widget_Tag_Cloud' );
  // unregister_widget( 'WP_Nav_Menu_Widget' );

}

/**
 * Modifies the TinyMCE settings array
 */
function ssm_tiny_mce_before_init( $init ) {

  // Restrict the Formats available in TinyMCE. Currently excluded: h1,h5,h6,address,pre
  $init['block_formats'] = 'Paragraph=p;Heading 2=h2; Heading 3=h3; Heading 4=h4; Blockquote=blockquote';
  return $init;

}

/**
 * Remove <p> tags from around images
 * See: http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/
 */
function ssm_remove_ptags_on_images( $content ) {

  return preg_replace( '/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content );

}

/**
 * Remove the injected styles for the [gallery] shortcode
 *
 */
function ssm_gallery_style( $css ) {

  return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );

}

/**
*  Set Home Page Programmatically if a Page Called "Home" Exists
*/

// Should this be wrapped in a function for better organization?

$homepage = get_page_by_title( 'Home' );

if ( $homepage ) {
    update_option( 'page_on_front', $homepage->ID );
    update_option( 'show_on_front', 'page' );
}

/*
 * Limits a post to a single category by changing the checkboxes into radio buttons. Simple.
 *
 */
function ssm_admin_catcher() {
  if( strstr($_SERVER['REQUEST_URI'], 'wp-admin/post-new.php')
    || strstr($_SERVER['REQUEST_URI'], 'wp-admin/post.php')
    || strstr($_SERVER['REQUEST_URI'], 'wp-admin/edit.php') ) {
    ob_start('ssm_one_category_only');
  }
}

function ssm_one_category_only($content) {
  return ssm_swap_out_checkboxes($content);
}


function ssm_swap_out_checkboxes($content) {
  $content = str_replace('type="checkbox" name="post_category', 'type="radio" name="post_category', $content);

  foreach (get_all_category_ids() as $i) {
    $content = str_replace('id="in-popular-category-'.$i.'" type="checkbox"', 'id="in-popular-category-'.$i.'" type="radio"', $content);
  }

  return $content;
}

/*
 * Adds a body class to target the home page edit screen
 *
 */
function ssm_home_admin_body_class( $classes ) {
  global $post;
    $screen = get_current_screen();
  $homepage = get_page_by_title( 'Home' );

    if ( 'post' == $screen->base && ( $post->ID == $homepage->ID ) ) {
        $classes .= 'front-page';
  }

    return $classes;

}

/**
*  Remove Editor Support on Pages (Replaced with ACF Page Builder)
*/
function ssm_remove_editor() {
  remove_post_type_support( 'page', 'editor' );
}

/**
*  Creates ACF Options Page(s)
*/
if( function_exists('acf_add_options_sub_page') ) {

  acf_add_options_page('Brand Options');
  acf_add_options_page('Style Builder');

  acf_add_options_sub_page(array(
        'title' => 'Brand Options',
        'parent' => 'options-general.php',
        'capability' => 'manage_options'
    ));

    acf_add_options_sub_page(array(
        'title' => 'Style Builder',
        'parent' => 'options-general.php',
        'capability' => 'manage_options'
    ));

}

/**
*  Load default choices from options page into content blocks
*/
function acf_load_style_default_choices( $field ) {

    // reset choices
    $field['choices'] = array();


    // if has rows
    if( have_rows('additional_styles', 'option') ) {

        // while has rows
        while( have_rows('additional_styles', 'option') ) {

            // instantiate row
            the_row();

              // vars
            $value = get_sub_field('value');
            $label = get_sub_field('label');

            // append to choices
            $field['choices'][ $value ] = $label;

        }

    }

    // return the field
    return $field;

}

/**
*  Removes unnecessary menu items from add new dropdown
*/
function remove_wp_nodes() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_node( 'new-link' );
    $wp_admin_bar->remove_node( 'new-media' );
    // $wp_admin_bar->remove_node( 'new-shop_coupon' );
    // $wp_admin_bar->remove_node( 'new-shop_order' );
    $wp_admin_bar->remove_node( 'new-user' );
}


/****************************************
Frontend
*****************************************/

/**
 * HTML5 DOCTYPE
 * removes the default Genesis doctype, adds new html5 doctype with IE detection
*/
function ssm_html5_doctype() {
?>
<!DOCTYPE html>

<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->

  <head>
    <meta charset="utf-8">
<?php }

/**
 * Load custom favicon to header
 */
function ssm_custom_favicon_filter( $favicon_url ) {
  return CHILD_URL . '/assets/images/favicon.ico';
}

/**
 * Load apple touch icon in header
 */
function ssm_apple_touch_icon() {
  echo '<link rel="apple-touch-icon" href="' . CHILD_URL . '/assets/images/apple-touch-icon.png">';
}


/**
 * Enqueue Script
 */
function ssm_scripts() {
  if ( !is_admin() ) {

    // Theme Scripts
    wp_enqueue_script('ssm-scripts', CHILD_URL . '/assets/js/main.min.js', array('jquery'), NULL, true );

    // Animation Scripts
    wp_enqueue_script('wow', CHILD_URL . '/assets/bower_components/wow.js/dist/wow.min.js', array('jquery'), NULL, true );

  }
}

/**
 * Inline Scripts
 */
function ssm_inline_scripts() { ?>

<script>
   new WOW().init();
</script>

<?php }

/**
 * Remove Query Strings From Static Resources
 */
function ssm_remove_script_version($src) {
  $parts = explode('?', $src);
  return $parts[0];
}

/**
 * Remove Read More Jump
 */
function ssm_remove_more_jump_link($link) {
  $offset = strpos($link, '#more-');
  if ($offset) {
    $end = strpos($link, '"',$offset);
  }
  if ($end) {
    $link = substr_replace($link, '', $offset, $end-$offset);
  }
  return $link;
}


/**
 * Fix Gravity Form Tabindex Conflicts
 * http://gravitywiz.com/fix-gravity-form-tabindex-conflicts/
 */
function gform_tabindexer( $tab_index, $form = false ) {
    $starting_index = 1000; // if you need a higher tabindex, update this number
    if( $form )
        add_filter( 'gform_tabindex_' . $form['id'], 'gform_tabindexer' );
    return GFCommon::$tab_index >= $starting_index ? GFCommon::$tab_index : $starting_index;
}

/**
 * Replace Site Title text entered in Settings > Reading with custom HTML.
 * @author Sridhar Katakam
 * @link http://sridharkatakam.com/replace-site-title-text-custom-html-genesis/
 *
 * @param string original title text
 * @return string modified title HTML
 */
function ssm_site_title( $title ) {
  $logo = get_field('brand_logo', 'options');

  if ( $logo ) {

    $url = $logo['url'];

  } else {

    $url = CHILD_URL . '/assets/images/ph-logo.png';

  }

  $title = '<a href="' . home_url() . '"><img src="' . $url . '" alt="' . get_bloginfo('description') . '" title="' . get_bloginfo('description') . '"/></a>';
  return $title;
}

/**
 * Build Header Right
 *
 */
function ssm_do_header_right() {

  include( CHILD_DIR . '/templates/includes/header-right.php');

}


/**
 * Rebuild Genesis Footer
 *
 */
function ssm_do_footer() {

  include( CHILD_DIR . '/templates/includes/footer.php');

}

/**
 * Replace Search Text
 *
 */
function ssm_modify_search_text( $text ) {

  if ( $placeholder_text = get_field('placeholder_text', 'options') ) {

  return esc_attr( $placeholder_text );

  } else {

  return esc_attr( 'Seach this site...' );

  }
}

/****************************************
Misc Theme Functions
*****************************************/

/**
 * Unregister the superfish scripts
 */
function ssm_unregister_superfish() {
  wp_deregister_script( 'superfish' );
  wp_deregister_script( 'superfish-args' );
}

/**
 * Filter Yoast SEO Metabox Priority
 */
function ssm_filter_yoast_seo_metabox() {
  return 'low';
}

/**
 *  Sanitize multiple classes at once
 */
if ( ! function_exists( "sanitize_html_classes" ) && function_exists( "sanitize_html_class" ) ) {
  /**
   * sanitize_html_class works just fine for a single class
   * Some times le wild <span class="blue hedgehog"> appears, which is when you need this function,
   * to validate both blue and hedgehog,
   * Because sanitize_html_class doesn't allow spaces.
   *
   * @uses   sanitize_html_class
   * @param  (mixed: string/array) $class   "blue hedgehog goes shopping" or array("blue", "hedgehog", "goes", "shopping")
   * @param  (mixed) $fallback Anything you want returned in case of a failure
   * @return (mixed: string / $fallback )
   */
  function sanitize_html_classes( $class, $fallback = null ) {

    // Explode it, if it's a string
    if ( is_string( $class ) ) {
      $class = explode(" ", $class);
    }


    if ( is_array( $class ) && count( $class ) > 0 ) {
      $class = array_map("sanitize_html_class", $class);
      return implode(" ", $class);
    }
    else {
      return sanitize_html_class( $class, $fallback );
    }
  }
}
