<?php $id = get_the_id(); ?>

<?php if ( get_field( 'include_CHANGEME_in_the_sidebar', $id ) == 'Yes' ) { // Replace include_CHANGEME_in_the_sidebar with the ACF id ?>

	<?php if ( ! empty( $instance['title'] ) ) { 
		echo $before_title . apply_filters( 'widget_title', $instance['title'], $instance, 'widget-id' )  . $after_title; 
	} ?>
	
	<ul class="CHANGEME"> <?php // Remember to update CHANGEME ?>
	
		<?php // include ACF Specific functionality here ?>
	
	</ul>

<?php } // endif include_CHANGEME_in_the_sidebar ?>