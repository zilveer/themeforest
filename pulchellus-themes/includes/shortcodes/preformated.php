<?php
	add_shortcode('preformated', 'preformated_handler');

	function preformated_handler($atts, $content=null, $code="") {
		return '<pre>'.$content.'</pre>';
	}
?>