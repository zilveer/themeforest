<?php

function dropcap_shortcode( $atts, $content = null ) {
	
	return '<span class="dropcap">' . do_shortcode($content) . '</span>';

}

add_shortcode( 'dropcap', 'dropcap_shortcode' );

?>