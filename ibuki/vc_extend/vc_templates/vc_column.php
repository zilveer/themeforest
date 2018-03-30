<?php
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass($el_class);
$width = wpb_translateColumnWidthToSpan($width);

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

$bgclass = null;
if ($bgmode=="custom-color") {
	$bgclass = 'row-color';
} else {
	$bgclass = '';
}

$equals_col_height_output = null;
if ($equals_col_height==true) {
	$equals_col_height_output = 'equals-col-height';
} 

if ($bgmode=="custom-color" && $padding=="custom-padding") { $bgmode = ' style="background-color: '.$custombgcolor.'; padding: '.$padding_value.'px !important;"'; } 
else if ($bgmode=="custom-color") { $bgmode = ' style="background-color: '.$custombgcolor.';"'; }
else { $bgmode = ''; }

$el_class .= '';
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $width.$el_class, $this->settings['base']);
$class = setClass(array($css_class, $bgclass, $equals_col_height_output, $padding, $animation_loading_class, $animation_effect_class));

$output .= '
<div'.$class.$bgmode.''.$animation_delay_class.'>';
$output .= 
wpb_js_remove_wpautop($content);
$output .= '
</div>'.$this->endBlockComment($width);

echo $output;

