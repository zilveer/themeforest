<?php


 // distance (horizonal-space)
 function webnus_distance1 ($atts, $content = null) {

 	return '<hr class="vertical-space1">';
 }
 add_shortcode('distance1','webnus_distance1');
 
 function webnus_distance2 ($atts, $content = null) {

 	return '<hr class="vertical-space2">';
 }
 add_shortcode('distance2','webnus_distance2');
 
  function webnus_distance3 ($atts, $content = null) {

 	return '<hr class="vertical-space3">';
 }
 add_shortcode('distance3','webnus_distance3');

  function webnus_distance4 ($atts, $content = null) {

 	return '<hr class="vertical-space4">';
 }
 add_shortcode('distance4','webnus_distance4');

 
  function webnus_distance ($atts, $content = null) {
	extract(shortcode_atts(array(
 	'type'      => '1'
						), $atts));
 	return ($type >0 )? '<hr class="vertical-space'.$type.'">': '<div class="null"></div>';
 }
 add_shortcode('distance','webnus_distance');
 
?>