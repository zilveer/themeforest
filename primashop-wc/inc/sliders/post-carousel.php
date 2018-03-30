<?php
/**
 * Functions to handle post carousel shortcodes
 *
 * WARNING: This file is part of the PrimaShop parent theme.
 * Please do all modifications in the form of a child theme.
 *
 * @category   PrimaShop
 * @package    Sliders
 * @subpackage Post
 * @author     PrimaThemes
 * @link       http://www.primathemes.com
 */

/**
 * Register products carousel shortcodes.
 *
 * @since PrimaShop 1.1
 */ 
add_shortcode('prima_carousel_posts', 'prima_carousel_post_shortcodes');
function prima_carousel_post_shortcodes($atts, $content=null, $code=""){
	global $wp_query, $prima_shortcodes_scripts;
	extract(shortcode_atts(array(
		'post_type' => 'post',
		'category' 	=> null,
		'numbers' 	=> 10,
		'orderby' => 'date', 
		'order' => 'desc',
		'ids' => '',
		'image' 	=> 'yes',
		'image_width' 	=> 150,
		'image_height' 	=> 150,
		'animation' => 'slide',
		'margin' => '20',
		'min_items' => '2',
		'max_items' => '4',
		'move' => '0',
		'slideshow' => 'yes',
		'speed' 	=> '4000',
		'duration' 	=> '600',
		'nav_direction' => 'yes',
		'nav_control' 	=> 'no',
		'post_title' => 'yes',
		'limit_content' => '120',
	), $atts));
	$box_id = rand(1000, 9999);
	$query_args = array(
		'post_status' => 'publish',
		'ignore_sticky_posts' => 1,
	);
	if ( !empty($ids) ) { 
		$ids = explode(',', $ids);
		array_walk($ids, create_function('&$val', '$val = trim($val);'));
		$query_args['post__in'] = $ids;
		$query_args['posts_per_page'] = -1;
		$query_args['orderby'] = 'post__in';
	}
	else {
		$query_args['posts_per_page'] = $numbers;
		$query_args['post_type'] = $post_type;
		$query_args['orderby'] = $orderby;
		$query_args['order'] = $order;
	}
	if ( $category ) {
		$term = term_exists( $category, 'category' );
		if ($term !== 0 && $term !== null)
			$query_args['cat'] = $term['term_id'];
	}
	query_posts($query_args);
	if (have_posts()) : 
		$slider_class = array();
		$slider_class[] = 'flexslider';
		$slider_class[] = 'carousel';
		$slider_class[] = 'group';
		$slider_class[] = 'ps-slider';
		$slider_class[] = 'ps-slider-carousel';
		$slider_class[] = 'ps-slider-'.$post_type;
		$slider_class = implode(' ', $slider_class);
		$content = '<div id="slider-'.$box_id.'" class="'.$slider_class.'"><ul class="slides">';
	while (have_posts()) : the_post();
		global $post, $product;
		$content .= '<li>';
		if ( $image == 'yes' ) {
			$content .= '<div class="ps-slider-image">';
			$content .= '<a href="'.get_permalink().'">';
			$content .= prima_get_image( array( 'width' => $image_width, 'height' => $image_height ) );
			$content .= '</a>';
			$content .= '</div>';
		}
		$content .= '<div class="ps-slider-content">';
		if ( $post_title == 'yes' ) {
			$content .= '<h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
		}
		if ( $limit_content > 0 ) {
			$content .= prima_get_excerpt_limit( $limit_content, __( 'Read More &rarr;', 'primathemes' ) );
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
		$prima_shortcodes_scripts .= 'animationLoop: true,';
		$prima_shortcodes_scripts .= 'itemWidth: '.$image_width.',';
		$prima_shortcodes_scripts .= 'itemMargin: '.$margin.',';
		$prima_shortcodes_scripts .= 'minItems: '.$min_items.',';
		$prima_shortcodes_scripts .= 'maxItems: '.$max_items.',';
		$prima_shortcodes_scripts .= 'move: '.$move.',';
		$prima_shortcodes_scripts .= 'itemMargin: '.$margin.',';
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
	
	return $content;
}
