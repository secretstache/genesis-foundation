<section <?php echo section_id_classes(); ?>>

	<div class="row">

	<?php if ( get_sub_field('headline') || get_sub_field('subheadline') ) { ?>

	<div class="small-10 column">

		<header class="section-header">		

			<?php if ( $headline = get_sub_field('headline') ) { ?>

			<h1 class="section-title"><?php echo $headline; ?></h1>

			<?php } ?>

			<?php if ( $subheadline = get_sub_field('subheadline') ) { ?>

			<h2 class="section-subtitle"><?php echo $subheadline; ?></h2>

			<?php } ?>

			<?php if ( get_sub_field('include_cta') == 'Yes' ) { ?>

			<div class="button-wrapper">

				<?php $button_text = get_sub_field('button_text'); ?>
				<?php $url = get_sub_field('url'); ?>

				<a class="button" href="<?php echo $button_url; ?>"><?php echo $button_text; ?></a>

			</div>
			<!-- end .button-wrapper -->

			<?php } ?> 

		</header>

	</div>

	<?php } ?>

	</div>
	<!-- end .row -->

</section>
<!-- end .headline -->