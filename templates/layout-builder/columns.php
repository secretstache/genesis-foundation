<?php 

$column_count = count(get_sub_field('column_list'));

?>

<section <?php echo section_id_classes(); ?>>

		<?php ssm_maybe_add_content_block_header(); ?>

		<?php if ( $columns = get_sub_field('column_list') ) { ?>

			<?php $i = 1; ?>

			<div class="row">

				<?php foreach ( $columns as $column ) { ?>

				<?php $column_type = sanitize_html_classes(sanitize_title_with_dashes($column['content_type'])); ?>

				<div class="small-12 medium-expand <?php echo $column_type; ?> col-<?php echo $i; ?> <?php echo sanitize_html_classes($column_classes); ?>">

					<?php if ( ( $column['content_type'] == 'Visual Editor') && $icon = $column['icon'] )  { ?>
					
					<img class="icon-image centered" src="<?php echo $icon['sizes']['icon']; ?>" alt="<?php echo $icon['alt']; ?>" title="<?php echo $icon['title']; ?>" />

					<?php } ?>

					<?php if ( $column['column_title'] ) { ?>

					<h2 class="col-title"><?php echo $column['column_title']; ?></h2>

					<?php } ?>

					<?php if ( ( $column['content_type'] == 'Visual Editor') && $column['visual_editor'] )  { ?>

					<?php echo $column['visual_editor']; ?>

					<?php } elseif ( $column['content_type'] == 'Image' && $image = $column['image'] ) { ?>

					<?php if ( $column['image_link'] ) { ?>

					<a href="<?php echo $column['image_link']; ?>"<?php echo $column['link_target'] == 'New Tab' ? ' target="_blank"' : ''; ?>>

					<?php } ?>

						<img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" title="<?php echo $image['title']; ?>" />

					<?php if ( $column['image_link'] ) { ?>

					</a>

					<?php } ?>

					<?php } elseif ( $column['content_type'] == 'Video' && $video = $column['video'] ) { ?>

					<div class="flex-video">

						<?php echo $video; ?>

					</div>

					<?php } ?>

				</div>

				<?php $i++; ?>

				<?php } // end foreach $columns ?>

			</div>
			<!-- end .row -->

		<?php } ?>

	</div>
	<!-- end .wrap -->

</section>
<!-- end .columns -->