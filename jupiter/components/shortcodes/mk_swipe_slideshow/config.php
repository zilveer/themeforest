<?php

extract( shortcode_atts( array(
	"images" 			=> '',
	"image_size" 		=> 'crop',
	"image_width" 		=> 770,
	"image_height" 		=> 350,
	"animation_speed" 	=> 700,
	"slideshow_speed" 	=> 7000,
	"direction" 		=> 'horizontal',
	"direction_nav" 	=> "true",
	"el_class" 			=> ''
), $atts ) );
Mk_Static_Files::addAssets('mk_swipe_slideshow');