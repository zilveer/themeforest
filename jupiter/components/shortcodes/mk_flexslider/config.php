<?php
extract( shortcode_atts( array(
	'title' 				=> '',
	'count'				=> 10,
	'orderby'			=> 'date',
	'slides' 				=> '',
	'order'				=> 'DESC',
	"image_width" 			=> 770,
	"image_height" 		=> 350,
	"effect" 			=> 'fade',
	"animation_speed" 		=> 700,
	"slideshow_speed" 		=> 7000,
	"pause_on_hover" 		=> "false",
	"smooth_height" 		=> "true",
	"direction_nav" 		=> "true",
	"caption_bg_color" 		=> "",
	"caption_color" 		=> "#fff",
	"caption_bg_opacity" 		=> 0.8,
	"el_class" 			=> '',
), $atts ) );
Mk_Static_Files::addAssets('mk_flexslider');