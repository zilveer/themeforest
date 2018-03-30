<?php

if ( ! function_exists( 'gp_left_blockquote' ) ) {
	function gp_left_blockquote($atts, $content = null) {
		return '<div class="blockquote-left">'.do_shortcode($content).'</div>';
	}
}
add_shortcode("bq_left", "gp_left_blockquote");

if ( ! function_exists( 'gp_authgp_right_blockquoteor_info_panel' ) ) {
	function gp_right_blockquote($atts, $content = null) {
		return '<div class="blockquote-right">'.do_shortcode($content).'</div>';
	}
}
add_shortcode("bq_right", "gp_right_blockquote");

?>