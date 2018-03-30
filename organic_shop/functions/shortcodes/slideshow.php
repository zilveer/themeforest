<?php

// Slideshow Wrapper
function slideshow_shortcode( $atts, $content = null ) {

	extract( shortcode_atts( array(
			'width' => ''
		), $atts ) );
	
	if( !isset($atts['width']) ) $width = '80%';
	
	return '<div id="slides" class="slide-loader section">
	<div class="slides_container">' 
				. do_shortcode($content) . 
			'</div>
			
			<a href="#" class="prev"><img src="' . get_template_directory_uri() . '/img/arrow-prev.png" alt="Arrow Prev"></a>
			<a href="#" class="next"><img src="' . get_template_directory_uri() . '/img/arrow-next.png" alt="Arrow Next"></a>
			
			</div>';

}

add_shortcode( 'slideshow', 'slideshow_shortcode' );

function slide_shortcode( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
			'image_url' => '',
			'link_url' => '',
			'caption' => '',
		), $atts ) );
	
	if( isset($atts['image_url']) ) $image_url = $atts['image_url'];
	if( isset($atts['link_url']) ) $link_url = $atts['link_url'];
	if( isset($atts['caption']) ) $caption = $atts['caption'];

	$output = '';
	$output .= '<div class="slide">';

	if( isset($atts['link_url']) ) {
		$output .= '<a href="' . $link_url . '"><img src="' . $image_url . '" alt="" /></a>';
	}

	else {
		$output .= '<img src="' . $image_url . '" alt="" />';
	}
	
	if ( $caption !== '' ) {
		$output .= '<div class="caption">';
		$output .= $caption;
		$output .= '</div>';
	}
	
	$output .= '</div>';

	return $output;

}

add_shortcode( 'slide', 'slide_shortcode' );

?>