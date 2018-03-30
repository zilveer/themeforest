<?php

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $animated
 * @var $animation_delay
 * @var $css
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column_text
 */
$el_class = $css = $css_animation = '';
$animation_delay = '0.3';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if(isset($animated) && !empty($animated)){
	$animated = 'wow '.$animated;
}


$class_to_filter = 'wpb_text_column wpb_content_element ' . $animated;
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$output = '
	<div class="' . esc_attr( $css_class ) . '" data-wow-delay="' . $animation_delay . 's" >
		<div class="wpb_wrapper">
			' . wpb_js_remove_wpautop( $content, true ) . '
		</div>
	</div>
';

echo $output;
