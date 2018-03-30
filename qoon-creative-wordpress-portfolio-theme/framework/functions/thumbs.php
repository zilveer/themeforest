<?php
/*=======================================
	Thumbnails
=======================================*/
if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150 );
	add_image_size( 'qoon_blog-wide', 1240, 400, true );
}
?>