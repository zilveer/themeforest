<?php
	add_shortcode('heading', 'heading_handler');

	function heading_handler($atts, $content=null, $code="") {
		if($atts['style']=="subheader" ) {
			return '<h4 class="subheader">'.do_shortcode($content).'</h4>';
		} else {
			return '<div class="'.$atts['style'].'-heading"><h3>'.do_shortcode($content).'</h3></div>';
		}
	}
	
	
?>