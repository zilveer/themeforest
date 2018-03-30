<?php
extract( shortcode_atts( array(
	'style' 			=> 'simple-style',
	'size' 				=> 34,
	'padding' 			=> 10,
	'background_color' 	=> '',
	'text_color' 		=> '',
	'el_class' 			=> '',
), $atts ) );
Mk_Static_Files::addAssets('mk_dropcaps');