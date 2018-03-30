<?php

/*-----------------------------------------------------------------------------------*/
/*	Row Inner VC Mapping (Backend)
/*-----------------------------------------------------------------------------------*/
			vc_map( array(
				'name' => __( 'Row', 'js_composer' ), //Inner Row
				'base' => 'vc_row_inner',
				'content_element' => false,
				'is_container' => true,
				'icon' => 'icon-wpb-row',
				'weight' => 1000,
				'show_settings_on_create' => false,
				'description' => __( 'Place content elements inside the row', 'js_composer' ),
				'params' => array(
					array(
						"type" => "colorpicker",
						"heading" => __('Background color', 'vivaco'),
						"param_name" => "vsc_bg_color",
						"description" => __("Background color overlay can be placed on top of background image or used separately", "vivaco")
					),
					array(
						"type" => "attach_image",
						"heading" => __("Background image", "vivaco"),
						"param_name" => "vsc_bg_image",
						"description" => __("Select rows backgound image", "vivaco")
					),
					array(
						"type" => "dropdown",
						"heading" => __('Background repeat', 'vivaco'),
						"param_name" => "vsc_bg_repeat",
						"value" => array(
							__('No Repeat', 'vivaco') => 'no-repeat',
							__("Repeat", 'vivaco') => 'repeat',
							__('Repeat-X', 'vivaco') => 'repeat-x',
							__("Repeat-Y", 'vivaco') => 'repeat-y'
						)
					),
					array(
						"type" => "dropdown",
						"heading" => __('Background position', 'vivaco'),
						"param_name" => "vsc_bg_position",
						"value" => array(
							__("Center Center", 'vivaco') => 'center center',
							__("Center Left", 'vivaco') => 'center left',
							__("Center Right", 'vivaco') => 'center right',
							__("Top Center", 'vivaco') => 'top center',
							__('Top Left', 'vivaco') => 'top left',
							__('Top Right', 'vivaco') => 'top right',
							__('Bottom Center', 'vivaco') => 'bottom center',
							__('Bottom Left', 'vivaco') => 'bottom left',
							__('Bottom Right', 'vivaco') => 'bottom right'
						)
					),
					array(
						"type" => "dropdown",
						"heading" => __('Background size', 'vivaco'),
						"param_name" => "vsc_bg_size",
						"value" => array(
							__("Cover", 'vivaco') => 'cover',
							__("Default", 'vivaco') => 'auto',
							__("Contain", 'vivaco') => 'contain'
						)
					),
					array(
						"type" => "checkbox",
						"heading" => __( "Height", "vivaco" ),
						"param_name" => "height",
						"value" => array(
							__( "100% container height", "vivaco" ) => "window_height",
						)
					),
					array(
						'type' => 'textfield',
						'heading' => __( 'Extra class name', 'js_composer' ),
						'param_name' => 'el_class',
						'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
					),
					array(
						'type' => 'css_editor',
						'heading' => __( 'Css', 'js_composer' ),
						'param_name' => 'css',
						// 'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
						'group' => __( 'Padding & Margins', 'js_composer' )
					)
				),
				'js_view' => 'VcRowView'
			) );
