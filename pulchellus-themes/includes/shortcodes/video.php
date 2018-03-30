<?php
	add_shortcode('video', 'video_handler');

	function video_handler($atts, $content=null, $code="") {

		return '<div class="embeded-container"><p>'.do_shortcode($content).'</p></div>';
	}
	

?>