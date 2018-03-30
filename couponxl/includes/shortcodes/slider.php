<?php
function couponxl_slider_func( $atts, $content ){
	ob_start();
	include( locate_template( 'includes/featured-slider.php' ) );
	$content = ob_get_contents();
	ob_end_clean();

	return $content;
}

add_shortcode( 'slider', 'couponxl_slider_func' );

function couponxl_slider_params(){
	return array();
}
?>