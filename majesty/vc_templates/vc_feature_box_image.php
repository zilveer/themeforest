<?php
$output = '';
$atts 	= vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$el_class = $this->getExtraClass( $el_class );
$css_classes = array( 'date-blocks', 'text-center', $el_class );

if( isset( $css_animation_type) && ! empty( $css_animation_type ) ) {
	$css_classes[] = 'animated';	
	$wrapper_attributes[] = ' data-animation="'. esc_attr( $css_animation_type ) .'"';
	if( isset( $css_animation_delay) && ! empty( $css_animation_delay ) ) {
		$wrapper_attributes[] = ' data-animation-delay="'. absint( $css_animation_delay ) .'"';
	}
}
$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output .= '<div '. implode( ' ', $wrapper_attributes ) .'>';
$output .= '<div class="block-item">';
if( ! empty( $image ) ) {
	$img_url = wp_get_attachment_image_src($image, 'full');
	$output .= '<img src="'. esc_url( $img_url[0] ) .'" alt="'. esc_attr( strip_tags( $title ) ) .'">';
}
if( ! empty( $title ) ) {
	$output .= '<h2>'. esc_attr( $title ) .'</h2>';
}
if( ! empty( $content ) ) {
	$output .= '<p>'. wpb_js_remove_wpautop( $content ) .'</p>';
}
$output .= '</div>';
$output .= '</div>';
global $majesty_allowed_tags;
echo wp_kses( $output, $majesty_allowed_tags  );