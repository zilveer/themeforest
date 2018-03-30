<?php 
/**
* Theme Setup . 
* PLEASE DO NOT MODIFY THIS FILE
*
* @author : VanThemes ( http://www.vanthemes.com )
* 
*/

/**
* Theme Info
************************************************/
$theme_name = 'Carino';
$theme_folder = 'carino';

define ('THEME_NAME', $theme_name);
define ('THEME_FOLDER', $theme_folder );
define ('THEME_XML', "http://demo.vanthemes.com/xml/" . $theme_folder . ".xml");

/**
* Add Theme support
*****************************************************/
add_action( 'after_setup_theme', 'van_theme_setup' );
function van_theme_setup(){

	if( function_exists( 'add_theme_support' ) ){ 

		add_theme_support('menus');
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'post-formats', array("image","gallery","link","video","audio","quote","status") );
	}
	// languages
	load_theme_textdomain( 'van', get_template_directory() . "/languages" );
	// Navigations
	register_nav_menus( array( 'PrimaryNav'  => __( 'Primary menu', 'van' ),
					      'FooterNav'    => __( 'Footer menu', 'van' ) ) );
	
	// thumbnails

	add_image_size( "small-thumb", 80, 80, true ); // smaller thumbnail
	add_image_size( "box-entry", 300, 190, true );   // thumbnail for slider and related articles
	add_image_size( "full-width", 940, 630, true );   // thumbnail for full width post
	add_image_size( "simple-thumb", 620, 330, true ); // default thumbnail
	add_image_size( "two-three-col", 300, 320, true ); // thumbnail for two columns with sidebar and three columns full width layout
	add_image_size( "two-col-full", 460, 330, true ); // thumbnail for two columns full width layout

	//Remove Gallery default style, This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );

}

/**
* Setup content width
*************************************************/
if ( ! isset( $content_width ) ) $content_width = 940;
