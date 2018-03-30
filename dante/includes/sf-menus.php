<?php
	
	/*
	*
	*	Swift Framework Menu Functions
	*	------------------------------------------------
	*	Swift Framework v2.0
	* 	Copyright Swift Ideas 2015 - http://www.swiftideas.net
	*
	*	sf_setup_menus()
	*
	*/
	
	
	/* CUSTOM MENU SETUP
	================================================== */
	if (!function_exists('sf_setup_menus')) {
		function sf_setup_menus() {
			// This theme uses wp_nav_menu() in four locations.
			register_nav_menus( array(
			'main_navigation' => __( 'Main Menu', "swiftframework" ),
			'mobile_menu' => __( 'Mobile Menu', "swiftframework" ),
			'top_bar_menu' => __( 'Top Bar Menu', "swiftframework" ),
			'footer_menu' => __( 'Footer Menu', "swiftframework" )
			) );
		}
		add_action( 'init', 'sf_setup_menus' );
	}
	
	
?>