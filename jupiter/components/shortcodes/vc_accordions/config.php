<?php

extract( shortcode_atts( array(
	'title' 				=> '',
	'heading_title' 		=> '',
	'interval' 				=> 0,
	'style' 				=> 'fancy-style',
	'container_bg_color' 	=> '#fff',
	'el_position' 			=> '',
	'open_toggle' 			=> 0,
	'responsive' 			=> 'true',
	'action_style' 			=> 'accordion-style',
	'el_class' 				=> ''
), $atts ) );


$container_bg_color = !empty($container_bg_color) ? ('background-color:'.$container_bg_color.';') : '';
Mk_Static_Files::addAssets('vc_accordions');