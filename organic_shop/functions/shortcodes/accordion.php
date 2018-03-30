<?php

// Accordion Wrapper
function accordion_shortcode( $atts, $content = null ) {

	return '<div class="accordion">' . do_shortcode($content) . '</div>';

}

add_shortcode( 'accordion', 'accordion_shortcode' );

// Accordion Items
function panel_shortcode( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
			'title' => '',
		), $atts ) );
	
	$title = $atts['title'];
	
	$output = '';
	$output .= '<h4>';
	$output .= $title;
	$output .= '</h4><div>';
	$output .= $content;
	$output .= '</div>';
	
	return $output;

}

add_shortcode( 'panel', 'panel_shortcode' );

?>