<?php
/*
    Extension Name: UberMenu Lite
    Extension URI:
    Version: 1.0
    Description: A lite version of UberMenu mega menu plugin for WordPress. You can easily upgrade to the full version by installing the plugin (v3.0 or higher).
    Author: SevenSpark
    Author URI: http://sevenspark.com/
*/

if( !defined( 'UBERMENU_PRO' ) || !UBERMENU_PRO ){


	//////////////////////////////
	/// DEFINE UBERMENU CONSTANTS
	//////////////////////////////

	//The URL to UberMenu within the theme
	$theme_url = get_template_directory_uri(); //parent theme

	//The path to UberMenu within the theme
	$theme_dir = get_template_directory(); //parent theme

	//Define UberMenu root URL
	if( ! defined( 'UBERMENU_URL' ) )
		define( 'UBERMENU_URL', $theme_url .'/extensions/ubermenu/' );

	//Define UberMenu root directory
	if( ! defined( 'UBERMENU_DIR' ) )
	 	define( 'UBERMENU_DIR', $theme_dir .'/extensions/ubermenu/' );

	//Set Pro to false - otherwise will try to load Pro, which won't exist
	if( ! defined( 'UBERMENU_PRO' ) )
		define( 'UBERMENU_PRO', false );



	//////////////////////////////
	/// LOAD UBERMENU
	//////////////////////////////

	require_once( 'ubermenu.php' );


	//////////////////////////////
	/// OVERRIDE DEFAULT SETTINGS
	//////////////////////////////

	add_filter( 'ubermenu_settings_defaults' , 'um_filter_settings_defaults' );
	function um_filter_settings_defaults( $defaults ){

		// Set custom skin as default skin
		$defaults['ubermenu_main']['skin'] = 'theme-default-styles';
		
		// Menu orientation
		// $defaults['ubermenu_main']['orientation'] = 'horizontal'; 

		// Disable submenu indicators
		$defaults['ubermenu_main']['display_submenu_indicators'] = 'on';

		//Example: Change Trigger
		//$defaults['ubermenu_main']['trigger'] = 'click';

		return $defaults;
	}
	
}


//////////////////////////////
/// REGISTER SKIN
//////////////////////////////

add_action( 'init' , 'um_register_theme_skins' , 15 );
function um_register_theme_skins(){
	$id 	= 'theme-default-styles';
	$title 	= 'Theme Default Style';
	$path 	= get_stylesheet_directory_uri().'/assets/css/ubermenu.lite.css';
	// $path 	= get_stylesheet_directory_uri().'/extensions/ubermenu/pro/assets/css/skins/vellum.css';
	ubermenu_register_skin( $id, $title, $path );
}


// Add layout specific horizontal/vertical display
function incentive_uber_menu($args) {
	$layout_data   = get_layout_options('other_options');
	$layoutStyle   = (isset($layout_data['layout-style']) && !empty($layout_data['layout-style'])) ? $layout_data['layout-style'] : get_options_data('options-page', 'layout-style', 'boxed');

	if($layoutStyle == 'boxed-left' || $layoutStyle == 'boxed-right' || $layoutStyle == 'full-width-left' || $layoutStyle == 'full-width-right') {
		$args['container_class'] = str_replace('ubermenu-horizontal', 'ubermenu-vertical', $args['container_class']);
	}
	else {
		$args['container_class'] = str_replace('ubermenu-vertical', 'ubermenu-horizontal', $args['container_class']);
	}
		
	if($layoutStyle == 'boxed-right' || $layoutStyle == 'full-width-right') {
		$args['container_class'] .= " ubermenu-right-direction";
	}
	return $args;
}
add_filter('ubermenu_nav_menu_args', 'incentive_uber_menu', 10);

function incentive_custom_ubermenu_item_settings( $settings ){
    $settings['general'][9] = array(
        'id'        => 'icon',
        'title'     => 'Icon',
        'type'      => 'text',
        'default'   => '',
        'desc'      => 'Enter the class of a Font Awesome icon, like <em>fa fa-home</em>',
    );
    return $settings;
}
add_filter( 'ubermenu_menu_item_settings' , 'incentive_custom_ubermenu_item_settings' );