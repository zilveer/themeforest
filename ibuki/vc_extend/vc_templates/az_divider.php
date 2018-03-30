<?php
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass($el_class);

$div_setup = null;
if ($div_color=="custom") { $div_setup = ' border-color: '.$custom_div_color.';'; }

$margin_top_value = 'margin-top: '.$margin_top_value.'px; ';
$margin_bottom_value = 'margin-bottom: '.$margin_bottom_value.'px;';

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

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,'divider'.$el_class, $this->settings['base']);
$class = setClass(array($css_class, $div_style, $div_type, $animation_loading_class, $animation_effect_class, $responsive_lg, $responsive_md, $responsive_sm, $responsive_xs));

$output .= '<div'.$class.''.$animation_delay_class.' style="'.$margin_top_value.$margin_bottom_value.$div_setup.'"></div>'.$this->endBlockComment('az_divider')."\n";

echo $output;