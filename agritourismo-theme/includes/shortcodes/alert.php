<?php
add_shortcode('alert', 'alert_handler');

function alert_handler($atts, $content=null, $code="") {
	extract(shortcode_atts(array('color' => null,'icon' => null,), $atts) );


	if(isset($icon) && $icon!="none" ) {
		$icon = '<span class="icon-text">'.htmlspecialchars_decode ($icon).'</span>';
	} else {
		$icon = false;
	}
		

	return '<div class="coloralert" style="background-color:#'.$color.';">'.$icon.'
				<p>'.do_shortcode($content).'</p>
				<a href="#close-alert">&#10006;</a>
			</div>';

}

?>
