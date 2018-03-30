<?php
extract( shortcode_atts( array(
	'slides' 			=> '',
	'height' 		=> 200,
	'padding' 		=> 30,
	'animation_style' 	=> 'fade',
	'orderby'		=> 'date',
	'order'			=> 'DESC',
	'autoplay' 		=> 'true',
	'slideshow_speed' 	=> 5000,
	'animation_duration' 	=> 600,
	"el_class" 		=> '',
), $atts ) );
Mk_Static_Files::addAssets('mk_banner_builder');