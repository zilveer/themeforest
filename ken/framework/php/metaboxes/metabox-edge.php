<?php
$config  = array(
	'title' => __( 'Edge Slider Meta Options', 'mk_framework' ),
	'id' => 'mk-metaboxes-edge',
	'pages' => array(
		'edge'
	),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'core'
);
$options = array(

	array(
		"name" => __( "Content Animation", "mk_framework" ),
		"subtitle" => __( "The type animation for this slide content", "mk_framework" ),
		"desc" => __( "Using this option you can define specific animations for the content of this slider. This option will affect custom content that you create from above WP editor or the built-in captions and buttons.", "mk_framework" ),
		"id" => "_animation",
		"default" => 'fade-in',
		"options" => array(
			"fade-in" => __( "Fade in", 'mk_framework' ),
			"slide-top" => __( 'Slide from Top', 'mk_framework' ),
			"slide-left" => __( 'Slide from Left', 'mk_framework' ),
			"slide-bottom" => __( 'Slide from Bottom', 'mk_framework' ),
			"slide-right" => __( 'Slide from Right', 'mk_framework' ),
			"scale-down" => __( 'Scale Down', 'mk_framework' ),
			"flip-x" => __( 'Horizontally Flip', 'mk_framework' ),
			"flip-y" => __( 'Vertically Flip', 'mk_framework' ),
		),
		"type" => "select"
	),

	array(
		"name" => __( "Slider Type", "mk_framework" ),
		"subtitle" => __( "Do you want to have video or Image for this slide item?", "mk_framework" ),
		"desc" => __( "", "mk_framework" ),
		"id" => "_edge_type",
		"default" => 'image',
		"options" => array(
			"image" => __( "Image", 'mk_framework' ),
			"video" => __( 'Video', 'mk_framework' ),

		),
		"type" => "select"
	),

	array(
		"name" => __( "MP4", "mk_framework" ),
		"subtitle" => __( "Upload MP4 format" , "mk_framework" ),
		"desc" => __( "MP4 for Safari, IE9, iPhone, iPad, Android, and Windows Phone 7", "mk_framework" ),
		"id" => "_video_mp4",
		"default" => '',
		"preview" => false,
		"type" => 'upload'
	),

	array(
		"name" => __( "WebM", "mk_framework" ),
		"subtitle" => __( "Upload WebM format" , "mk_framework" ),
		"desc" => __( "WebM/VP8 for Firefox4, Opera, and Chrome", "mk_framework" ),
		"id" => "_video_webm",
		"default" => '',
		"preview" => false,
		"type" => 'upload'
	),

	array(
		"name" => __( "OGV", "mk_framework" ),
		"subtitle" => __( "Upload OGV format" , "mk_framework" ),
		"desc" => __( "Compatibility for older Firefox and Opera versions", "mk_framework" ),
		"id" => "_video_ogv",
		"default" => '',
		"preview" => false,
		"type" => 'upload'
	),


	array(
		"name" => __( "Video Preview Image", "mk_framework" ),
		"subtitle" => __( "This Image will be shown until the video load." , "mk_framework" ),
		"desc" => __( "If video is not played due to lack of video support the image will remain as a fallback.", "mk_framework" ),
		"id" => "_video_preview",
		"default" => '',
		"type" => 'upload'
	),

	array(
		"name" => __( "Upload Image", "mk_framework" ),
		"subtitle" => __( "Upload slideshow image. Image will fit to the container size." , "mk_framework" ),
		"desc" => __( "For better quality in all browsers recommded size is 1920px * 1080px.", "mk_framework" ),
		"id" => "_slide_image",
		"default" => '',
		"preview" => true,
		"type" => 'upload'
	),
	array(
		"name" =>__( "Cover whole background", "mk_framework" ),
		"subtitle" => __( "This option is only when image is uploaded.", "mk_framework" ),
		"desc" => __( "Scale the background image to be as large as possible so that the background area is completely covered by the background image. Some parts of the background image may not be in view within the background positioning area.", "mk_framework" ),
		"id" => "_cover",
		"default" => "true",
		"type" => "toggle"
	),

	array(
		"name" => __( 'background Color', 'mk_framework' ),
		"subtitle" => __( "You can use solid color in slide item", "mk_framework" ),
		"desc" => __( "Solid color backgrounds can give your slideshow a playground for your company slogans", "mk_framework" ),
		"id" => "_bg_color",
		"default" => "",
		"type" => "color"
	),
	array(
		"name" =>__( "Pattern Mask", "mk_framework" ),
		"subtitle" => __( "If you enable this option a pattern will overlay the video.", "mk_framework" ),
		"desc" => __( "If you are going to use text and content over the video mask will make your content more readable.", "mk_framework" ),
		"id" => "_pattern",
		"default" => "false",
		"type" => "toggle"
	),

	array(
		"name" => __( 'Color Overlay', 'mk_framework' ),
		"subtitle" => __( 'Overlay trancparency value can be set in below option.', 'mk_framework' ),
		"desc" => __( "This color will stay over the video or image and the final output will be a colored video.", "mk_framework" ),
		"id" => "_color_overlay",
		"default" => "",
		"type" => "color"
	),
	array(
		"name" => __( "Color Overlay Opacity", "mk_framework" ),
		"subtitle" => __( "Default : 0.3", "mk_framework" ),
		"desc" => __( "", "mk_framework" ),
		"id" => "_overlay_opacity",
		"default" => "0.3",
		"min" => "0",
		"max" => "1",
		"step" => "0.1",
		"unit" => 'alpha',
		"type" => "range"
	),


	array(
		"name" => __( "Content Align", "mk_framework" ),
		"subtitle" => __( "Location of caption and buttons.", "mk_framework" ),
		"desc" => __( "Based on your choice of the location the content will be dynamically located inside the slideshow.", "mk_framework" ),
		"id" => "_caption_align",
		"default" => 'left_center',
		"options" => array(
			"left_top" => __( "Left Top", 'mk_framework' ),
			"center_top" => __( 'Center Top', 'mk_framework' ),
			"right_top" => __( 'Right Top', 'mk_framework' ),
			"left_center" => __( 'Left Center', 'mk_framework' ),
			"center_center" => __( 'Center Center', 'mk_framework' ),
			"right_center" => __( 'Right Center', 'mk_framework' ),
			"left_bottom" => __( 'Left Bottom', 'mk_framework' ),
			"center_bottom" => __( 'Center Bottom', 'mk_framework' ),
			"right_bottom" => __( 'Right Bottom', 'mk_framework' ),

		),
		"type" => "select"
	),

	array(
		"name" => __( "Content Width", "mk_framework" ),
		"subtitle" => __( "You can define the content width based on percent.", "mk_framework" ),
		"desc" => __( "please note that this width will be defined percent width of main grid. default : 70%", "mk_framework" ),
		"id" => "_content_width",
		"default" => "70",
		"min" => "0",
		"max" => "100",
		"step" => "1",
		"unit" => '%',
		"type" => "range"
	),
	array(
		"name" => __( "Caption Title", "mk_framework" ),
		"subtitle" => __( '', 'mk_framework' ),
		"desc" => __( "", "mk_framework" ),
		"id" => "_title",
		"default" => '',
		"type" => "text"
	),
	array(
		"name" => __( "Caption Title Font Size", "mk_framework" ),
		"subtitle" => __( "Default : 50", "mk_framework" ),
		"desc" => __( "", "mk_framework" ),
		"id" => "_title_size",
		"default" => "50",
		"min" => "12",
		"max" => "200",
		"step" => "1",
		"unit" => 'px',
		"type" => "range"
	),
	array(
		"name" => __( "Caption Title Font Weight", "mk_framework" ),
		"subtitle" => __( "", "mk_framework" ),
		"desc" => __( "", "mk_framework" ),
		"id" => "_caption_title_weight",
		"default" => '300',
		"options" => array(
			"inherit" => __('Default', "mk_framework"),
            "600" => __('Semi Bold', "mk_framework"),
            "bold" => __('Bold', "mk_framework"),
            "bolder" => __('Bolder', "mk_framework"),
            "normal" => __('Normal', "mk_framework"),
            "300" => __('Light', "mk_framework")

		),
		"type" => "select"
	),

	array(
		"name" => __( "Caption Description", "mk_framework" ),
		"subtitle" => __( '', 'mk_framework' ),
		"desc" => __( "", "mk_framework" ),
		"id" => "_description",
		"default" => "",
		"rows" => "3",
		"type" => "textarea"
	),

	array(
		"name" => __( "Caption Skin", "mk_framework" ),
		"subtitle" => __( "", "mk_framework" ),
		"desc" => __( "", "mk_framework" ),
		"id" => "_caption_skin",
		"default" => 'light',
		"options" => array(
			"light" => __( "Light", 'mk_framework' ),
			"dark" => __( 'Dark', 'mk_framework' ),
			"custom" => __( 'Custom Color (Change from below option)', 'mk_framework' ),

		),
		"type" => "select"
	),
	array(
		"name" => __( 'Custom Caption Text Color', 'mk_framework' ),
		"subtitle" => __( 'This option will only work when you choose custom from "Caption Skin" option above.', 'mk_framework' ),
		"desc" => __( "This option will affect both caption title & description.", "mk_framework" ),
		"id" => "_custom_caption_color",
		"default" => "",
		"type" => "color"
	),


	array(
		"name" => __( "Button 1 Style", "mk_framework" ),
		"subtitle" => __( "", "mk_framework" ),
		"desc" => __( "", "mk_framework" ),
		"id" => "_btn_1_style",
		"default" => 'outline',
		'layout' => 'half',
		"options" => array(
			"outline" => __( "Outline", 'mk_framework' ),
			"flat" => __( 'Flat', 'mk_framework' ),
			"line" => __( 'Line', 'mk_framework' ),
			"fill" => __( 'Fill', 'mk_framework' ),
			"radius" => __( 'Radius', 'mk_framework' ),
			"fancy_link" => __( 'Fancy', 'mk_framework' )
		),
		"type" => "select"
	),

	array(
		"name" => __( "Button 1 Skin", "mk_framework" ),
		"subtitle" => __( "", "mk_framework" ),
		"desc" => __( "", "mk_framework" ),
		"id" => "_btn_1_skin",
		"default" => 'light',
		'layout' => 'half',
		"divider" => true,
		"options" => array(
			"dark" => __( "Dark", 'mk_framework' ),
			"light" => __( 'Light', 'mk_framework' ),
			"skin" => __( 'Theme Skin Color', 'mk_framework' ),
		),
		"type" => "select"
	),


	array(
		"name" => __( "Button 1 Text", "mk_framework" ),
		"subtitle" => __( '', 'mk_framework' ),
		"desc" => __( "", "mk_framework" ),
		"id" => "_btn_1_txt",
		"default" => '',
		'layout' => 'half',
		"size" => 30,
		"type" => "text"
	),

	array(
		"name" => __( "Button 1 URL", "mk_framework" ),
		"subtitle" => __( 'Button Link', 'mk_framework' ),
		"desc" => __( "including http://", "mk_framework" ),
		"id" => "_btn_1_url",
		"default" => '',
		'layout' => 'half',
		"size" => 30,
		"type" => "text"
	),




	array(
		"name" => __( "Button 2 Style", "mk_framework" ),
		"subtitle" => __( "", "mk_framework" ),
		"desc" => __( "", "mk_framework" ),
		"id" => "_btn_2_style",
		"default" => 'outline',
		'layout' => 'half',
		"options" => array(
			"outline" => __( "Outline", 'mk_framework' ),
			"flat" => __( 'Flat', 'mk_framework' ),
			"line" => __( 'Line', 'mk_framework' ),
			"fill" => __( 'Fill', 'mk_framework' ),
			"radius" => __( 'Radius', 'mk_framework' ),
			"fancy_link" => __( 'Fancy', 'mk_framework' )
		),
		"type" => "select"
	),



	array(
		"name" => __( "Button 2 Skin", "mk_framework" ),
		"subtitle" => __( "", "mk_framework" ),
		"desc" => __( "", "mk_framework" ),
		"id" => "_btn_2_skin",
		"default" => 'light',
		'layout' => 'half',
		"divider" => true,
		"options" => array(
			"dark" => __( "Dark", 'mk_framework' ),
			"light" => __( 'Light', 'mk_framework' ),
			"skin" => __( 'Theme Skin Color', 'mk_framework' ),
		),
		"type" => "select"
	),

	array(
		"name" => __( "Button 2 Text", "mk_framework" ),
		"subtitle" => __( '', 'mk_framework' ),
		"desc" => __( "", "mk_framework" ),
		"id" => "_btn_2_txt",
		"default" => '',
		'layout' => 'half',
		"size" => 30,
		"type" => "text"
	),



	array(
		"name" => __( "Button 2 URL", "mk_framework" ),
		"subtitle" => __( 'Button Link', 'mk_framework' ),
		"desc" => __( "including http://", "mk_framework" ),
		"id" => "_btn_2_url",
		"default" => '',
		'layout' => 'half',
		"size" => 30,
		"type" => "text"
	),


	array(
		"name" => __( "Transparent Header Style Skin for this Slide", "mk_framework" ),
		"subtitle" => __( "If this slide image or video is light color then you should choose dark otherwise light.", "mk_framework" ),
		"desc" => __( "", "mk_framework" ),
		"id" => "_edge_header_skin",
		"default" => 'dark',
		"options" => array(
			"dark" => __( "Dark", 'mk_framework' ),
			"light" => __( 'Light', 'mk_framework' ),

		),
		"type" => "select"
	),

	array(
		"name" => __( "Hash Data Attribute?", "mk_framework" ),
		"subtitle" => __( 'Add an alias title for this slide (use dash instead of space)', 'mk_framework' ),
		"desc" => __( "Use this field if you want to navigate to an specific slide using URL hash value. You will also need to enable the 'Hash Navigation?' option from edge slider shortcode options.", "mk_framework" ),
		"id" => "_hash_attribute",
		"default" => '',
		'layout' => 'half',
		"size" => 30,
		"type" => "text"
	),




);
new mk_metaboxesGenerator( $config, $options );
