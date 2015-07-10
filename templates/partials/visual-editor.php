<?php 

include( CHILD_DIR . '/templates/includes/additional-classes.php' );

?>



<section <?php echo $html_id != NULL ? 'id="' . $html_id . '"' : ''; ?> class="content-block visual-editor row-<?php echo $cb_i; ?> row-<?php echo $even_odd; ?><?php echo $html_classes != NULL ? ' ' . $html_classes : ''; ?>">

	<div class="wrap">

		<?php if ( get_sub_field('headline') || get_sub_field('subheadline') ) { ?>

		<header class="section-header small-12 column">		

			<?php if ( $headline = get_sub_field('headline') ) { ?>

			<h1 class="section-title<?php echo $headline_animation != NULL ? ' wow ' . $headline_animation : ''; ?>"><?php echo $headline; ?></h1>

			<?php } ?>

			<?php if ( $subheadline = get_sub_field('subheadline') ) { ?>

			<h2 class="section-subtitle<?php echo $subheadline_animation != NULL ? ' wow ' . $subheadline_animation : ''; ?>"><?php echo $subheadline; ?></h2>

			<?php } ?>

		</header>

		<?php } ?>

		<?php if ( $wysiwyg = get_sub_field('visual_editor') ) { ?>

		<div class="section-entry small-12 column<?php echo $visual_editor_animation != NULL ? ' wow ' . $visual_editor_animation : ''; ?>">

			<?php echo $wysiwyg; ?>

		</div>
		<!-- end .section-entry -->

		<?php } ?>

	</div>
	<!-- end .wrap -->

</section>
<!-- end .visual-editor -->