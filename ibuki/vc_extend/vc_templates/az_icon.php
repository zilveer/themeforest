<?php
$output = $icon_output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass($el_class);

// Target
if ( $target == 'same' || $target == '_self' ) { $target = ''; }
if ( $target != '' ) { $target = ' target="'.$target.'"'; }

// Customization
$icon_custom_value = $icon_style_color = null;
if ($icon_color=="custom" && !empty($icon_size)) { $icon_custom_value = ' style="color:'.$custom_icon_color.'; font-size:'.$icon_size.'px;"'; }
else if (!empty($icon_size)) { $icon_custom_value = ' style="font-size:'.$icon_size.'px;"'; }

// Animation
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

if ( $icon_mode == 'yes-icon' ) {
	$iconClass = isset( ${"icon_" . $icon_type} ) ? esc_attr( ${"icon_" . $icon_type} ) : 'font-icon-phone';
	$class = setClass(array($iconClass, $icon_align, $el_class, $animation_loading_class, $animation_effect_class, $responsive_lg, $responsive_md, $responsive_sm, $responsive_xs));

	if ($icon_wrap_link==true) {
		$icon_output .= '<a class="icon-sh" href="'.$icon_wrap_link_url.'" '.$target.'>';
		$icon_output .= '<span class="icon-shortcode"><i'.$class.''.$animation_delay_class.$icon_custom_value.'></i></span>';
		$icon_output .= '</a>';
	} else {
		$icon_output .= '<span class="icon-shortcode"><i'.$class.''.$animation_delay_class.$icon_custom_value.'></i></span>';
	}

} else {
	$icon_output = '';
}

$output .= $icon_output.$this->endBlockComment('az_icon')."\n";

echo $output;

?>