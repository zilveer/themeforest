<?php 

/*
**	SLIDER
*/

//Register "container" content element. It will hold all your inner (child) content elements
vc_map( array(
	"name"			=> "Slider",
	"description"	=> "Slider",
	"base"			=> "slider",
	"class"			=> "",
	"icon"			=> get_template_directory_uri() . "/images/visual_composer/slider-main.png",
	"as_parent" => array('only' => 'image_slide'),
	"content_element" => true,
	"params" => array(
        // add params same as with any other content element
	
 		array(
			"type"			=> "dropdown",
 			"holder"		=> "div",
 			"class" 		=> "hide_in_vc_editor",
 			"admin_label" 	=> false,
			"heading"		=> "Height",
			"param_name"	=> "full_height",
			"value"			=> array('Full Height' => 'yes', 'Custom Height' => 'no'),
 		),
		
 		array(
 			"type"			=> "textfield",
 			"holder"		=> "div",
 			"class" 		=> "hide_in_vc_editor",
 			"admin_label" 	=> false,
			"heading"		=> "Custom Height",
			"param_name"	=> "custom_height",
 			"value"			=> "",
			"dependency"	=> array(
				"element" 	=> "full_height",
				"value"		=> array('no'),
			),
 		),

 		array(
			'type' => 'checkbox',
			'param_name' => 'hide_arrows',
			'heading' => 'Hide Navigation Arrows',
		),

 		array(
			'type' => 'checkbox',
			'param_name' => 'hide_bullets',
			'heading' => 'Hide Navigation Bullets',
		),

    ),
    "js_view" => 'VcColumnView'
));

vc_map( array(
    "name" => 'Image Slide',
    "base" => "image_slide",
    "as_child" => array('only' => 'slider'), // Use only|except attributes to limit parent (separate multiple values with comma)
    "icon"	=> get_template_directory_uri() . "/images/visual_composer/slider.png",
    "params" => array(
        // add params same as with any other content element

		array(
			'type' => 'checkbox',
			'param_name' => 'advanced_options',
			'heading' => 'Advanced Options',
		),

        array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Title",
			"param_name"	=> "title",
			"value"			=> "",
		),

		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "half_width",
			"admin_label" 	=> false,
			"heading"		=> "Title Font Size",
			"param_name"	=> "title_font_size",
			"value"			=> "60px",
			'dependency' => array(
				'element' => 'advanced_options',
  				'not_empty' => true,
  			),
		),

		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "half_width",
			"admin_label" 	=> false,
			"heading"		=> "Title Line Height",
			"param_name"	=> "title_line_height",
			"value"			=> "",
			'dependency' => array(
				'element' => 'advanced_options',
  				'not_empty' => true,
  			),
		),

		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> false,
			"heading"		=> "Title Font Family",
			"param_name"	=> "title_font_family",
			"value"			=> array(
				"Primary Font"		=> "primary_font",
				"Secondary Font"	=> "secondary_font",
			),
			"std"			=> "",
			'dependency' => array(
				'element' => 'advanced_options',
  				'not_empty' => true,
  			),
		),

		array(
			"type"			=> "textarea",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> false,
			"heading"		=> "Description",
			"param_name"	=> "description",
			"value"			=> "",
		),

		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "half_width hide_in_vc_editor",
			"admin_label" 	=> false,
			"heading"		=> "Description Font Size",
			"param_name"	=> "description_font_size",
			"value"			=> "21px",
			'dependency' => array(
				'element' => 'advanced_options',
  				'not_empty' => true,
  			),
		),

		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "half_width",
			"admin_label" 	=> false,
			"heading"		=> "Description Line Height",
			"param_name"	=> "description_line_height",
			"value"			=> "",
			'dependency' => array(
				'element' => 'advanced_options',
  				'not_empty' => true,
  			),
		),

		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> false,
			"heading"		=> "Description Font Family",
			"param_name"	=> "description_font_family",
			"value"			=> array(
				"Primary Font"		=> "primary_font",
				"Secondary Font"	=> "secondary_font",
			),
			"std"			=> "",
			'dependency' => array(
				'element' => 'advanced_options',
  				'not_empty' => true,
  			),
		),

		array(
			"type"			=> "colorpicker",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> false,
			"heading"		=> "Title & Description Text Color",
			"param_name"	=> "text_color",
			"value"			=> "#000000",
		),

		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> false,
			"heading"		=> "Button Text",
			"param_name"	=> "button_text",
			"value"			=> "",
		),

		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> false,
			"heading"		=> "Button URL",
			"param_name"	=> "button_url",
			"value"			=> "",
		),

		array(
			"type"			=> "colorpicker",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> false,
			"heading"		=> "Button Color",
			"param_name"	=> "button_color",
			"value"			=> "#000000",
			'dependency' => array(
				'element' => 'advanced_options',
  				'not_empty' => true,
  			),
		),

		array(
			"type"			=> "colorpicker",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> false,
			"heading"		=> "Button Text Color",
			"param_name"	=> "button_text_color",
			"value"			=> "#FFF",
			'dependency' => array(
				'element' => 'advanced_options',
  				'not_empty' => true,
  			),
		),
		
		array(
			"type"			=> "colorpicker",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> false,
			"heading"		=> "Slide Background Color",
			"param_name"	=> "bg_color",
			"value"			=> "#000000",
		),
		
		array(
			"type"			=> "attach_image",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> false,
			"heading"		=> "Background Image",
			"param_name"	=> "bg_image",
			"value"			=> "",
		),

		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> false,
			"heading"		=> "Text Align",
			"param_name"	=> "text_align",
			"value"			=> array(
				"Left"		=> "left",
				"Center"	=> "center",
				"Right"		=> "right",
			),
			"std"			=> "",
		),
    )
) );
//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Slider extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Image_Slide extends WPBakeryShortCode {
    }
}