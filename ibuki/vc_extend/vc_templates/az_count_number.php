<?php
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass($el_class);

$animation_loading_class = null;
if ($animation_loading == "yes") {
  	$animation_loading_class = 'animated-content';
}

$animation_effect_class = null;
if ($animation_loading == "yes") {
  	$animation_effect_class = $animation_loading_effects;
} else {
	$animation_effect_class = '';
}

$animation_delay_class = null;
if ($animation_loading == "yes" && !empty($animation_delay)) {
	$animation_delay_class = ' data-delay="'.$animation_delay.'"';
}

// Check Color Icon
$color_icon = null;
if ($icon_color=="custom") { 
	$color_icon = ' style="color: '.$custom_icon_color.';"';  
}

// Check Field Color
$color_field = null;
if ($field_color=="custom") { 
	$color_field = ' style="color: '.$custom_field_color.';"';  
}

// Check Counter Color
$color_number = null;
if ($number_color=="custom") { 
	$color_number = ' style="color: '.$custom_number_color.';"';  
}

$icon_output = null;
if ( $icon_mode == 'yes-icon' ) {
	$iconClass = isset( ${"icon_" . $icon_type} ) ? esc_attr( ${"icon_" . $icon_type} ) : 'font-icon-phone';
	$icon_output = '<div class="count-number-icon textaligncenter"><i class="'.$iconClass.'"'.$color_icon.'></i></div>';
} else {
	$icon_output = '';
}

$counter_output = null;
if( !empty($number_field)) {
	$counter_output = '<span class="number-value timer" data-from="'.$number_value_from.'" data-to="'.$number_value_to.'" data-speed="'.$number_speed.'"'.$color_number.'></span><span class="number-field"'.$color_field.'>'.$number_field.'</span>';
} else {
	$counter_output = '<span class="number-value timer" data-from="'.$number_value_from.'" data-to="'.$number_value_to.'" data-speed="'.$number_speed.'"'.$color_number.'></span>';
}

$class = setClass(array('counter-number', $el_class, $animation_loading_class, $animation_effect_class, $responsive_lg, $responsive_md, $responsive_sm, $responsive_xs));

$output .= '<div'.$class.''.$animation_delay_class.'>'.$icon_output.'';
$output .= '<div class="output-number" data-delay="'.$number_delay.'">';
$output .= $counter_output;
$output .= '</div>';
$output .= '</div>';

echo $output.$this->endBlockComment('az_count_number');

?>