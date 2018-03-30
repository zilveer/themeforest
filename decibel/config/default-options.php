<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function wolf_theme_default_options_init() {

	$theme_options = get_option( 'wolf_theme_options_' . wolf_get_theme_slug() );
	$default_header_content = '<h1 style="text-align:center;">WELCOME ON OUR WEBSITE!</h1>';
	$default_header_img = wolf_get_theme_uri( '/images/presets/header.jpg' );

	$default_options = array(

		// Main
		'accent_color' => '#c74735',
		'responsive' => 'true',
		'layout' => 'wide',
		'lightbox' => 'fancybox',

		// Home
		'home_header_type' => 'video',
		'video_header_bg_type' => 'selfhosted',
		'video_header_bg_mp4' => wolf_get_theme_uri( '/images/presets/gram.mp4' ),
		'hero_fade_while_scroll' => 'true',
		'home_header_content' => $default_header_content,
		'home_header_height' => 85,
		'header_bg_font_color' => 'light',

		'header_overlay_color' => '#000',
		'header_overlay_opacity' => 30,

		'slider_speed' => 5000,

		// Menu
		'breakpoint' => 1140,
		'sticky_menu' => 'true',
		'menu_width' => 'boxed',
		'menu_style' => 'transparent',
		'menu_hover_effect' => 'default',
		'search_menu_item' => 'true',
		'cart_menu_item' => 'true',
		'menu_position' => 'default',
		'menu_skin' => 'light',

		'additional_toggle_menu' => 'true',
		'additional_toggle_menu_type' => 'side',

		// header
		'page_header_type' => 'medium',

		// blog
		'date_format' => 'human_diff',
		'excerpt_type' => 'auto',
		'blog_type' => 'sidebar',
		'blog_width' => 'boxed',
		'post_views' => 'true',
		'post_likes' => 'true',
		'post_share' => 'true',
		'show_author_box' => 'true',

		// albums
		'gallery_isotope' => 'true',
		'gallery_type' => 'vertical',

		// videos
		'video_isotope' => 'true',
		'video_type' => 'youtube-all',
		'video_author' => 'true',
		'video_views' => 'true',
		'video_likes' => 'true',
		'video_comments' => 'true',
		'video_share' => 'true',
		'video_embed' => 'true',

		// discography
		'release_type' => 'grid',
		'release_cols' => 3,
		'release_width' => 'boxed',
		'release_padding' => 'padding',

		// woocommerce
		'products_per_page' => 12,

		// share
		'social_meta' => 'true',
		'show_author_box' => 'true',
		'show_share_box_single' => 'true',
		'share_text' => 'Share',
		'share_facebook' => 'true',
		'share_twitter' => 'true',
		'share_pinterest' => 'true',

		// fonts
		'google_fonts' => '',

		'heading_font_name' => 'Montserrat',
		'menu_font_name' => 'Open Sans',
		'menu_font_transform' => 'uppercase',
		'entry_meta_font_name' => 'Montserrat',

		// socials
		'facebook' => '#',
		'twitter' => '#',

		// footer
		'bottom_socials' => 'true',
		'copyright_textbox' => '&copy; Powered by Wordpress',

		// misc
		'page_transition' => 'yes',
		'loader' => 'yes',
		'loader_type' => 'loader8',
		'js_min' => 'true',
		'css_min' => 'true',

	);

	if ( ! $theme_options ) {

		add_option( 'wolf_theme_options_' . wolf_get_theme_slug(), $default_options );
	}

	// default WP settings
	//update_option( 'image_default_link_type', 'lightbox' );

	// woo thumbnails
	$catalog = array(
		'width' 	=> '400',	// px
		'height'	=> '400',	// px
		'crop'	=> 1 		// true
	);

	$single = array(
		'width' 	=> '600',	// px
		'height'	=> '600',	// px
		'crop'	=> 1 		// true
	);

	$thumbnail = array(
		'width' 	=> '120',	// px
		'height'	=> '120',	// px
		'crop'	=> 0 		// false
	);

	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail );
	update_option( 'woocommerce_enable_lightbox', 'no' );
}