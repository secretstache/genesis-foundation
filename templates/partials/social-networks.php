<ul class="social-networks">

	<?php if ( $facebook = get_field('facebook', 'options') ) { ?>

		<li class="facebook">
			<a href="<?php echo $facebook; ?>" target="_blank"><i class="fi-social-facebook"></i></a>
		</li>

	<?php } // end $facebook ?>

	<?php if ( $twitter = get_field('twitter', 'options') ) { ?>

		<li class="twitter">
			<a href="<?php echo $facebook; ?>" target="_blank"><i class="fi-social-twitter"></i></a>
		</li>

	<?php } // end $twitter ?>

	<?php if ( $instagram = get_field('instagram', 'options') ) { ?>

		<li class="instagram">
			<a href="<?php echo $instagram; ?>" target="_blank"><i class="fi-social-instagram"></i></a>
		</li>

	<?php } // end $instagram ?>

	<?php if ( $linkedin = get_field('linkedin', 'options') ) { ?>

		<li class="linkedin">
			<a href="<?php echo $linkedin; ?>" target="_blank"><i class="fi-social-linkedin"></i></a>
		</li>

	<?php } // end $linkedin ?>

	<?php if ( $google_plus = get_field('google_plus', 'options') ) { ?>

		<li class="google-plus">
			<a href="<?php echo $google_plus; ?>" target="_blank"><i class="fi-social-google-plus"></i></a>
		</li>

	<?php } // end $google_plus ?>

	<?php if ( $youtube = get_field('youtube', 'options') ) { ?>

		<li class="youtube">
			<a href="<?php echo $youtube; ?>" target="_blank"><i class="fi-social-youtube"></i></a>
		</li>

	<?php } // end $youtube ?>

	<?php if ( $vimeo = get_field('vimeo', 'options') ) { ?>

		<li class="vimeo">
			<a href="<?php echo $vimeo; ?>" target="_blank"><i class="fi-social-vimeo"></i></a>
		</li>

	<?php } // end $youtube ?>

	</ul>
	<!-- end .social-networks -->