<?php
extract( shortcode_atts( array(
	'el_class' 	=> '',
	'type' 		=> 'confirm-message',
), $atts ) );
Mk_Static_Files::addAssets('mk_message_box');