<?php
/**
 * Prints the Nivo slider in header.
 */

global $pexeto_content_sizes, $pexeto_slider_data, $post, $pexeto_scripts;

//get the default slider size
$slider_init_data = pexeto_get_nivo_data($pexeto_slider_data, 'container', '', $post->ID);


echo pexeto_get_nivo_slider_html(
	$slider_init_data['images'], 
	$slider_init_data['options'], 
	$slider_init_data['slider_div_id'], 
	$slider_init_data['height'], 
	$slider_init_data['autoresizing']);

?>

