<?php
extract( shortcode_atts( array(
	'desc' 				=> '',
	'desc_text_size' 		=> 15,
	'desc_color' 			=> '#444',
	'percent' 			=> 50,
	'bar_color' 			=> $mk_options['skin_color'],
	'track_color' 			=> '#ececec',
	'line_width' 			=> 10,
	'bar_size' 			=> 150,
	'content' 			=> '',
	'content_type' 			=> 'percent',
	'icon' 				=> '',
	'custom_text' 			=> '',
	'custom_text_size'		=> '15',
	'percentage_text_size' 	=> '15',
	'percentage_color' 		=> '#444',
	'el_class' 			=> '',
	'icon_size' 			=> '32',
	'icon_color' 			=> '#444',
	'visibility' 			=> '',
	'animation' 			=> '',
), $atts ) );
Mk_Static_Files::addAssets('mk_chart');