<?php 

include( CHILD_DIR . '/templates/includes/additional-classes.php' );

?>

<section <?php echo $html_id != NULL ? 'id="' . $html_id . '"' : ''; ?> class="content-block accordion row-<?php echo $cb_i; ?> row-<?php echo $even_odd; ?><?php echo $html_classes != NULL ? ' ' . $html_classes : ''; ?>">

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

	<?php if ( $accordion = get_sub_field('accordion_list') ) { ?>

	<?php $i = 1; ?>

	<ul class="accordion small-12 column<?php echo $accordion_list_animation != NULL ? ' wow ' . $accordion_list_animation : ''; ?>" data-accordion>

		<?php foreach ( $accordion as $item ) { ?>

		<?php $id = sanitize_title_with_dashes($item['headline']); ?>

		<li class="accordion-navigation">

			<a href="#<?php echo $id; ?>"><?php echo $item['headline']; ?></a>

			<div id="<?php echo $id; ?>" class="content<?php echo $i == 1 ? ' active' : ''; ?>">

			<?php echo $item['content']; ?>

			</div>
			<!-- end .content -->

		</li>

		<?php $i++; ?>

		<?php } ?> 

	</ul>
	<!-- end .accordion -->

	<?php } ?>

	</div>
	<!-- end .wrap -->

</section>
<!-- end .accordion -->