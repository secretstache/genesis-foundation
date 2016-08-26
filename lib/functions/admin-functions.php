<?php 

/****************************************
Admin Functions
*****************************************/

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
 * Re-prioritise Genesis SEO metabox from high to default.
 */
function ssm_add_inpost_seo_box() {
  if ( genesis_detect_seo_plugins() )
    return;
  foreach ( (array) get_post_types( array( 'public' => true ) ) as $type ) {
    if ( post_type_supports( $type, 'genesis-seo' ) )
      add_meta_box( 'genesis_inpost_seo_box', __( 'Theme SEO Settings', 'genesis' ), 'genesis_inpost_seo_box', $type, 'normal', 'default' );
  }
}

/**
 * Re-prioritise Genesislayout metabox from high to default.
 *
 */
function ssm_add_inpost_layout_box() {
  if ( ! current_theme_supports( 'genesis-inpost-layouts' ) )
    return;
  foreach ( (array) get_post_types( array( 'public' => true ) ) as $type ) {
    if ( post_type_supports( $type, 'genesis-layouts' ) )
      add_meta_box( 'genesis_inpost_layout_box', __( 'Layout Settings', 'genesis' ), 'genesis_inpost_layout_box', $type, 'normal', 'default' );
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
function ssm_remove_acf_menu() {
    // provide a list of usernames who can edit custom field definitions here
    $admins = array( 'admin', 'jrstaatsiii', 'aman');

    // get the current user
    $current_user = wp_get_current_user();

    // match and remove if needed
    if( !in_array( $current_user->user_login, $admins ) ) {
        remove_menu_page('edit.php?post_type=acf');
    }
}

/**
 * Add 2 step verification to remove a content block or repeater field in ACF
 */
function ssm_two_step_acf_field_deletion() {  ?>
  <script type="text/javascript">
    (function($) {
      $('body').on('click', '.-minus', function( e ){
        return confirm("Are you sure you want to delete this field? This cannot be reversed.");
      })
    })(jQuery);
  </script>
<?php }

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
function ssm_force_home_page_on_front() {
  $homepage = get_page_by_title( 'Home' );

  if ( $homepage ) {
      update_option( 'page_on_front', $homepage->ID );
      update_option( 'show_on_front', 'page' );
  }
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

  acf_add_options_sub_page(array(
        'title' => 'Brand Options',
        'parent' => 'options-general.php',
        'capability' => 'manage_options'
    ));

}

/**
*  Removes unnecessary menu items from add new dropdown
*/
function remove_wp_nodes() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_node( 'new-link' );
    $wp_admin_bar->remove_node( 'new-media' );
    $wp_admin_bar->remove_node( 'new-user' );
}

/**
 * Filter Yoast SEO Metabox Priority
 */
function ssm_filter_yoast_seo_metabox() {
  return 'low';
}

/**
 * Registering menus
 */
register_nav_menus(
  array(
    'primary-navigation' => __( 'Primary Navigation' ),
  )
);

function ssm_admin_styles() {

  wp_enqueue_style( 'ssm-admin-css', CHILD_URL . '/admin.css' );

}