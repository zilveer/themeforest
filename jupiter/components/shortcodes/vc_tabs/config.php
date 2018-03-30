<?php
/**
 *  Shortcode defaults and user settings
 * ============================================================== */

extract( shortcode_atts( array(
	'heading_title' 		=> '',
	'style' 				=> 'default',
    'orientation' 			=> 'horizental',
	'title' 				=> '',
	'container_bg_color' 	=> '#fff',
	'tab_location' 			=> 'left',
    'inner_padding'			=> '',
    'responsive' 			=> 'true',
	'el_class' 				=> '',
), $atts ) );

Mk_Static_Files::addAssets('vc_tabs');