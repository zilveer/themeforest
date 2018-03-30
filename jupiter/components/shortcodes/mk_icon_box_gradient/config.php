<?php
/**
 *  Shortcode defaults and user settings
 * ============================================================== */

extract( shortcode_atts( array(
	'icon_type' 				=> '',
	'icon_size'  				=> '16',
	'icon_image' 				=> '',
	'icon'  							=> 'mk-li-smile',
	'holder_shape'  				=> 'circle',
	'color_style' 					=> 'single_color',
	'container_color' 			=> '', 
	'container_hover_color' 	=> '', 
	'grandient_color_from' 		=> '',
	'grandient_color_to' 		=> '',
	'grandient_color_angle' 	=> 'vertical',
	'grandient_color_style' 	=> 'linear',
	'grandient_color_fallback' 	=> '',
	'icon_color' 				=> '',
	'icon_hover_color' 			=> '',
	'title' 					=> '',
	'title_size' 				=> '20',
	'title_weight' 				=> 'inherit',
	'title_color' 				=> '',
	'title_top_padding' 		=> '10',
	'title_bottom_padding' 		=> '10',
	'content_color'		 		=> '',
	'align' 					=> 'center',
	'read_more_url' 			=> '',
	'animation' 				=> '',	
	'el_class' 					=> '',
), $atts ) );
Mk_Static_Files::addAssets('mk_icon_box_gradient');