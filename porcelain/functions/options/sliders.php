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
			array( 'id'=>'contentslider', 'name'=>'Content Slider' ),
			array( 'id'=>'nivo', 'name'=>'Nivo Slider' ),
			array( 'id'=>'portfolio', 'name'=>'Portfolio slider' ),
			array( 'id'=>'nivopost', 'name'=>'Slider as post gallery' ),
			array( 'id'=>'nivocontent', 'name'=>'Nivo in content' ) )
	),

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
		'desc' => 'If enabled, the images will be resized automatically.<br/>
		<b>Note:</b> The original images must be bigger than the default resize
		size (in both witdth and height) in order to be automatically cropped.
		If the image is smaller than the resize size, the original image will
		be used.'
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
		'name' => 'Autoplay',
		'id' => 'content_autoplay',
		'type' => 'checkbox',
		'std' => true,
		'desc' => 'If enabled, the slider will change the slides automatically'
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
		'name' => 'Animation Speed',
		'id' => 'content_speed',
		'type' => 'text',
		'std' => '400',
		'desc' => 'The animation speed in milliseconds'
	),

	array(
		'name' => 'Animation interval',
		'id' => 'content_interval',
		'type' => 'text',
		'std' => '3000',
		'desc' => 'The time interval between image changes in milliseconds'
	),

	array(
		'name' => 'Default slider content height',
		'id' => 'content_slider_height',
		'type' => 'text',
		'std' => '290',
		'desc' => 'The minimum slider content height in pixels. If you have longer 
			content which exceeds the default slider height, the slider will 
			be automatically resized to show all the content. If you prefer 
			to have a static height for the slider for all the slides, 
			you can increase the default height in this field.'
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
		'name' => 'Automatic image resizing',
		'id' => 'nivo_auto_resize',
		'type' => 'checkbox',
		'std' => true,
		'desc' => 'If enabled, the images will be resized automatically.<br/>
		<b>Note:</b> The original images must be bigger than the default resize
		size (in both witdth and height) in order to be automatically cropped.
		If the image is smaller than the resize size, the original image will
		be used.'
	),

	array(
		'name' => 'Default slider height',
		'id' => 'nivo_height',
		'type' => 'text',
		'desc' => 'The default image height for the slider, when automatic 
			image resizing is enabled in the field above',
		'std' => '550'
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
		'name' => 'Animation Effect',
		'id' => 'nivo_animation',
		'type' => 'multicheck',
		'options' => array( 
			array( 'id'=>'fold', 'name'=>'Fold' ), 
			array( 'id'=>'fade', 'name'=>'Fade' ),
			array( 'id'=>'sliceDownRight', 'name'=>'Slice Down' ), 
			array( 'id'=>'sliceDownLeft', 'name'=>'Slice Down Left' ), 
			array( 'id'=>'sliceUpRight', 'name'=>'Slice Up' ),
			array( 'id'=>'sliceUpDown', 'name'=>'Slice Up Down' ), 
			array( 'id'=>'sliceUpLeft', 'name'=>'Slice Up Left' ), 
			array( 'id'=>'sliceUpDownLeft', 'name'=>'Slice Up Down Left' ),
			array( 'id'=>'boxRandom', 'name'=>'Box Random' ), 
			array( 'id'=>'boxRainGrow', 'name'=>'Box Rain Grow' ), 
			array( 'id'=>'boxRainGrowReverse', 'name'=>'Box Rain Grow Reverse' )
		),
		'class'=>'include',
		'std'=>array( 'fold', 'fade', 'sliceDownRight', 'sliceDownLeft', 'sliceUpRight', 
			'sliceUpDown', 'sliceUpLeft', 'sliceUpDownLeft', 'boxRandom', 'boxRainGrow', 'boxRainGrowReverse' )
	),

	array(
		'name' => 'Number of slices',
		'id' => 'nivo_slices',
		'type' => 'text',
		'std' => '15',
		'desc' => 'For slice animations only.'
	),

	array(
		'name' => 'Number of box rows',
		'id' => 'nivo_rows',
		'type' => 'text',
		'std' => '4',
		'desc' => 'For box animations only.'
	),

	array(
		'name' => 'Number of box columns',
		'id' => 'nivo_columns',
		'type' => 'text',
		'std' => '8',
		'desc' => 'For box animations only.'
	),

	array(
		'name' => 'Animation Speed',
		'id' => 'nivo_speed',
		'type' => 'text',
		'std' => '800',
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
	size.<br/>
	<b>Note:</b> The original images must be bigger than the default resize
	size (in both witdth and height) in order to be automatically cropped.
	If the image is smaller than the resize size, the original image will
	be used.'
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
	size. <br/>
	<b>Note:</b> The original images must be bigger than the default resize
	size (in both witdth and height) in order to be automatically cropped.
	If the image is smaller than the resize size, the original image will
	be used.'
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


	/* ------------------------------------------------------------------------*
	 * NIVO SLIDER IN CONTENT
	 * ------------------------------------------------------------------------*/

	array(
		'type' => 'subtitle',
		'id'=>'nivocontent'
	),

	array(
		'type' => 'documentation',
		'text' => '<p>This is the Nivo slider that can be added into the content
		of any post/page with the text editor "Insert Nivo Slider" button</p>'
	),


	array(
		'name' => 'Automatic image resizing',
		'id' => 'nivo_auto_resize_content',
		'type' => 'checkbox',
		'std' => true,
		'desc' => 'If enabled, the images will be resized automatically. <br/>
		<b>Note:</b> The original images must be bigger than the default resize
		size (in both witdth and height) in order to be automatically cropped.
		If the image is smaller than the resize size, the original image will
		be used.'
	),

	array(
		'name' => 'Default slider height',
		'id' => 'nivo_height_content',
		'type' => 'text',
		'desc' => 'The default image height for the slider, when automatic 
			image resizing is enabled in the field above',
		'std' => '450'
	),


	array(
		'name' => 'Show navigation',
		'id' => 'exclude_nivo_navigation_content',
		'type' => 'multicheck',
		'options' => array( 
			array( 'id'=>'arrows', 'name'=>'Arrows' ), 
			array( 'id'=>'buttons', 'name'=>'Navigation Buttons' ) ),
		'class'=>'exclude'
	),

	array(
		'name' => 'Animation Effect',
		'id' => 'nivo_animation_content',
		'type' => 'multicheck',
		'options' => array( 
			array( 'id'=>'fold', 'name'=>'Fold' ), 
			array( 'id'=>'fade', 'name'=>'Fade' ),
			array( 'id'=>'sliceDownRight', 'name'=>'Slice Down' ), 
			array( 'id'=>'sliceDownLeft', 'name'=>'Slice Down Left' ), 
			array( 'id'=>'sliceUpRight', 'name'=>'Slice Up' ),
			array( 'id'=>'sliceUpDown', 'name'=>'Slice Up Down' ), 
			array( 'id'=>'sliceUpLeft', 'name'=>'Slice Up Left' ), 
			array( 'id'=>'sliceUpDownLeft', 'name'=>'Slice Up Down Left' ),
			array( 'id'=>'boxRandom', 'name'=>'Box Random' ), 
			array( 'id'=>'boxRainGrow', 'name'=>'Box Rain Grow' ), 
			array( 'id'=>'boxRainGrowReverse', 'name'=>'Box Rain Grow Reverse' )
		),
		'class'=>'include',
		'std'=>array( 'fold', 'fade', 'sliceDownRight', 'sliceDownLeft', 'sliceUpRight', 
			'sliceUpDown', 'sliceUpLeft', 'sliceUpDownLeft', 'boxRandom', 'boxRainGrow', 'boxRainGrowReverse' )
	),

	array(
		'name' => 'Number of slices',
		'id' => 'nivo_slices_content',
		'type' => 'text',
		'std' => '15',
		'desc' => 'For slice animations only.'
	),

	array(
		'name' => 'Number of box rows',
		'id' => 'nivo_rows_content',
		'type' => 'text',
		'std' => '4',
		'desc' => 'For box animations only.'
	),

	array(
		'name' => 'Number of box columns',
		'id' => 'nivo_columns_content',
		'type' => 'text',
		'std' => '8',
		'desc' => 'For box animations only.'
	),

	array(
		'name' => 'Animation Speed',
		'id' => 'nivo_speed_content',
		'type' => 'text',
		'std' => '800',
		'desc' => 'The animation speed in miliseconds'
	),

	array(
		'name' => 'Animation interval',
		'id' => 'nivo_interval_content',
		'type' => 'text',
		'std' => '3000',
		'desc' => 'The time interval between image changes in miliseconds'
	),

	array(
		'name' => 'Autoplay',
		'id' => 'nivo_autoplay_content',
		'type' => 'checkbox',
		'std' => true,
		'desc' => 'If enabled, the images will rotate automatically'
	),

	array(
		'name' => 'Pause on hover',
		'id' => 'nivo_pause_hover_content',
		'type' => 'checkbox',
		'std' => true,
		'desc' => 'If enabled, when the user hovers the image, the automatic rotation will pause.'
	),


	array(
		'type' => 'close' ),

	array(
		'type' => 'close' ) );


$pexeto->options->add_option_set( $pexeto_slider_options );
