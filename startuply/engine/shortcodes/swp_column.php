<?php

/*-----------------------------------------------------------------------------------*/
/*	Column VC Mapping (Backend)
/*-----------------------------------------------------------------------------------*/
			vc_map(array(
				"name" => __("Column", "js_composer"),
				"base" => "vc_column",
				"class" => "",
				"icon" => "",
				"wrapper_class" => "",
				"controls" => "full",
				"content_element" => false,
				"is_container" => true,
				"params" => array(
					array(
						"type" => "textfield",
						"heading" => __("Extra class name", "js_composer"),
						"param_name" => "el_class",
						"value" => "",
						"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
					),
					array(
						"type" => "dropdown",
						"heading" => __("Column alignment", "vivaco"),
						"param_name" => "el_align",
						"value" => array(
							__("None", "vivaco") => "",
							__("Left", "vivaco") => 'alignleft',
							__("Center", "vivaco") => "aligncenter",
							__("Right", "vivaco") => "alignright"
						)
					),
					array(
						"type" => "checkbox",
						"heading" => __( "Height", "vivaco" ),
						"param_name" => "height",
						"value" => array(
							__( "100% container height", "vivaco" ) => "full_height",
						)
					),
					array(
						"type" => "css_editor",
						"heading" => __('Css', "js_composer"),
						"param_name" => "css",
						// "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer"),
						"group" => __('Padding & Margins', 'js_composer')
					),
					array(
						'type' => 'dropdown',
						'heading' => __( 'Width', 'js_composer' ),
						'param_name' => 'width',
						'value' => array(
							__('1 column - 1/12', 'js_composer') => '1/12',
							__('2 columns - 1/6', 'js_composer') => '1/6',
							__('3 columns - 1/4', 'js_composer') => '1/4',
							__('4 columns - 1/3', 'js_composer') => '1/3',
							__('5 columns - 5/12', 'js_composer') => '5/12',
							__('6 columns - 1/2', 'js_composer') => '1/2',
							__('7 columns - 7/12', 'js_composer') => '7/12',
							__('8 columns - 2/3', 'js_composer') => '2/3',
							__('9 columns - 3/4', 'js_composer') => '3/4',
							__('10 columns - 5/6', 'js_composer') => '5/6',
							__('11 columns - 11/12', 'js_composer') => '11/12',
							__('12 columns - 1/1', 'js_composer') => '1/1'
						),
						'group' => __( 'Width & Responsiveness', 'js_composer' ),
						'description' => __( 'Select column width.', 'js_composer' ),
						'std' => '1/1'
					),
					array(
						'type' => 'column_offset',
						'heading' => __( 'Responsiveness', 'js_composer' ),
						'param_name' => 'offset',
						'group' => __( 'Width & Responsiveness', 'js_composer' ),
						'description' => __( 'Adjust column for different screen sizes. Control width, offset and visibility settings.', 'js_composer' )
					)
				),
				"js_view" => 'VcColumnView'
			));
