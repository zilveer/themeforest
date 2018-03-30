<?php
$output = '';
$atts 	= vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$el_class = $this->getExtraClass( $el_class );
$css_classes = array( 'menu_today', 'dark', $el_class );

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
$output .= '<div class="menu_today_item"><figure>';
if( ! empty( $image ) ) {
	$img_url = wp_get_attachment_image_src($image, 'full');
	$output .= '<img src="'. esc_url( $img_url[0] ) .'" class="img-responsive" alt="'. esc_attr( strip_tags( $title ) ) .'">';
}
$output .= '<figcaption class="text-center"><div class="fig_container">';
if( ! empty( $title ) ) {
	$output .= '<h3>'. esc_attr( $title ) .'</h3>';
}
if( ! empty( $content ) ) {
	$output .= '<p>'. wpb_js_remove_wpautop( $content ) .'</p>';
}
$output .= '</div></figcaption>';
$output .= '</figure>';
$output .= '</div></div>';
global $majesty_allowed_tags;
echo wp_kses( $output, $majesty_allowed_tags  );
