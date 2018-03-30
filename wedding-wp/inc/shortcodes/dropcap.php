<?php
function webnus_dropcap1 ($atts, $content = null) {

 	return '<span class="dropcap1">' . do_shortcode($content) . '</span>';
 }
add_shortcode('dropcap1','webnus_dropcap1');

function webnus_dropcap2 ($atts, $content = null) {

	return '<span class="dropcap2">' . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap2','webnus_dropcap2');

function webnus_dropcap3 ($atts, $content = null) {

	return '<span class="dropcap3">' . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap3','webnus_dropcap3');

function webnus_dropcap ($atts, $content = null) {
	extract( shortcode_atts( array(
	'type' => '1', 
	'dropcap_content' => '', 

), $atts ) );
return '<span class="dropcap'.$type.'">' . $dropcap_content . '</span>';
}
add_shortcode('dropcap','webnus_dropcap');
?>