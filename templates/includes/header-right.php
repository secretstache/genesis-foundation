<?php if ( get_field('header_right_options', 'options') != 'Empty' ) { ?>

<?php $header_right = get_field('header_right_options', 'options'); ?>

<div class="header-right show-for-medium medium-centered large-8 column">

	<?php if  ( $header_right == 'Menu' ) { ?>

	<?php $header_menu = get_field('header_right_menu', 'options'); ?>

	<div class="header-menu align-right">

		<?php wp_nav_menu( array('depth' => 2, 'menu' => $header_menu, 'menu_class'	=> 'dropdown menu', 'items_wrap' => '<ul id="%1$s" class="%2$s" data-dropdown-menu>%3$s</ul>', 'walker'  => new Foundation_Walker()) ); ?>

	</div>
	<!-- end .header-menu -->

	<?php } elseif ( $header_right == 'Search Form' ) { ?>

	<div class="header-search align-right">
	
		<?php get_search_form(); ?>

	</div>
	<!-- end .header-search -->

	<?php } elseif ( $header_right == 'Social Networks' ) { ?>

	<div class="header-social align-right">

		<?php include( CHILD_DIR . '/templates/includes/social-networks.php' ); ?>

	</div>

	<?php } ?>

</div>

<div class="header-right show-for-small-only small-2 column last">
	<button class="menu-icon" type="button" data-toggle="offCanvas"></button>
</div>


<?php } ?>