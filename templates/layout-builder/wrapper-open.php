<?php

$html_id = get_sub_field('html_id');
$html_classes = sanitize_html_classes(get_sub_field('html_classes'));

if ( get_sub_field('background_options') == 'Photo' && get_sub_field('image') ) { 

	$image = get_sub_field('image');
	$css = 'style="background: url(' . $image['url'] . ') no-repeat;"';

} elseif ( get_sub_field('background_options') == 'Repeatable Pattern' && get_sub_field('pattern') ) {

	$image = get_sub_field('pattern');
	$css = 'style="background: url(' . $image['url'] . ') repeat;"';

} ?>


<div<?php echo $wrapper_id_classes; ?>><?php echo $css = $image =! null ? ' ' . $css : ''; ?>>

<?php if ( get_sub_field('video') ) { ?>

<?php $video = get_sub_field('video'); ?>

	<video autoplay class="bg-video" loop>

		<source src="<?php echo $video['url']; ?>" type="video/mp4">

	</video>

<?php } ?>
