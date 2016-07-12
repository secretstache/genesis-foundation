<?php 

include( CHILD_DIR . '/templates/includes/additional-classes.php' );

?>

<section <?php echo $html_id != NULL ? 'id="' . $html_id . '"' : ''; ?> class="content-block headline row-<?php echo $cb_i; ?> row-<?php echo $even_odd; ?><?php echo $html_classes != NULL ? ' ' . $html_classes : ''; ?>">

	<div class="wrap">

	<?php if ( get_sub_field('headline') || get_sub_field('subheadline') ) { ?>

	<header class="section-header small-12 column">		

		<?php if ( $headline = get_sub_field('headline') ) { ?>

		<h1 class="section-title"</h1>

		<?php } ?>

		<?php if ( $subheadline = get_sub_field('subheadline') ) { ?>

		<h2 class="section-subtitle"><?php echo $subheadline; ?></h2>

		<?php } ?>

		<?php if ( get_sub_field('include_cta') == 'Yes' && $button_text = get_sub_field('button_text') ) { ?>

		<div class="button-wrapper">

			<?php if ( get_sub_field('button_link') == 'Page' ) { 
				$link = get_sub_field('choose_page');
			} elseif ( get_sub_field('button_link') == 'Absolute URL' ) {
				$link = get_sub_field('url');
			} ?>

			<?php if ( get_sub_field('button_link') == 'Absolute URL' && get_sub_field('link_target') == 'New Tab') {
				$target= ' target="_blank"';
			} else {
				$target = '';
			}; ?>

			<a class="button" href="<?php echo $link; ?>"<?php echo $target; ?>><?php echo $button_text; ?></a>

		</div>
		<!-- end .button-wrapper -->

		<?php } ?> 

	</header>

	<?php } ?>

	</div>
	<!-- end .wrap -->

</section>
<!-- end .headline -->