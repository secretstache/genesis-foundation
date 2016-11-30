<?php

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
    wp_enqueue_script('ssm-scripts', CHILD_URL . '/assets/dist/js/main.min.js', array('jquery'), NULL, true );

  }
}

/**
 * Inline Scripts
 */
function ssm_inline_scripts() { ?>
  <script>
  /*
   * Load up Foundation
   */
  jQuery(document).ready(function($) {
    $(document).foundation();
  });
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

    $url = CHILD_URL . '/assets/dist/images/png/ph-logo.png';

  }

  $title = '<a href="' . home_url() . '"><img src="' . $url . '" alt="' . get_bloginfo('description') . '" title="' . get_bloginfo('description') . '"/></a>';
  return $title;
}

/**
 * Build Header Right
 *
 */
function ssm_do_header_right() {

  include( CHILD_DIR . '/templates/partials/header-right.php');

}


/**
 * Rebuild Genesis Footer
 *
 */
function ssm_do_footer() {

  include( CHILD_DIR . '/templates/partials/footer.php');

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

/**
 * Add body class if the page/post has a featured image
 *
 */
function ssm_if_featured_image_class($classes) {

  if ( has_post_thumbnail() ) {
    array_push($classes, 'has-featured-image');
  }

  return $classes;
}

/**
 * Unregister the superfish scripts
 *
 */
function ssm_unregister_superfish() {
  wp_deregister_script( 'superfish' );
  wp_deregister_script( 'superfish-args' );
}

/**
 * Build Off Canvas Menu
 *
 */
function ssm_do_off_canvas_menu() { 

  wp_nav_menu(array(
    'container' => false,
    'menu' => 'Primary Navigation',                 // nav name
    'menu_class' => 'vertical menu',                // ul class
    'theme_location' => 'primary-navigation',       // where it's located in the theme
    'before' => '',                                 // before the menu
    'after' => '',                                  // after the menu
    'link_before' => '',                            // before each link
    'link_after' => '',                             // after each link
    'walker'  => new Foundation_Walker()
  ));

}

remove_theme_support( 'genesis-structural-wraps' );

/**
 * Insert Royal Preloader
 *
 */
function ssm_do_royal_preloader() {
  echo '<div id="royal_preloader"></div>';
}
