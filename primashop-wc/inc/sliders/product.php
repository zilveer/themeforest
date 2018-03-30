<?php
/**
 * Functions to handle products slider shortcodes
 *
 * WARNING: This file is part of the PrimaShop parent theme.
 * Please do all modifications in the form of a child theme.
 *
 * @category   PrimaShop
 * @package    Sliders
 * @subpackage Product
 * @author     PrimaThemes
 * @link       http://www.primathemes.com
 */

/**
 * Register products slider shortcodes.
 *
 * @since PrimaShop 1.1
 */ 
add_shortcode('prima_slider_products', 'prima_slider_product_shortcodes');
function prima_slider_product_shortcodes($atts, $content=null, $code=""){
	global $wp_query, $woocommerce, $prima_shortcodes_scripts;
	extract(shortcode_atts(array(
		'post_type' => 'product',
		'mode' => '',
		'name' => '',
		'numbers' 	=> 5,
		'orderby' => 'date', 
		'order' => 'desc',
		'ids' => '',
		'background' => 'no',
		'image_width' 	=> null,
		'image_height' 	=> null,
		'animation' => 'fade',
		'slideshow' => 'yes',
		'speed' 	=> '4000',
		'duration' 	=> '600',
		'nav_direction' => 'yes',
		'nav_control' 	=> 'yes',
		'product_saleflash' => 'yes',
		'product_price' => 'yes',
		'product_summary' => 'yes',
		'product_button' => 'yes',
		'button_text' => __( 'Buy Now', 'primathemes' ),
	), $atts));
	$box_id = rand(1000, 9999);
	$query_args = array(
		'post_status' => 'publish',
		'ignore_sticky_posts' => 1,
		'posts_per_page' => $numbers,
	);
	$query_args['post_type'] = $post_type;
	$query_args['orderby'] = $orderby;
	$query_args['order'] = $order;
	$query_args['meta_query'] = $woocommerce->query->get_meta_query();
	switch( $mode ){
		case 'ids':
			if ( empty( $ids ) ) return '<p class="woocommerce-info">'.__('No defined IDs in the current shortcode.', 'primathemes').'</p>';
			$ids = explode(',', $ids);
			array_walk($ids, create_function('&$val', '$val = trim($val);'));
			$query_args['post__in'] = $ids;
			$query_args['posts_per_page'] = -1;
			$query_args['orderby'] = 'post__in';
		break;
		case 'featured':
			$query_args['meta_query'][] = array(
				'key' => '_featured',
				'value' => 'yes'
			);
		break;
		case 'onsale':
			$product_ids_on_sale = woocommerce_get_product_ids_on_sale();
			$product_ids_on_sale[] = 0;
			$query_args['no_found_rows'] = 1;
			$query_args['post__in'] = $product_ids_on_sale;
		break;
		case 'bestsellers':
			$query_args['orderby'] = 'meta_value_num';
			$query_args['meta_key'] = 'total_sales';
			$query_args['no_found_rows'] = 1;
		break;
		case 'toprated':
			add_filter( 'posts_clauses',  array( $woocommerce->query, 'order_by_rating_post_clauses' ) );
			$query_args['no_found_rows'] = 1;
		break;
		case 'category':
			$term = term_exists( $name, 'product_cat' );
			if ($term !== 0 && $term !== null) {
				$query_args['tax_query'] = array(
					array(
						'taxonomy' => 'product_cat',
						'field' => 'id',
						'terms' => array( $term['term_id'] ),
						'operator' => 'IN'
					)
				);
			}
			else {
				return '<p class="woocommerce-info">'.sprintf( __('%s product category does not exist.', 'primathemes'), $name ).'</p>';
			}
		break;
		case 'tag':
			$term = term_exists( $name, 'product_tag' );
			if ($term !== 0 && $term !== null) {
				$query_args['tax_query'] = array(
					array(
						'taxonomy' => 'product_tag',
						'field' => 'id',
						'terms' => array( $term['term_id'] ),
						'operator' => 'IN'
					)
				);
			}
			else {
				return '<p class="woocommerce-info">'.sprintf( __('%s product tag does not exist.', 'primathemes'), $name ).'</p>';
			}
		break;
	}
	query_posts($query_args);
	if (have_posts()) : 
		$slider_class = array();
		$slider_class[] = 'flexslider';
		$slider_class[] = 'group';
		$slider_class[] = 'ps-slider';
		$slider_class[] = 'ps-slider-2columns';
		$slider_class[] = 'ps-slider-'.$post_type;
		if ( $background == 'yes' ) {
			$slider_class[] = 'ps-slider-withbg';
		}
		else {
			$slider_class[] = 'ps-slider-nobg';
		}
		if ( $nav_control == 'thumbnails' ) {
			$numbers = $wp_query->post_count ? $wp_query->post_count : $numbers;
			$slider_class[] = 'ps-slider-thumbs-'.$numbers;
		}
		$slider_class[] = 'woocommerce';
		$slider_class = implode(' ', $slider_class);
		$content = '<div id="slider-'.$box_id.'" class="'.$slider_class.'"><ul class="slides">';
	while (have_posts()) : the_post();
		global $post, $product;
		if ( $nav_control == 'thumbnails' ) {
			$content .= '<li data-thumb="'.prima_get_image( array( 'output' => 'url', 'width' => $image_width, 'height' => $image_height ) ).'">';
		}
		else {
			$content .= '<li>';
		}
		$content .= '<div class="ps-slider-image">';
		$content .= '<a href="'.get_permalink().'">';
		$content .= prima_get_image( array( 'width' => $image_width, 'height' => $image_height ) );
		$content .= '</a>';
		if ( $product_saleflash == 'yes' && $product->is_on_sale() ) { 
			$content .= apply_filters('woocommerce_sale_flash', '<span class="onsale">'.__( 'Sale!', 'primathemes' ).'</span>', $post, $product);
		}
		$content .= '</div>';
		$content .= '<div class="ps-slider-content">';
		$content .= '<h3>'.get_the_title().'</h3>';
		if ( $product_price == 'yes' ) {
			$content .= '<p class="price">'.$product->get_price_html().'</p>';
		}
		if ( $product_summary == 'yes' ) {
			$content .= wpautop( apply_filters( 'woocommerce_short_description', $post->post_excerpt ) );
		}
		if ( $product_button == 'yes' ) {
			$button_text = empty( $button_text ) ? __( 'Buy Now', 'primathemes' ) : $button_text;
			$content .= '<a class="ps-button large" href="'.get_permalink().'">'.$button_text.'</a>';
		}
		$content .= '</div>';
		$content .= '</li>';
	endwhile;
		$content .= '</ul></div>';
		$prima_shortcodes_scripts .= 'jQuery(window).load(function() {';
		$prima_shortcodes_scripts .= 'jQuery("#slider-'.$box_id.'").flexslider({';
		if ( $animation == 'slide' ) {
			$prima_shortcodes_scripts .= 'animation: "slide",';
			$prima_shortcodes_scripts .= 'slideDirection: "horizontal",';
		}
		elseif ( $animation == 'slide_reverse' ) {
			$prima_shortcodes_scripts .= 'animation: "slide",';
			$prima_shortcodes_scripts .= 'slideDirection: "horizontal",';
			$prima_shortcodes_scripts .= 'reverse: "reverse",';
		}
		elseif ( $animation == 'fade' ) {
			$prima_shortcodes_scripts .= 'animation: "fade",';
		}
		$prima_shortcodes_scripts .= 'slideshowSpeed: '.$speed.',';
		$prima_shortcodes_scripts .= 'animationDuration: '.$duration.',';
		if ( $nav_direction == 'yes' ) {
			$prima_shortcodes_scripts .= 'directionNav: true,';
		}
		elseif ( $nav_direction == 'no' ) {
			$prima_shortcodes_scripts .= 'directionNav: false,';
		}
		if ( $nav_control == 'yes' ) {
			$prima_shortcodes_scripts .= 'controlNav: true,';
		}
		elseif ( $nav_control == 'no' ) {
			$prima_shortcodes_scripts .= 'controlNav: false,';
		}
		elseif ( $nav_control == 'thumbnails' ) {
			$prima_shortcodes_scripts .= 'controlNav: "thumbnails",';
		}
		if ( $slideshow == 'yes' ) {
			$prima_shortcodes_scripts .= 'slideshow: true,';
		}
		elseif ( $slideshow == 'no' ) {
			$prima_shortcodes_scripts .= 'slideshow: false,';
		}
		$prima_shortcodes_scripts .= 'pauseOnHover: true';
		$prima_shortcodes_scripts .= '});';
		$prima_shortcodes_scripts .= '});';
		$prima_shortcodes_scripts .= "\n";
	endif;
	wp_reset_query();
	switch( $mode ){
		case 'toprated':
			remove_filter( 'posts_clauses', array( $woocommerce->query, 'order_by_rating_post_clauses' ) );
		break;
	}
	
	return $content;
}
