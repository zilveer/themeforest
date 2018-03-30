<?php

function webnus_quote( $attributes, $content = null ) {
 	
	extract(shortcode_atts(array(
	"text" =>'',
	"name" =>'',
	"name_sub" =>'',
	
	
		), $attributes));
    $out= '';
    $out .='<blockquote class="max-quote">';
    $out .='<h2>'. $text .'</h2>';
    $out .='<cite title="">'. $name .' <small>'. $name_sub .'</small></cite></blockquote>';
	return $out;
}

add_shortcode('quote', 'webnus_quote');		
?>