<?php

function webnus_onethird( $attributes, $content = null ) {

	extract(shortcode_atts(array(
 	'last'  => null,
 	), $attributes));
	
	$out = '<div class="col-md-4">';
	$out .= do_shortcode($content);
	$out .= '</div>';
			
	return $out;
}
 add_shortcode('one_third', 'webnus_onethird');
 
 
function webnus_onehalf( $attributes, $content = null ) {

	extract(shortcode_atts(array(
 	'last'  => null,
 	), $attributes));
	
	$out = '<div class="col-md-6">';
	$out .= do_shortcode($content);
	$out .= '</div>';
			
	return $out;
}
 add_shortcode('one_half', 'webnus_onehalf');

 
 
function webnus_twothird( $attributes, $content = null ) {

	extract(shortcode_atts(array(
 	'last'  => null,
 	), $attributes));
	
	$out = '<div class="col-md-8">';
	$out .= do_shortcode($content);
	$out .= '</div>';
			
	return $out;
}
 add_shortcode('two_third', 'webnus_twothird');
 
 
 
 
function webnus_onefourth( $attributes, $content = null ) {

	extract(shortcode_atts(array(
 	'last'  => null,
 	), $attributes));
	
	$out = '<div class="col-md-3">';
	$out .= do_shortcode($content);
	$out .= '</div>';
			
	return $out;
}
 add_shortcode('one_fourth', 'webnus_onefourth');
 
 
 
function webnus_onesixth( $attributes, $content = null ) {

	extract(shortcode_atts(array(
 	'last'  => null,
 	), $attributes));
	
	$out = '<div class="col-md-2">';
	$out .= do_shortcode($content);
	$out .= '</div>';
			
	return $out;
}
 add_shortcode('one_sixth', 'webnus_onesixth');
 
 function webnus_onetwelfth( $attributes, $content = null ) {

	extract(shortcode_atts(array(
 	'last'  => null,
 	), $attributes));
	
	$out = '<div class="col-md-1">';
	$out .= do_shortcode($content);
	$out .= '</div>';
			
	return $out;
}
 add_shortcode('one_twelfth', 'webnus_onetwelfth');
 
?>