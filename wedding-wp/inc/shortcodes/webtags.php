<?php

 // Paragraph
 function webnus_paragraph ($atts, $content = null) {
	extract(shortcode_atts(array(
		'class'      => ''
	), $atts));
 	return '<p class="'. $class .'">' . do_shortcode($content) . '</p>';
 }
 add_shortcode('p','webnus_paragraph');
 
 
function maxone_paragraph ($atts, $content = null) {
	extract(shortcode_atts(array(
		'class'      => ''
	), $atts));
 	return '<p class="max-p">' . do_shortcode($content) . '</p>';
 }
 add_shortcode('max-p','maxone_paragraph');


 // Link (magicmore)
function  magiclink_shortcode($attributes, $content = null)
{

	extract(shortcode_atts(array(
	"url" => '#',
		), $attributes));

	return '<a class="magicmore" href="'. $url .'">'. do_shortcode($content) . '</a>';
}
add_shortcode("link", 'magiclink_shortcode');

 // BoxLink (magiclink)
function  boxlink_shortcode($attributes, $content = null)
{

	extract(shortcode_atts(array(
	"url" => '#',
		), $attributes));

	return '<div class="magic-link"><a href="'. $url .'">'. do_shortcode($content) . '</a></div>';
}
add_shortcode("boxlink", 'boxlink_shortcode');



 // Lists (ul li)
 function webnus_ul( $atts, $content = null ) {
 	extract(shortcode_atts(array(
 	'type'      => '',

 	), $atts));
 	return '<ul class="'. $type . '" >' . do_shortcode($content) . '</ul>';
 }
 add_shortcode('list-ul', 'webnus_ul');

 function webnus_li( $atts, $content = null ) {
 	extract(shortcode_atts(array(
 	'type'      => '',

 	), $atts));
	return '<li class="'. $type .'">' . do_shortcode($content) . '</li>';
 }
 add_shortcode('li-row', 'webnus_li');

 

  // Center
 function webnus_center( $atts, $content = null ) {
 	
	return '<div class="aligncenter">' . do_shortcode($content) . '</div>';
 }
 add_shortcode('center', 'webnus_center');


  // Span
 function webnus_span( $atts, $content = null ) {
 	
	return '<span>' . do_shortcode($content) . '</span>';
 }
 add_shortcode('span', 'webnus_span');


  // Row
 function webnus_row( $atts, $content = null ) {
 	
	return '<div class="row">' . do_shortcode($content) . '</div>';
 }
 add_shortcode('row', 'webnus_row');

 // Row
 function webnus_container( $atts, $content = null ) {
 	
	
	return '<section class="container">' . do_shortcode($content) . '</section>';
	
 }
 add_shortcode('container', 'webnus_container');

// Horizonal line1
 function webnus_hr1( $atts, $content = null ) {
 	return '<hr class="vertical-space1">';
 }
 add_shortcode('line1', 'webnus_hr1');
 
// Horizonal line2
 function webnus_hr2( $atts, $content = null ) {
 	return '<hr class="vertical-space2">';
 }
 add_shortcode('line2', 'webnus_hr2');
 // Clear
 function webnus_clear( $atts, $content = null ) {
 	return '<div class="clear"></div>';
 }
 add_shortcode('clear', 'webnus_clear');


 
  // Horizonal line
 function webnus_hr( $atts, $content = null ) {
 	
	extract(shortcode_atts(array(
 	'type'      => '1'
						), $atts));
	return ( $type == '1')?  '<hr>' : '<hr class="boldbx">';
	
	
 }
 add_shortcode('line', 'webnus_hr');

 
 // Horizonal line
 function webnus_thickline( $atts, $content = null ) {
 	return '<hr class="boldbx">';
 }
 add_shortcode('tline', 'webnus_thickline');


 // Maxone line
 function webnus_maxline( $atts, $content = null ) {
 	return '<span class="max-line"></span>';
 }
 add_shortcode('max-line', 'webnus_maxline');
 
 
 

?>