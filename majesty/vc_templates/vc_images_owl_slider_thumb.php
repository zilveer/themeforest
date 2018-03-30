<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $images
 * @var $autoplay
 * @var $pagination
 * @var $paginationspeed
 * @var $pagination_marg_top
 * @var $items
 * @var $itemsdesktop
 * @var $el_class
 */

wp_enqueue_script('owl-carousel'); 
$output = $slider = $thumb = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'menu-thumb-slide' . $el_class . ' clearfix', $this->settings['base'], $atts );
$images = explode( ',', $images );
foreach ( $images as $attach_id ){
	if ( $attach_id > 0 ) {
		$img_url_larg   = wp_get_attachment_image_src($attach_id, 'full');
		$img_url_thumb	= wp_get_attachment_image_src($attach_id, 'majesty-slider-thumb');
		$img_html_larg  = '<img src="'. esc_url( $img_url_larg[0] ) .'" alt="" />';
		$img_html_thumb = '<img src="'. esc_url( $img_url_thumb[0] ) .'" alt="" />';
	} else {
		$img_html_larg  = '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" class="img-responsive img-centered" alt="" />';
		$img_html_thumb = '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" class="img-responsive img-centered" alt="" />';
	}
	
	//$thumbnail = $post_thumbnail['thumbnail'];
	$slider .= '<div class="item">'. $img_html_larg .'</div>';
	$thumb  .= '<div class="item">'. $img_html_thumb .'</div>';					
}
$slider_id    = 'single-img-' . rand(1,9999);
$carousel_id = 'thumb-img-' . rand(1,9999);
$output .= '<div class="'. esc_attr( $css_class ) .'">';
$output .= '<div id="'. esc_attr( $slider_id ) .'" class="owl-carousel single-img single-img-slider">'. $slider .'</div>';
$output .= '<div id="'. esc_attr( $carousel_id ) .'" class="owl-carousel thumb-img thumb-img-slider" data-pagination="'. esc_attr( $pagination ) .'" data-items="'. absint( $items ) .'" data-itemsdesktop="'. absint( $itemsdesktop ) .'">'. $thumb .'</div>';
$output .= '</div>';
global $majesty_allowed_tags;
echo wp_kses( $output, $majesty_allowed_tags  );