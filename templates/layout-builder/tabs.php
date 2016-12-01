<section <?php echo section_id_classes(); ?>>

	<?php ssm_maybe_add_content_block_header(); ?>

	<?php if ( $tabs = get_sub_field('tab_list') ) { ?>

	<?php $t_i = 1; ?>
	<?php $c_i = 1; ?>

	<?php global $cb_i; ?>

	<div class="row align-center">

		<div class="small-12 large-9 column">

			<ul class="tabs" data-tabs id="tab-set-<?php echo $cb_i; ?>">

				<?php foreach ( $tabs as $item ) { ?>

				<?php $id = sanitize_title_with_dashes($item['headline']); ?>

				<li class="tabs-title<?php echo $t_i == 1 ? ' is-active' : ''; ?>">

					<a href="#<?php echo $id; ?>"><?php echo $item['headline']; ?></a>

				</li>

				<?php $t_i++; ?>

				<?php } ?> 

			</ul>
			<!-- end .accordion -->

			<div class="tabs-content" data-tabs-content="tab-set-<?php echo $cb_i; ?>">

				<?php foreach ( $tabs as $item ) { ?>

				<?php $id = sanitize_title_with_dashes($item['headline']); ?>

				<div id="<?php echo $id; ?>" class="tabs-panel<?php echo $c_i == 1 ? ' is-active' : ''; ?>">

					<?php echo $item['content']; ?>

				</div>
				<!-- end .content -->

				<?php $c_i++; ?>

				<?php } ?>

			</div>
			<!--end .tabs-content -->

		</div>

	</div>
	<!-- end .row -->

	<?php } ?>

</section>
<!-- end .tabs -->