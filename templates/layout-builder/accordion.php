<?php 

include( CHILD_DIR . '/templates/partials/additional-classes.php' );

?>

<section <?php echo $html_id != NULL ? 'id="' . $html_id . '"' : ''; ?> class="content-block accordion row-<?php echo $cb_i; ?> row-<?php echo $even_odd; ?><?php echo $html_classes != NULL ? ' ' . $html_classes : ''; ?>">

	<div class="wrap">

	<?php ssm_maybe_add_content_block_header(); ?>

	<?php if ( $accordion = get_sub_field('accordion_list') ) { ?>

	<?php $i = 1; ?>

	<ul class="accordion small-12 column" data-accordion>

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