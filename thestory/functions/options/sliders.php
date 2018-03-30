<?php

/**
 * This file contains the main slider settings.
 */

$pexeto_slider_options= array( array(
		'name' => 'Slider Settings',
		'type' => 'title',
		'img' => 'icon-images'
	),

	array(
		'type' => 'open',
		'subtitles'=>array(
			array( 'id'=>'fullpageslider', 'name'=>'Fullscreen Slider' ),
			array( 'id'=>'contentslider', 'name'=>'Content Slider' ),
			array( 'id'=>'nivo', 'name'=>'Fade Slider' ),
			array( 'id'=>'portfolio', 'name'=>'Portfolio Slider' ),
			array( 'id'=>'nivopost', 'name'=>'Post Gallery' ) )
	),

	/* ------------------------------------------------------------------------*
	 * STORY SLIDER
	 * ------------------------------------------------------------------------*/

	array(
		'type' => 'subtitle',
		'id'=>'fullpageslider'
	),

	array(
		'name' => 'Animate elements on display',
		'id' => 'fullpage_animate',
		'type' => 'checkbox',
		'std' => true
	),

	array(
		'name' => 'Show a scroll down arrow on the first slide',
		'id' => 'fullpage_scroll_arrow',
		'type' => 'checkbox',
		'std' => false
	),

	array(
		'type' => 'documentation',
		'text' => '<h3>Image Size Options</h3>'
	),

	array(
		'name' => 'Automatic image resizing',
		'id' => 'fullpage_auto_resize',
		'type' => 'checkbox',
		'std' => true,
		'desc' => 'If enabled, the content images will be resized automatically.'
	),

	array(
		'type' => 'text',
		'id' => 'fullpage_column_image_height',
		'name' => 'Two-column layout image height',
		'std' => '450',
		'suffix' => 'px',
		'desc' => 'This is the height of the image when the content type is set
		to "Text + Image" and the Layout is set to "Image left" or "Image right". 
		If you leave this field empty, the
		height of the images will be dynamic, depending on the default
		image ratio.'
	),

	array(
		'type' => 'multioption',
		'id' => 'fullpage_center_image_size',
		'name' => 'Center layout image size',
		'desc' => 'This is the height of the image when the content type is set
		to "Text + Image" and the Layout is set to "Image top" or "Image bottom".
		If you leave the height field empty, the
		height of the images will be dynamic, depending on the default
		image ratio.',
		'fields' => array(
			array(
				'id' => 'width',
				'name' => 'Width',
				'type' => 'text',
				'std' => '700',
				'suffix' => 'px' ),
			array(
				'id' => 'height',
				'name' => 'Height',
				'type' => 'text',
				'std' => '350',
				'suffix' => 'px' ),
		)
	),

	


	array(
		'type' => 'close' ),

	/* ------------------------------------------------------------------------*
	 * CONTENT SLIDER
	 * ------------------------------------------------------------------------*/

	array(
		'type' => 'subtitle',
		'id'=>'contentslider'
	),

	array(
		'name' => 'Automatic image resizing',
		'id' => 'content_auto_resize',
		'type' => 'checkbox',
		'std' => true,
		'desc' => 'If enabled, the images will be resized automatically.'
	),

	array(
		'name' => 'Default image height',
		'id' => 'content_img_height',
		'type' => 'text',
		'desc' => 'The default slider image height, when automatic
			image resizing is enabled in the field above. This is the image that
			is displayed on the left/right side of the text in a slide.',
		'std' => '320'
	),

	array(
		'name' => 'Show navigation',
		'id' => 'exclude_content_navigation',
		'type' => 'multicheck',
		'options' => array(
			array( 'id'=>'arrows', 'name'=>'Arrows' ),
			array( 'id'=>'buttons', 'name'=>'Navigation Buttons' ) ),
		'class'=>'exclude'
	),

	array(
		'name' => 'Thumbnail preview',
		'id' => 'content_thumbnail_preview',
		'type' => 'checkbox',
		'std' => true,
		'desc' => 'If enabled, a thumbnail preview will be displayed when
		hovering the slider arrows.'
	),

	array(
		'name' => 'Autoplay',
		'id' => 'content_autoplay',
		'type' => 'checkbox',
		'std' => true,
		'desc' => 'If enabled, the slider will change the slides automatically'
	),

	array(
		'name' => 'Autoplay on mobile devices',
		'id' => 'content_autoplay_mobile',
		'type' => 'checkbox',
		'std' => false,
		'desc' => 'It is recommended to keep this option disabled for 
		better accessibility and performance.'
	),

	array(
		'name' => 'Pause on hover',
		'id' => 'content_pause_hover',
		'type' => 'checkbox',
		'std' => true,
		'desc' => 'If enabled, when the user hovers the slider, the automatic 
			rotation will pause.'
	),

	array(
		'name' => 'Animation interval',
		'id' => 'content_interval',
		'type' => 'text',
		'std' => '3000',
		'desc' => 'The time interval between image changes in milliseconds'
	),

	array(
		'name' => 'Slider content height',
		'id' => 'content_slider_height',
		'type' => 'text',
		'std' => '290',
		'suffix' => 'px',
		'desc' => 'The minimum slider content height in pixels. If you have longer 
			content which exceeds the default slider height, the slider will 
			be automatically resized to show all the content. If you prefer 
			to have a static height for the slider for all the slides, 
			you can increase the default height in this field.'
	),

	array(
		'name' => 'Slider vertical padding',
		'id' => 'content_padding',
		'type' => 'text',
		'std' => '130',
		'suffix' => 'px',
		'desc' => 'You can set a custom top and bottom padding of the slider.
		If you would like to decrease the default slider height, you can decrease
		this value.'
	),


	array(
		'type' => 'close' ),


	/* ------------------------------------------------------------------------*
	 * NIVO SLIDER
	 * ------------------------------------------------------------------------*/

	array(
		'type' => 'subtitle',
		'id'=>'nivo'
	),

	array(
		'type' => 'documentation',
		'text' => '<h3>General settings</h3>'
	),

	array(
		'name' => 'Automatic image resizing',
		'id' => 'nivo_auto_resize',
		'type' => 'checkbox',
		'std' => true,
		'desc' => 'If enabled, the images will be resized automatically.'
	),


	array(
		'name' => 'Show navigation',
		'id' => 'exclude_nivo_navigation',
		'type' => 'multicheck',
		'options' => array( 
			array( 'id'=>'arrows', 'name'=>'Arrows' ), 
			array( 'id'=>'buttons', 'name'=>'Navigation Buttons' ) ),
		'class'=>'exclude'
	),

	array(
		'name' => 'Animation Speed',
		'id' => 'nivo_speed',
		'type' => 'text',
		'std' => '300',
		'desc' => 'The animation speed in miliseconds'
	),

	array(
		'name' => 'Animation interval',
		'id' => 'nivo_interval',
		'type' => 'text',
		'std' => '3000',
		'desc' => 'The time interval between image changes in miliseconds'
	),

	array(
		'name' => 'Autoplay',
		'id' => 'nivo_autoplay',
		'type' => 'checkbox',
		'std' => true,
		'desc' => 'If enabled, the images will rotate automatically'
	),

	array(
		'name' => 'Pause on hover',
		'id' => 'nivo_pause_hover',
		'type' => 'checkbox',
		'std' => true,
		'desc' => 'If enabled, when the user hovers the image, the automatic 
			rotation will pause.'
	),

	array(
		'type' => 'documentation',
		'text' => '<h3>Slider height settings</h3>'
	),

	array(
		'name' => 'Slider as page header',
		'id' => 'nivo_height',
		'type' => 'text',
		'desc' => 'The default image height for the slider, when automatic 
			image resizing is enabled in the field above',
		'std' => '550'
	),

	array(
		'name' => 'Slider in content',
		'id' => 'nivo_height_content',
		'type' => 'text',
		'desc' => 'The default image height for the slider, when automatic 
			image resizing is enabled in the field above. This options is applied
			to the Fade slider that can be added into the content of any post/page 
			with the text editor "Insert Fade Slider" button',
		'std' => '450'
	),


	array(
		'type' => 'close' ),




	/* ------------------------------------------------------------------------*
	 * PORTFOLIO SLIDER
	 * ------------------------------------------------------------------------*/

	array(
		'type' => 'subtitle',
		'id'=>'portfolio'
	),

	array(
		'type' => 'documentation',
		'text' => '<h3>Full-width slider</h3>'
	),

	array(
		'name' => 'Automatic image resizing',
		'id' => 'ps_full_auto_resize',
		'type' => 'checkbox',
		'std' => true,
		'desc' => 'If enabled, the images will be automatically cropped to the
	same size and you can set the default image height in the "Image height"
	field below. Otherwise the images will be displayed in their original
	size.
	'
	),

	array(
		'name' => 'Image height',
		'id' => 'ps_full_height',
		'type' => 'text',
		'std' => 600
	),

	array(
		'type' => 'documentation',
		'text' => '<h3>Slider with side content</h3>'
	),

	array(
		'name' => 'Automatic image resizing',
		'id' => 'ps_side_auto_resize',
		'type' => 'checkbox',
		'std' => true,
		'desc' => 'If enabled, the images will be automatically cropped to the
	same size and you can set the default image height in the "Image height"
	field below. Otherwise the images will be displayed in their original
	size. 
	'
	),

	array(
		'name' => 'Image height',
		'id' => 'ps_side_height',
		'type' => 'text',
		'std' => 550
	),

	array(
		'type' => 'documentation',
		'text' => '<h3>Related projects carousel</h3>'
	),

	array(
		'name' => 'Display related projects carousel',
		'id' => 'portfolio_show_carousel',
		'type' => 'checkbox',
		'std' => true
	),

	array(
		'name' => 'Load items from categories',
		'id' => 'portfolio_carousel_cat',
		'type' => 'select',
		'options' => array_merge(
			array(
				array( 'name'=>'Items from the same categories', 'id'=>'related' ),
				array( 'name'=>'All categories', 'id'=>'all' )
			),
			pexeto_get_portfolio_categories()
		),
		'std' => 'related'
	),

	array(
		'name' => 'Max number of items to load',
		'id' => 'portfolio_carousel_num_items',
		'type' => 'text',
		'std' => 15
	),

	array(
		'name' => 'Order items by',
		'id' => 'portfolio_carousel_order_by',
		'type' => 'select',
		'options' => array(
			array( 'name'=>'Date', 'id'=>'date' ),
			array( 'name'=>'Custom order', 'id'=>'menu_order' )
		),
		'std' => 'date'
	),

	array(
		'name' => 'Order',
		'id' => 'portfolio_carousel_order',
		'type' => 'select',
		'options' => array(
			array( 'name'=>'Descending', 'id'=>'DESC' ),
			array( 'name'=>'Ascending', 'id'=>'ASC' )
		),
		'std' => 'DESC'
	),

	array(
		'name' => 'Add spacing between items',
		'id' => 'portfolio_carousel_spacing',
		'type' => 'checkbox',
		'std' => true
	),

	array(
		'name' => 'Items thumbnail height',
		'id' => 'portfolio_carousel_height',
		'type' => 'text',
		'std' => 230,
		'suffix' => 'px'
	),


	array(
		'type' => 'documentation',
		'text' => '<h3>General Options</h3>'
	),

	array(
		'name' => 'Strip gallery from content',
		'id' => 'ps_strip_gallery',
		'type' => 'checkbox',
		'std' => true,
		'desc' => 'Automatically strip first gallery object from slider content.
			If this option is enabled and you have added the images to the slider 
			as a gallery, this gallery won\'t be displayed in the slider content.'
	),

	array(
		'type' => 'close' ),

	/* ------------------------------------------------------------------------*
	 * SLIDER AS POST GALLERY
	 * ------------------------------------------------------------------------*/

	array(
		'type' => 'subtitle',
		'id'=>'nivopost'
	),

	array(
		'type' => 'documentation',
		'text' => '<p>This is the blog post slider which is displayed as a 
		header of the posts with a "Gallery" post format selected.</p>'
	),

	array(
		'name' => 'Show navigation',
		'id' => 'exclude_nivo_navigation_post',
		'type' => 'multicheck',
		'options' => array( 
			array( 'id'=>'arrows', 'name'=>'Arrows' ), 
			array( 'id'=>'buttons', 'name'=>'Navigation Buttons' ) ),
		'class'=>'exclude'
	),

	array(
		'name' => 'Animation Speed',
		'id' => 'nivo_speed_post',
		'type' => 'text',
		'std' => '400',
		'desc' => 'The animation speed in miliseconds'
	),

	array(
		'name' => 'Animation interval',
		'id' => 'nivo_interval_post',
		'type' => 'text',
		'std' => '3000',
		'desc' => 'The time interval between image changes in miliseconds'
	),

	array(
		'name' => 'Autoplay',
		'id' => 'nivo_autoplay_post',
		'type' => 'checkbox',
		'std' => true,
		'desc' => 'If enabled, the images will rotate automatically'
	),

	array(
		'name' => 'Pause on hover',
		'id' => 'nivo_pause_hover_post',
		'type' => 'checkbox',
		'std' => true,
		'desc' => 'If enabled, when the user hovers the image, the automatic rotation will pause'
	),


	array(
		'type' => 'close' ),


	array(
		'type' => 'close' ) );


$pexeto->options->add_option_set( $pexeto_slider_options );
