<?php

add_action('genesis_before', 'ssm_offcanvas_markup', 11);
/**
 * Add Foundation offcanvas opening markup
 */
function ssm_offcanvas_markup() { ?>

  <div class="off-canvas" id="offCanvas" data-toggler=".is-active">
    <?php ssm_do_off_canvas_menu(); ?>
    <button class="button off-canvas-close" data-toggle="offCanvas">Close</button>
  </div>

<?php }

add_action('genesis_header', 'ssm_open_header_markup', 5);
/**
 * Add Foundation opening header markup
 */
function ssm_open_header_markup() { ?>

  <div class="title-bar">
    <div class="row align-justify align-middle">

<?php }

add_action('genesis_header', 'ssm_close_header_markup', 11);
/**
 * Add Foundation opening header markup
 */
function ssm_close_header_markup() { ?>

    </div>
  </div>

<?php }

/**
 * Rebuild Navigation Menus
 */

// Remove Genesis Nav Support
remove_theme_support( 'genesis-menus' );

/*********************
ADD FOUNDATION FEATURES TO WORDPRESS
*********************/
add_action('genesis_after_header', 'ssm_do_primary_navigation');

function ssm_do_primary_navigation() { ?>

    <?php if ( has_nav_menu('primary-navigation') ) { ?>

      <nav class="primary">
        <div class="row">
          <div class="show-for-medium medium-12 column">
            <?php
              wp_nav_menu(array(
                'container' => false,
                'menu' => 'Primary Navigation',
                'menu_class'  => 'dropdown menu',               // nav name
                'theme_location' => 'primary-navigation',       // where it's located in the theme
                'before' => '',                                 // before the menu
                'after' => '',                                  // after the menu
                'link_before' => '',                            // before each link
                'link_after' => '',
                'items_wrap' => '<ul id="%1$s" class="%2$s" data-dropdown-menu>%3$s</ul>',
                'walker'  => new Foundation_Walker()                            // after each link
              ));
            ?>
          </div>
        </div>
      </nav>

    <?php } // endif has_nav_menu ?>

<?php }