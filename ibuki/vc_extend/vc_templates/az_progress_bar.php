<?php
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass($el_class);

$class_bg = null;
if ($bgcolor=="custom") { $class_bg = 'custom-bar'; $bgcolor = ' background-color: '.$custombarcolor.';'; }

if ( $icon_mode == 'yes-icon' ) {
	$iconClass = isset( ${"icon_" . $icon_type} ) ? esc_attr( ${"icon_" . $icon_type} ) : 'font-icon-phone';
	$icon_output = '<i class="'.$iconClass.'"></i>';
} else {
	$icon_output = '';
}

// Output Bar
$bar_output = null;
if ($animated_bar==true) {
	$bar_output .= '<div class="bar animable" data-percent="'.$percentage.'" style="'.$bgcolor.'"></div>';
} else {
	$bar_output .= '<div class="bar" style="width: '.$percentage.'%; '.$bgcolor.'"></div>';
}

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

$class = setClass(array('progress-bar', $el_class, $class_bg, $animation_loading_class, $animation_effect_class, $responsive_lg, $responsive_md, $responsive_sm, $responsive_xs));

$output .= '<div'.$class.''.$animation_delay_class.'>';
$output .= '<div class="progress">';
$output .= '<span class="field">'.$icon_output.$field.'</span>';
$output .= $bar_output;
$output .= '</div></div>';

echo $output.$this->endBlockComment('az_progress_bar');

?>