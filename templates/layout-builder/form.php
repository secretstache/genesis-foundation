<?php 

include( CHILD_DIR . '/templates/partials/additional-classes.php' );

?>

<section <?php echo $html_id != NULL ? 'id="' . $html_id . '"' : ''; ?> class="content-block form row-<?php echo $cb_i; ?> row-<?php echo $even_odd; ?><?php echo $html_classes != NULL ? ' ' . $html_classes : ''; ?>">

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

		<?php $business_information = get_sub_field('included_business_information'); ?>

		<?php if ( $business_information ) { ?>

		<div class="business-information small-12 medium-4 column" itemscope itemtype="http://schema.org/LocalBusiness">

			<?php if ( in_array('Business Name', $business_information) ) { ?>

			<p><span itemprop="name"><?php the_field('legal_business_name', 'options'); ?></span></p>

			<?php } ?>

			<?php if ( in_array('Tagline', $business_information) && get_bloginfo('description') ) { ?>

			<p><span itemprop="description"><?php echo get_bloginfo('description'); ?></p>

			<?php } ?>

			<?php if ( in_array('Address', $business_information) ) { ?>

				<?php $address_line_1 = get_field('address_line_1', 'options'); ?>
				<?php $address_line_2 = get_field('address_line_2', 'options'); ?>
				<?php $city = get_field('city', 'options'); ?>
				<?php $state = get_field('state', 'options'); ?>
				<?php $zipcode = get_field('zipcode', 'options'); ?>

				<?php if ( $address_line_1 || $address_line_2 || $city || $state || $zip ) { ?>

				<div class="address" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">

					<?php if ( $address_line_1 ) { ?>

					<p><span itemprop="streetAddress"><?php echo $address_line_1; ?></span></p>

					<?php } ?>

					<?php if ( $address_line_2 ) { ?>

					<p><span itemprop="streetAddress"><?php echo $address_line_2; ?></span></p>

					<?php } ?>

					<?php if ( $city ) { ?>

					<p><span itemprop="addressLocality"><?php echo $city; ?><?php echo $state != NULL ? ',' : ''; ?></span>

					<?php } ?>

					<?php if ( $state ) { ?>

					<span itemprop="addressRegion"><?php echo $state; ?></span>

					<?php } ?>

					<?php if ( $zipcode ) { ?>

					<span itemprop="postalCode"><?php echo ' ' . $zipcode; ?></span></p>

					<?php } ?>

				</div>

				<?php } ?>

				<?php if ( in_array('Phone Number', $business_information) && $phone_number = get_field('phone_number', 'options') ) { ?>

				<p><span itemprop="telephone"><?php echo $phone_number; ?></span></p>

				<?php } ?>

				<?php if ( in_array('Email Address', $business_information) && $default_email = get_field('default_email', 'options') ) { ?>

				<p><a href="mailto:<?php echo $default_email; ?>" itemprop="email"><?php echo $default_email; ?></a></p>

				<?php } ?>

			<?php } ?>
		
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
	<!-- end .wrap -->

</section>
<!-- end .form -->