<?php

global $cb_i;

$html_id 		= get_sub_field('html_id');
$html_classes 	= sanitize_html_classes(get_sub_field('class_options'));
$even_odd 		= 0 == $cb_i % 2 ? 'even' : 'odd';