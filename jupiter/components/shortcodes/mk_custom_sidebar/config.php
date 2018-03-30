<?php
extract( shortcode_atts( array(
	'el_class' 	=> '',
	'sidebar' 	=> '',
), $atts ) );
Mk_Static_Files::addAssets('mk_custom_sidebar');
