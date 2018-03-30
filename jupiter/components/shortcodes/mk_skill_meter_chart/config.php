<?php
extract( shortcode_atts( array(
	'percent_1' 			=> false,
	'name_1' 				=> false,
	'color_1' 				=> '#e74c3c',
	'percent_2' 			=> false,
	'name_2' 				=> false,
	'color_2' 				=> '#8c6645',
	'percent_3' 			=> false,
	'name_3' 				=> false,
	'color_3' 				=> '#265573',
	'percent_4' 			=> false,
	'name_4' 				=> false,
	'color_4' 				=> '#008b83',
	'percent_5' 			=> false,
	'color_5' 				=> '#d96b52',
	'name_5' 				=> false,
	'percent_6' 			=> false,
	'name_6' 				=> false,
	'color_6' 				=> '#82bf56',
	'percent_7' 			=> false,
	'name_7' 				=> false,
	'color_7' 				=> '#4ecdc4',
	'center_color' 			=> '#1e3641',
	'default_text' 			=> 'Skills',
	'default_text_color' 	=> '#fff',
	'animation' 			=> '',
	'el_class' 				=> '',
), $atts ) );

wp_print_scripts( 'jquery-raphael' );
Mk_Static_Files::addAssets('mk_skill_meter_chart');
