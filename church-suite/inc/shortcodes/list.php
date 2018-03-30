<?php

 // Lists (ul li)
 function webnus_list( $atts, $content = null ) {
 	extract(shortcode_atts(array(
 	'type'      => 'plus',

 	), $atts));
 	return '<ul class="'. $type . '" >' . do_shortcode($content) . '</ul>';
 }
 add_shortcode('ul', 'webnus_list');

 function webnus_list_item( $atts, $content = null ) {
 	extract(shortcode_atts(array(
 	'type'      => '',

 	), $atts));
	return '<li class="'. $type .'">' . do_shortcode($content) . '</li>';
 }
 add_shortcode('li', 'webnus_list_item');

?>