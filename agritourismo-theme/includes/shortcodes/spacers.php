<?php
	add_shortcode('spacer', 'spacer_handler');

	function spacer_handler($atts, $content=null, $code="") {
		return '<div class="split-line-'.$atts['style'].'"></div>';

	}
?>