<?php

$args = array(
	"number_of_columns" => "",
	"switch_to_one_column" => "",
	"alignment_one_column" => "",
	"items_float_left" => "",
	"background_color" => ""
);

$html = "";

extract(shortcode_atts($args, $atts));

$background_color = esc_attr($background_color);

$elements_holder_class = "";
$elements_holder_style = "";

if($number_of_columns != ""){
	$elements_holder_class = " " . $number_of_columns ;
}

if($switch_to_one_column != ""){
	$elements_holder_class .= " responsive_mode_from_" . $switch_to_one_column ;
} else {
	$elements_holder_class .= " responsive_mode_from_768" ;
}

if($alignment_one_column != ""){
	$elements_holder_class .= " alignment_one_column_" . $alignment_one_column ;
}

if($items_float_left !== ""){
	$elements_holder_class .= " elements_items_float";
}

if($background_color != ""){
	$elements_holder_style .= " style='background-color:". $background_color ."'";
}


$html = "<div class='q_elements_holder" . $elements_holder_class . "' ". $elements_holder_style .">";
$html .= do_shortcode($content);
$html .= '</div>';

print $html;