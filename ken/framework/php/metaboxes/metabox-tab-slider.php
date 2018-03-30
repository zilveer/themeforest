<?php
$config  = array(
	'title' => __( 'Tab Slider Meta Options', 'mk_framework' ),
	'id' => 'mk-metaboxes-edge',
	'pages' => array(
		'tab_slider'
	),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'core'
);
$options = array(


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

	// array(
	// 	"name" => __( 'Color Overlay', 'mk_framework' ),
	// 	"subtitle" => __( 'Overlay trancparency value can be set in below option.', 'mk_framework' ),
	// 	"desc" => __( "This color will stay over the video or image and the final output will be a colored video.", "mk_framework" ),
	// 	"id" => "_color_overlay",
	// 	"default" => "",
	// 	"type" => "color"
	// ),
	// array(
	// 	"name" => __( "Color Overlay Opacity", "mk_framework" ),
	// 	"subtitle" => __( "Default : 0.3", "mk_framework" ),
	// 	"desc" => __( "", "mk_framework" ),
	// 	"id" => "_overlay_opacity",
	// 	"default" => "0.3",
	// 	"min" => "0",
	// 	"max" => "1",
	// 	"step" => "0.1",
	// 	"unit" => 'alpha',
	// 	"type" => "range"
	// ),

	array(
		"name" => __( 'Content Background Color', 'mk_framework' ),
		"subtitle" => __( "You can use solid color in slide item", "mk_framework" ),
		"desc" => __( "Solid color backgrounds can give your slideshow a playground for your company slogans", "mk_framework" ),
		"id" => "_bg_color",
		"default" => "",
		"type" => "color"
	),


	array(
		"name" => __( "Style Skin for this Slide", "mk_framework" ),
		"subtitle" => __( "If this slide image or video is dark color then you should choose light otherwise dark.", "mk_framework" ),
		"desc" => __( "", "mk_framework" ),
		"id" => "_tab_skin",
		"default" => 'dark',
		"options" => array(
			"dark" => __( "Dark", 'mk_framework' ),
			"light" => __( 'Light', 'mk_framework' ),

		),
		"type" => "select"
	),


);
new mk_metaboxesGenerator( $config, $options );
