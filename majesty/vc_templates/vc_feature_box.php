<?php
$output = $wrapper_attributes = '';
$atts 	= vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$el_class = $this->getExtraClass( $el_class );
$css_classes = array( 'address-content', 'clearfix', $el_class );

if( isset( $css_animation_type) && ! empty( $css_animation_type ) ) {
	$css_classes[] = 'animated';	
	$wrapper_attributes[] = ' data-animation="'. esc_attr( $css_animation_type ) .'"';
	if( isset( $css_animation_delay) && ! empty( $css_animation_delay ) ) {
		$wrapper_attributes[] = ' data-animation-delay="'. absint( $css_animation_delay ) .'"';
	}
}

if ( ! empty ( $text_align ) ) {
	$css_classes[] = $text_align;
}
if( $position == 'icon_centered' ) {
	$css_classes[] = 'icon-centered';
}
$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output .= '<div '. implode( ' ', $wrapper_attributes ) .'>';
if( $position == 'icon_centered' ) {
	if( ! empty( $icon ) ) {
		$output .= '<p class="icon"><i class="fa '. esc_attr( $icon ) .'"></i></p>';
	}
	$output .= '<div class="content-item">';
	if( ! empty( $title ) ) {
		$output .= '<h3>'. esc_attr( $title ) .'</h3>';
	}
	if( ! empty( $content ) ) {
		$output .= '<p>'. wpb_js_remove_wpautop( $content ) .'</p>';
	}
	$output .= '</div>';
} else {
	if( ! empty( $icon ) ) {
		$output .= ' <div class="icon col-md-3"><i class="fa '. esc_attr( $icon ) .'"></i></div>';
	}
	$output .= '<div class="content-item col-md-9">';
	if( ! empty( $title ) ) {
		$output .= '<h3>'. esc_attr( $title ) .'</h3>';
	}
	if( ! empty( $content ) ) {
		$output .= '<p>'. wpb_js_remove_wpautop( $content ) .'</p>';
	}
	$output .= '</div>';
}

$output .= '</div>';
global $majesty_allowed_tags;
echo wp_kses( $output, $majesty_allowed_tags  );