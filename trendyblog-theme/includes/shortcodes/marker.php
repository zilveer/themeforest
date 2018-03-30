<?php
	add_shortcode('textmarker', 'textmarker_handler');

	function textmarker_handler($atts, $content=null, $code="") {

		return '<mark style="background-color:#'.$atts['color'].';">'.$content.'</mark>';
	
	}
?>