<?php
/**
 * Created by Clapat.
 * Date: 01/02/15
 * Time: 1:54 PM
 */

$post_type = get_post_type();

// hero section container properties 
global $cpbg_hero_scroll_opacity, $cpbg_hero_size, $cpbg_hero_position, $cpbg_hero_type, $cpbg_content_type, $cpbg_use_main_slider, $cpbg_custom_slider;

if( $post_type == THEME_ID . '_portfolio' ){
	$cpbg_hero_type 			= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-portfolio-hero-type' );
	$cpbg_hero_size 			= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-portfolio-hero-height' );
	$cpbg_hero_position 		= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-portfolio-hero-position' );
	$cpbg_hero_scroll_opacity 	= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-portfolio-hero-scroll-opacity' );
	$cpbg_content_type			= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-portfolio-hero-content' );
	$cpbg_use_main_slider		= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-portfolio-hero-use-main-slider' );
	$cpbg_custom_slider			= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-portfolio-hero-custom-slider' );
} else if( $post_type == 'post' ){
    $cpbg_hero_type 			= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-post-hero-type' );
    $cpbg_hero_size 			= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-post-hero-height' );
    $cpbg_hero_position 		= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-post-hero-position' );
    $cpbg_hero_scroll_opacity 	= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-post-hero-scroll-opacity' );
    $cpbg_content_type			= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-post-hero-content' );
	$cpbg_use_main_slider		= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-post-hero-use-main-slider' );
	$cpbg_custom_slider			= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-post-hero-custom-slider' );
} else {
	$cpbg_hero_type 			= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-page-hero-type' );
	$cpbg_hero_size 			= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-page-hero-height' );
	$cpbg_hero_position 		= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-page-hero-position' );
	$cpbg_hero_scroll_opacity 	= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-page-hero-scroll-opacity' );
	$cpbg_content_type			= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-page-hero-content' );
	$cpbg_use_main_slider		= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-page-hero-use-main-slider' );
	$cpbg_custom_slider			= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-page-hero-custom-slider' );
}

// hero section image properties 
global $cpbg_hero_image, $cpbg_hero_image_overlay_color, $cpbg_hero_image_overlay_color_opacity, $cpbg_hero_image_caption, $cpbg_hero_image_caption_position;

if( $post_type == THEME_ID . '_portfolio' ){
	$cpbg_hero_image 						= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-portfolio-hero-image' );
	$cpbg_hero_image_overlay_color 			= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-portfolio-hero-image-overlay-color' );
	$cpbg_hero_image_overlay_color_opacity 	= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-portfolio-hero-image-overlay-color-opacity' );
	$cpbg_hero_image_caption 				= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-portfolio-hero-image-caption' );
	$cpbg_hero_image_caption_position 		= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-portfolio-hero-image-caption-position' );
}
else if( $post_type == 'post' ){
    $cpbg_hero_image 						= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-post-hero-image' );
    $cpbg_hero_image_overlay_color 			= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-post-hero-image-overlay-color' );
    $cpbg_hero_image_overlay_color_opacity 	= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-post-hero-image-overlay-color-opacity' );
    $cpbg_hero_image_caption 				= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-post-hero-image-caption' );
    $cpbg_hero_image_caption_position 		= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-post-hero-image-caption-position' );
}
else{
	$cpbg_hero_image 						= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-page-hero-image' );
	$cpbg_hero_image_overlay_color 			= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-page-hero-image-overlay-color' );
	$cpbg_hero_image_overlay_color_opacity 	= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-page-hero-image-overlay-color-opacity' );
	$cpbg_hero_image_caption 				= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-page-hero-image-caption' );
	$cpbg_hero_image_caption_position 		= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-page-hero-image-caption-position' );
}

// hero section video properties
global $cpbg_video_url, $cpbg_video_placeholder;

if( $post_type == THEME_ID . '_portfolio' ){
	$cpbg_video_url 		= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-portfolio-hero-video-url' );
	$cpbg_video_placeholder	= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-portfolio-hero-video-placeholder' );
}
else if( $post_type == 'post' ){
    $cpbg_video_url 		= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-post-hero-video-url' );
    $cpbg_video_placeholder	= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-post-hero-video-placeholder' );
} else {
	$cpbg_video_url 		= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-page-hero-video-url' );
	$cpbg_video_placeholder	= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-page-hero-video-placeholder' );
}

if( $cpbg_hero_type != 'none' ){

	get_template_part('sections/hero_section_container'); 
}

?>