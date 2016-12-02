<?php

$html_id = get_sub_field('html_id');
$html_classes = sanitize_html_classes(get_sub_field('html_classes'));

if ( get_sub_field('background_options') == 'Photo' && $image = get_sub_field('image') ) { 

	$css = 'style="background: url(' . $image['url'] . ') no-repeat; background-position: center center";';

} elseif ( get_sub_field('background_options') == 'Solid Color' && $color = get_sub_field('solid_color') ) {

  $css = 'style="background: ' . $color . '";';

}

?>


<div<?php echo wrapper_id_classes(); ?><?php echo $css != NULL ? $css : ''; ?>>

<?php if ( get_sub_field('video') ) { ?>

<?php $video = get_sub_field('video'); ?>

	<video autoplay class="bg-video" loop>

		<source src="<?php echo $video['url']; ?>" type="video/mp4">

	</video>

<?php } ?>

