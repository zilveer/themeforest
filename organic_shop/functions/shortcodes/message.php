<?php

function message_shortcode( $atts, $content = null ) {
	
	// type: default / notice / success / fail	
	extract( shortcode_atts( array(
			'type' => '',
		), $atts ) );
	
	if( !isset($atts['type']) ) {
		$class = "default";
	}
	
	else {
		$class = $atts['type'];
	}
	
	return '<div class="msg ' . $class . ' clearfix"><p>' . do_shortcode($content) . '</p></div>';

}

add_shortcode( 'msg', 'message_shortcode' );

?>