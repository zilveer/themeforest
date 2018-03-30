<?php
extract( shortcode_atts( array(
	'images' 			=> '',
	'background_cover' => 'true',
	'bg_repeat' => 'repeat',
	'bg_position' 		=> 'center center',
	'slideshow_speed' 	=> '3000',
	'transition_speed' 	=> '1000',
	'overlay' 			=> '',
	'slideshow_mask'	=> 'false',
	'section_height' 	=> '400',
	'full_width_cnt' 	=> 'false',
	'full_height' 		=> 'false',
	'padding_top' 		=> '10',
	'padding_bottom' 	=> '10',
	'el_class' 			=> '',
), $atts ) );
Mk_Static_Files::addAssets('mk_slideshow_box');
