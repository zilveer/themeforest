<?php
global $mk_options;
extract( shortcode_atts( array(
	'title' 		=> '',
	'step' 			=> 4,
	'hover_color' 	=> $mk_options['skin_color'],
	'icon_1' 		=> '',
	'title_1' 		=> '',
	'desc_1' 		=> '',
	'url_1' 		=> '',

	'icon_2' 		=> '',
	'title_2' 		=> '',
	'desc_2' 		=> '',
	'url_2' 		=> '',

	'icon_3' 		=> '',
	'title_3' 		=> '',
	'desc_3' 		=> '',
	'url_3'		 	=> '',

	'icon_4' 		=> '',
	'title_4' 		=> '',
	'desc_4' 		=> '',
	'url_4' 		=> '',

	'icon_5' 		=> '',
	'title_5' 		=> '',
	'desc_5' 		=> '',
	'url_5' 		=> '',

	'el_class' 		=> '',
	'animation' 	=> '',
), $atts ) );
Mk_Static_Files::addAssets('mk_steps');