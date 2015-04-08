<?php

add_action('genesis_before', 'ssm_open_offnav_markup');
/**
 * Add Foundation offcanvas opening markup
 */
function ssm_open_offnav_markup() {
	echo '<div class="off-canvas-wrap" data-offcanvas>';
}

add_action('genesis_after', 'ssm_close_offnav_markup');
/**
 * Add Foundation offcanvas closing markup
 */
function ssm_close_offnav_markup() {
	echo '</div><!-- end .off-canvas-wrap -->';
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
    if ( $item->current == 1 || $item->current_item_ancestor == true ) {
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
    	'menu' => 'Primary Navigation',  				// nav name
    	'theme_location' => 'primary-navigation',       // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
		'walker'	=> new Foundation_Walker()
	));

}

function ssm_primary_mobile_navigation() {
	// display the wp3 menu if available
    wp_nav_menu(array(
		'container'	=> false,
    	'menu' => 'Primary Navigation',  				// nav name
		'menu_class' =>	'off-canvas-list',				// ul class			
    	'theme_location' => 'primary-navigation',       // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
		'walker'	=> new Foundation_Walker()
	));

}
 

add_action('genesis_after_header', 'ssm_do_nav');
/*
 * Buld the Navigation with proper wrapping HTML (for foundation)
 *
*/
function ssm_do_nav() { ?>
		
		<?php if ( has_nav_menu('primary-navigation') ) { ?>
		
		<div class="show-for-medium-up contain-to-grid">
			<nav class="top-bar" data-topbar>	
				<section class="top-bar-section">
					<?php ssm_primary_navigation(); ?>
				</section>
			</nav>
		</div>

		<div class="show-for-small-only mobile-menu">
			<nav class="tab-bar">
				<section class="left-small">
					<a class="left-off-canvas-toggle menu-icon"><span></span></a>
				</section>
				<section class="middle tab-bar-section">
					<h1 class="title">Title</h1>
				</section>
			</nav>
		</div>

		<aside class="left-off-canvas-menu">
				<ul class="off-canvas-list">
					<li><label>Navigation</label></li>
				</ul>
				
				<?php ssm_primary_mobile_navigation(); ?>
				
		</aside>

		<a class="exit-off-canvas"></a>
		
		<?php } // endif has_nav_menu ?>
		
<?php }