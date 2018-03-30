<?php

extract( shortcode_atts( array(
	'el_class' 								=> '',
	'divider_width' 						=> 'full_width',
    'animation'  							=> '',
	'custom_width' 						=> '10',
	'style' 									=> 'double_dot',
	'align' 									=> 'center',
	'thickness'								=> 1,
	'border_color' 						=> '',
	'thin_color_style' 					=> 'single_color',
	'thin_single_color' 					=> '',
	'thin_grandient_color_from' 		=> '',
	'thin_grandient_color_to' 			=> '',
	'thin_gradient_color_style' 		=> 'linear',
	'thin_gradient_color_angle' 		=> 'vertical',
	'thin_grandient_color_fallback' 	=> '',
	'margin_top' 		=> '20',
	'margin_bottom' 	=> '20',
	'visibility' 	=> '',

), $atts ) );
Mk_Static_Files::addAssets('mk_divider');

