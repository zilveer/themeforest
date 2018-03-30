<?php
$output = '';

$atts 	= vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$el_class = $this->getExtraClass( $el_class );
$css_classes = array( 'google-map', $el_class );
$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );

$allowed_tags 	= sama_allowed_html();
$zoom 			= absint($zoom);
if( $zoom < 0 ) {
	$zoom = 17;
}
if( ! empty( $image ) ) {
	$img_url = wp_get_attachment_image_src($image, 'full');
	$image  = esc_url($img_url[0]);
}
if( isset( $style ) && $style == 'dark' ) {
	$style = 'dark';
} else {
	$style = 'light';
}
global $majesty_allowed_tags;
echo '<div class="'. esc_attr( trim( $css_class ) ) .'">';
	
if( ! empty( $content ) ) {
	echo '<div class="custom-google-map-desc">'. wp_kses( force_balance_tags(wpb_js_remove_wpautop($content)), $majesty_allowed_tags  ) .'</div>';
}
echo '<div id="custom-map" class="map custom-google-map'. esc_attr($el_class) .'" data-map-style="'. esc_attr($style) .'" data-map-title="'. esc_attr($title) .'" data-map-latlang="'. esc_attr($latlang) .'" data-map-zoom="'. absint($zoom) .'" data-map-image="'. esc_url( $image ).'"></div></div>';