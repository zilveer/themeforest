<?php
extract( shortcode_atts( array(
	'el_class' 		=> '',
	'title' 		=> '',
	'button_text' 	=> '',
	'visibility' 	=> '',
	'button_url' 	=> '',
), $atts ) );
Mk_Static_Files::addAssets('mk_mini_callout');