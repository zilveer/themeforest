<?php

$prefix = 'us_';

$meta_boxes[] = array(
	'id' => 'grata_page_portfolio_header_settings',
	'title' => 'Page Header Settings',
	'pages' => array('page'),
	'context' => 'normal',
	'priority' => 'default',

	// List of meta fields
	'fields' => array (
		array(
			'name'		=> 'Title Bar Content',
			'id'		=> $prefix . "titlebar",
			'type'		=> 'select',
			'options'	=> array(
				'' => 'Captions and Breadcrumbs',
				'caption_only' => 'Captions only',
				'hide' => 'Hide',
			),
		),
		array(
			'name'		=> 'Title Bar Size',
			'id'		=> $prefix . "header_layout_type",
			'type'		=> 'select',
			'options'	=> array(
				'' => 'Default (set at Theme Options)',
				'Large' => 'Large',
				'Compact' => 'Compact',
				'Ultra Compact' => 'Ultra Compact',
			),
		),
		array(
			'name'		=> 'Small caption (shown next to Page Title)',
			'id'		=> $prefix . 'subtitle',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
//		'desc'		=> 'Small caption is shown next to Page Title',
		),
		array(
			'name'		=> 'Title Bar Color Style',
			'id'		=> $prefix . "titlebar_color",
			'type'		=> 'select',
//		'desc'		=> 'Header takes more space. Use this when you want bigger image to show as Header Background. Active Slider always expands the header.',
			'options'	=> array(
				'' => 'Default',
				'primary' => 'Primary background & white text',
				'secondary' => 'Secondary background & white text',
			),
		),
		array(
			'name'		=> 'Title Bar Background Image',
			'id'		=> $prefix . "titlebar_image",
			'type'		=> 'image_advanced',
			'max_file_uploads'	=> 1,

		),
		array(
			'name'		=> 'Title Bar Background Image Size',
			'id'		=> $prefix . "titlebar_image_stretch",
			'type'		=> 'select',
			'options'	=> array(
				'' => 'Default',
				'stretch' => 'Stretch to 100% width',
//				'hide' => 'Hide',
			),
//			'desc'		=> 'Stretch the loaded image to 100% width',
		),

	),
);

$meta_boxes[] = array(
	'id' => 'page_section_settings',
	'title' => 'Page Section Settings',
	'pages' => array('us_main_page_section'),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array (

		array(
			'name'		=> 'Size',
			'type'		=> 'heading',
			'id'		=> $prefix . "heading_size",
			'class'		=> 'first',
		),
		array(
			'name'		=> 'Full Width Content',
			'id'		=> $prefix . "full_width",
			'type'		=> 'checkbox',
			'desc'		=> 'Expand content of this section to the screen width',
		),
		array(
			'name'		=> 'Full Height Content',
			'id'		=> $prefix . "full_height",
			'type'		=> 'checkbox',
			'desc'		=> 'Remove vertical indents',
		),
		array(
			'type'		=> 'divider',
			'id'		=> $prefix . "divider_1",
		),
		array(
			'name'		=> 'Full Screen Section',
			'id'		=> $prefix . "full_screen",
			'type'		=> 'checkbox',
			'desc'		=> 'Expand this section to browser window size',
		),
		array(
			'name'		=> 'Full Screen Centering',
			'id'		=> $prefix . "centering",
			'type'		=> 'checkbox',
			'desc'		=> 'Center content of this section by vertical',
		),
		array(
			'name'		=> 'Color',
			'type'		=> 'heading',
			'id'		=> $prefix . "heading_color",
		),
		array(
			'name'		=> 'Color Style',
			'id'		=> $prefix . "style",
			'type'		=> 'select',
			'options'	=> array(
				'' => 'Default',
				'primary' => 'White text on Primary background',
				'secondary' => 'White text on Secondary background',
				'custom' => 'Custom colors',
			),
		),
		array(
			'name'		=> 'Background Color',
			'id'		=> $prefix . "bg_color",
			'type'		=> 'color',
		),
		array(
			'name'		=> 'Text Color',
			'id'		=> $prefix . "text_color",
			'type'		=> 'color',
		),
		array(
			'name'		=> 'Image Background',
			'type'		=> 'heading',
			'id'		=> $prefix . "heading_img_bg",
		),
		array(
			'name'		=> 'Background Image',
			'id'		=> $prefix . "background",
			'type'		=> 'image_advanced',
			'max_file_uploads'	=> 1,
		),
		array(
			'name'		=> 'Stretch Image',
			'id'		=> $prefix . "bg_stretch",
			'std'		=> TRUE,
			'type'		=> 'checkbox',
			'desc'		=> 'Stretch Background Image to the screen size',
		),
		array(
			'name'		=> 'Parallax Effect',
			'id'		=> $prefix . "scrolling_effect",
			'type'		=> 'select',
			'options'	=> array(
				'' => 'None',
				'bg_fix' => 'Fix Background Image',
				'parallax_ver' => 'Vertical Parallax',
				'parallax_hor' => 'Horizontal Parallax',
			),
		),
		array(
			'name'		=> 'Video Background',
			'type'		=> 'heading',
			'id'		=> $prefix . "heading_video_bg",
		),
		array(
			'name'		=> 'Background Video',
			'id'		=> $prefix . "video",
			'type'		=> 'checkbox',
			'desc'		=> 'Apply Background Video to this section',
		),
		array(
			'name'		=> 'MP4 video file',
			'id'		=> $prefix . "video_mp4",
			'type'		=> 'text',
			'desc'      => 'Add link to MP4 video file',
		),
		array(
			'name'		=> 'OGV video file',
			'id'		=> $prefix . "video_ogg",
			'type'		=> 'text',
			'desc'      => 'Add link to OGV video file',
		),
		array(
			'name'		=> 'WebM video file',
			'id'		=> $prefix . "video_webm",
			'type'		=> 'text',
			'desc'      => 'Add link to WebM video file',
		),
		array(
			'name'		=> 'Overlay',
			'type'		=> 'heading',
			'id'		=> $prefix . "heading_overlay",
		),
		array(
			'name'		=> 'Overlay Background',
			'id'		=> $prefix . "fade",
			'type'		=> 'checkbox',
			'desc'		=> 'Overlay background of this section with custom color',
		),
		array(
			'name'		=> 'Overlay Color',
			'id'		=> $prefix . "fade_color",
			'type'		=> 'color',
		),
		array(
			'name'		 => 'Opacity of Overlay Color',
			'id'		 => $prefix . "fade_opacity",
			'type'		 => 'slider',
			'js_options' => array(
				'min' => 1,
				'max' => 99,
			)
		),
		array(
			'name'		=> 'Animation',
			'type'		=> 'heading',
			'id'		=> $prefix . "heading_animation",
		),
		array(
			'name'		=> 'Animation Effect',
			'id'		=> $prefix . "animation_effect",
			'desc'      => 'Choose effect for this section when it appears on the screen',
			'type'		=> 'select',
			'options'	=> array(
				'' => 'None',
				'fadeIn' => 'FadeIn',
				'fadeInUp' => 'FadeIn to Up',
				'fadeInDown' => 'FadeIn to Down',
				'fadeInLeft' => 'FadeIn to Left',
				'fadeInRight' => 'FadeIn to Right',
				'zoomIn' => 'ZoomIn',
			),
		),
	),
);

$meta_boxes[] = array(
	'id' => 'portfolio_layout_settings',
	'title' => 'Portfolio Project Settings',
	'pages' => array('us_portfolio'),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array (
		array(
			'name'		=> 'Custom Project Link',
			'id'		=> $prefix . 'custom_link',
			'type'		=> 'text',
		),
		array(
			'name'		=> 'Custom Project Link Target',
			'id'		=> $prefix . "custom_link_blank",
			'type'		=> 'checkbox',
			'desc'		=> 'Open Custom Project Link in new tab (window)',
		),
		array(
			'name'		=> 'Additional CSS Class',
			'id'		=> $prefix . "additional_class",
			'type'		=> 'text',
			'desc'		=> 'You can apply additional styling to particular portfolio item using this class',
		),
	)

);

$meta_boxes[] = array(
	'id' => 'client_settings',
	'title' => 'Client Settings',
	'pages' => array('us_client'),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		array(
			'name'		=> 'Client URL',
			'id'		=> $prefix . 'client_url',
			'type'		=> 'text',
			'std'		=> '',
		),
		array(
			'name'		=> 'Open URL in new Tab',
			'id'		=> $prefix . "client_new_tab",
			'type'		=> 'checkbox',
			'std'		=> false,
		),
	),
);

function us_register_meta_boxes()
{
	global $meta_boxes;

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $meta_boxes as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'us_register_meta_boxes' );
