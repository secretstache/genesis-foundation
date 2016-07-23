<?php

add_action('genesis_before', 'ssm_open_offnav_markup', 10);
/**
 * Add Foundation offcanvas opening markup
 */
function ssm_open_offnav_markup() {
	echo '<div class="off-canvas-wrapper"><div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>';
}

add_action('genesis_after', 'ssm_close_offnav_markup', 5);
/**
 * Add Foundation offcanvas closing markup
 */
function ssm_close_offnav_markup() {
	echo '</div><!-- end .off-canvas-wrap --></div></div>';
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
		'top-bar-navigation' => __( 'Top Bar Navigation' ), 
		'primary-navigation' => __( 'Primary Navigation' ),
	)
);


// Foundation Top Bar Navigation
function ssm_top_bar_navigation() {
	// display the wp3 menu if available
    wp_nav_menu(array(
		'container'	=> false,
    	'menu' => 'Top Bar Navigation',  				// nav name
    	'theme_location' => 'top-bar-navigation',       // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
		'walker'	=> new Foundation_Walker()
	));

}

// the main menu
function ssm_primary_navigation() {
	// display the wp3 menu if available
    wp_nav_menu(array(
		'container'	=> false,
    	'menu' => 'Primary Navigation', 
    	'menu_class'	=> 'genesis-nav-menu', 				// nav name
    	'theme_location' => 'primary-navigation',       // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
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
 

// add_action('genesis_before_header', 'ssm_do_top_bar_navigation');

/*
 * Buld the Navigation with proper wrapping HTML (for foundation)
 *
*/
function ssm_do_top_bar_navigation() { ?>
		
		<?php if ( has_nav_menu('top-bar-navigation') ) { ?>
		
		<div class="show-for-medium fixed">
			<nav class="top-bar" data-topbar>	
				<section class="top-bar-section">
					<?php ssm_top_bar_navigation(); ?>
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
			<nav class="tab-bar">
				<button type="button" class="menu-item" data-open="offCanvasLeft">X</button>
			</nav>
		</div>

		<aside class="off-canvas position-left" id="offCanvas" data-off-canvas>
			<div class="off-canvas-content" data-off-canvas-content>
				<ul class="vertical menu">
					<li><label>Navigation</label></li>
				</ul>
				
				<?php ssm_primary_mobile_navigation(); ?>
			</div>
		</aside>
		
		<?php } // endif has_nav_menu ?>
		
<?php }

function ssm_do_home_page_primary_navigation() { ?>
		
		<?php if ( has_nav_menu('primary-navigation') ) { ?>
		
		<div class="show-for-large">
			<nav class="nav-primary">
				<div class="wrap">	
				<?php ssm_primary_navigation(); ?>
				</div>
			</nav>
		</div>
		
		<?php } // endif has_nav_menu ?>
		
<?php }

function ssm_do_home_page_mobile_primary_navigation() { ?>

	<div class="hide-for-large mobile-menu">
			<nav class="tab-bar">
				<button type="button" class="menu-item" data-open="offCanvasLeft"></button>
			</nav>
		</div>

		<aside class="off-canvas position-left" id="offCanvas" data-off-canvas>
			<div class="off-canvas-content" data-off-canvas-content>
				<ul class="vertical menu">
					<li><label>Navigation</label></li>
				</ul>
				
				<?php ssm_primary_mobile_navigation(); ?>
			</div>
		</aside>

<?php } 
