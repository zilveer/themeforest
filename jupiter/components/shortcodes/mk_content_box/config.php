<?php
	extract( shortcode_atts( array(
		'el_class' 		=> '',
		'heading' 		=> '',
		'icon' 			=> '',
		'visibility' 	=> '',
		'animation' 	=> '',
	), $atts ) );
Mk_Static_Files::addAssets('mk_content_box');