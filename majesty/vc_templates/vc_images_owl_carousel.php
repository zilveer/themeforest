<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var type
 * @var $images
 * @var $img_size
 * @var $onclick
 * @var $custom_links 
 * @var $custom_links_target
 * @var $autoplay
 * @var $stoponhover
 * @var $slidespeed
 * @var $lazyload
 * @var $navigation
 * @var $pagination
 * @var $paginationspeed
 * @var $pagination_marg_top
 * @var $items
 * @var $itemsdesktop
 * @var $itemsdesktopsmall
 * @var $itemstablet 
 * @var $itemsmobile 
 * @var $el_class
 */

wp_enqueue_script('owl-carousel'); 
$output = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'owl-carousel owl-theme' . $el_class . ' clearfix', $this->settings['base'], $atts );
if ( 'link_image' === $onclick ) {
	wp_enqueue_style( 'prettyphoto' );
	wp_enqueue_script( 'prettyphoto' );
	
}
if( $type == 'slider' ) {
	$slider_type = 'slider';
	$css_class .= ' theme-owl-slider';
} else {
	$slider_type = 'carousel';
	$css_class .= ' theme-owl-carousel';
}
if( $pagination_marg_top == '50px' ) {
	$css_class .= ' marg-pag-50';
}
if ( '' === $images ) {
	$images = '-1,-2,-3';
}

if ( 'custom_link' === $onclick ) {
	$custom_links = explode( ',', $custom_links );
}

$images = explode( ',', $images );
$i = - 1;
$carousel_id = 'theme-owl-carousel-' . rand(1,9999);

$output .= '<div id="'. esc_attr( $carousel_id ) .'" class="'. esc_attr( $css_class ) .'" data-slider-type="'. esc_attr( $slider_type ) .'" data-autoplay="'. esc_attr( $autoplay ) .'" 
			data-stoponhover="'. esc_attr( $stoponhover ) .'" data-slidespeed="'. esc_attr( $slidespeed ) .'" data-lazyload="'. esc_attr($lazyload) .'" 
			data-navigation="'. esc_attr( $navigation ) .'" data-pagination="'. esc_attr( $pagination ) .'" data-paginationspeed="'.  esc_attr( $paginationspeed ).'" data-items="'. absint( $items ) .'" data-itemsdesktop="'. absint( $itemsdesktop ) .'" data-itemsdesktopsmall="'. absint( $itemsdesktopsmall ) .'" data-itemstablet="'. absint( $itemstablet ) .'" data-itemsmobile="'. absint( $itemsmobile ) .'">';
foreach ( $images as $attach_id ){

	$i++;
	$before_img = '';
	$after_img  = '';
	if ( $attach_id > 0 ) {
		$img_url   = wp_get_attachment_image_src($attach_id, $img_size);
		$img_html = '<img src="'. esc_url( $img_url[0] ) .'" class="img-responsive img-centered" alt="" />';
	} else {
		$img_html = '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" class="img-responsive img-centered" alt="" />';
	}
	if ( 'link_image' === $onclick ) {
		$img_url   = wp_get_attachment_image_src($attach_id, 'full');
		$before_img = '<a href="'. esc_url( $img_url[0] ) .'" rel="lightbox">';
		$after_img  = '</a>';
	}
	if ( 'custom_link' === $onclick && isset( $custom_links[ $i ] ) && '' !== $custom_links[ $i ] ) {
		$link_target = '';
		if( ! empty( $custom_links_target ) ) {
			$link_target = ' target="' . $custom_links_target . '"';
		}
		$before_img = '<a href="'. esc_url( $custom_links[ $i ] ) .'"'. $link_target .'>';
		$after_img  = '</a>';
	}
	$output .= '<div class="item">';
	$output .= $before_img . $img_html . $after_img;
	$output .= '</div>';				
}
		
$output .= '</div>';
echo $output;