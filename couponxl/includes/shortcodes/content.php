<?php
function couponxl_content_func( $atts, $content ){

	return '<div class="white-block"><div class="white-block-content">'.apply_filters( 'the_content', $content ).'</div></div>';
}

add_shortcode( 'content', 'couponxl_content_func' );

function couponxl_content_params(){
	return array();
}
?>