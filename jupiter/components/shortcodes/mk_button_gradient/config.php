<?php
/**
 *  Shortcode defaults and user settings
 * ============================================================== */

extract( shortcode_atts( array(
	'dimension' 				=> 'two',
	'id_second' 				=> '',
	'size' 						=> 'small',
	'corner_style' 				=> 'pointed',
	'grandient_color_from' 		=> '',
	'grandient_color_to' 		=> '',
	'grandient_color_angle' 	=> 'vertical',
	'grandient_color_style' 	=> 'linear',
	'grandient_color_fallback' => '',
	'text_color' 					=> 'light',
	'icon' 						=> '',
	'icon_anim' 				=> '',
	'url' 						=> '',
	'target' 					=> '_self',
	'align' 					=> 'left',
	'fullwidth' 				=> 'false',
	'button_custom_width' 		=> 0,
	'margin_top' 				=> 0,		
	'margin_bottom' 			=> 15,
	'margin_right'				=> 15,
	'visibility' 				=> '',
	'animation' 				=> '',
	'el_class' 					=> ''
), $atts ) );
Mk_Static_Files::addAssets('mk_button_gradient');
Mk_Static_Files::addAssets('mk_button');