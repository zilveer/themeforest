<?php
function webnus_h1 ($attributes, $content = null) {

	extract(shortcode_atts(array(
	"class" => '',

	), $attributes));

 	return '<h1 class="'. $class .'">' . do_shortcode($content) . '</h1>';
 }
 add_shortcode('h1','webnus_h1');
 
 function webnus_h2 ($attributes, $content = null) {

	extract(shortcode_atts(array(
	"class" => '',

	), $attributes));

 	return '<h2 class="'. $class .'">' . do_shortcode($content) . '</h2>';
 }
 add_shortcode('h2','webnus_h2');
 
 function webnus_h3 ($attributes, $content = null) {

	extract(shortcode_atts(array(
	"class" => '',

	), $attributes));

 	return '<h3 class="'. $class .'">' . do_shortcode($content) . '</h3>';
 }
 add_shortcode('h3','webnus_h3');
 
 function webnus_h4 ($attributes, $content = null) {

	extract(shortcode_atts(array(
	"class" => '',

	), $attributes));

 	return '<h4 class="'. $class .'">' . do_shortcode($content) . '</h4>';
 }
 add_shortcode('h4','webnus_h4');
 
 function webnus_h5 ($attributes, $content = null) {

	extract(shortcode_atts(array(
	"class" => '',

	), $attributes));

 	return '<h5 class="'. $class .'">' . do_shortcode($content) . '</h5>';
 }
 add_shortcode('h5','webnus_h5');
 
 function webnus_h6 ($attributes, $content = null) {

	extract(shortcode_atts(array(
	"class" => '',

	), $attributes));

 	return '<h6 class="'. $class .'">' . do_shortcode($content) . '</h6>';
 }
 add_shortcode('h6','webnus_h6');
 
 
 function webnus_strong ($attributes, $content = null) {

	extract(shortcode_atts(array(
	"class" => '',

	), $attributes));

 	return '<strong class="'. $class .'">' . do_shortcode($content) . '</strong>';
 }
 add_shortcode('strong','webnus_strong');
 
 function webnus_br ($attributes, $content = null) {

	extract(shortcode_atts(array(
	"class" => '',

	), $attributes));

 	return '<br class="'. $class .'">';
 }
 add_shortcode('br','webnus_br');
 
  function webnus_div ($attributes, $content = null) {

	extract(shortcode_atts(array(
	"class" => '',

	), $attributes));

 	return '<div class="'. $class .'">'.do_shortcode($content). '</div>';
 }
 add_shortcode('div','webnus_div');
 ?>