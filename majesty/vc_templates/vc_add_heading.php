<?php
$output = $css_animation_type = $css_animation_delay = $el_class = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$el_class = $this->getExtraClass( $el_class );
$css_classes = array( 'head_title', $el_class );
if( ! empty( $text_align ) ) {
	$css_classes[] = $text_align;
}
if( ! empty( $margin_bottom ) && $margin_bottom != 'default' ) {
	$css_classes[] = $margin_bottom;
}
if( ! empty( $icon_size ) ) {
	$css_classes[] = $icon_size;
}

$wrapper_attributes = array();
if( isset( $css_animation_type) && ! empty( $css_animation_type ) ) {
	$css_classes[] = 'animated';	
	$wrapper_attributes[] = ' data-animation="'. esc_attr( $css_animation_type ) .'"';
	if( isset( $css_animation_delay) && ! empty( $css_animation_delay ) ) {
		$wrapper_attributes[] = ' data-animation-delay="'. absint( $css_animation_delay ) .'"';
	}
}
$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
if( ! empty ( $icon_type ) ) {
	if( ( ! empty( $icon ) && $icon != 'no' ) || ( ! empty( $iconawesome ) && $iconawesome != 'no' ) ) {
		if( $icon_type == 'fontawesome' ) {
			$icon = $iconawesome;
		}
		$output .= ' <i class="'. esc_attr( $icon ) .'"></i>';
	}
}
if( empty( $tag_marg_bottom ) ) {
	$output .= '<'. esc_attr($tag) .'>'. esc_attr( $title ) .'</'. esc_attr($tag) .'>';
} else {
	$output .= '<'. esc_attr($tag) .' class="'. esc_attr( $tag_marg_bottom ) .'">'. esc_attr( $title ) .'</'. esc_attr($tag) .'>';
}
if( ! empty( $subtitle ) ) {
	$output .= '<span class="welcome">'. esc_attr( $subtitle ) .'</span>';
}
$output .= '</div>';
global $majesty_allowed_tags;
echo wp_kses( $output, $majesty_allowed_tags );