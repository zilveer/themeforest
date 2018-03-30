<?php

	/* ------------------------------------
	:: DROP CAPS
	------------------------------------*/
	
	function dropcap_shortcode( $atts, $content = null ) {
	   extract( shortcode_atts( array(
		  'style' => '',
		  'text' => '',
		  'color' => '',
		  ), $atts ) );
	 
	   return '<span class="dropcap '. $style .' '. $color .'">' . $text  . '</span>';
	
	}

	/* ------------------------------------
	:: DROPCAPS MAP 	
	------------------------------------*/

	wpb_map( array(
		"name"		=> __("Drop Cap", "js_composer"),
		"base"		=> "dropcap",
		"controls"	=> "edit_popup_delete",
		"class"		=> "dropcap",
		"icon"		=> "icon-dropcap",
		'deprecated' => '4.6',
		"category"  => __('Content', 'js_composer'),
		"params"	=> array(
			array(
				"type" => "dropdown",
				"heading" => __("Style", "js_composer"),
				"param_name" => "style",
				"value" => array(
					__('Circle + Character', "js_composer") => 'two',
					__('Character', "js_composer") => 'one', 
				),
			),				
			array(
				"type" => "dropdown",
				"heading" => __("Color", "js_composer"),
				"param_name" => "color",
				"value" => get_options_array('colors'),
				"description" => __("Select color of the toggle icon.", "js_composer")
			),
			array(
				"type" => "textfield",
				"holder" => 'h4',
				"heading" => __("Character", "js_composer"),
				"param_name" => "text",
				"value" => "",
			),								
		)
	));	
	
	add_shortcode('dropcap', 'dropcap_shortcode');