<?php

/*
 * shows a tooltip when you hover the shortcodes' content
 */

function wpv_shortcode_tooltip($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'tooltip_content' => ''
	), $atts));
	
	ob_start();

	include(locate_template('templates/shortcodes/tooltip.php'));

	return ob_get_clean();
}
add_shortcode('tooltip', 'wpv_shortcode_tooltip');
