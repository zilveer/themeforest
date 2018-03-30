<?php
/**
 *  Shortcode defaults and user settings
 * ============================================================== */

extract( shortcode_atts( array(
	'el_class' 									=> '',
	'border_color_style'						=> 'none',
	'border_color' 							=> '',
	'border_style' 							=> 'solid',
	'border_width' 							=> 1,
	'border_grandient_color_from' 		=> '',
	'border_grandient_color_to' 			=> '',
	'border_gradient_color_style' 		=> 'linear',
	'border_gradient_color_angle' 		=> 'vertical',
	'border_grandient_color_fallback'	=> '',

	'background_style'						=> 'image',
	'bg_color' 									=> '',
	'bg_grandient_color_from' 				=> 'rgba(0, 0, 0, 0)',
	'bg_grandient_color_to'					=> 'rgba(0, 0, 0, 0)',
	'bg_gradient_color_style'				=> 'linear',
	'bg_gradient_color_angle'				=> 'vertical',
	'bg_grandient_color_fallback'			=> '',
	'bg_image' 									=> '',
	'bg_position' 								=> 'center center',
	'bg_repeat' 								=> 'no-repeat',
	'bg_stretch'								=> 'false',
	'overlay_color'							=> '',

	'background_hov_color_style' 	 		=> 'image',
	'bg_hov_color' 	 						=> '',
	'bg_grandient_hov_color_from' 	 	=> '',
	'bg_grandient_hov_color_to' 	 		=> '',
	'bg_gradient_hov_color_style' 	 	=> 'linear',
	'bg_gradient_hov_color_angle' 	 	=> 'vertical',
	'bg_grandient_hov_color_fallback' 	=> '',
	'bg_image_hov_effect' 	 				=> 'none',

	'corner_radius'							=> 0,
	'padding_horizental' 					=> '20',
	'padding_vertical' 						=> '30',
	'min_height' 								=> '100',
	'margin_bottom' 							=> '10',
	'visibility' 								=> '',
	'animation' 								=> '',
), $atts ) );
Mk_Static_Files::addAssets('mk_custom_box');