<?php

/* HGroup
-------------------------------------------------------------------------------------------------------------------*/

if (!function_exists('title')) {
	function title( $atts, $content = null) {

	    extract( shortcode_atts( array(
	        "title"    => "",
	        "align"    => "",
	        "el_class" => ""
	    ), $atts ) );

	    if( !empty( $el_class ) ) {
		    $output = '<div class="section-title text-' . $align . ' ' . $el_class . '">';
	    } else {
		    $output = '<div class="section-title text-' . $align . '">';
	    }

	    	if( !empty( $title ) ) {
	    		$output .= '<h2>' . $title . '</h2>';
	    	}

	    $output .= '</div>';

	    return $output;

	}

}

add_shortcode('title', 'title');