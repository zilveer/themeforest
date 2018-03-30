<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

/* ==========================================================================
	Theme options
============================================================================= */

if( ! function_exists( 'shiroi_option_defaults' ) ):

function shiroi_option_defaults() {
	return array(
		'accent_color' => shiroi_default_accent_color(), 
		'color_scheme' => 'default', 

		'body_bg' => '#f0f0f0', 
		'text_color' => '#444444', 
		'headings_color' => '#101010', 
		'base_border_color' => '#eaeaea', 
		'dotted_border_color' => '#d5d5d5', 
		'base_box_bg' => '#ffffff', 
		'header_top_bg' => '#1d1d1d', 
		'header_top_text_color' => '#a7a7a7', 
		'header_top_link_hover_color' => '#ffffff', 
		'header_bg' => '#ffffff', 
		'menu_link_color' => '#444444', 
		'menu_link_hover_color' => '#101010', 
		'menu_submenu_bg' => '#1d1d1d', 
		'menu_submenu_link_color' => '#a7a7a7', 
		'menu_submenu_link_hover_color' => '#ffffff', 
		'footer_bg' => '#383838', 
		'footer_text_color' => '#cccccc', 
		'footer_link_color' => '#fafafa', 
		'footer_link_hover_color' => '#ffffff', 
		'footer_bottom_bg' => '#2f2f2f', 
		'widget_box_bg' => '#ffffff', 
		'widget_title_color' => '#101010', 
		'widget_title_border_color' => '#d5d5d5', 
		'widget_border_color' => '#eaeaea', 
		'widget_footer_title_color' => '#fafafa', 
		'widget_footer_title_border_color' => '#4d4d4d', 
		'widget_footer_border_color' => '#4d4d4d', 

		'headings_font' => '', 
		'body_font' => '', 
		'blockquote_font' => '', 
		'menu_font' => '', 
		'post_meta_font' => '', 
		'post_label_font' => '', 
		'slider_title_font' => '', 
		'slider_meta_font' => '', 
		'slider_read_more_font' => '', 

		'show_top_bar' => true, 
		'top_bar_menu_fallback' => __( 'Welcome to my blog, a place where I write about stuffs.', 'shiroi' ), 

		'logo_image' => '', 
		'logo_top_padding' => 35, 
		'logo_bottom_padding' => 35, 
		'logo_max_width' => 200, 
		'logo_max_height' => 0, 

		'responsive_breakpoint' => 992, 

		'footer_copyright_text' => __( '&copy; 2012-2014. Youxi Themes. All Rights Reserved.', 'shiroi' ), 
		'footer_widget_areas' => 4, 

		'featured_slider_enabled' => true, 
		'featured_slider_overlap' => true, 
		'featured_slider_animate_text' => true, 
		'featured_slider_meta' => 'category', 
		'featured_slider_transition' => 'slide', 
		'featured_slider_transition_duration' => 300, 
		'featured_slider_autoplay_timeout' => 0, 
		'featured_slider_limit' => 0, 
		'featured_slider_orderby' => 'date', 
		'featured_slider_order' => 'DESC', 

		'blog_above_title_meta' => 'date', 
		'blog_below_title_meta' => array( 'author', 'category', 'comments' ), 
		'blog_header_alignment' => 'center', 
		'blog_featured_image_behavior' => 'img', 
		'blog_summary' => 'the_excerpt', 
		'blog_excerpt_length' => 100, 

		'blog_show_tags' => true, 
		'blog_sections' => array( 'values' => array( 'sharing', 'author', 'adjacent', 'related', 'comments' ) ), 
		'blog_related_posts_count' => 3, 

		'blog_index_layout' => 'right_sidebar', 
		'blog_index_sidebar' => 'default-sidebar', 
		'blog_index_layout_mode' => 'default', 
		'blog_archive_layout' => 'right_sidebar', 
		'blog_archive_sidebar' => 'default-sidebar', 
		'blog_archive_layout_mode' => 'default', 
		'blog_single_layout' => 'right_sidebar', 
		'blog_single_sidebar' => 'default-sidebar', 
		'blog_search_layout' => 'fullwidth', 
		'blog_search_sidebar' => '', 
		'blog_pagination' => 'pager', 

		'blog_category_title' => __( '{category}', 'shiroi' ), 
		'blog_category_subtitle' => __( 'Browsing Category', 'shiroi' ), 
		'blog_tag_title' => __( '&lsquo;{tag}&rsquo;', 'shiroi' ), 
		'blog_tag_subtitle' => __( 'Posts Tagged', 'shiroi' ), 
		'blog_author_title' => __( '{author}', 'shiroi' ), 
		'blog_author_subtitle' => __( 'Posts Written By', 'shiroi' ), 
		'blog_date_title' => __( '{date}', 'shiroi' ), 
		'blog_date_subtitle' => __( 'Posts Written On', 'shiroi' ), 
		'blog_search_title' => __( '&lsquo;{query}&rsquo;', 'shiroi' ), 
		'blog_search_subtitle' => __( 'Search Results For', 'shiroi' )
	);
}
endif;
add_filter( 'youxi_option_defaults', 'shiroi_option_defaults' );

if( ! function_exists( 'shiroi_option_ot_keys' ) ):

function shiroi_option_ot_keys() {
	return array(
		'custom_widget_areas', 
		'addthis_sharing_buttons', 
		'addthis_profile_id', 
		'social_profiles', 
		'custom_css'
	);
}
endif;
add_filter( 'youxi_option_ot_keys', 'shiroi_option_ot_keys' );

if( ! function_exists( 'shiroi_option_ot_on_off' ) ):

function shiroi_option_ot_on_off() {
	return array();
}
endif;
add_filter( 'youxi_option_ot_on_off', 'shiroi_option_ot_on_off' );