<?php

function dcs_load_scripts() {

	// load WP's included jQuery library
	wp_enqueue_script('jquery');

	// global scripts
	wp_enqueue_script('jquery-easing', get_template_directory_uri() . '/includes/js/jquery.easing.1.3.js');
	wp_enqueue_script('jquery-fancybox', get_template_directory_uri() . '/includes/fancybox/jquery.fancybox.pack.js');
	wp_enqueue_script('jquery-fancybox', get_template_directory_uri() . '/includes/jquery.fitvids.js');
	
	// sticky header
	if (of_get_option('sticky_header') == 'yes') { 
		wp_enqueue_script('jquery-sticky', get_template_directory_uri() . '/includes/js/jquery.sticky.js');
	}
	
	// load singular (posts and pages) scripts
	if ( is_singular() ) {
		wp_enqueue_script( 'comment-reply' ); //enable nested comments 
	}
	
	// front page scripts
	if (is_front_page()) { 
		wp_enqueue_script('jquery-slides', get_template_directory_uri() . '/includes/js/slides.jquery.js');
	}
	
	// global styles
	wp_enqueue_style('css-stocky', get_stylesheet_directory_uri() . '/style.css');
	wp_enqueue_style('css-fancybox', get_template_directory_uri() . '/includes/fancybox/jquery.fancybox.css');
	wp_enqueue_style('heading-font', get_template_directory_uri() . '/fonts/style-' . stripslashes(of_get_option('heading_font')) . '.css');
		
}
add_action('wp_enqueue_scripts', 'dcs_load_scripts');

// load in header
function dcs_add_footer_js() {
	get_template_part('includes/js/storedjs');
}
add_action('wp_footer', 'dcs_add_footer_js');