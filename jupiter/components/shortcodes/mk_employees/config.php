<?php
extract(shortcode_atts(array(
	'count'				=> 10,
	'column'				=> 3,
	'style'				=> 'simple',
	'rounded_image'	=> 'true',
	'box_border_color'=> '',
	'box_bg_color' 	=> '',
	'employees'			=> '',
	'categories'             => '',
	'animation'			=> '',
	'description'		=> 'true',
	'el_class'			=> '',
	'offset'				=> 0,
	'orderby' 			=> 'date',
	'order' 				=> 'DESC',
	'name_color'		=> '',
	'position_color'	=> '',
	'about_color'		=> '',
	'social_color'		=> '',
	'grayscale_image'	=> 'true',
) , $atts));
Mk_Static_Files::addAssets('mk_employees');
