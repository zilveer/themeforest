<?php

function title_shortcode( $atts, $content = null ) {
	
	$output = '<div class="tag-title-wrap clearfix">';
	$output .= '<h4 class="tag-title">';
	$output .= $content;
	$output .= '</h4>';
	$output .= '</div>';
	
	return $output;

}

add_shortcode( 'title', 'title_shortcode' );

?>