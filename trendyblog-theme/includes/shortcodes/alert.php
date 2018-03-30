<?php
add_shortcode('alert', 'alert_handler');

function alert_handler($atts, $content=null, $code="") {
	extract(shortcode_atts(array('color' => null, 'icon' => null, 'title' => null), $atts) );
	
	return '<div class="alert_message '.$color.'" style="margin-bottom: 5px"><p>'.do_shortcode($content).'</p></div>';		


}


?>