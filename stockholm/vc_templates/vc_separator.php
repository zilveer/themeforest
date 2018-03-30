<?php
$output = '';
extract(shortcode_atts(array(
    'el_class' 		=> '',
    'type' 			=> '',
    'position' 		=> '',
    'color' 		=> '',
    'border_style' 	=> '',
    'up' 			=> '',
    'down' 			=> '',
    'thickness' 	=> '',
    'width' 		=> ''
), $atts));

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'separator', $this->settings['base']);

$separator_classes = "";
$separator_styles  = array();

$separator_classes .= $css_class." ".$el_class." ";
$separator_classes .= $type." ";
$separator_classes .= $position." ";

if($color != "") {
	$separator_styles[] = "border-color: ".$color;
}

if($thickness != "") {
	$separator_styles[] = "border-width:". $thickness ."px";
}

if($width != ""){
	$separator_styles[]= "width:". $width ."px";
}

if($up != ""){
	$separator_styles[] = "margin-top:". $up ."px";
}

if($down != ""){
	$separator_styles[] = "margin-bottom:". $down ."px";
}

if($border_style != "") {
	$separator_styles[] = "border-style: ".$border_style;
}

$output .= '<div class="'.esc_attr($separator_classes).' " style="'.implode(';', $separator_styles).'">';

$output .= '</div>'.$this->endBlockComment('separator')."\n";

print $output;