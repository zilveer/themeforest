<?php
$output = '';
$atts 	= vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$el_class = $this->getExtraClass( $el_class );
$css_classes = array( 'testimonials', $el_class );
if( $align == 'right' ) {
	$css_classes[] = 'text-right';
} else {
	$css_classes[] = 'text-left';
}
$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output .= '<div '. implode( ' ', $wrapper_attributes ) .'>';
if( $align == 'right' ) {
	if( ! empty( $image ) ) {
		$img_url = wp_get_attachment_image_src($image, 'full');
		$output .= '<div class="quote_image"><div class="col-sm-2 pull-right"><img src="'. esc_url( $img_url[0] ) .'" class="img-responsive" alt="'. esc_attr( strip_tags( $author ) ) .'"></div></div>';
	}
	$output .= '<div class="col-sm-10 pull-left">';
	if( ! empty( $content ) ) {
		$output .= '<blockquote><p>'. esc_attr( $content ) .'</p></blockquote>';
	}
	if( ! empty( $author ) ) {
		$output .= '<div class="author_name"><p>'. esc_attr( $author ) .'</p></div>';
	}
	$output .= '</div>';
} else {
	if( ! empty( $image ) ) {
		$img_url = wp_get_attachment_image_src($image, 'full');
		$output .= '<div class="quote_image"><div class="col-sm-2 pull-left"><img src="'. esc_url( $img_url[0] ) .'" class="img-responsive" alt="'. esc_attr( strip_tags( $author ) ) .'"></div></div>';
	}
	$output .= '<div class="col-sm-10 pull-right">';
	if( ! empty( $content ) ) {
		$output .= '<blockquote><p>'. esc_attr( $content ) .'</p></blockquote>';
	}
	if( ! empty( $author ) ) {
		$output .= '<div class="author_name"><p>'. esc_attr( $author ) .'</p></div>';
	}
	$output .= '</div>';
}

$output .= '</div>';
global $majesty_allowed_tags;
echo wp_kses( $output, $majesty_allowed_tags  );