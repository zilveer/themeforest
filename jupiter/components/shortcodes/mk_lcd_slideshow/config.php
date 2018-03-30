<?php
extract( shortcode_atts( array(
	'title' 			=> '',
	"images" 		=> '',
	"animation_speed" 	=> 700,
	"slideshow_speed" 	=> 7000,
	"pause_on_hover" 	=> "false",
	'animation' 		=> '',
	"el_class" 		=> '',
), $atts ) );
Mk_Static_Files::addAssets('mk_lcd_slideshow');