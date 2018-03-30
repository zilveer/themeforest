<?php
/**
 * Functions
 *
 * This is the main functions file that can add some additional functionality to the theme.
 * It calls an object from a manager class that inits all the needed functionality.
 */

global $allowedtags;

if ( !defined( 'PEXETO_SHORTNAME' ) )
	define( 'PEXETO_SHORTNAME', 'porcelain' );

$pexeto_theme_data = wp_get_theme(PEXETO_SHORTNAME);
if(!$pexeto_theme_data->Version){
	$pexeto_theme_data = wp_get_theme();
}
$pexeto = new stdClass();
$pexeto_scripts = array();

if(!isset($pexeto_content_sizes)){
	$pexeto_content_sizes = array(
		'content' => 776,
		'fullwidth' => 1170,
		'container' => 1500, //this is dynamic depending on the window screen, 
		//that's just an indicative value for the image cropping

		'column_spacing' => array(
			'blog' => 30,
			'gallery' => 15,
			'carousel' => 6,
			'quick_gallery' => 10,
			'services' => 33,
			'content_slider' => 33
			),
		'header-height' => 400 //used for static header image
	);

	//calculate the slider width as 70% of the full width
	$pexeto_content_sizes['sliderside'] = 70*$pexeto_content_sizes['fullwidth']/100;
}

if ( ! isset( $content_width ) ) $content_width = $pexeto_content_sizes['fullwidth'];

if ( !defined( 'PEXETO_VERSION' ) )
	define( 'PEXETO_VERSION', $pexeto_theme_data->Version );

//main theme info constants
if ( !defined( 'PEXETO_THEMENAME' ) )
	define( 'PEXETO_THEMENAME', $pexeto_theme_data->Name );


if ( !defined( 'PEXETO_LIB_PATH' ) )
	define( 'PEXETO_LIB_PATH', get_template_directory() . '/lib/' );
if ( !defined( 'PEXETO_FUNCTIONS_PATH' ) )
	define( 'PEXETO_FUNCTIONS_PATH', get_template_directory() . '/functions/' );
if ( !defined( 'PEXETO_LIB_URL' ) )
	define( 'PEXETO_LIB_URL', get_template_directory_uri().'/lib/' );
if ( !defined( 'PEXETO_FUNCTIONS_URL' ) )
	define( 'PEXETO_FUNCTIONS_URL', get_template_directory_uri().'/functions/' );
if ( !defined( 'PEXETO_IMAGES_URL' ) )
	define( 'PEXETO_IMAGES_URL', PEXETO_LIB_URL.'images/' );
if ( !defined( 'PEXETO_FRONT_IMAGES_URL' ) )
	define( 'PEXETO_FRONT_IMAGES_URL', get_template_directory_uri().'/images/' );
if ( !defined( 'PEXETO_PATTERNS_URL' ) )
	define( 'PEXETO_PATTERNS_URL', PEXETO_IMAGES_URL.'pattern_samples/' );
if ( !defined( 'PEXETO_FRONT_SCRIPT_URL' ) )
	define( 'PEXETO_FRONT_SCRIPT_URL', get_template_directory_uri().'/js/' );
if ( !defined( 'PEXETO_OPTIONS_PAGE' ) )
	define( 'PEXETO_OPTIONS_PAGE', 'pexeto_options' );


require PEXETO_LIB_PATH.'init.php';  //init file of the Pexeto library
require PEXETO_FUNCTIONS_PATH.'init.php';  //init file of the theme functions



?>