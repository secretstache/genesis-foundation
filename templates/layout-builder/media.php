<section <?php echo section_id_classes(); ?>>

	<?php $media_size = get_sub_field('media_size'); ?>

	<?php ssm_maybe_add_content_block_header(); ?>

	<?php if ( $media_size == 'Contained' ) { ?>

	<div class="row">

	<?php } ?>

		<div class="small-12 column<?php echo $media_size == 'Full Width' ? ' large-collapse' : 'large-9'; ?>">

			<?php if ( get_sub_field('media_type') == 'Photo' && $image = get_sub_field('image') ) { ?>

			<?php if ( $image_link = get_sub_field('image_link') ) { ?>

			<?php $target = get_sub_field('link_target'); ?>

			<a href="<?php echo $image_link; ?>"<?php echo $target == "New Tab" ? ' target="_blank"' : ''; ?>>

			<?php } ?>
			
			<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" title="<?php echo $image['title']; ?>" />

			<?php if ( $image_link = get_sub_field('image_link') ) { ?>
			
			</a>

			<?php } ?>

			<?php } elseif ( get_sub_field('media_type') == 'Video' && $video = get_sub_field('video') ) { ?>

			<div class="flex-video">

				<?php echo $video; ?>

			</div>
			<!-- end .video -->

			<?php } elseif ( get_sub_field('media_type') == 'Gallery' && $gallery = get_sub_field('gallery') ) { ?>

				<?php if ( get_sub_field( 'layout' ) == 'Slideshow' ) { ?>

				<ul>

					<?php foreach ( $gallery as $image ) { ?>

					<li>

						<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" title="<?php echo $image['title']; ?>" />

						<?php if ( $image['caption'] ) { ?>

						<div class="caption">

							<?php echo $image['caption']; ?>

						</div>

						<?php } ?>

					</li>

					<?php } ?>

				</ul>

				<?php } elseif ( get_sub_field( 'layout' ) == 'Thumbnails with Modal Preview' ) { ?>

				<ul class="clearing-thumbs small-block-grid-2 medium-block-grid-4 large-block-grid-6" data-clearing>

					<?php foreach ( $gallery as $image ) { ?>

					<li>

						<a href="<?php echo $image['url']; ?>">

							<img src="<?php echo $image['sizes']['square-500']; ?>" alt="<?php echo $image['alt']; ?>" title="<?php echo $image['title']; ?>" />
						
						</a>

					</li>

					<?php } // end foreach $image ?>

				</ul>
				<!-- end .clearing-thumbs -->

				<?php } // endif Thumbnails with Modal Preview ?>

			<?php } // endif $gallery ?>

		</div>
		<!-- end .column -->

	<?php if ( get_sub_field('media_size') == 'Contained' ) { ?>

	</div>
	<!-- end .wrap -->

	<?php } ?>

</section>
<!-- end .media -->