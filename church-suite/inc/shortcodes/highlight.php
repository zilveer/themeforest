<?php
function webnus_highlight1 ($atts, $content = null) {

 	return '<span class="highlight1">' . do_shortcode($content) . '</span>';
 }
 add_shortcode('highlight1','webnus_highlight1');

 function webnus_highlight2 ($atts, $content = null) {

 	return '<span class="highlight2">' . do_shortcode($content) . '</span>';
 }
 add_shortcode('highlight2','webnus_highlight2');

 function webnus_highlight3 ($atts, $content = null) {

 	return '<span class="highlight3">' . do_shortcode($content) . '</span>';
 }
 add_shortcode('highlight3','webnus_highlight3');

 function webnus_highlight4 ($atts, $content = null) {

 	return '<span class="highlight4">' . do_shortcode($content) . '</span>';
 }
 add_shortcode('highlight4','webnus_highlight4');
 
 
 function webnus_highlight( $atts, $content = null ) {
 	extract( shortcode_atts( array(
 	'type' => '1', 
 	
 	), $atts ) );
	return '<span class="highlight'.$type.'">' . do_shortcode($content) . '</span>';
}
 add_shortcode('highlight','webnus_highlight');
?>