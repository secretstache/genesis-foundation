<?php

add_action('genesis_before', 'ssm_open_offnav_markup', 10);
/**
 * Add Foundation offcanvas opening markup
 */
function ssm_open_offnav_markup() {
  $offnavopen = '<div class="off-canvas-wrapper">';
  $offnavopen .= '<div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>';

	echo $offnavopen;
}

add_action('genesis_after', 'ssm_close_offnav_markup', 5);
/**
 * Add Foundation offcanvas closing markup
 */
function ssm_close_offnav_markup() {
  $offnavclose = '</div><!-- end .off-canvas-wrapper-inner -->';
  $offnavclose .= '</div><!-- end off-canvas-wrapper -->';
	
  echo $offnavclose;
}

/**
 * Rebuild Navigation Menus
 */

// Remove Genesis Nav Support
remove_theme_support( 'genesis-menus' );

/*********************
ADD FOUNDATION FEATURES TO WORDPRESS
*********************/


//Use the active class of the ZURB Foundation for the current menu item. (From: https://github.com/milohuang/reverie/blob/master/functions.php)
function required_active_nav_class( $classes, $item ) {
    if ( $item->current == 1 ) {
        $classes[] = 'active';
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'required_active_nav_class', 10, 2 );


// Registering menus
register_nav_menus(
	array(
		'primary-navigation' => __( 'Primary Navigation' ),
	)
);

// the main menu
function ssm_primary_navigation() {
	// display the wp3 menu if available
    wp_nav_menu(array(
      'container'	=> false,
      'menu' => 'Primary Navigation', 
      'menu_class'	=> 'dropdown menu', 				// nav name
      'theme_location' => 'primary-navigation',       // where it's located in the theme
      'before' => '',                                 // before the menu
      'after' => '',                                  // after the menu
      'link_before' => '',                            // before each link
      'link_after' => '', 
      'items_wrap' => '<ul id="%1$s" class="%2$s" data-dropdown-menu>%3$s</ul>',
      'walker'  => new Foundation_Walker()                            // after each link
	));

}

function ssm_primary_mobile_navigation() {
	// display the wp3 menu if available
    wp_nav_menu(array(
      'container'	=> false,
      'menu' => 'Primary Navigation',  				// nav name
      'menu_class' =>	'vertical menu',				// ul class			
      'theme_location' => 'primary-navigation',       // where it's located in the theme
      'before' => '',                                 // before the menu
      'after' => '',                                  // after the menu
      'link_before' => '',                            // before each link
      'link_after' => '',                             // after each link
      'walker'	=> new Foundation_Walker()
	));

}

add_action('genesis_after_header', 'ssm_do_primary_navigation');

function ssm_do_primary_navigation() { ?>
		
		<?php if ( has_nav_menu('primary-navigation') ) { ?>
		
		<div class="show-for-large">
			<nav class="nav-primary">
				<div class="wrap">	
				<?php ssm_primary_navigation(); ?>
				</div>
			</nav>
		</div>

		<div class="hide-for-large mobile-menu">
			<div class="title-bar">
				 <button class="menu-icon" type="button" data-toggle="offCanvas"></button>
			</div>
		</div>

    <div class="off-canvas position-left" id="offCanvas" data-off-canvas data-position="left">
      <?php ssm_primary_mobile_navigation(); ?>
    </div>
		
		<?php } // endif has_nav_menu ?>
		
<?php }
