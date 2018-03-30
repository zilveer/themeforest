<?php
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass($el_class);

$icons_markup = $icons_standard = $icon_style_color = $icon_class_color = $box_class_color = null;
if ( $icon_color == "custom" ) { 
	$box_class_color= ' style="border-color:'.$custom_icon_color.';"'; $icon_class_color = ' custom-color'; $icon_style_color = ' style="color:'.$custom_icon_color.';"'; 
}

if ( $icon_mode == 'yes-icon' ) {
	$iconClass = isset( ${"icon_" . $icon_type} ) ? esc_attr( ${"icon_" . $icon_type} ) : 'font-icon-phone';
	$icon_output = '<i class="'.$iconClass.$icon_class_color.'"'.$icon_style_color.'></i>';
} else {
	$icon_output = '';
}

// Target
if ( $target == 'same' || $target == '_self' ) { $target = ''; }
if ( $target != '' ) { $target = ' target="'.$target.'"'; }

// Position
if ( $position == 'same' || $position == 'top' ) { $position = ''; }

if ( $position=="left" && $icons_select=="icon_circle" ) { $position = 'listed-left circle-icon'; }
if ( $position=="right" && $icons_select=="icon_circle" ) { $position = 'listed-right circle-icon'; }

if ( $position=="left" && $icons_select=="icon_only" ) { $position = 'listed-left only-icon'; }
if ( $position=="right" && $icons_select=="icon_only" ) { $position = 'listed-right only-icon'; }

if ( $icons_select=="boxed_version" ) { $position = 'boxed-version'; $icons_markup = '<div class="icon-boxed">'.$icon_output.'</div>'; }
if ( $icons_select=="icon_circle" ) { $icons_select = 'icon circle-mode-box'; $icons_markup = '<div class="'.$icons_select.$icon_class_color.'"'.$box_class_color.'>'.$icon_output.'</div>'; }
if ( $icons_select=="icon_only" ) { $icons_select = 'icon icon-only-mode-box'; $icons_markup = '<div class="'.$icons_select.'">'.$icon_output.'</div>'; }
if ( $icons_select=="icon_standard" ) { $icons_select = 'icon standard-mode-box'; $position = 'listed-left standard-icon'; $icons_standard = $icon_output; }

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

$class = setClass(array('box', $el_class, $position, $animation_loading_class, $animation_effect_class, $responsive_lg, $responsive_md, $responsive_sm, $responsive_xs));

if ($box_wrap_link==true) {
	$output .= '<a href="'.$box_wrap_link_url.'" title="'.$title.'"'.$target.'>';
	$output .= '<div'.$class.''.$animation_delay_class.'>'.$icons_markup.'';
	$output .= '<div class="box-text">'; 
	$output .= '<h4>'.$icons_standard.$title.'</h4>';
	$output .= wpb_js_remove_wpautop($content, true);
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</a>';
} else {
	$output .= '<div'.$class.''.$animation_delay_class.'>'.$icons_markup.'';
	$output .= '<div class="box-text">'; 
	$output .= '<h4>'.$icons_standard.$title.'</h4>';
	$output .= wpb_js_remove_wpautop($content, true);
	$output .= '</div>';
	$output .= '</div>';
} 

echo $output.$this->endBlockComment('az_box_icon');

?>