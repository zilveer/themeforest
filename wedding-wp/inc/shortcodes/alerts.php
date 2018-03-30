<?php

// Alerts
function webnus_alerts( $atts, $content = null ) {
 	extract( shortcode_atts( array(
 	'alert_content' => '',
 	'type' => 'info', /* alert-info, alert-success, alert-error */
 	'close' => 'false', /* display close link */
 	), $atts ) );

 	$out = '<div class="alert alert-'. $type . '">';
 	if($close == 'true') {
 		$out .= '<button type="button" class="close" data-dismiss="alert">&times;</button>';
 	}
 	$out .= $alert_content;
 	$out .= '</div>';

 	return $out;
 }

 add_shortcode('alert', 'webnus_alerts');

?>