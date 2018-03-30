<?php
function couponxl_row_func( $atts, $content ){

	return '<div class="row">'.do_shortcode( $content ).'</div>';
}

add_shortcode( 'row', 'couponxl_row_func' );

function couponxl_row_params(){
	return array();
}
?>