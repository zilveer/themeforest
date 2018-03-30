<?php
global $mk_options;
extract( shortcode_atts( array(
	"icon" 			=> '',
	"icon_size" 	=> 'small',
	"align" 			=> 'left',
	'text_size' 	=> '',
	'desc_size' 	=> 14,
	'font_weight' 	=> '',
	"icon_color" 	=> $mk_options['skin_color'],
	"start" 			=> 0,
	"stop" 			=> 100,
	"speed" 			=> 2000,
	"prefix" 		=> '',
	"suffix" 		=> '',
	"text" 			=> '',
	"link" 			=> '',
	"text_color" 	=> '',
	'visibility' 	=> '',
	"font_family" 	=> '',
	"font_type" 	=> '',
	'el_class' 		=> '',
), $atts ) );
Mk_Static_Files::addAssets('mk_milestone');
