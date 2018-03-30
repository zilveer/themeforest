<?php
/*
 *	Greatives Visual Composer Shortcode Extentions
 *
 * 	@author		Greatives Team
 * 	@URI		http://greatives.eu
 */


if ( function_exists( 'vc_add_param' ) ) {

	//Generic css aniation for elements

	$grve_add_animation = array(
		"type" => "dropdown",
		"heading" => esc_html__("CSS Animation", 'blade' ),
		"param_name" => "animation",
		"admin_label" => true,
		"value" => array(
			esc_html__( "No", 'blade' ) => '',
			esc_html__( "Fade In", 'blade' ) => "fadeIn",
			esc_html__( "Fade In Up", 'blade' ) => "fadeInUp",
			esc_html__( "Fade In Down", 'blade' ) => "fadeInDown",
			esc_html__( "Fade In Left", 'blade' ) => "fadeInLeft",
			esc_html__( "Fade In Right", 'blade' ) => "fadeInRight",
			esc_html__( "Zoom In", 'blade' ) => "zoomIn",
		),
		"description" => esc_html__("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'blade' ),
	);

	$grve_add_animation_delay = array(
		"type" => "textfield",
		"heading" => esc_html__( 'Css Animation Delay', 'blade' ),
		"param_name" => "animation_delay",
		"value" => '200',
		"description" => esc_html__( "Add delay in milliseconds.", 'blade' ),
	);

	$grve_add_margin_bottom = array(
		"type" => "textfield",
		"heading" => esc_html__( 'Bottom margin', 'blade' ),
		"param_name" => "margin_bottom",
		"description" => esc_html__( "You can use px, em, %, etc. or enter just number and it will use pixels.", 'blade' ),
	);

	$grve_add_el_class = array(
		"type" => "textfield",
		"heading" => esc_html__("Extra class name", 'blade' ),
		"param_name" => "el_class",
		"description" => esc_html__( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'blade' ),
	);

	$grve_column_width_list = array(
		esc_html__( '1 column - 1/12', 'blade' ) => '1/12',
		esc_html__( '2 columns - 1/6', 'blade' ) => '1/6',
		esc_html__( '3 columns - 1/4', 'blade' ) => '1/4',
		esc_html__( '4 columns - 1/3', 'blade' ) => '1/3',
		esc_html__( '5 columns - 5/12', 'blade' ) => '5/12',
		esc_html__( '6 columns - 1/2', 'blade' ) => '1/2',
		esc_html__( '7 columns - 7/12', 'blade' ) => '7/12',
		esc_html__( '8 columns - 2/3', 'blade' ) => '2/3',
		esc_html__( '9 columns - 3/4', 'blade' ) => '3/4',
		esc_html__( '10 columns - 5/6', 'blade' ) => '5/6',
		esc_html__( '11 columns - 11/12', 'blade' ) => '11/12',
		esc_html__( '12 columns - 1/1', 'blade' ) => '1/1'
	);

	$grve_column_desktop_hide_list = array(
		esc_html__( 'Default value from width attribute', 'blade') => '',
		esc_html__( 'Hide', 'blade' ) => 'hide',
	);

	$grve_column_width_tablet_list = array(
		esc_html__( 'Default value from width attribute', 'blade') => '',
		esc_html__( 'Hide', 'blade' ) => 'hide',
		esc_html__( '1 column - 1/12', 'blade' ) => '1-12',
		esc_html__( '2 columns - 1/6', 'blade' ) => '1-6',
		esc_html__( '3 columns - 1/4', 'blade' ) => '1-4',
		esc_html__( '4 columns - 1/3', 'blade' ) => '1-3',
		esc_html__( '5 columns - 5/12', 'blade' ) => '5-12',
		esc_html__( '6 columns - 1/2', 'blade' ) => '1-2',
		esc_html__( '7 columns - 7/12', 'blade' ) => '7-12',
		esc_html__( '8 columns - 2/3', 'blade' ) => '2-3',
		esc_html__( '9 columns - 3/4', 'blade' ) => '3-4',
		esc_html__( '10 columns - 5/6', 'blade' ) => '5-6',
		esc_html__( '11 columns - 11/12', 'blade' ) => '11-12',
		esc_html__( '12 columns - 1/1', 'blade' ) => '1',
	);

	$grve_column_width_tablet_sm_list = array(
		esc_html__( 'Inherit from Tablet Landscape', 'blade') => '',
		esc_html__( 'Hide', 'blade' ) => 'hide',
		esc_html__( '1 column - 1/12', 'blade' ) => '1-12',
		esc_html__( '2 columns - 1/6', 'blade' ) => '1-6',
		esc_html__( '3 columns - 1/4', 'blade' ) => '1-4',
		esc_html__( '4 columns - 1/3', 'blade' ) => '1-3',
		esc_html__( '5 columns - 5/12', 'blade' ) => '5-12',
		esc_html__( '6 columns - 1/2', 'blade' ) => '1-2',
		esc_html__( '7 columns - 7/12', 'blade' ) => '7-12',
		esc_html__( '8 columns - 2/3', 'blade' ) => '2-3',
		esc_html__( '9 columns - 3/4', 'blade' ) => '3-4',
		esc_html__( '10 columns - 5/6', 'blade' ) => '5-6',
		esc_html__( '11 columns - 11/12', 'blade' ) => '11-12',
		esc_html__( '12 columns - 1/1', 'blade' ) => '1',
	);
	$grve_column_mobile_width_list = array(
		esc_html__( '12 columns - 1/1', 'blade' ) => '',
		esc_html__( 'Hide', 'blade' ) => 'hide',
	);

	vc_add_param( "vc_row",
		array(
			"type" => "textfield",
			"heading" => esc_html__('Section ID', 'blade' ),
			"param_name" => "section_id",
			"description" => esc_html__("If you wish you can type an id to use it as bookmark.", 'blade' ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => "colorpicker",
			"heading" => esc_html__('Font Color', 'blade' ),
			"param_name" => "font_color",
			"description" => esc_html__("Select font color", 'blade' ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Heading Color", 'blade' ),
			"param_name" => "heading_color",
			"value" => array(
				esc_html__( "Default", 'blade' ) => '',
				esc_html__( "Dark", 'blade' ) => 'dark',
				esc_html__( "Light", 'blade' ) => 'light',
				esc_html__( "Primary 1", 'blade' ) => 'primary-1',
				esc_html__( "Primary 2", 'blade' ) => 'primary-2',
				esc_html__( "Primary 3", 'blade' ) => 'primary-3',
				esc_html__( "Primary 4", 'blade' ) => 'primary-4',
				esc_html__( "Primary 5", 'blade' ) => 'primary-5',
			),
			"description" => esc_html__( "Select heading color", 'blade' ),
		)
	);

	vc_add_param( "vc_row", $grve_add_el_class );

	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Section Type", 'blade' ),
			"param_name" => "section_type",
			"value" => array(
				esc_html__( "Full Width Background", 'blade' ) => 'fullwidth-background',
				esc_html__( "Full Width Element", 'blade' ) => 'fullwidth',
			),
			"description" => esc_html__( "Select section type", 'blade' ),
			"group" => esc_html__( "Section Options", 'blade' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Equal Column Height", 'blade' ),
			"param_name" => "equal_column_height",
			"value" => array(
				esc_html__( "None", 'blade' ) => 'none',
				esc_html__( "Equal Height Columns", 'blade' ) => 'equal-column',
				esc_html__( "Equal Height Columns and Middle Content", 'blade' ) => 'middle-content',
			),
			"description" => esc_html__( "Recommended for multiple columns with different background colors. Additionally you can set your columns content in middle. If you need some paddings in your columns, please place them only in the column with the largest content.", 'blade' ),
			"group" => esc_html__( "Section Options", 'blade' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Section Window Height", 'blade' ),
			"param_name" => "section_full_height",
			"value" => array(
				esc_html__( "No", 'blade' ) => 'no',
				esc_html__( "Yes", 'blade' ) => 'fullheight',
			),
			"description" => esc_html__( "Select if you want your section height to be equal with the window height", 'blade' ),
			"group" => esc_html__( "Section Options", 'blade' ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => 'dropdown',
			"heading" => esc_html__( "Background Type", 'blade' ),
			"param_name" => "bg_type",
			"description" => esc_html__( "Select Background type", 'blade' ),
			"value" => array(
				esc_html__( "None", 'blade' ) => '',
				esc_html__( "Color", 'blade' ) => 'color',
				esc_html__( "Image", 'blade' ) => 'image',
				esc_html__( "Hosted Video", 'blade' ) => 'hosted_video',
			),
			"group" => esc_html__( "Section Options", 'blade' ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => "colorpicker",
			"heading" => esc_html__( "Custom Background Color", 'blade' ),
			"param_name" => "bg_color",
			"description" => esc_html__( "Select background color for your row", 'blade' ),
			"dependency" => array(
				'element' => 'bg_type',
				'value' => array( 'color' )
			),
			"group" => esc_html__( "Section Options", 'blade' ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => "attach_image",
			"heading" => esc_html__('Background Image', 'blade' ),
			"param_name" => "bg_image",
			"value" => '',
			"description" => esc_html__("Select background image for your row. Used also as fallback for video.", 'blade' ),
			"dependency" => array(
				'element' => 'bg_type',
				'value' => array( 'image', 'hosted_video' )
			),
			"group" => esc_html__( "Section Options", 'blade' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Background Image Type", 'blade' ),
			"param_name" => "bg_image_type",
			"value" => array(
				esc_html__( "Default", 'blade' ) => '',
				esc_html__( "Parallax", 'blade' ) => 'parallax',
				esc_html__( "Horizontal Parallax Left to Right", 'blade' ) => 'horizontal-parallax-lr',
				esc_html__( "Horizontal Parallax Right to Left", 'blade' ) => 'horizontal-parallax-rl',
				esc_html__( "Animated", 'blade' ) => 'animated',
				esc_html__( "Horizontal Animation", 'blade' ) => 'horizontal',
				esc_html__( "Image usage as Pattern", 'blade' ) => 'pattern'
			),
			"description" => esc_html__( "Select how a background image will be displayed", 'blade' ),
			"dependency" => array(
				'element' => 'bg_type',
				'value' => array( 'image' )
			),
			"group" => esc_html__( "Section Options", 'blade' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Background Image Vertical Position", 'blade' ),
			"param_name" => "bg_image_vertical_position",
			"value" => array(
				esc_html__( "Top", 'blade' ) => 'top',
				esc_html__( "Center", 'blade' ) => 'center',
				esc_html__( "Bottom", 'blade' ) => 'bottom',
			),
			"description" => esc_html__( "Select vertical position for background image", 'blade' ),
			"dependency" => array(
				'element' => 'bg_image_type',
				'value' => array( 'horizontal-parallax-lr', 'horizontal-parallax-rl' )
			),
			"group" => esc_html__( "Section Options", 'blade' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Parallax Sensor", 'blade' ),
			"param_name" => "parallax_sensor",
			"value" => array(
				esc_html__( "Low", 'blade' ) => '150',
				esc_html__( "Normal", 'blade' ) => '250',
				esc_html__( "High", 'blade' ) => '350',
				esc_html__( "Max", 'blade' ) => '550',
			),
			"description" => esc_html__( "Define the appearance for the parallax effect. Note that you get greater image zoom when you increase the parallax sensor.", 'blade' ),
			"dependency" => array(
				'element' => 'bg_image_type',
				'value' => array( 'parallax', 'horizontal-parallax-lr', 'horizontal-parallax-rl' )
			),
			"std" => '250',
			"group" => esc_html__( "Section Options", 'blade' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "textfield",
			"heading" => esc_html__("WebM File URL", 'blade'),
			"param_name" => "bg_video_webm",
			"description" => esc_html__( "Fill WebM and mp4 format for browser compatibility", 'blade' ),
			"dependency" => array(
				'element' => 'bg_type',
				'value' => array( 'hosted_video' )
			),
			"group" => esc_html__( "Section Options", 'blade' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "textfield",
			"heading" => esc_html__( "MP4 File URL", 'blade' ),
			"param_name" => "bg_video_mp4",
			"description" => esc_html__( "Fill mp4 format URL", 'blade' ),
			"dependency" => array(
				'element' => 'bg_type',
				'value' => array( 'hosted_video' )
			),
			"group" => esc_html__( "Section Options", 'blade' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "textfield",
			"heading" => esc_html__( "OGV File URL", 'blade' ),
			"param_name" => "bg_video_ogv",
			"description" => esc_html__( "Fill OGV format URL ( optional )", 'blade' ),
			"dependency" => array(
				'element' => 'bg_type',
				'value' => array( 'hosted_video' )
			),
			"group" => esc_html__( "Section Options", 'blade' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Loop", 'blade' ),
			"param_name" => "bg_video_loop",
			"value" => array(
				esc_html__( "Yes", 'blade' ) => 'yes',
				esc_html__( "No", 'blade' ) => 'no',
			),
			"std" => 'yes',
			"dependency" => array(
				'element' => 'bg_type',
				'value' => array( 'hosted_video' )
			),
			"group" => esc_html__( "Section Options", 'blade' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Muted", 'blade' ),
			"param_name" => "bg_video_muted",
			"value" => array(
				esc_html__( "Yes", 'blade' ) => 'yes',
				esc_html__( "No", 'blade' ) => 'no',
			),
			"std" => 'yes',
			"dependency" => array(
				'element' => 'bg_type',
				'value' => array( 'hosted_video' )
			),
			"group" => esc_html__( "Section Options", 'blade' ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => 'checkbox',
			"heading" => esc_html__( "Pattern overlay", 'blade'),
			"param_name" => "pattern_overlay",
			"description" => esc_html__( "If selected, a pattern will be added.", 'blade' ),
			"value" => Array(esc_html__( "Add pattern", 'blade' ) => 'yes'),
			"dependency" => array(
				'element' => 'bg_type',
				'value' => array( 'image', 'hosted_video' )
			),
			"group" => esc_html__( "Section Options", 'blade' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Color overlay", 'blade' ),
			"param_name" => "color_overlay",
			"value" => array(
				esc_html__( "None", 'blade' ) => '',
				esc_html__( "Dark", 'blade' ) => 'dark',
				esc_html__( "Light", 'blade' ) => 'light',
				esc_html__( "Primary 1", 'blade' ) => 'primary-1',
				esc_html__( "Primary 2", 'blade' ) => 'primary-2',
				esc_html__( "Primary 3", 'blade' ) => 'primary-3',
				esc_html__( "Primary 4", 'blade' ) => 'primary-4',
				esc_html__( "Primary 5", 'blade' ) => 'primary-5',
				esc_html__( "Custom", 'blade' ) => 'custom',
			),
			"dependency" => array(
				'element' => 'bg_type',
				'value' => array( 'image', 'hosted_video' )
			),
			"description" => esc_html__( "A color overlay for the media", 'blade' ),
			"group" => esc_html__( "Section Options", 'blade' ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => "colorpicker",
			"heading" => esc_html__('Custom Color Overlay', 'blade' ),
			"param_name" => "color_overlay_custom",
			"dependency" => array(
				'element' => 'color_overlay',
				'value' => array( 'custom' )
			),
			"std" => '#ffffff',
			"description" => esc_html__("Select custom color overlay", 'blade' ),
			"group" => esc_html__( "Section Options", 'blade' ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Opacity overlay", 'blade' ),
			"param_name" => "opacity_overlay",
			"value" => array( 10, 20, 30 ,40, 50, 60, 70, 80 ,90 ),
			"description" => esc_html__( "Opacity of the overlay", 'blade' ),
			"dependency" => array(
				'element' => 'color_overlay',
				'value' => array( 'dark', 'light', 'primary-1', 'primary-2', 'primary-3', 'primary-4', 'primary-5' )
			),
			"group" => esc_html__( "Section Options", 'blade' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Top padding", 'blade' ),
			"param_name" => "padding_top",
			"dependency" => array(
				'element' => 'section_full_height',
				'value' => array( 'no' )
			),
			"description" => esc_html__( "You can use px, em, %, etc. or enter just number and it will use pixels.", 'blade' ),
			"group" => esc_html__( "Section Options", 'blade' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Bottom padding", 'blade' ),
			"param_name" => "padding_bottom",
			"dependency" => array(
				'element' => 'section_full_height',
				'value' => array( 'no' )
			),
			"description" => esc_html__( "You can use px, em, %, etc. or enter just number and it will use pixels.", 'blade' ),
			"group" => esc_html__( "Section Options", 'blade' ),
		)
	);
	vc_add_param( "vc_row",
		array(
		"type" => "textfield",
		"heading" => esc_html__( 'Bottom margin', 'blade' ),
		"param_name" => "margin_bottom",
		"description" => esc_html__( "You can use px, em, %, etc. or enter just number and it will use pixels.", 'blade' ),
		"group" => esc_html__( "Section Options", 'blade' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => 'checkbox',
			"heading" => esc_html__( "Header Section", 'blade' ),
			"param_name" => "header_feature",
			"description" => esc_html__( "Use this option if first section ( no gap from header )", 'blade' ),
			"value" => Array(esc_html__( "Header section", 'blade' ) => 'yes'),
			"group" => esc_html__( "Section Options", 'blade' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => 'checkbox',
			"heading" => esc_html__( "Footer Section", 'blade' ),
			"param_name" => "footer_feature",
			"description" => esc_html__( "Use this option if last section ( no gap from footer )", 'blade' ),
			"value" => Array(esc_html__( "Footer section", 'blade' ) => 'yes'),
			"group" => esc_html__( "Section Options", 'blade' ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => 'checkbox',
			"heading" => esc_html__( "Desktop Visibility", 'blade'),
			"param_name" => "desktop_visibility",
			"description" => esc_html__( "If selected, row will be hidden on desktops/laptops.", 'blade' ),
			"value" => Array(esc_html__( "Hide", 'blade' ) => 'hide'),
			'group' => esc_html__( "Responsiveness", 'blade' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => 'checkbox',
			"heading" => esc_html__( "Tablet Landscape Visibility", 'blade'),
			"param_name" => "tablet_visibility",
			"description" => esc_html__( "If selected, row will be hidden on tablet devices with landscape orientation.", 'blade' ),
			"value" => Array(esc_html__( "Hide", 'blade' ) => 'hide'),
			'group' => esc_html__( "Responsiveness", 'blade' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => 'checkbox',
			"heading" => esc_html__( "Tablet Portrait Visibility", 'blade'),
			"param_name" => "tablet_sm_visibility",
			"description" => esc_html__( "If selected, row will be hidden on tablet devices with portrait orientation.", 'blade' ),
			"value" => Array(esc_html__( "Hide", 'blade' ) => 'hide'),
			'group' => esc_html__( "Responsiveness", 'blade' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => 'checkbox',
			"heading" => esc_html__( "Mobile Visibility", 'blade'),
			"param_name" => "mobile_visibility",
			"description" => esc_html__( "If selected, row will be hidden on mobile devices.", 'blade' ),
			"value" => Array(esc_html__( "Hide", 'blade' ) => 'hide'),
			'group' => esc_html__( "Responsiveness", 'blade' ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Header Style", 'blade' ),
			"param_name" => "scroll_header_style",
			"value" => array(
				esc_html__( "Dark", 'blade' ) => 'dark',
				esc_html__( "Light", 'blade' ) => 'light',
			),
			"std" => 'dark',
			"description" => esc_html__( "Select header style", 'blade' ),
			"group" => esc_html__( "Scrolling Section Options", 'blade' ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => "textfield",
			"heading" => esc_html__('Scrolling Section Title', 'blade' ),
			"param_name" => "scroll_section_title",
			"description" => esc_html__("If you wish you can type a title for the side dot navigation.", 'blade' ),
			"group" => esc_html__( "Scrolling Section Options", 'blade' ),
		)
	);

	vc_add_param( "vc_column",
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( "Width", 'blade' ),
			'param_name' => 'width',
			'value' => $grve_column_width_list,
			'group' => esc_html__( "Width & Responsiveness", 'blade' ),
			'description' => esc_html__( "Select column width.", 'blade' ),
			'std' => '1/1'
		)
	);
	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Desktop", 'blade' ),
			"param_name" => "desktop_hide",
			"value" => $grve_column_desktop_hide_list,
			"description" => esc_html__( "Responsive column on desktops/laptops.", 'blade' ),
			'group' => esc_html__( 'Width & Responsiveness', 'blade' ),
		)
	);
	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Tablet Landscape", 'blade' ),
			"param_name" => "tablet_width",
			"value" => $grve_column_width_tablet_list,
			"description" => esc_html__( "Responsive column on tablet devices with landscape orientation.", 'blade' ),
			'group' => esc_html__( 'Width & Responsiveness', 'blade' ),
		)
	);
	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Tablet Portrait", 'blade' ),
			"param_name" => "tablet_sm_width",
			"value" => $grve_column_width_tablet_sm_list,
			"description" => esc_html__( "Responsive column on tablet devices with portrait orientation.", 'blade' ),
			'group' => esc_html__( 'Width & Responsiveness', 'blade' ),
		)
	);
	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Mobile", 'blade' ),
			"param_name" => "mobile_width",
			"value" => $grve_column_mobile_width_list,
			"description" => esc_html__( "Responsive column on mobile devices.", 'blade' ),
			'group' => esc_html__( 'Width & Responsiveness', 'blade' ),
		)
	);

	vc_add_param( "vc_column",
		array(
			"type" => "colorpicker",
			"heading" => esc_html__('Font Color', 'blade' ),
			"param_name" => "font_color",
			"description" => esc_html__("Select font color", 'blade' ),
		)
	);

	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Heading Color", 'blade' ),
			"param_name" => "heading_color",
			"value" => array(
				esc_html__( "Default", 'blade' ) => '',
				esc_html__( "Dark", 'blade' ) => 'dark',
				esc_html__( "Light", 'blade' ) => 'light',
				esc_html__( "Primary 1", 'blade' ) => 'primary-1',
				esc_html__( "Primary 2", 'blade' ) => 'primary-2',
				esc_html__( "Primary 3", 'blade' ) => 'primary-3',
				esc_html__( "Primary 4", 'blade' ) => 'primary-4',
				esc_html__( "Primary 5", 'blade' ) => 'primary-5',
			),
			"description" => esc_html__( "Select heading color", 'blade' ),
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( "Width", 'blade' ),
			'param_name' => 'width',
			'value' => $grve_column_width_list,
			'group' => esc_html__( "Width & Responsiveness", 'blade' ),
			'description' => esc_html__( "Select column width.", 'blade' ),
			'std' => '1/1'
		)
	);
	vc_add_param( "vc_column_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Desktop", 'blade' ),
			"param_name" => "desktop_hide",
			"value" => $grve_column_desktop_hide_list,
			"description" => esc_html__( "Responsive column on desktops/laptops.", 'blade' ),
			'group' => esc_html__( 'Width & Responsiveness', 'blade' ),
		)
	);
	vc_add_param( "vc_column_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Tablet Landscape", 'blade' ),
			"param_name" => "tablet_width",
			"value" => $grve_column_width_tablet_list,
			"description" => esc_html__( "Responsive column on tablet devices with landscape orientation.", 'blade' ),
			'group' => esc_html__( 'Width & Responsiveness', 'blade' ),
		)
	);
	vc_add_param( "vc_column_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Tablet Portrait", 'blade' ),
			"param_name" => "tablet_sm_width",
			"value" => $grve_column_width_tablet_sm_list,
			"description" => esc_html__( "Responsive column on tablet devices with portrait orientation.", 'blade' ),
			'group' => esc_html__( 'Width & Responsiveness', 'blade' ),
		)
	);
	vc_add_param( "vc_column_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Mobile", 'blade' ),
			"param_name" => "mobile_width",
			"value" => $grve_column_mobile_width_list,
			"description" => esc_html__( "Responsive column on mobile devices.", 'blade' ),
			'group' => esc_html__( 'Width & Responsiveness', 'blade' ),
		)
	);

	vc_add_param( "vc_widget_sidebar",
		array(
			'type' => 'hidden',
			'param_name' => 'title',
			'value' => '',
		)
	);

	if ( defined( 'WPB_VC_VERSION' ) && version_compare( WPB_VC_VERSION, '4.6', '>=') ) {

		vc_add_param( "vc_tta_tabs",
			array(
				'type' => 'hidden',
				'param_name' => 'no_fill_content_area',
				'value' => '',
			)
		);

		vc_add_param( "vc_tta_tabs",
			array(
				'type' => 'hidden',
				'param_name' => 'tab_position',
				'value' => 'top',
			)
		);

		vc_add_param( "vc_tta_accordion",
			array(
				'type' => 'hidden',
				'param_name' => 'no_fill',
				'value' => '',
			)
		);

		vc_add_param( "vc_tta_tour",
			array(
				'type' => 'hidden',
				'param_name' => 'no_fill_content_area',
				'value' => '',
			)
		);
	}

	vc_add_param( "vc_column_text",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Text Style", 'blade' ),
			"param_name" => "text_style",
			"value" => array(
				esc_html__( "None", 'blade' ) => '',
				esc_html__( "Leader", 'blade' ) => 'leader-text',
				esc_html__( "Subtitle", 'blade' ) => 'subtitle',
			),
			"description" => esc_html__( "Select your text style", 'blade' ),
		)
	);
	vc_add_param( "vc_column_text", $grve_add_animation );
	vc_add_param( "vc_column_text", $grve_add_animation_delay );


}

//Omit closing PHP tag to avoid accidental whitespace output errors.
