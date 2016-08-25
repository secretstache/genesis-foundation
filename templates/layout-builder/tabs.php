<?php 

include( CHILD_DIR . '/templates/partials/additional-classes.php' );

?>

<section <?php echo $html_id != NULL ? 'id="' . $html_id . '"' : ''; ?> class="content-block tabs row-<?php echo $cb_i; ?> row-<?php echo $even_odd; ?><?php echo $html_classes != NULL ? ' ' . $html_classes : ''; ?>">

	<div class="wrap">

		<?php ssm_maybe_add_content_block_header(); ?>
	
		<?php if ( $tabs = get_sub_field('tab_list') ) { ?>

		<?php $t_i = 1; ?>
		<?php $c_i = 1; ?>

		<div class="small-12 column">

			<ul class="tabs" data-tab>

				<?php foreach ( $tabs as $item ) { ?>

				<?php $id = sanitize_title_with_dashes($item['headline']); ?>

				<li class="tab-title<?php echo $t_i == 1 ? ' active' : ''; ?>">

					<a href="#<?php echo $id; ?>"><?php echo $item['headline']; ?></a>

				</li>

				<?php $t_i++; ?>

				<?php } ?> 

			</ul>
			<!-- end .accordion -->

			<div class="tabs-content">

				<?php foreach ( $tabs as $item ) { ?>

				<?php $id = sanitize_title_with_dashes($item['headline']); ?>

				<div id="<?php echo $id; ?>" class="content<?php echo $c_i == 1 ? ' active' : ''; ?>">

					<?php echo $item['content']; ?>

				</div>
				<!-- end .content -->

				<?php $c_i++; ?>

				<?php } ?>

			</div>
			<!--end .tabs-content -->

		</div>
		<!-- end .column -->

		<?php } ?>

	</div>
	<!-- end .wrap -->

</section>
<!-- end .tabs -->