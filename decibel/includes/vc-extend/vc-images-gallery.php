<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$args = array(
	'name' => __( 'Image gallery', 'wolf' ),
	'base' => 'wolf_images_gallery',
	'category' => 'by WolfThemes',
	'icon' => 'wolf-vc-icon wolf-vc-images-gallery',
	'allowed_container_element' => 'vc_row',
	'params' => array(

		array(
			'type' => 'attach_images',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Images', 'wolf' ),
			'param_name' => 'ids',
			'description' => '',
		),

		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => __( 'Layout', 'wolf' ),
			'param_name' => 'layout',
			'value' => array(
				__( 'Mosaic', 'wolf' ) => 'mosaic',
				//__( 'Mosaic carousel', 'wolf' ) => 'carousel_mosaic',
				__( 'Simple carousel', 'wolf' ) => 'carousel_simple',
				__( 'Simple', 'wolf' ) => 'simple',
			),
			'description' => __( 'For the mosaic gallery set a minimum of 12 image and a multiple of 6 is recommended.<br>Uploaded images must be 960x960px minimum.', 'wolf' ),
		),

		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => __( 'Columns', 'wolf' ),
			'param_name' => 'columns',
			'value' => array(
				1,2,3,4,5,6
			),
			'description' => '',
			'dependency' => array( 'element' => 'layout', 'value' => array( 'simple' ) ),
		),

		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => __( 'Image size', 'wolf' ),
			'param_name' => 'size',
			'value' => array(
				__( 'Standard', 'wolf' ) => 'classic-thumb',
				__( 'Square', 'wolf' ) => '2x2',
				__( 'Portrait', 'wolf' ) => 'portrait',
			),
			'description' => '',
			'dependency' => array( 'element' => 'layout', 'value' => array( 'simple', 'carousel_simple' ) ),
		),

		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => __( 'Link', 'wolf' ),
			'param_name' => 'link',
			'value' => array(
				__( 'Open in a lightbox', 'wolf' ) => 'file',
				__( 'Full Size image', 'wolf' ) => 'raw-file',
				__( 'Attachment page', 'wolf' ) => 'attachment',
				__( 'Not linked', 'wolf' ) => 'none',
			),
			'description' => '',
		),

		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => __( 'Hover effect', 'wolf' ),
			'param_name' => 'hover_effect',
			'value' => array(
				__( 'Default', 'wolf' ) => 'default',
				__( 'Black and white to colored', 'wolf' ) => 'greyscale',
				__( 'Colored to black and white', 'wolf' ) => 'to-greyscale',
				__( 'Zoom + Black and white to colored', 'wolf' ) => 'scale-greyscale',
				__( 'Zoom + Colored to black and white', 'wolf' ) => 'scale-to-greyscale',
				__( 'None', 'wolf' ) => 'none',
			),
			'description' => __( 'Note that not all browser support the black and white effect', 'wolf' ),
			'dependency' => array( 'columns' => 'link', 'value' => array( 'full_size', 'attachment' ) ),
		),

		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => __( 'Padding', 'wolf' ),
			'param_name' => 'padding',
			'value' => array(
				__( 'No', 'wolf' ) => 'no',
				__( 'Yes', 'wolf' ) => 'yes',
			),
			'description' => '',
			'dependency' => array( 'element' => 'layout', 'value' => array( 'simple', 'carousel_simple' ) ),
		),

		array(
			'type' => 'textfield',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Inline style', 'wolf' ),
			'param_name' => 'inline_style',
			'description' => __( 'Additional inline CSS style', 'wolf' ),
			'value' => '',
		),

		array(
			'type' => 'textfield',
			'holder' => 'div',
			'class' => '',
			'heading' => __( 'Extra class', 'wolf' ),
			'param_name' => 'class',
			'description' => __( 'Optional additional CSS class to add to the element', 'wolf' ),
			'value' => '',
		),
	)
);
vc_map( $args );