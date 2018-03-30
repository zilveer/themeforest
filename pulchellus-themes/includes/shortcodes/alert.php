<?php
	add_shortcode('alert', 'alert_handler');

	function alert_handler($atts, $content=null, $code="") {

		$return =  '<div class="'.$atts['type'].'">';
		$return.=  '<p><strong>'.$atts['title'].'</strong> '.$content.'</p>';
		$return.=  '</div>';

		return $return;
	}
?>