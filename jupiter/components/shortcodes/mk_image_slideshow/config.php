<?php
extract( shortcode_atts( array(
	'title' 			=> '',
	"images" 			=> '',
	"image_width" 		=> 770,
	"image_height" 		=> 350,
	"margin_top" 		=> 0,
	"margin_bottom" 		=> 0,
	"effect" 			=> 'fade',
	"animation_speed" 	=> 700,
	"slideshow_speed" 	=> 7000,
	"pause_on_hover" 	=> "false",
	"smooth_height" 	=> "true",
	"direction_nav" 	=> "true",
	"el_class" 			=> '',
), $atts ) );
Mk_Static_Files::addAssets('mk_swipe_slideshow');
Mk_Static_Files::addAssets('mk_image_slideshow');