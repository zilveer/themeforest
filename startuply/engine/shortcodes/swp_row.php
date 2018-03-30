<?php

/*-----------------------------------------------------------------------------------*/
/*	Row VC Mapping (Backend)
/*-----------------------------------------------------------------------------------*/
			vc_map(array(
				"name" => __("Row", "vivaco"),
				"base" => "vc_row",
				"is_container" => true,
				"icon" => "icon-wpb-row",
				"weight" => 100,
				"show_settings_on_create" => true,
				"category" => __("Content", "vivaco"),
				"description" => __("Main content wrapper", "vivaco"),
				"params" => array(
					array(
						"type" => "textfield",
						"heading" => __("Anchor ID", "vivaco"),
						"param_name" => "vsc_id",
						"description" => __("Set an ID if you want to link this section with one page scrolling navigation e.g.: team", "vivaco")
					),
					array(
						'type' => 'dropdown',
						'heading' => __( 'Row stretch', 'js_composer' ),
						'param_name' => 'full_width',
						'value' => array(
							__('Default (Boxed)','js_composer') => '',
							__('Stretch row (100% width)','js_composer') => 'stretch_row',
							__('Stretch row and content','js_composer') => 'stretch_row_content',
							__('Stretch row and content without spaces','js_composer') => 'stretch_row_content_no_spaces',
						),
						'description' => __( 'This controls the width of the row and contents. Fullscreen rows are only allowed in Fullscreen page template <a target="_blank" class="help" href="https://wpbakery.atlassian.net/wiki/pages/viewpage.action?pageId=3604483">?</a>', 'js_composer' )
					),
					array(
						"type" => "checkbox",
						"heading" => __( "Height options", "vivaco" ),
						"param_name" => "options",
						"value" => array(
							__( "100% window height", "vivaco" ) => "window_height",
							__( "Vertical centering", "vivaco" ) => "centered",
						)
					),
					array(
						"type" => "dropdown",
						"heading" => __('Text color scheme', 'vivaco'),
						"param_name" => "vsc_text_scheme",
						"description" => __("'Light Text' looks good on dark backgrounds while 'Dark Text' looks good on light backgrounds", "vivaco"),
						"value" => array(
							__("Dark Text", 'vivaco') => 'lighter-overlay',
							__("Light Text", 'vivaco') => 'darker-overlay'
						)
					),
					//compatibility fix, removes the type value on save
					array(
						"type" => "holder",
						"param_name" => "vsc_row_type",
						"value" => array(
							__("Default", 'vivaco') => ''
						)
					),
					//compatibility fix, removes the type value on save
					array(
						"type" => "holder",
						"param_name" => "bg_image",
						"value" => array(
							__("Default", 'vivaco') => ''
						)
					),
					//compatibility fix, removes the type value on save
					array(
						"type" => "holder",
						"param_name" => "bg_color",
						"value" => array(
							__("Default", 'vivaco') => ''
						)
					),
					array(
						"type" => "attach_image",
						"heading" => __("Background image", "vivaco"),
						"param_name" => "vsc_bg_image",
						"description" => __("Select rows backgound image", "vivaco")
					),
					array(
						"type" => "checkbox",
						"heading" => __("Use parallax?", "vivaco"),
						"param_name" => "vsc_parallax",
						"value" => array(
							__("Yes, please", "vivaco") => "yes"
						)
					),
					array(
						"type" => "colorpicker",
						"heading" => __('Background overlay color', 'vivaco'),
						"param_name" => "vsc_bg_color",
						"description" => __("Background color overlay can be placed on top of background image or used separately", "vivaco")
					)
					,
					array(
						"type" => "textarea",
						"heading" => __('Background overlay gradient', 'vivaco'),
						"param_name" => "vsc_bg_gradient",
						"value" => '',
						"description" => __("Put awesome gradient as an overlay, generate yours at <a target=\"blank\" href=\"http://www.cssmatic.com/gradient-generator\">CSSMatic</a> and just copy-paste the code here!", "vivaco")
					),
					array(
						"type" => "dropdown",
						"heading" => __('Background repeat', 'vivaco'),
						"param_name" => "vsc_bg_repeat",
						"dependency" => array(
							"element" => "vsc_bg_image",
							"not_empty" => true
						),
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
						"dependency" => array(
							"element" => "vsc_bg_image",
							"not_empty" => true
						),
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
						"dependency" => array(
							"element" => "vsc_bg_image",
							"not_empty" => true
						),
						"value" => array(
							__("Cover", 'vivaco') => 'cover',
							__("Default", 'vivaco') => 'auto',
							__("Contain", 'vivaco') => 'contain'
						)
					),
					array(
						"type" => "textfield",
						"heading" => __("Extra class name", "vivaco"),
						"param_name" => "el_class",
						"description" => __("Additional class that you can add custom styles to", "vivaco")
					),
					array(
						'type' => 'css_editor',
						'heading' => __( 'Css', 'js_composer' ),
						'param_name' => 'css',
						'group' => __( 'Padding & Margins', 'js_composer' )
					),
					array(
						"type" => "textfield",
						"heading" => __('YouTube video background URL', 'vivaco'),
						"param_name" => "vsc_youtube_url",
						"description" => __("Don't forget to add an 'Anchor ID' above and a 'Background image'. The background image will be used as a cover, for devices that doesn`t play videos automatically (mobile and tablets)", "vivaco"),
						'group' => __( 'Video background', 'js_composer' )
					),
					array(
						"type" => "checkbox",
						"heading" => __( "Video Options", "vivaco" ),
						"param_name" => "vsc_youtube_options",
						"value" => array(
							__( "Disable autoplay", "vivaco" ) => "autoplay",
							__( "Disable sound on load", "vivaco" ) => "sound"
						),
						"dependency" => array(
							"element" => "vsc_youtube_url",
							"not_empty" => true
						),
						'group' => __( 'Video background', 'js_composer' )
					),
					array(
						"type" => "dropdown",
						"heading" => __('YouTube video controls position', 'vivaco'),
						"param_name" => "vsc_youtube_controls",
						"description" => __("Video controls position.", "vivaco"),
						"value" => array(
							__("Left", "vivaco") => "left",
							__("Center", "vivaco") => "center",
							__("Right", "vivaco") => "right",
							__("Disabled", "vivaco") => 'none',
						),
						"dependency" => array(
							"element" => "vsc_youtube_url",
							"not_empty" => true
						),
						'group' => __( 'Video background', 'js_composer' )
					)
				),
				"js_view" => 'VcRowView'
			));
