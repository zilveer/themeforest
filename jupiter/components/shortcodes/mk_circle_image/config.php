<?php
extract( shortcode_atts( array(
	'heading_title' 		=> '',
	'image_diameter' 	=> 500,
	'image_height' 	=> 350,
	'src' 			=> '',
	'animation' 		=> '',
	'link' 			=> '',
	'visibility' 		=> '',
	'el_class' 		=> '',
), $atts ) );
Mk_Static_Files::addAssets('mk_circle_image');