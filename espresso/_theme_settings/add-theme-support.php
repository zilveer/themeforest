<?php

function espresso_setup() {

	load_theme_textdomain( 'espresso', get_template_directory() . '/languages' );

	// Post Thumbnails
	add_theme_support('post-thumbnails');
	add_theme_support('post-formats', array( 'gallery', 'audio', 'video'));
	set_post_thumbnail_size(66,66,true);
	
	// Main Images (slider and page banners)
	add_image_size('slide-image',2000,553,true);
	add_image_size('page-banner',2000,200,true);
	
	// Lightbox images and medium thumbnails
	add_image_size('gallery-thumb',500,500,false);
	add_image_size('lightbox-large',1500,1500,false);

	// Post Thumbnails
	add_image_size('recent-post-thumbnail',600,240,true);
	add_image_size('recent-post-thumbnail-square',600,600,true);
	add_image_size('feature-block-half',450,120,true);
	add_image_size('feature-block-full',940,120,true);
	
	// Single Post Images
	add_image_size('single-featured-sm',600,600,false);
	add_image_size('single-featured-full',940,940,false);

	// Timthumb replacements
	add_image_size( 'image-preview', 79, 87, true);
	add_image_size( 'image-id', 30, 20, true);
	add_image_size( 'big-id', 149, 87, true);
	add_image_size( 'slide', 1440, 558, true);
	
	// Navigation
	add_theme_support('menus');
	register_nav_menus(array( 'main-menu' => __( 'Main Menu','espresso' ), 'mobile-menu' => __( 'Mobile Menu','espresso' )));

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

}
add_action( 'after_setup_theme', 'espresso_setup' );