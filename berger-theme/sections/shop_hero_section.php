<?php
/**
 * Created by Clapat.
 * Date: 01/02/15
 * Time: 1:54 PM
 */

if( function_exists( 'wc_get_page_id' ) ){
	
	$shop_page_id = wc_get_page_id( 'shop' );
	
	// hero section container properties 
	global $cpbg_hero_scroll_opacity, $cpbg_hero_size, $cpbg_hero_position, $cpbg_hero_type, $cpbg_content_type;
	
	$cpbg_hero_type 			= redux_post_meta( THEME_OPTIONS, $shop_page_id, 'cpbg-opt-page-hero-type' );
	$cpbg_hero_size 			= redux_post_meta( THEME_OPTIONS, $shop_page_id, 'cpbg-opt-page-hero-height' );
	$cpbg_hero_position 		= redux_post_meta( THEME_OPTIONS, $shop_page_id, 'cpbg-opt-page-hero-position' );
	$cpbg_hero_scroll_opacity 	= redux_post_meta( THEME_OPTIONS, $shop_page_id, 'cpbg-opt-page-hero-scroll-opacity' );
	$cpbg_content_type			= redux_post_meta( THEME_OPTIONS, $shop_page_id, 'cpbg-opt-page-hero-content' );
	
	// hero section image properties 
	global $cpbg_hero_image, $cpbg_hero_image_overlay_color, $cpbg_hero_image_overlay_color_opacity, $cpbg_hero_image_caption, $cpbg_hero_image_caption_position;
	
	$cpbg_hero_image 						= redux_post_meta( THEME_OPTIONS, $shop_page_id, 'cpbg-opt-page-hero-image' );
	$cpbg_hero_image_overlay_color 			= redux_post_meta( THEME_OPTIONS, $shop_page_id, 'cpbg-opt-page-hero-image-overlay-color' );
	$cpbg_hero_image_overlay_color_opacity 	= redux_post_meta( THEME_OPTIONS, $shop_page_id, 'cpbg-opt-page-hero-image-overlay-color-opacity' );
	$cpbg_hero_image_caption 				= redux_post_meta( THEME_OPTIONS, $shop_page_id, 'cpbg-opt-page-hero-image-caption' );
	$cpbg_hero_image_caption_position 		= redux_post_meta( THEME_OPTIONS, $shop_page_id, 'cpbg-opt-page-hero-image-caption-position' );
	
	
	// hero section video properties
	global $cpbg_video_url, $cpbg_video_placeholder;
	
	$cpbg_video_url 		= redux_post_meta( THEME_OPTIONS, $shop_page_id, 'cpbg-opt-page-hero-video-url' );
	$cpbg_video_placeholder	= redux_post_meta( THEME_OPTIONS, $shop_page_id, 'cpbg-opt-page-hero-video-placeholder' );
	
	if( $cpbg_hero_type != 'none' ){
	
		get_template_part('sections/hero_section_container'); 
	}

}

?>