<?php
/*=======================================
	Thumbnails
=======================================*/
add_filter('widget_text', 'do_shortcode');

if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150 );
	
	// additional image sizes
	add_image_size( 'wall-portfolio-squre', 400, 400, true );
	add_image_size( 'wall-portfolio-squrex2', 800,800, true );
	add_image_size( 'wall-portfolio-wide', 800, 400, true );
	add_image_size( 'wall-portfolio-long', 400, 800, true );
	add_image_size( 'real-wall-portfolio-squre', 400, 400, true );
	
	add_image_size( 'blog-wide', 720, 400, true );
	add_image_size( 'blog-normal', 640, 480, true );
}
?>