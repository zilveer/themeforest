<?php

/*-----------------------------------------------------------------------------------*/
/*	Configure WP2.9+ Thumbnails
/*-----------------------------------------------------------------------------------*/

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support('post-formats', array( 'quote' , 'gallery' , 'audio'  , 'video' ) );
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 770, 313, true );
    add_image_size( 'thumb-portfolio', 300 , 9999 );
	add_image_size( 'thumb-portfolio-widget', 150, 110, true );
}

/*-----------------------------------------------------------------------------------*/
/*	RSS Feeds
/*-----------------------------------------------------------------------------------*/

add_theme_support( 'automatic-feed-links' );