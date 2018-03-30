<?php
/**
 * Shortcode attributes
 * @var $title
 * @var $image
 * @var $url
 * @var $desc
 * @var $price
 * @var $featured_txt
 * @var $pricecolor
 * @var $featuredcolor
 * @var $marginb
 * @var $css_animation_type
 * @var $css_animation_delay
 * @var $dotted
 * @var $circleimg  ver 1.2.9
 * @var $el_class
 */

$output = $link_before = $link_after = $featuredtext = '';
$atts 	= vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$el_class = $this->getExtraClass( $el_class );
$css_classes = array( 'menu-item-list','single-menu-item', $el_class );

if( isset( $css_animation_type) && ! empty( $css_animation_type ) ) {
	$css_classes[] = 'animated';	
	$wrapper_attributes[] = ' data-animation="'. esc_attr( $css_animation_type ) .'"';
	if( isset( $css_animation_delay) && ! empty( $css_animation_delay ) ) {
		$wrapper_attributes[] = ' data-animation-delay="'. absint( $css_animation_delay ) .'"';
	}
}

if( empty( $image ) && empty( $marginb ) ) {
	$css_classes[] = 'item-m-20';
} elseif( ! empty( $image ) && empty( $marginb ) ) {
	$css_classes[] = 'item-m-60';
}

if( ! empty( $marginb ) ) {
	if( $marginb == 'mb60' ) {
		$css_classes[] = 'item-m-60';
	} else {
		$css_classes[] = esc_attr($marginb);
	}
	
}
if( isset( $dotted ) && $dotted == 'true' ) {
	$css_classes[] = 'item-with-dotted';
}
if( isset( $circleimg ) && $circleimg == 'true' ) {
	$css_classes[] = 'img-with-circle';
}

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output .= '<div '. implode( ' ', $wrapper_attributes ) .'>';
if( ! empty( $image ) ) {
	$img_url = wp_get_attachment_image_src($image, 'full');
	$output .= '<div class="item-img"><img src="'. esc_url( $img_url[0] ) .'" alt="'. esc_attr( strip_tags( $title ) ) .'"></div>';
}
if( ! empty( $title ) ) {
	$output .= '<h3>';
	if( ! empty( $url ) ) {
		$href = vc_build_link($url);
		if(  empty( $href['title'] ) ) {
			$href['title'] = $title;
		}
		if(  empty( $href['target'] ) ) {
			$href['target'] = '_self';
		}
		if( ! empty( $href['url'] ) ) {
			$link_before = '<a href="'. esc_url( $href['url'] ) .'" title="'. esc_attr( $href['title'] ) .'" target="'. esc_attr( trim($href['target']) )  .'">';
			$link_after  = '</a>';
		}
	}
	if( ! empty( $featured_txt ) ) {
		$css = 'label';
		if( ! empty( $featuredcolor ) ) {
			$css = 'label '. $featuredcolor;
		}
		$featuredtext = ' <span class="'. esc_attr( $css ) .'">'. esc_attr( $featured_txt ) .'</span>';
	}
	$output .= '<span class="menu-title">' . $link_before . esc_attr( $title ). $link_after . $featuredtext .'</span>';
	
	if( isset( $dotted ) && $dotted == 'true' ) {
		$output .= '<span class="dotted"></span>';
	}
	if( ! empty( $price ) ) {
		if( $pricecolor == 'dark' ) {
			$output .= '<span class="price dark">'. esc_attr( $price ) .'</span>';
		} else {
			$output .= '<span class="price">'. esc_attr( $price ) .'</span>';
		}
	}
	$output .= '</h3>';
}
if( ! empty( $desc ) ) {
	$output .= '<p>'. wpb_js_remove_wpautop( $desc ) .'</p>';
}
$output .= '</div>';
global $majesty_allowed_tags;
echo wp_kses( $output, $majesty_allowed_tags  );