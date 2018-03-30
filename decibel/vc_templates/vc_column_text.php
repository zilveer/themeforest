<?php
$output = $el_class = $css_animation = '';

if ( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );	
}

extract(shortcode_atts(array(
	'el_class' => '',
	'animation' => '',
	'animation_delay' => '',
	'inline_style' => '',
	'css' => ''
), $atts));

$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_text_column wpb_content_element ' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
// $css_class .= $this->getCSSAnimation($css_animation);
if ( $animation ) {
	$css_class .= " wow $animation";
}
$style = ( $animation_delay && 'none' != $animation ) ? 'animation-delay:' . $animation_delay / 1000 . 's;-webkit-animation-delay:' . $animation_delay / 1000 . 's;' : '' ;
$container_inline_style = ( $style ) ? " style='$style'" : '';

$inner_style = '';

if ( $inline_style )
	$inner_style .= " $inline_style";

$inner_inline_style = ( $inner_style ) ? " style='$inner_style'" : '';

$output .= "\n\t".'<div class="'.$css_class.'"' . $container_inline_style . '>';
$output .= "\n\t\t".'<div class="wpb_wrapper" ' . $inner_inline_style . '>';
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content, true);
$output .= "\n\t\t".'</div> ' . $this->endBlockComment('.wpb_wrapper');
$output .= "\n\t".'</div> ' . $this->endBlockComment('.wpb_text_column');

echo $output;