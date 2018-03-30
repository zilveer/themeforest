<?php

	/* ------------------------------------
	:: DROP CAPS
	------------------------------------*/
	
	function dropcap_shortcode( $atts, $content = null ) {
	   extract( shortcode_atts( array(
		  'style' => '',
		  'text' => '',
		  'color' => '',
		  ), $atts ) );
	 
	   return '<span class="dropcap '. $style .' '. $color .'">' . $text  . '</span>';
	
	}
	
	add_shortcode('dropcap', 'dropcap_shortcode');