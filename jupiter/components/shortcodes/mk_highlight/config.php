<?php

extract( shortcode_atts( array(
	'text' 			=> '',
	'bg_color' 		=> '',
	'text_color' 	=> '',
	'el_class' 		=> '',
), $atts ) );
Mk_Static_Files::addAssets('mk_highlight');