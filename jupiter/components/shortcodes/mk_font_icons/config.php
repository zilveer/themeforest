<?php
/**
 *  Shortcode defaults and user settings
 * ============================================================== */

extract( shortcode_atts( array(
	'size' 							=> 'small',
	'icon'							=> '',
	'margin_horizental' 			=> 4,
	'margin_vertical' 			=> 4,
	'color_style' 					=> 'single_color',
	'color' 							=> '',
	'grandient_color_from' 		=> '',
	'grandient_color_to' 		=> '',
	'grandient_color_angle' 	=> 'vertical',
	'grandient_color_style' 	=> 'linear',
	'grandient_color_fallback' => '',
	'circle' 						=> 'false',
	'circle_color' 				=> '',
	'circle_border_color' 		=> '',
	'circle_border_style' 		=> 'solid',
	'circle_border_width' 		=> '1',
	'align' 							=> 'none',
	'animation' 					=> '',	
	'smooth_scroll' 				=> 'false',
	'link' 							=> '',
	'target' 						=> '_self',
	'el_class' 						=> '',
), $atts ) );
Mk_Static_Files::addAssets('mk_font_icons');