<?php
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass($el_class);

// Target
if ( $target == 'same' || $target == '_self' ) { $target = ''; }
if ( $target != '' ) { $target = ' target="'.$target.'"'; }

$img_id = preg_replace('/[^\d]/', '', $image);

$image_string = wp_get_attachment_image_src( $img_id, 'full');
$image_string = $image_string[0];
$image_title = get_the_title($img_id);

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

$img_output = null;
if ($image_link == "yes") {
    $img_output = '<a href="'.$image_link_url.'" title="'.$image_title.'"'.$target.'><img'.$animation_delay_class.' class="'.$image_mode.' '.$image_style_effects.' '.$image_box_shadow_effects.' '.$image_alignment.' '.$animation_loading_class.' '.$animation_effect_class.' '.$el_class.'" alt="'.$image_title.'" src="'.$image_string.'" /></a>';
} else {
    $img_output = '<img'.$animation_delay_class.' class="'.$image_mode.' '.$image_alignment.' '.$image_style_effects.' '.$image_box_shadow_effects.' '.$animation_loading_class.' '.$animation_effect_class.' '.$el_class.'" alt="'.$image_title.'" src="'. $image_string .'" />';
}

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,'single-image', $this->settings['base']);
$class = setClass(array($css_class, $responsive_lg, $responsive_md, $responsive_sm, $responsive_xs));

$output .= '<div'.$class.'>';
$output .= $img_output;
$output .= '</div>'.$this->endBlockComment('az_single_image')."\n";

echo $output;
