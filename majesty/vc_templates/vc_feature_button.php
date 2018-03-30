<?php
$output = $icon_html = $wrapper_attributes = '';
$atts 	= vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$el_class = $this->getExtraClass( $el_class );
$css_classes = array( $el_class );


if( isset( $css_animation_type) && ! empty( $css_animation_type ) ) {
	$css_classes[] = 'animated';	
	$wrapper_attributes[] = ' data-animation="'. esc_attr( $css_animation_type ) .'"';
	if( isset( $css_animation_delay) && ! empty( $css_animation_delay ) ) {
		$wrapper_attributes[] = ' data-animation-delay="'. absint( $css_animation_delay ) .'"';
	}
}
if( $type == 'bootstrap_btn' ) {
	if( ! empty( $bootstrap_size ) ) {
		$css_classes[] =  esc_attr( $bootstrap_size );
	}
	$css_classes[] =  esc_attr( $bootstrap_bg );
} else {
	if( ! empty ( $customcolor ) && $bgcolor == 'custom' ) {
		$wrapper_attributes[] = ' style="background:'. $customcolor .';"';
		$css_classes[] = esc_attr( $size );
	} else {
		$css_classes[] = esc_attr( $bgcolor );
		$css_classes[] =  esc_attr( $size );
	}
	if( $border == 'yes' ) {
		$css_classes[] ='display-border';
	}
	if( $corner == 'yes' ) {
		$css_classes[] = 'corner-btns';
	} else {
		$css_classes[] = 'no-corner-btns';
	}
}

if( ! empty( $icon ) ) {
	$css_classes[] = $icon_pos;
	$icon_html = '<i class="fa '. esc_attr( $icon ) .'"></i>';
}

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output = '<span class="btns-group"><a href="'. esc_url($href) .'" title="'. esc_attr(strip_tags($title)) .'" '. implode( ' ', $wrapper_attributes ) .'>';
if( $icon_pos != 'icon_right' ) {
	$output .= $icon_html . esc_attr( $title );
} else {
	$output .= esc_attr( $title ) . $icon_html;
}
$output .= '</a></span>';
global $majesty_allowed_tags;
echo wp_kses( $output, $majesty_allowed_tags  );