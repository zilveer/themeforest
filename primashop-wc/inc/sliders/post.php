<?php
/**
 * Functions to handle post slider shortcodes
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
 * Register post slider shortcodes.
 *
 * @since PrimaShop 1.1
 */ 
add_shortcode('prima_slider_posts', 'prima_slider_post_shortcodes');
function prima_slider_post_shortcodes($atts, $content=null, $code=""){
	global $wp_query, $prima_shortcodes_scripts;
	extract(shortcode_atts(array(
		'post_type' => 'post',
		'category' 	=> null,
		'numbers' 	=> 5,
		'orderby' => 'date', 
		'order' => 'desc',
		'ids' => '',
		'image_width' 	=> null,
		'image_height' 	=> null,
		'post_title' 	=> 'yes',
		'animation' => 'fade',
		'slideshow' => 'yes',
		'speed' 	=> '4000',
		'duration' 	=> '600',
		'nav_direction' => 'yes',
		'nav_control' 	=> 'yes',
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
		switch($code){
			case 'prima_slider_posts':
				$post_type = 'post';
			break;
			case 'prima_slider_pages':
				$post_type = 'page';
			break;
		}
		$query_args['post_type'] = $post_type;
		$query_args['orderby'] = $orderby;
		$query_args['order'] = $order;
		if ( $category ) {
			$term = term_exists( $category, 'category' );
			if ($term !== 0 && $term !== null)
				$query_args['cat'] = $term['term_id'];
		}
	}
	query_posts($query_args);
	if (have_posts()) : 
		$slider_class = array();
		$slider_class[] = 'flexslider';
		$slider_class[] = 'group';
		$slider_class[] = 'ps-slider';
		$slider_class[] = 'ps-slider-overlay';
		$slider_class[] = 'ps-slider-'.$post_type;
		if ( $nav_control == 'thumbnails' ) {
			$numbers = $wp_query->post_count ? $wp_query->post_count : $numbers;
			$slider_class[] = 'ps-slider-thumbs-'.$numbers;
		}
		$slider_class = implode(' ', $slider_class);
		$content = '<div id="slider-'.$box_id.'" class="'.$slider_class.'"><ul class="slides">';
	while (have_posts()) : the_post();
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
		$content .= '</div>';
		if ( $post_title == 'yes' ) {
			$content .= '<div class="ps-slider-content">';
			$content .= '<h2><a href="'.get_permalink().'" title="'.the_title_attribute('echo=0').'">'.get_the_title().'</a></h2>';
			$content .= '</div>';
		}
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
	return $content;
}
