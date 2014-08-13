<div class="admin-widget-class"> <?php // (ie ssm-resources) ?>
	
	<label>Title:</label>
	
	<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />

	<p>This widget requires no other options.  It is controlled from the page editor.  A list of <?php // (ie Resources) ?> will be appended to the sidebar if activated, otherwise it will be ignored.</p>

</div>