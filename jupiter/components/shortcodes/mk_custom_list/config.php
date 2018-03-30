<?php
global $mk_options;
extract( shortcode_atts( array(
	'el_class' 		=> '',
	'title' 		=> '',
	'style' 		=> 'f00c',
	'icon_color'	=> $mk_options['skin_color'],
	'animation' 	=> '',
	'align' 		=> 'none',
	'margin_bottom' => 30,
), $atts ) );
Mk_Static_Files::addAssets('mk_custom_list');