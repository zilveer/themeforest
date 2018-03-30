<?php

extract( shortcode_atts( array(
	'title' 			=> '',
	'count'				=> 10,
	'style' 			=> 'carousel',
	'column' 			=> 3,
	'gutter_space' 		=> 0,
	'bg_color' 			=> '',
	'border_color' 		=> '',
	'border_style' 		=> 'boxed',
	'bg_hover_color' 	=> '',
	'orderby'			=> 'date',
	'target' 			=> '_self',
	'clients' 			=> '',
	'height' 			=> 110,
	'order'				=> 'ASC',
	'margin_bottom' 	=> 20,
	'autoplay' 			=> 'true',
	'cover' 			=> 'false',
	'el_class' 			=> '',
), $atts ) );
Mk_Static_Files::addAssets('mk_clients');