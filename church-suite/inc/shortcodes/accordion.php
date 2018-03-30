<?php
function webnus_accordion ($atts, $content = null) {
 	extract(shortcode_atts(array(
 	'title'      => '',
	'active'=>null
	), $atts));
	
	$active=isset($active)?'active':'';

	$out = '<span class="acc-trigger '. $active .'"><a href="#"><strong>' . $title . '</strong></a></span>';
	$out .='<div class="acc-container">';
	$out .='<article class="content">';
	$out .='<p>' . do_shortcode($content) . '</p>';
	$out .='</article>';
	$out .='</div>';
return $out;
}
 add_shortcode('accordion','webnus_accordion');
?>