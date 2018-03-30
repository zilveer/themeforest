<?php
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass($el_class);

$heading_setup = null;

if(!empty($custom_heading_line)) { $custom_heading_line = ' line-height:'.$custom_heading_line.'px;'; }

if ($heading_color=="custom" && $heading_size=="custom") { $heading_setup = ' style="color: '.$custom_heading_color.'; font-size: '.$custom_heading_size.'px;'.$custom_heading_line.'"'; }
else if ($heading_size=="custom") { $heading_setup = ' style="font-size: '.$custom_heading_size.'px;'.$custom_heading_line.'"'; }
else if ($heading_color=="custom") { $heading_setup = ' style="color: '.$custom_heading_color.';"'; }

$padding_bottom_heading = ' style="padding-bottom: '.$padding_bottom_heading.'px;"';

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

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'special-heading'.$el_class, $this->settings['base']);
$class = setClass(array($css_class, $heading_align, $heading_style, $animation_loading_class, $animation_effect_class, $responsive_lg, $responsive_md, $responsive_sm, $responsive_xs));

$output .= '<div'.$class.''.$animation_delay_class.''.$padding_bottom_heading.'>';
$output .= '<h'. $heading_type . $heading_setup .' class="'.$heading_style.'">'.wp_kses_post($content_heading).'</h'. $heading_type. '>';
$output .= '</div>'.$this->endBlockComment('az_special_heading');

echo $output;

?>