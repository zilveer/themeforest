<?php

extract( shortcode_atts( array(
	"title" 			=> '',
	"images" 			=> '',
	"size" 				=> 'full',
	"animation_speed" 	=> 700,
	"slideshow_speed" 	=> 7000,
	"pause_on_hover" 	=> "false",
	"el_class" 			=> '',
	'animation' 		=> '',
), $atts ) );
Mk_Static_Files::addAssets('mk_laptop_slideshow');