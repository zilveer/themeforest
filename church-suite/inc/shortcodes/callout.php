<?php
function callout_shortcode($attributes, $content)
{

	extract(shortcode_atts(array(
	"title" => '',
	"text" => '',
	"button_text" =>'',
	"button_link" =>''
		), $attributes));

	$out = '<article class="callout">';
	$out .='<a class="callurl" href="'. $button_link .'">'. $button_text .'</a>';
	$out .='<h3>'. $title .'</h3>';
	$out .='<p>'. $text .'</p>';
	$out .='</article>';
	  
	
	return $out;
}
add_shortcode("callout", 'callout_shortcode');
?>