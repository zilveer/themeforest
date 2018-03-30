<?php
	/*	
	*	Goodlayers Framework File
	*	---------------------------------------------------------------------
	*	This file contains the function that add and controls the font in the theme
	*	---------------------------------------------------------------------
	*/

	$gdlr_font_family = array( 									
		'title' => __('Font Family', 'gdlr_translate'),
		'options' => array(
			
			'header-font-family' => array(
				'title' => __('Header Font', 'gdlr_translate'),
				'type' => 'font-combobox',
				'default' => 'Arial, Helvetica, sans-serif',
				'data-type' => 'font',
				'selector' => 'h1, h2, h3, h4, h5, h6, .gdlr-title-font{ font-family: #gdlr#; }'
			),			
			'content-font-family' => array(
				'title' => __('Content Font', 'gdlr_translate'),
				'type' => 'font-combobox',
				'default' => 'Arial, Helvetica, sans-serif',
				'data-type' => 'font',
				'selector' => 'body, input, textarea, select{ font-family: #gdlr#; }'
			),			
			'navigaiton-font-family' => array(
				'title' => __('Navigation Font', 'gdlr_translate'),
				'type' => 'font-combobox',
				'default' => 'Arial, Helvetica, sans-serif',
				'data-type' => 'font',
				'selector' => '.gdlr-navigation-wrapper .gdlr-main-menu > li > a{ font-family: #gdlr#; }'
			),			
			'slider-font-family' => array(
				'title' => __('Slider Font', 'gdlr_translate'),
				'type' => 'font-combobox',
				'default' => 'Arial, Helvetica, sans-serif',
				'data-type' => 'font',
				'selector' => '.gdlr-slider-item{ font-family: #gdlr#; }'
			),
		)
	);	
	
	add_filter('gdlr_admin_option', 'gdlr_register_font_option');	
	if( !function_exists('gdlr_register_font_option') ){
		function gdlr_register_font_option( $array ){		
			if( empty($array['font-settings']['options']) ) return $array;
			
			global $gdlr_font_family;
			
			$array['font-settings']['options']['font-family'] = $gdlr_font_family;
			return $array;
		}
	}	
	
	// register the font script to embedding it when used.
	if( !function_exists('gdlr_register_font_location') ){
		function gdlr_register_font_location(){
			global $gdlr_font_family, $gdlr_font_controller;
			
			$font_location = array();
			foreach( $gdlr_font_family['options'] as $font_slug => $font_settings ){
				array_push($font_location, $font_slug);
			}

			$gdlr_font_controller->font_location = $font_location;
		}	
	}
	gdlr_register_font_location();

?>