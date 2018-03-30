<?php

/* Counter Up
-------------------------------------------------------------------------------------------------------------------*/

if (!function_exists('counterup')) {
	function counterup( $atts, $content = null) {
 
	    extract( shortcode_atts( array(
	        "el_class" => ""
	    ), $atts ) );

	    if( !empty( $el_class ) ) {
		    $output = '<div class="counter-container ' . $el_class . '">';
	    } else {
		    $output = '<div class="counter-container">';
	    }

	    $output .= wpb_js_remove_wpautop($content) . '</div>';

	    return $output;

	}

}

add_shortcode('counterup', 'counterup');