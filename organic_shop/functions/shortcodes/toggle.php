<?php

function toggle_shortcode( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
			'title' => '',
		), $atts ) );
	
	$title = $atts['title'];
	
	$output = '';
	$output .= '<div class="toggle"><div class="title"><h4>';
	$output .= $title;
	$output .= '</h4><span></span></div><div class="inner">';
	$output .= $content;
	$output .= '</div></div>';
	
	return $output;

}

add_shortcode( 'toggle', 'toggle_shortcode' );

?>