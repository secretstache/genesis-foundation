<?php if ( get_field('content', 'options') || get_field('footer_menu', 'options') ) { ?>

	<div class="small-12 medium-6 column">

		<?php if ( $content = get_field('content', 'options') ) { ?>

		<div class="copyright">

			<?php echo $content; ?>

		</div>
		<!-- end .copyright -->

		<?php } // endif $content ?>

		<?php if ( $footer_menu = get_field('footer_menu', 'options') ) { ?>

		<div class="footer-menu">

			<?php wp_nav_menu( array('depth' => 1, 'menu' => $footer_menu) ); ?>

		</div>
		<!-- end .footer-menu -->

		<?php } // endif $footer_menu ?>

	</div>
	<!-- end .column -->

<?php } // endif $content or $footer_menu ?>

<?php if ( $social_networks = get_field('include_social_networks', 'option') == 'Yes' ) { ?>

<div class="social small-12 medium-6 column">

	<?php include( CHILD_DIR . '/templates/includes/social-networks.php' ); ?>

</div>
<!-- end .social -->

<?php } // endif $social_networks ?>