<section <?php echo section_id_classes(); ?>>

	<div class="row">

		<?php ssm_maybe_add_content_block_header(); ?>

		<?php $business_information = get_sub_field('included_business_information'); ?>

		<?php if ( $business_information ) { ?>

		<div class="business-information small-12 medium-4 column" itemscope itemtype="http://schema.org/LocalBusiness">

			<?php ssm_do_business_information(); ?>
		
		</div>
		<!-- end .business-information -->

		<?php } ?>

		<?php if ( $form = get_sub_field('form') ) { ?>

		<div class="form<?php echo $business_information != NULL ? ' small-12 medium-8 column' : ' small-12 large-9 large-centered column'; ?>">

		<?php gravity_form_enqueue_scripts($form->id, true); ?>
		<?php gravity_form($form->id, false, false, false, '', true, 1); ?>

		</div>
    	<!-- end .form -->

		<?php } ?>

	</div>
	<!-- end .row -->

</section>
<!-- end .form -->