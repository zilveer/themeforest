<?php
wp_enqueue_style('prettyphoto');
wp_enqueue_script('prettyphoto');

$output = '';
$atts 	= vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$el_class = $this->getExtraClass( $el_class );
$css_classes = array( $el_class );
$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );

$output = '<a href="'. esc_url( $lightbox ) .'" rel="lightbox" title="'. esc_attr( $title ) .'" class="'. esc_attr( trim( $css_class ) ) .'">';
if( $type == 'image' ) {
	if( ! empty( $image ) ) {
		$img_url = wp_get_attachment_image_src($image, 'full');
		$output .= '<img src="'. esc_url( $img_url[0] ) .'" class="img-responsive" alt="">';
	}
} else {
	$output .= esc_attr( $title );
}
$output .= '</a>';

global $majesty_allowed_tags;
echo wp_kses( $output, $majesty_allowed_tags  );