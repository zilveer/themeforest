<?php

	/* ------------------------------------
	:: HIGHLIGHT
	------------------------------------*/
	
	function highlight_shortcode( $atts, $content = null ) {
	   extract( shortcode_atts( array(
		  'type' => '',
		  ), $atts ) );
	  
	   return '<span class="nv-skin highlight ' . esc_attr($type) .'">' . $content . '</span>';
	}
	
	add_shortcode('highlight', 'highlight_shortcode');