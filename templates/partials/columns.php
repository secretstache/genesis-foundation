<?php 

include( CHILD_DIR . '/templates/includes/additional-classes.php' );

$column_count = count(get_sub_field('column_list'));

?>

<section <?php echo $html_id != NULL ? 'id="' . $html_id . '"' : ''; ?> class="content-block cols has-<?php echo $column_count; ?>-cols row-<?php echo $cb_i; ?> row-<?php echo $even_odd; ?><?php echo $html_classes != NULL ? ' ' . $html_classes : ''; ?>">

	<div class="wrap">

		<?php if ( get_sub_field('headline') || get_sub_field('subheadline') ) { ?>

		<header class="section-header small-12 column">		

			<?php if ( $headline = get_sub_field('headline') ) { ?>

			<h1 class="section-title"><?php echo $headline; ?></h1>

			<?php } ?>

			<?php if ( $subheadline = get_sub_field('subheadline') ) { ?>

			<h2 class="section-subtitle"><?php echo $subheadline; ?></h2>

			<?php } ?>

		</header>

		<?php } ?>

		<?php if ( $columns = get_sub_field('column_list') ) { ?>

			<?php 
				if ( $column_count == 2 ) { 
					$column_classes = 'small-12 medium-6 column';
				} elseif ( $column_count == 3 ) {
					$column_classes = 'small-12 medium-4 column';
				} elseif ( $column_count == 4 ) {
					$column_classes = 'small-12 medium-3 column';
				}
			?>

			<?php $i = 1; ?>

			<div class="section-entry row">

				<?php foreach ( $columns as $column ) { ?>

				<?php $column_type = sanitize_html_classes(sanitize_title_with_dashes($column['content_type'])); ?>

				<div class="<?php echo $column_type; ?> col-<?php echo $i; ?> <?php echo sanitize_html_classes($column_classes); ?>">

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
			<!-- end .section-entry -->

		<?php } ?>

	</div>
	<!-- end .wrap -->

</section>
<!-- end .columns -->