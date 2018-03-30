<?php
extract( shortcode_atts( array(
	'el_class' 		=> '',
	'title' 		=> '',
	'style' 		=> 'style1',
	'visibility' 	=> '',
), $atts ) );
Mk_Static_Files::addAssets('mk_table');