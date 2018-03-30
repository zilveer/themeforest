<?php

function webnus_quote( $attributes, $content = null ) {
 	
	extract(shortcode_atts(array(
	"text" => 'Quote content text goes here',
	"name" =>'Name',
	"name_sub" =>'Name Subtitle',
	
	
		), $attributes));
    $out= '';
    $out .='<blockquote class="max-quote">';
    $out .='<h2>'. $text .'</h2>';
    $out .='<cite title="">'. $name .' <small> - '. $name_sub .'</small></cite></blockquote>';
	return $out;
}

add_shortcode('quote', 'webnus_quote');		
?>