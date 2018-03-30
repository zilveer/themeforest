<?php

/**
 * Ebor Framework
 * Styles & Scripts Enqueuement
 * @since version 1.0
 * @author TommusRhodus
 */

/**
 * Ebor Load Scripts
 * Properly Enqueues Scripts & Styles for the theme
 * @since version 1.0
 * @author TommusRhodus
 */ 
function ebor_load_scripts() {
	global $post;
	$protocol = is_ssl() ? 'https' : 'http';
	
	/**
	 * Load custom fonts
	 */
	require( "theme_fonts.php" );
	
	$location = 'Montserrat';
	$body_location = 'Roboto Slab';
	
	foreach( $fonts as $font ){
	
		if( $font["title"] == get_option('heading_font', 'Montserrat') )
			$location = $font["location"];
			
		if( $font["title"] == get_option('body_font', 'Roboto Slab') )
			$body_location = $font["location"];
			
	}
	
	wp_enqueue_style( 'ebor-heading-font', "$protocol://fonts.googleapis.com/css?family=$location" );
	wp_enqueue_style( 'ebor-body-font', "$protocol://fonts.googleapis.com/css?family=$body_location" );
	wp_enqueue_style( 'ebor-framework', get_template_directory_uri() . '/ebor_framework/css/framework.css' );
	wp_enqueue_style( 'ebor-font-awesome', get_template_directory_uri() . '/ebor_framework/css/font-awesome.min.css' );
	wp_enqueue_style( 'ebor-style', get_stylesheet_uri() );
	wp_enqueue_style( 'ebor-custom', get_template_directory_uri() . '/custom.css' );

	wp_enqueue_script( 'ebor-plugins', get_template_directory_uri() . '/js/plugins.js', array('jquery'), false, true  );
	wp_enqueue_script( 'ebor-scripts', get_template_directory_uri() . '/js/custom.js', array('jquery'), false, true  );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) || is_page_template('page_gallery.php') && comments_open() && get_post_meta( $post->ID, '_ebor_gallery_comments', 1) == 'on' ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	wp_enqueue_script( 'ebor-view', get_template_directory_uri() . '/js/view.min.js?auto', array('jquery'), false, true  );

}
add_action('wp_enqueue_scripts', 'ebor_load_scripts');

/**
 * Ebor Load Non Standard Scripts
 * Quickly insert HTML into wp_head()
 * @since version 1.0
 * @author TommusRhodus
 */
function ebor_load_non_standard_scripts() {
	echo '<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->';
}
add_action('wp_head', 'ebor_load_non_standard_scripts', 95);

/**
 * Ebor Load Admin Scripts
 * Properly Enqueues Scripts & Styles for the theme
 * @since version 1.0
 * @author TommusRhodus
 */ 
function ebor_load_admin_scripts() {
	wp_enqueue_style( 'ebor-admin-styles', get_template_directory_uri() . '/ebor_framework/css/admin.css' );
    wp_enqueue_script('custom_script', get_template_directory_uri().'/ebor_framework/js/admin.js', array('jquery'), false, true);
}
add_action('admin_enqueue_scripts', 'ebor_load_admin_scripts', 9999); 