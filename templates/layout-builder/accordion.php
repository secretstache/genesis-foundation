<section <?php echo section_id_classes(); ?>>

	<?php ssm_maybe_add_content_block_header(); ?>

	<div class="row align-center">

	<?php if ( $accordion = get_sub_field('accordion_list') ) { ?>

	<?php $i = 1; ?>

	<ul class="accordion small-12 large-9 column" data-accordion>

		<?php foreach ( $accordion as $item ) { ?>

		<?php $id = sanitize_title_with_dashes($item['headline']); ?>

		<li class="accordion-item<?php echo $i == 1 ? ' is-active' : ''; ?>" data-accordion-item>

			<a href="#<?php echo $id; ?>"><?php echo $item['headline']; ?></a>

			<div id="<?php echo $id; ?>" class="accordion-content" data-tab-content>

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
	<!-- end .row -->

</section>
<!-- end .accordion -->