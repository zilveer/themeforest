<?php



function columns_shortcode( $atts, $content = null ) {
	return '<div class="clearfix page-content">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'columns', 'columns_shortcode' );



function one_half_shortcode( $atts, $content = null ) {
	return '<div class="one-half">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'one_half', 'one_half_shortcode' );



function one_half_last_shortcode( $atts, $content = null ) {
	return '<div class="one-half last-col">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'one_half_last', 'one_half_last_shortcode' );



function one_third_shortcode( $atts, $content = null ) {
	return '<div class="one-third">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'one_third', 'one_third_shortcode' );



function one_third_last_shortcode( $atts, $content = null ) {
	return '<div class="one-third last-col">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'one_third_last', 'one_third_last_shortcode' );



function two_thirds_shortcode( $atts, $content = null ) {
	return '<div class="two-thirds">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'two_thirds', 'two_thirds_shortcode' );



function two_thirds_last_shortcode( $atts, $content = null ) {
	return '<div class="two-thirds last-col">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'two_thirds_last', 'two_thirds_last_shortcode' );



function one_forth_shortcode( $atts, $content = null ) {
	return '<div class="one-forth">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'one_forth', 'one_forth_shortcode' );



function one_forth_last_shortcode( $atts, $content = null ) {
	return '<div class="one-forth last-col">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'one_forth_last', 'one_forth_last_shortcode' );



?>