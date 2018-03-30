<?php
/**
 *  Shortcode defaults and user settings
 * ============================================================== */

extract( shortcode_atts( array(
	'src_first' 		=> '',
	'src_second'  		=> '',
	'hover_animation'	=> 'without-fading',
	'image_width' 		=> '800',
	'image_height' 		=> '350',
	'crop' 				=> 'true',
	'svg' 				=> 'false',
	'align' 			=> 'left',
	'margin_bottom' 	=> '10',
	'link'				=> '',
	'animation' 		=> '',
	'el_class' 			=> '',
), $atts ) );
Mk_Static_Files::addAssets('mk_image_switch');