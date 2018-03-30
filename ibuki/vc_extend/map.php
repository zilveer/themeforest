<?php 

/*-----------------------------------------------------------------------------------*/
/*	Section - Row
/*-----------------------------------------------------------------------------------*/
vc_map_update( 'vc_row', array(
	'name' => __( 'Section/Row', AZ_THEME_NAME),
	'description' => __( 'Place content elements inside the section', AZ_THEME_NAME),
	'show_settings_on_create' => true,
	'params' => array(
		array(
		  	'type' => 'textfield',
		  	'heading' => __('Extra Section ID name', AZ_THEME_NAME),
		  	'param_name' => 'section_id',
		  	'admin_label' => true,
		  	'description' => __('If you wish to style particular content element differently, then use this field to add an ID and then refer to it in your css/js file.', AZ_THEME_NAME)
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('Extra Section Class name', AZ_THEME_NAME),
		  	'param_name' => 'section_class',
		  	'admin_label' => true,
		  	'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME)
		),

		array(
		  	'type' => 'dropdown',
		  	'heading' => __('Section Mode', AZ_THEME_NAME),
		  	'param_name' => 'section_mode',
		  	'value' => array(
		  		__('Default', AZ_THEME_NAME) 	 => 'normal', 
		  		__('Full Width', AZ_THEME_NAME)  => 'fluid',
		  		__('Full Screen', AZ_THEME_NAME)  => 'full-screen'
		  	),
		  	'admin_label' => true,
		  	'description' => __('Choose Layout Mode.<br/>Default 1170px Container.<br/>Full Width is a 100% Width Container.', AZ_THEME_NAME)
		),

		// No Padding - Margin
		array(
		  	'type' => 'checkbox',
		  	'heading' => __('No Margin and Padding', AZ_THEME_NAME),
		  	'param_name' => 'no_margin_padding',
		  	'value' => array(
		  		__('Yes, please', AZ_THEME_NAME) => 'yes'
		  	),
		  	'admin_label' => true,
		  	'description' => __('Enable it if you want a container without margin and padding. Useful for sliders, maps, etc.' , AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'section_mode', 
		  		'value' => array( 'fluid' )
		  	)
		),

		// Scroll Next
		array(
		  	'type' => 'checkbox',
		  	'heading' => __('Scroll Button to Next Section', AZ_THEME_NAME),
		  	'param_name' => 'scroll_button',
		  	'value' => array(
		  		__('Yes, please', AZ_THEME_NAME) => 'yes'
		  	),
		  	'admin_label' => true,
		  	'description' => __('Enable it if you want a button scroll to next section.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'section_mode', 
		  		'value' => array( 'full-screen' )
		  	)
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('ID Next Section - Required', AZ_THEME_NAME),
		  	'param_name' => 'scroll_id',
		  	'description' => __('Enter ID of Next Section. For set the ID of Next Section click on Edit (pencil icon) and write your ID and copy and paste here.', AZ_THEME_NAME),
		  	'value' => '',
		  	'admin_label' => true,
		  	'dependency' => array(
		  		'element' => 'scroll_button', 
		  		'value' => array( 'yes' )
		  	)
		),

		// Section Module
		array(
		  	'type' => 'dropdown',
		  	'heading' => __('Section Module', AZ_THEME_NAME),
		  	'param_name' => 'bgmode',
		  	'value' => array(
		  		__('Default', AZ_THEME_NAME)	  => 'default', 
		  		__('Custom Image', AZ_THEME_NAME) => 'customimagebg',
		  		__('Custom Color', AZ_THEME_NAME) => 'custom',
		  		__('Custom Video', AZ_THEME_NAME) => 'video'
		  	),
		  	'admin_label' => true,
		  	'description' => __('Choose your favorite Section Module.', AZ_THEME_NAME)
		),

		// Custom Image Settings
		array(
		  	'type' => 'attach_image',
		  	'heading' => __('Image', AZ_THEME_NAME),
		  	'param_name' => 'image',
		  	'value' => '',
		  	'description' => __('Select image from media library.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'bgmode', 
		  		'value' => array( 'customimagebg' )
		  	)
		),

		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Background Color Image', AZ_THEME_NAME),
		  	'param_name' => 'bgimagebackgrouncolor',
		  	'description' => __('Choose a background color if you want use a transparent image.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'image',
		  		'not_empty' => true
		  	)
		),

		array(
		  	'type' => 'dropdown',
		  	'heading' => __('Background Image Position', AZ_THEME_NAME),
		  	'param_name' => 'bgposition',
		  	'value' => 
			  	array(
			  		__('Left Top', AZ_THEME_NAME) 	 	=> 'left top',
					__('Left Center', AZ_THEME_NAME) 	=> 'left center',
					__('Left Bottom', AZ_THEME_NAME) 	=> 'left bottom', 
					__('Center Top', AZ_THEME_NAME) 	=> 'center top',
					__('Center Center', AZ_THEME_NAME) 	=> 'center center',
					__('Center Bottom', AZ_THEME_NAME) 	=> 'center bottom',
					__('Right Top', AZ_THEME_NAME) 		=> 'right top',
					__('Right Center', AZ_THEME_NAME) 	=> 'right center',
					__('Right Bottom', AZ_THEME_NAME) 	=> 'right bottom'
				),
		  	'dependency' => array(
		  		'element' => 'image',
		  		'not_empty' => true
		  	)
		),

		array(
		  	'type' => 'dropdown',
		  	'heading' => __('Background Image Repeat', AZ_THEME_NAME),
		  	'param_name' => 'bgrepeat',
		  	'value' => array(
			  	__('No Repeat', AZ_THEME_NAME) 			 => 'no-repeat',
				__('Repeat', AZ_THEME_NAME) 			 => 'repeat',
				__('Repeat Horizontally', AZ_THEME_NAME) => 'repeat-x',
				__('Repeat vertically', AZ_THEME_NAME) 	 => 'repeat-y',
				__('Stretch to fit', AZ_THEME_NAME) 	 => 'stretch'
			),
		  	'dependency' => array(
		  		'element' => 'image', 
		  		'not_empty' => true
		  	)
		),

		array(
		  	'type' => 'dropdown',
		  	'heading' => __('Background Attachment', AZ_THEME_NAME),
		  	'param_name' => 'bgattachment',
		  	'value' => array(
			  	__('Scroll', AZ_THEME_NAME) => 'scroll',
				__('Fixed', AZ_THEME_NAME)	=> 'fixed'
			),
		  	'dependency' => array(
		  		'element' => 'image', 
		  		'not_empty' => true
		  	)
		),

		// Overlay Mask
		array(
		  	'type' => 'dropdown',
		  	'heading' => __('Overlay Mask', AZ_THEME_NAME),
		  	'param_name' => 'section_overlay',
		  	'value' => array(
		  		__('No Overlay Mask', AZ_THEME_NAME) 	=> 'no_overlay', 
		  		__('Yes, Overlay Mask', AZ_THEME_NAME) 	=> 'yes_overlay'
		  	),
		  	'description' => __('Enable or Disable the custom options for overlay section.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'bgmode', 
		  		'value' => array( 'customimagebg' )
		  	)
		),

		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Background Color Overlay Mask', AZ_THEME_NAME),
		  	'param_name' => 'sectionoveralycolor',
		  	'description' => __('Choose a background color overlay for your section block. Only if Overlay Mask is enabled.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'section_overlay',
		  		'value' => array( 'yes_overlay' )
		  	)
		),

		// Background Color Without Image Settings
		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Background Color', AZ_THEME_NAME),
		  	'param_name' => 'custombgcolor',
		  	'description' => __('Select a custom background color.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'bgmode', 
		  		'value' => array( 'custom' )
		  	)
		),

		// Video Settings
		array(
		  	'type' => 'textarea_raw_html',
		  	'heading' => __('Vimeo/YouTube Embed Code', AZ_THEME_NAME),
		  	'param_name' => 'customvideoembed',
		  	'value' => base64_encode(''),
		  	'description' => __('Required. Insert Vimeo or Youtube Embed Code.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'bgmode', 
		  		'value' => array( 'video' )
		  	)
		),

		array(
		  	'type' => 'attach_image',
		  	'heading' => __('Video Preview Image', AZ_THEME_NAME),
		  	'param_name' => 'customimagevideo',
		  	'value' => '',
		  	'description' => __('Optional. Upload your image.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'bgmode',
		  		'value' => array( 'video' )
		  	)
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('WEBM File URL', AZ_THEME_NAME),
		  	'param_name' => 'customvideowebm',
		  	'description' => __('Required. Upload a WEBM File.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'bgmode', 
		  		'value' => array( 'video' )
		  	)
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('MP4 File URL', AZ_THEME_NAME),
		  	'param_name' => 'customvideom4v',
		  	'description' => __('Required. Upload a M4V or MP4 File.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'bgmode', 
		  		'value' => array( 'video' )
		  	)
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('OGV File URL', AZ_THEME_NAME),
		  	'param_name' => 'customvideoogv',
		  	'description' => __('Required. Upload a OGV File.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'bgmode', 
		  		'value' => array( 'video' )
		  	)
		),

		array(
		  	'type' => 'checkbox',
		  	'heading' => __('Disable Loop Self-Hosted Video?', AZ_THEME_NAME),
		  	'param_name' => 'disable_video_loop',
		  	'value' => array(
		  		__('Yes, please', AZ_THEME_NAME) => 'yes'
		  	),
		  	'admin_label' => true,
		  	'description' => __('Disable Loop on your Self-Hosted Video only.' , AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'bgmode', 
		  		'value' => array( 'video' )
		  	)
		),

		// Video Overlay
		array(
		  	'type' => 'dropdown',
		  	'heading' => __('Video Overlay Mask', AZ_THEME_NAME),
		  	'param_name' => 'video_overlay',
		  	'value' => array(
		  		__('No Overlay Mask', AZ_THEME_NAME) 	=> 'off_video_overlay', 
		  		__('Yes, Overlay Mask', AZ_THEME_NAME) 	=> 'show_video_overlay'
		  	),
		  	'description' => __('Enable or Disable the custom options for video overlay section.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'bgmode', 
		  		'value' => array( 'video' )
		  	)
		),

		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Video Overlay Color', AZ_THEME_NAME),
		  	'param_name' => 'video_color_overlay',
		  	'description' => __('Select a custom color for video overlay block. Only if Video Overlay Mask is enabled.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'video_overlay', 
		  		'value' => array( 'show_video_overlay' )
		  	)
		),

		// Pattern
		array(
		  	'type' => 'attach_image',
		  	'heading' => __('Pattern Image', AZ_THEME_NAME),
		  	'param_name' => 'pattern',
		  	'value' => '',
		  	'description' => __('Optional. Select a pattern from media library.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'bgmode', 
		  		'value' => array( 'customimagebg', 'custom', 'video' )
		  	)
		),

		// Padding Settings
		array(
		  	'type' => 'dropdown',
		  	'heading' => __('Section Padding', AZ_THEME_NAME),
		  	'param_name' => 'padding',
		  	'value' => array(
		  		__('No Padding', AZ_THEME_NAME) 	 => 'no-padding', 
		  		__('Small Padding', AZ_THEME_NAME) 	 => 'small-padding', 
		  		__('Default Padding', AZ_THEME_NAME) => 'default-padding', 
		  		__('Large Padding', AZ_THEME_NAME) 	 => 'large-padding', 
		  		__('Custom Padding', AZ_THEME_NAME)  => 'custom-padding'
		  	),
		  	'admin_label' => true,
		  	'description' => __('Define the sections top and bottom padding.', AZ_THEME_NAME)
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('Padding Top', AZ_THEME_NAME),
		  	'param_name' => 'padding_top_value',
		  	'description' => __('Padding Top value in pixel. Enter only number value. Default value is 70.', AZ_THEME_NAME),
		  	'value' => '70',
		  	'dependency' => array(
		  		'element' => 'padding',
		  		'value' => array( 'custom-padding' )
		  	)
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('Padding Bottom', AZ_THEME_NAME),
		  	'param_name' => 'padding_bottom_value',
		  	'description' => __('Padding Bottom value in pixel. Enter only number value. Default value is 70.', AZ_THEME_NAME),
		  	'value' => '70',
		  	'dependency' => array(
		  		'element' => 'padding', 
		  		'value' => array( 'custom-padding' )
		  	)
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('Extra Row Class name', AZ_THEME_NAME),
		  	'param_name' => 'el_class',
		  	'admin_label' => true,
		  	'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME)
		),

		/* Responsive Visibility */
		$responsive_lg,
		$responsive_md,
		$responsive_sm,
		$responsive_xs

	)
));

vc_map_update( 'vc_row_inner', array(
	'params' => array(
	  	array(
	    	'type' => 'textfield',
	    	'heading' => __('Extra class name', AZ_THEME_NAME),
	    	'param_name' => 'el_class',
	    	'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME)
	  	)
	),
));


/*-----------------------------------------------------------------------------------*/
/*	Columns
/*-----------------------------------------------------------------------------------*/
global $vc_column_width_list;
$vc_column_width_list = array(
	__( '1 column - 1/12', AZ_THEME_NAME ) 	  => '1/12',
	__( '2 columns - 1/6', AZ_THEME_NAME ) 	  => '1/6',
	__( '3 columns - 1/4', AZ_THEME_NAME ) 	  => '1/4',
	__( '4 columns - 1/3', AZ_THEME_NAME ) 	  => '1/3',
	__( '5 columns - 5/12', AZ_THEME_NAME )   => '5/12',
	__( '6 columns - 1/2', AZ_THEME_NAME ) 	  => '1/2',
	__( '7 columns - 7/12', AZ_THEME_NAME )   => '7/12',
	__( '8 columns - 2/3', AZ_THEME_NAME ) 	  => '2/3',
	__( '9 columns - 3/4', AZ_THEME_NAME ) 	  => '3/4',
	__( '10 columns - 5/6', AZ_THEME_NAME )   => '5/6',
	__( '11 columns - 11/12', AZ_THEME_NAME ) => '11/12',
	__( '12 columns - 1/1', AZ_THEME_NAME )   => '1/1'
);

vc_map_update( 'vc_column', array(
	'params' => array(
		
		array(
			'type' => 'dropdown',
			'heading' => __('Width', AZ_THEME_NAME),
			'param_name' => 'width',
			'value' => $vc_column_width_list,
			'description' => __('Select column width.', AZ_THEME_NAME),
			'std' => '1/1'
		),

		array(
		  	'type' => 'dropdown',
		  	'heading' => __('Background Mode', AZ_THEME_NAME),
		  	'param_name' => 'bgmode',
		  	'value' => array(
		  		__('Default', AZ_THEME_NAME) 	  => 'default',
		  		__('Custom Color', AZ_THEME_NAME) => 'custom-color'
		  	),
		  	'description' => __('Choose Background Mode.', AZ_THEME_NAME)
		),

		// Custom Column Color
		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Background Color', AZ_THEME_NAME),
		  	'param_name' => 'custombgcolor',
		  	'description' => __('Select a custom background color.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'bgmode', 
		  		'value' => array( 'custom-color' )
		  	)
		),

		// Equals Col Height
		array(
		  	'type' => 'checkbox',
		  	'heading' => __('Equals Columns Height Script?', AZ_THEME_NAME),
		  	'param_name' => 'equals_col_height',
		  	'value' => array(
		  		__('Yes, please', AZ_THEME_NAME) => 'yes'
		  	),
		  	'description' => __('Enable Equals Columns Height!', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'bgmode', 
		  		'value' => array( 'custom-color' )
		  	)
		),

		// Padding
		array(
		  	'type' => 'dropdown',
		  	'heading' => __('Column Padding', AZ_THEME_NAME),
		  	'param_name' => 'padding',
		  	'value' => array(
		  		__('Default', AZ_THEME_NAME) 	    => 'default-color-padding',
		  		__('Custom Padding', AZ_THEME_NAME) => 'custom-padding'
		  	),
		  	'description' => __('Define the column padding value.', AZ_THEME_NAME)
		),

		array(
	    	'type' => 'textfield',
	    	'heading' => __('Padding', AZ_THEME_NAME),
	    	'param_name' => 'padding_value',
	    	'value' => '40',
	    	'description' => __('Padding value in pixel. Enter only number value. Default value is 40.', AZ_THEME_NAME),
	    	'dependency' => array(
		  		'element' => 'padding', 
		  		'value' => array( 'custom-padding' )
		  	)
		),

	  	array(
	    	'type' => 'textfield',
	    	'heading' => __('Extra class name', AZ_THEME_NAME),
	    	'param_name' => 'el_class',
	    	'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME)
		),

		/* Animations */
		$animated_choice,
		$animated_effects,
		$animated_delay
	)
));

vc_map_update( 'vc_column_inner', array(
	'params' => array(

		array(
			'type' => 'dropdown',
			'heading' => __('Width', AZ_THEME_NAME),
			'param_name' => 'width',
			'value' => $vc_column_width_list,
			'description' => __('Select column width.', AZ_THEME_NAME),
			'std' => '1/1'
		),
		
	  	array(
	    	'type' => 'textfield',
	    	'heading' => __('Extra class name', AZ_THEME_NAME),
	    	'param_name' => 'el_class',
	    	'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME)
	  	)
	),
));

/*-----------------------------------------------------------------------------------*/
/*	Text-Block
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Column_Text extends WPBakeryShortCode {}
vc_map(array(
	'name' => __('Text Block', AZ_THEME_NAME),
	'description' => __( 'A block of text with WYSIWYG editor', AZ_THEME_NAME),
	'base' => 'az_column_text',
	'icon' => 'icon-wpb-layer-shape-text',
	'category' => __('Content', AZ_THEME_NAME),
	'wrapper_class' => 'clearfix',
	'params' => array(

		array(
		  	'type' => 'textarea_html',
		  	'holder' => 'div',
		  	'heading' => __('Text', AZ_THEME_NAME),
		  	'param_name' => 'content',
		  	'value' => __('I am text block. Click edit button to change this text.', AZ_THEME_NAME)
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('Extra class name', AZ_THEME_NAME),
		  	'param_name' => 'el_class',
		  	'admin_label' => true,
		  	'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME)
		),

		/* Responsive Visibility */
		$responsive_lg,
		$responsive_md,
		$responsive_sm,
		$responsive_xs,

		/* Animations */
		$animated_choice,
		$animated_effects,
		$animated_delay

	)
));

/*-----------------------------------------------------------------------------------*/
/*	Special Heading
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Special_Heading extends WPBakeryShortCode {}
vc_map(array(
	'name' => __('Special Heading', AZ_THEME_NAME),
	'description' => __( 'A special heading text block', AZ_THEME_NAME),
	'base' => 'az_special_heading',
	'icon' => 'icon-wpb-layer-shape-text',
	'category' => __('Content', AZ_THEME_NAME),
	'params' => array(

		array(
    		'type' => 'textfield',
    		'holder' => 'div',
    		'heading' => __('Heading Title', AZ_THEME_NAME),
    		'param_name' => 'content_heading',
    		'admin_label' => true,
    		'description' => __('Required. Enter the your title.', AZ_THEME_NAME)
    	),

		array(
			'type' => 'dropdown',
			'heading' => __('Heading Mode', AZ_THEME_NAME),
			'param_name' => 'heading_type',
			'value' => array(
				__('H1', AZ_THEME_NAME) => '1',
				__('H2', AZ_THEME_NAME) => '2',
				__('H3', AZ_THEME_NAME) => '3',
				__('H4', AZ_THEME_NAME) => '4',
				__('H5', AZ_THEME_NAME) => '5',
				__('H6', AZ_THEME_NAME) => '6',
			),
			'admin_label' => true,
			'description' => __('Select which kind of heading you want to display.', AZ_THEME_NAME)
		),

		array(
			'type' => 'dropdown',
			'heading' => __('Special Heading Color', AZ_THEME_NAME),
			'param_name' => 'heading_color',
			'value' => array(
				__('Default', AZ_THEME_NAME) => '',
				__('Custom', AZ_THEME_NAME)  => 'custom'
			),
			'admin_label' => true,
			'description' => __('Select the special heading color mode.', AZ_THEME_NAME)
		),

		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Font Color', AZ_THEME_NAME),
		  	'param_name' => 'custom_heading_color',
		  	'description' => __('Choose a color for your heading.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'heading_color',
		  		'value' => array( 'custom' )
		  	)
		),

		array(
			'type' => 'dropdown',
			'heading' => __('Special Heading Size', AZ_THEME_NAME),
			'param_name' => 'heading_size',
			'value' => array(
				__('Default', AZ_THEME_NAME) => '',
				__('Custom', AZ_THEME_NAME)  => 'custom'
			),
			'admin_label' => true,
			'description' => __('Choose a size for your heading text.', AZ_THEME_NAME)
		),

		array(
    		'type' => 'textfield',
    		'heading' => __('Special Heading Custom Size', AZ_THEME_NAME),
    		'param_name' => 'custom_heading_size',
    		'admin_label' => false,
    		'description' => __('Font Size in pixel. Enter only number value.', AZ_THEME_NAME),
    		'dependency' => array(
		  		'element' => 'heading_size',
		  		'value' => array( 'custom' )
		  	)
    	),

    	array(
    		'type' => 'textfield',
    		'heading' => __('Special Heading Line-Height', AZ_THEME_NAME),
    		'param_name' => 'custom_heading_line',
    		'admin_label' => false,
    		'description' => __('Font Line-Height in pixel. Enter only number value.', AZ_THEME_NAME),
    		'dependency' => array(
		  		'element' => 'heading_size',
		  		'value' => array( 'custom' )
		  	)
    	),

    	array(
			'type' => 'dropdown',
			'heading' => __('Special Heading Style', AZ_THEME_NAME),
			'param_name' => 'heading_style',
			'value' => array(
				__('Default Style', AZ_THEME_NAME) => 'default',
				__('Italic Style', AZ_THEME_NAME)  => 'italic',
			),
			'admin_label' => true,
			'description' => __('Select a special heading style.', AZ_THEME_NAME)
		),

    	array(
			'type' => 'dropdown',
			'heading' => __('Special Heading Align', AZ_THEME_NAME),
			'param_name' => 'heading_align',
			'value' => array(
				__('Align Left', AZ_THEME_NAME)   => 'textalignleft',
				__('Align Center', AZ_THEME_NAME) => 'textaligncenter',
				__('Align Right', AZ_THEME_NAME)  => 'textalignright',
			),
			'admin_label' => true,
			'description' => __('Select a special heading align.', AZ_THEME_NAME)
		),

		array(
    		'type' => 'textfield',
    		'heading' => __('Padding Bottom', AZ_THEME_NAME),
    		'param_name' => 'padding_bottom_heading',
    		'value' => '30',
    		'admin_label' => true,
    		'description' => __('Bottom Padding in pixel. Enter only number value. Default value is 30.', AZ_THEME_NAME)
    	),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('Extra class name', AZ_THEME_NAME),
		  	'param_name' => 'el_class',
		  	'admin_label' => true,
		  	'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME)
		),

		/* Responsive Visibility */
		$responsive_lg,
		$responsive_md,
		$responsive_sm,
		$responsive_xs,

		/* Animations */
		$animated_choice,
		$animated_effects,
		$animated_delay
	)
));

/*-----------------------------------------------------------------------------------*/
/*	Divider / Blank Divider
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Divider extends WPBakeryShortCode {}
vc_map(array(
	'name'		=> __('Divider', AZ_THEME_NAME),
	'description' => __( 'Horizontal separator line', AZ_THEME_NAME),
    'base'		=> 'az_divider',
    'icon'      => 'icon-wpb-ui-empty_space',
	'category' 	=> __('Content', AZ_THEME_NAME),
	'show_settings_on_create' => true,
    'params'	=> array(

    	array(
			'type' => 'dropdown',
			'heading' => __('Divider Style', AZ_THEME_NAME),
			'param_name' => 'div_style',
			'value' => array(
				__('Normal', AZ_THEME_NAME) => 'normal',
				__('Short', AZ_THEME_NAME)  => 'short',
			),
			'admin_label' => true,
			'description' => __('Choose between the two available divider styles.', AZ_THEME_NAME)
		),

		array(
			'type' => 'dropdown',
			'heading' => __('Divider Type', AZ_THEME_NAME),
			'param_name' => 'div_type',
			'value' => array(
				__('Fat Solid', AZ_THEME_NAME)  => 'fat-solid-div',
				__('Thin Solid', AZ_THEME_NAME) => 'thin-solid-div',
				__('Dotted', AZ_THEME_NAME)     => 'dotted-div',
				__('Double', AZ_THEME_NAME)     => 'double-div',
			),
			'admin_label' => true,
			'description' => __('Choose between the two available divider types.', AZ_THEME_NAME)
		),

		array(
			'type' => 'dropdown',
			'heading' => __('Divider Color', AZ_THEME_NAME),
			'param_name' => 'div_color',
			'value' => array(
				__('Default', AZ_THEME_NAME)      => '',
				__('Custom Color', AZ_THEME_NAME) => 'custom',
			),
			'admin_label' => true,
			'description' => __('Choose a color for your divider.', AZ_THEME_NAME)
		),

		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Divider Custom Color', AZ_THEME_NAME),
		  	'param_name' => 'custom_div_color',
		  	'description' => __('Choose a color for your divider.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'div_color',
		  		'value' => array( 'custom' )
		  	)
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('Margin Top Value', AZ_THEME_NAME),
		  	'param_name' => 'margin_top_value',
		  	'value' => '30',
		  	'admin_label' => true,
		  	'description' => __('Margin Top Value in pixel. Enter only number value. Default value is 30.', AZ_THEME_NAME)
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('Margin Bottom Value', AZ_THEME_NAME),
		  	'param_name' => 'margin_bottom_value',
		  	'value' => '36',
		  	'admin_label' => true,
		  	'description' => __('Margin Bottom Value in pixel. Enter only number value. Default value is 36.', AZ_THEME_NAME)
		),

        array(
		  	'type' => 'textfield',
		  	'heading' => __('Extra class name', AZ_THEME_NAME),
		  	'param_name' => 'el_class',
		  	'admin_label' => true,
		  	'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME)
		),

		/* Responsive Visibility */
		$responsive_lg,
		$responsive_md,
		$responsive_sm,
		$responsive_xs,

		/* Animations */
		$animated_choice,
		$animated_effects,
		$animated_delay

    )
));


class WPBakeryShortCode_AZ_Blank_Divider extends WPBakeryShortCode {}
vc_map(array(
	'name'		=> __('Blank Divider', AZ_THEME_NAME),
	'description' => __('Blank space with custom height', AZ_THEME_NAME),
    'base'		=> 'az_blank_divider',
    'icon'      => 'icon-wpb-ui-empty_space',
	'category' 	=> __('Content', AZ_THEME_NAME),
	'show_settings_on_create' => true,
    'params'	=> array(

		array(
		  	'type' => 'textfield',
		  	'heading' => __('Height Value', AZ_THEME_NAME),
		  	'param_name' => 'height_value',
		  	'admin_label' => true,
		  	'description' => __('Height Value in pixel. Enter only number value. Default value is 20.', AZ_THEME_NAME),
		  	'value' => '20'
		),

        array(
		  	'type' => 'textfield',
		  	'heading' => __('Extra class name', AZ_THEME_NAME),
		  	'param_name' => 'el_class',
		  	'admin_label' => true,
		  	'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME)
		),

		/* Responsive Visibility */
		$responsive_lg,
		$responsive_md,
		$responsive_sm,
		$responsive_xs

    )
));


/*-----------------------------------------------------------------------------------*/
/*	Alert Boxes
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Alert_Box extends WPBakeryShortCode {}
vc_map(array(
	'name'		=> __('Alert Box', AZ_THEME_NAME),
	'description' => __( 'Notification box', AZ_THEME_NAME),
    'base'		=> 'az_alert_box',
    'icon'      => 'icon-wpb-ui-empty_space',
	'category' 	=> __('Content', AZ_THEME_NAME),
	'show_settings_on_create' => true,
    'params'	=> array(

    	array(
			'type' => 'dropdown',
			'heading' => __('Alert Box Type', AZ_THEME_NAME),
			'param_name' => 'type_acc',
			'value' => array(
				__('Standard', AZ_THEME_NAME) => 'alert-standard',
				__('Warning', AZ_THEME_NAME)  => 'alert-warning',
				__('Error', AZ_THEME_NAME)    => 'alert-error',
				__('Info', AZ_THEME_NAME)     => 'alert-info',
				__('Success', AZ_THEME_NAME)  => 'alert-success',
			),
			'admin_label' => true,
			'description' => __('Choose your alert box style.', AZ_THEME_NAME)
		),

		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'param_name' => 'content',
			'heading' => __('Box Text', AZ_THEME_NAME),
			'value' => __('Insert your message...', AZ_THEME_NAME)
		),

        array(
		  	'type' => 'textfield',
		  	'heading' => __('Extra class name', AZ_THEME_NAME),
		  	'param_name' => 'el_class',
		  	'admin_label' => true,
		  	'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME)
		),

		/* Animations */
		$animated_choice,
		$animated_effects,
		$animated_delay

    )
));


/*-----------------------------------------------------------------------------------*/
/*	Accordion / Toggle / Tab
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Accordion_Container extends WPBakeryShortCode {}
vc_map(array(
	'name'		=> __('Accordion', AZ_THEME_NAME),
	'description' => __( 'Collapsible content panels', AZ_THEME_NAME),
    'base'		=> 'az_accordion_container',
    'icon'      => 'icon-wpb-ui-empty_space',
	'category' 	=> __('Content', AZ_THEME_NAME),
	'show_settings_on_create' => true,
    'params'	=> array(

		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => __('Accordion', AZ_THEME_NAME),
			'param_name' => 'content',
			'value' => __('Click here, delete this text and click on AZ Shortcodes Button and select Accordion Section Shortcode...', AZ_THEME_NAME),
			'description' => __('Click on the <strong>AZ Shortcode Button</strong> and select <strong>Accordion Section Shortcode</strong>.', AZ_THEME_NAME)
		),

        array(
		  	'type' => 'textfield',
		  	'heading' => __('Extra class name', AZ_THEME_NAME),
		  	'param_name' => 'el_class',
		  	'admin_label' => true,
		  	'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME)
		)

    )
));

class WPBakeryShortCode_AZ_Toggle_Container extends WPBakeryShortCode {}
vc_map(array(
	'name'		=> __('Toggle', AZ_THEME_NAME),
	'description' => __( 'Collapsible content panels', AZ_THEME_NAME),
    'base'		=> 'az_toggle_container',
    'icon'      => 'icon-wpb-ui-empty_space',
	'category' 	=> __('Content', AZ_THEME_NAME),
	'show_settings_on_create' => true,
    'params'	=> array(

		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => __('Toggle', AZ_THEME_NAME),
			'param_name' => 'content',
			'value' => __('Click here, delete this text and click on AZ Shortcodes Button and select Toggle Section Shortcode...', AZ_THEME_NAME),
			'description' => __('Click on the <strong>AZ Shortcode Button</strong> and select <strong>Toggle Section Shortcode</strong>.', AZ_THEME_NAME)
		),

        array(
		  	'type' => 'textfield',
		  	'heading' => __('Extra class name', AZ_THEME_NAME),
		  	'param_name' => 'el_class',
		  	'admin_label' => true,
		  	'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME)
		)
		
    )
));

class WPBakeryShortCode_AZ_Tab_Container extends WPBakeryShortCode {}
vc_map(array(
	'name'		=> __('Tab', AZ_THEME_NAME),
	'description' => __( 'Tabbed content', AZ_THEME_NAME),
    'base'		=> 'az_tab_container',
    'icon'      => 'icon-wpb-ui-empty_space',
	'category' 	=> __('Content', AZ_THEME_NAME),
	'show_settings_on_create' => true,
    'params'	=> array(

		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => __('Tab', AZ_THEME_NAME),
			'param_name' => 'content',
			'value' => __('Click here, delete this text and click on AZ Shortcodes Button and select Tab Section Shortcode...', AZ_THEME_NAME),
			'description' => __('Click on the <strong>AZ Shortcode Button</strong> and select <strong>Tab Section Shortcode</strong>.', AZ_THEME_NAME)
		),

        array(
		  	'type' => 'textfield',
		  	'heading' => __('Extra class name', AZ_THEME_NAME),
		  	'param_name' => 'el_class',
		  	'admin_label' => true,
		  	'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME)
		)
		
    )
));


/*-----------------------------------------------------------------------------------*/
/*	Testimonial
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Testimonial_Container extends WPBakeryShortCode {}
vc_map(array(
	'name'		=> __('Testimonials', AZ_THEME_NAME),
	'description' => __( 'Display Testimonials Posts', AZ_THEME_NAME),
    'base'		=> 'az_testimonial_container',
    'icon'      => 'icon-wpb-ui-empty_space',
	'category' 	=> __('Content', AZ_THEME_NAME),
	'show_settings_on_create' => true,
    'params'	=> array(

		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => __('Testimonial', AZ_THEME_NAME),
			'param_name' => 'content',
			'value' => __('Click here, delete this text and click on AZ Shortcodes Button and select Testimonial Section Shortcode...', AZ_THEME_NAME),
			'description' => __('Click on the <strong>AZ Shortcode Button</strong> and select <strong>Testimonial Section Shortcode</strong>.', AZ_THEME_NAME)
		),

        array(
		  	'type' => 'textfield',
		  	'heading' => __('Extra class name', AZ_THEME_NAME),
		  	'param_name' => 'el_class',
		  	'admin_label' => true,
		  	'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME)
		)
		
    )
));


/*-----------------------------------------------------------------------------------*/
/*	Single Image / Lightbox Image, Video, Gallery Images
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Single_Image extends WPBakeryShortCode {}
vc_map( array(
	'name' => __( 'Single Image', AZ_THEME_NAME ),
	'base' => 'az_single_image',
	'icon' => 'icon-wpb-single-image',
	'category' => __( 'Content', AZ_THEME_NAME ),
	'description' => __( 'Single Image', AZ_THEME_NAME ),
	'params' => array(

		array(
			'type' => 'attach_image',
			'heading' => __( 'Image', AZ_THEME_NAME ),
			'param_name' => 'image',
			'value' => '',
			'description' => __( 'Required. Select image from media library.', AZ_THEME_NAME )
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Image Mode', AZ_THEME_NAME ),
			'param_name' => 'image_mode',
			'value' => array(
		  		__('No Responsive', AZ_THEME_NAME) => 'img-no-responsive',
		  		__('Image Responsive', AZ_THEME_NAME) => 'img-responsive', 
		  		__('Full Image Responsive', AZ_THEME_NAME) => 'img-full-responsive'
		  	),
		  	'admin_label' => true,
		  	'description' => __( 'Choose Image Mode.<br/>Image Responsive: Image is responsive but not has 100% width.<br/>Full Image Responsive: Image is responsive and has 100% width.', AZ_THEME_NAME )
		),

		$image_styles,
		$image_box_shadow_styles,

		array(
			'type' => 'dropdown',
			'heading' => __( 'Image Alignment', AZ_THEME_NAME ),
			'param_name' => 'image_alignment',
			'value' => array(
				__('Left', AZ_THEME_NAME)   => 'alignleft',
				__('Center', AZ_THEME_NAME) => 'aligncenter',
				__('Right', AZ_THEME_NAME)  => 'alignright'
			),
			'admin_label' => true,
			'description' => __( 'Optional. Select the alignment for your image.', AZ_THEME_NAME )
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Image Link Mode', AZ_THEME_NAME ),
			'param_name' => 'image_link',
			'value' => array(
				__('No', AZ_THEME_NAME) => 'no-link',
				__('Yes', AZ_THEME_NAME) => 'yes'
			),
			'admin_label' => true,
			'description' => __( 'Optional. Enabled if you want a link url for your image.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Link URL', AZ_THEME_NAME ),
			'param_name' => 'image_link_url',
			'description' => __( 'Where should your image link to?.', AZ_THEME_NAME ),
			'dependency' => array(
				'element' => 'image_link',
				'value' => array( 'yes' )
			)
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Link Target', AZ_THEME_NAME ),
			'param_name' => 'target',
			'value' => $target_arr,
			'dependency' => array(
				'element' => 'image_link',
				'value' => array( 'yes' )
			)
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', AZ_THEME_NAME ),
			'param_name' => 'el_class',
			'admin_label' => true,
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME )
		),

		/* Responsive Visibility */
		$responsive_lg,
		$responsive_md,
		$responsive_sm,
		$responsive_xs,

		/* Animations */
		$animated_choice,
		$animated_effects,
		$animated_delay
	)
) );

// Lightbox Image
class WPBakeryShortCode_AZ_Lightbox_Image extends WPBakeryShortCode {}
vc_map( array(
	'name' => __( 'Lightbox Image', AZ_THEME_NAME ),
	'base' => 'az_lightbox_image',
	'icon' => 'icon-wpb-single-image',
	'category' => __( 'Content', AZ_THEME_NAME ),
	'description' => __( 'Image Lightbox', AZ_THEME_NAME ),
	'params' => array(

		array(
			'type' => 'attach_image',
			'heading' => __( 'Image', AZ_THEME_NAME ),
			'param_name' => 'image',
			'value' => '',
			'description' => __( 'Required. Select image from media library.', AZ_THEME_NAME )
		),

		array(
			'type' => 'attach_image',
			'heading' => __( 'Different Image', AZ_THEME_NAME ),
			'param_name' => 'image_popup',
			'value' => '',
			'description' => __( 'Optional. Select image from media library, if you want a different popup image.', AZ_THEME_NAME ),
			'dependency' => array(
				'element' => 'image',
				'not_empty' => true
			)
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Thumbnail Width (Optional)', AZ_THEME_NAME ),
			'param_name' => 'thumb_widht',
			'value' => '',
			'admin_label' => true,
			'description' => __( 'Optional. If you wish choose a width for your thumbnail. It will be automatically cropped and resized. Enter only number value.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Fancybox Gallery Name', AZ_THEME_NAME ),
			'param_name' => 'gallery_name',
			'admin_label' => true,
			'description' => __( 'Optional. Insert a name if you want a gallery between other lightbox image shortcode only. Remember to add/write the same name for each shortcode.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', AZ_THEME_NAME ),
			'param_name' => 'el_class',
			'admin_label' => true,
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME )
		),

		/* Responsive Visibility */
		$responsive_lg,
		$responsive_md,
		$responsive_sm,
		$responsive_xs,

		/* Animations */
		$animated_choice,
		$animated_effects,
		$animated_delay

	)
) );

// Lightbox Video
class WPBakeryShortCode_AZ_Lightbox_Video extends WPBakeryShortCode {}
vc_map( array(
	'name' => __( 'Lightbox Video', AZ_THEME_NAME ),
	'base' => 'az_lightbox_video',
	'icon' => 'icon-wpb-single-image',
	'category' => __( 'Content', AZ_THEME_NAME ),
	'description' => __( 'Video Lightbox', AZ_THEME_NAME ),
	'params' => array(

		array(
			'type' => 'attach_image',
			'heading' => __( 'Image', AZ_THEME_NAME ),
			'param_name' => 'image',
			'value' => '',
			'description' => __( 'Required. Select image from media library.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Thumbnail Width (Optional)', AZ_THEME_NAME ),
			'param_name' => 'thumb_widht',
			'value' => '',
			'admin_label' => true,
			'description' => __( 'Optional. If you wish choose a width for your thumbnail. It will be automatically cropped and resized. Enter only number value.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Video Link URL', AZ_THEME_NAME ),
			'param_name' => 'link_url',
			'admin_label' => true,
			'description' => __( 'Only Youtube and Vimeo Support.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Caption Title', AZ_THEME_NAME ),
			'param_name' => 'title',
			'description' => __( 'Optional. Insert the title of your video. <strong>NO HTML</strong>', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Fancybox Gallery Name', AZ_THEME_NAME ),
			'param_name' => 'gallery_name',
			'admin_label' => true,
			'description' => __( 'Optional. Insert a name if you want a gallery between other lightbox video shortcode only. Remember to add/write the same name for each shortcode.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', AZ_THEME_NAME ),
			'param_name' => 'el_class',
			'admin_label' => true,
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME )
		),

		/* Responsive Visibility */
		$responsive_lg,
		$responsive_md,
		$responsive_sm,
		$responsive_xs,

		/* Animations */
		$animated_choice,
		$animated_effects,
		$animated_delay

	)
) );

// Lightbox Image Gallery
class WPBakeryShortCode_AZ_Lightbox_Image_Gallery extends WPBakeryShortCode {}
vc_map( array(
	'name' => __( 'Lightbox Image Gallery', AZ_THEME_NAME ),
	'base' => 'az_lightbox_image_gallery',
	'icon' => 'icon-wpb-single-image',
	'category' => __( 'Content', AZ_THEME_NAME ),
	'description' => __( 'Gallery Images Lightbox', AZ_THEME_NAME ),
	'params' => array(

		array(
			'type' => 'attach_image',
			'heading' => __( 'Image', AZ_THEME_NAME ),
			'param_name' => 'image',
			'value' => '',
			'description' => __( 'Required. Select image from media library.', AZ_THEME_NAME )
		),

		array(
			'type' => 'attach_image',
			'heading' => __( 'Different Image', AZ_THEME_NAME ),
			'param_name' => 'image_popup',
			'value' => '',
			'description' => __( 'Optional. Select image from media library, if you want a different popup image.', AZ_THEME_NAME ),
			'dependency' => array(
				'element' => 'image',
				'not_empty' => true
			)
		),

		array(
			'type' => 'attach_images',
			'heading' => __( 'Images for Gallery', AZ_THEME_NAME ),
			'param_name' => 'images_gallery',
			'value' => '',
			'description' => __( 'Required. Select images from media library.', AZ_THEME_NAME ),
			'dependency' => array(
				'element' => 'image',
				'not_empty' => true
			)
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Thumbnail Width (Optional)', AZ_THEME_NAME ),
			'param_name' => 'thumb_widht',
			'value' => '',
			'admin_label' => true,
			'description' => __( 'Optional. If you wish choose a width for your thumbnail. It will be automatically cropped and resized. Enter only number value.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Fancybox Gallery Name', AZ_THEME_NAME ),
			'param_name' => 'gallery_name',
			'admin_label' => true,
			'description' => __( 'Required. Insert a name for the lightbox gallery.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', AZ_THEME_NAME ),
			'param_name' => 'el_class',
			'admin_label' => true,
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME )
		),

		/* Responsive Visibility */
		$responsive_lg,
		$responsive_md,
		$responsive_sm,
		$responsive_xs,

		/* Animations */
		$animated_choice,
		$animated_effects,
		$animated_delay
	)
) );


/*-----------------------------------------------------------------------------------*/
/*	Portfolio Grid
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Portfolio_Grid extends WPBakeryShortCode {}
vc_map( array(
	'name' => __( 'Portfolio Grid', AZ_THEME_NAME ),
	'base' => 'az_portfolio_grid',
	'icon' => 'icon-wpb-single-image',
	'category' => __( 'Content', AZ_THEME_NAME ),
	'description' => __( 'Display Portfolio Posts', AZ_THEME_NAME ),
	'params' => array(

		array(
			'type' => 'dropdown',
			'heading' => __('Layout Mode', AZ_THEME_NAME),
			'param_name' => 'portfolio_layout',
			'value' => array(
				__('Grid', AZ_THEME_NAME) 			    => 'grid-portfolio',
				__('Masonry', AZ_THEME_NAME)  		    => 'masonry-portfolio',
				__('Masonry Grid Block', AZ_THEME_NAME) => 'masonry-block-portfolio',
				__('Striped', AZ_THEME_NAME)  		    => 'striped-portfolio',
				__('Scrollable', AZ_THEME_NAME) 		=> 'scrollable-portfolio',
				__('Listed', AZ_THEME_NAME) 			=> 'listed-portfolio',
		  		__('Carousel', AZ_THEME_NAME) 			=> 'carousel-portfolio'
			),
			'admin_label' => true,
			'description' => __('Select Portfolio Layout Mode.', AZ_THEME_NAME),
		),

		// Carousel Mode
		array(
			'type' => 'textfield',
			'heading' => __('Item Number', AZ_THEME_NAME),
			'param_name' => 'carousel_portfolio_item',
			'value' => '6',
			'admin_label' => false,
			'description' => __('', AZ_THEME_NAME),
			'dependency' => array(
		  		'element' => 'portfolio_layout', 
		  		'value'   => array( 'carousel-portfolio' )
		  	)
		),

		array(
			'type' => 'textfield',
			'heading' => __('Item Tablet Number', AZ_THEME_NAME),
			'param_name' => 'carousel_portfolio_item_tablet',
			'value' => '3',
			'admin_label' => false,
			'description' => __('', AZ_THEME_NAME),
			'dependency' => array(
		  		'element' => 'portfolio_layout', 
		  		'value'   => array( 'carousel-portfolio' )
		  	)
		),

		array(
			'type' => 'textfield',
			'heading' => __('Item Mobile Number', AZ_THEME_NAME),
			'param_name' => 'carousel_portfolio_item_mobile',
			'value' => '1',
			'admin_label' => false,
			'description' => __('', AZ_THEME_NAME),
			'dependency' => array(
		  		'element' => 'portfolio_layout', 
		  		'value'   => array( 'carousel-portfolio' )
		  	)
		),

		array(
			'type' => 'dropdown',
			'heading' => __('Carousel Navigation', AZ_THEME_NAME),
			'param_name' => 'carousel_portfolio_navigation',
			'value' => array(
				__('No', AZ_THEME_NAME)  => 'false',
				__('Yes', AZ_THEME_NAME) => 'true',
			),
			'admin_label' => false,
			'description' => __('', AZ_THEME_NAME),
			'dependency' => array(
		  		'element' => 'portfolio_layout', 
		  		'value'   => array( 'carousel-portfolio' )
		  	)
		),

		array(
			'type' => 'dropdown',
			'heading' => __('Carousel Pagination', AZ_THEME_NAME),
			'param_name' => 'carousel_portfolio_pagination',
			'value' => array(
				__('No', AZ_THEME_NAME)  => 'false',
				__('Yes', AZ_THEME_NAME) => 'true',
			),
			'admin_label' => false,
			'description' => __('', AZ_THEME_NAME),
			'dependency' => array(
		  		'element' => 'portfolio_layout', 
		  		'value'   => array( 'carousel-portfolio' )
		  	)
		),

		array(
			'type' => 'dropdown',
			'heading' => __('Carousel Autoplay', AZ_THEME_NAME),
			'param_name' => 'carousel_portfolio_autoplay',
			'value' => array(
				__('No', AZ_THEME_NAME)  => 'false',
				__('Yes', AZ_THEME_NAME) => 'true',
			),
			'admin_label' => false,
			'description' => __('', AZ_THEME_NAME),
			'dependency' => array(
		  		'element' => 'portfolio_layout', 
		  		'value'   => array( 'carousel-portfolio' )
		  	)
		),

		// Columns
		array(
			'type' => 'dropdown',
			'heading' => __('Columns', AZ_THEME_NAME),
			'param_name' => 'portfolio_columns_count',
			'value' => array(
				__('2 Columns', AZ_THEME_NAME) => '2clm',
				__('3 Columns', AZ_THEME_NAME) => '3clm',
				__('4 Columns', AZ_THEME_NAME) => '4clm',
				__('5 Columns (Only Wall Effect Enabled)', AZ_THEME_NAME) => '5clm',
				__('6 Columns (Only Wall Effect Enabled)', AZ_THEME_NAME) => '6clm'
			),
			'admin_label' => true,
			'description' => __('How many columns should be displayed?', AZ_THEME_NAME),
			'dependency' => array(
		  		'element' => 'portfolio_layout', 
		  		'value'   => array( 'grid-portfolio', 'masonry-portfolio' )
		  	)
		),

		// Wall
		array(
			'type' => 'checkbox',
			'heading' => __('Enable Wall Effect?', AZ_THEME_NAME),
			'param_name' => 'portfolio_wall',
			'value' => array(
		  		__('Yes, please', AZ_THEME_NAME) => 'yes'
		  	),
		  	'admin_label' => true,
		  	'description' => __('Enable or Disable Portfolio Wall Effect!', AZ_THEME_NAME),
			'dependency' => array(
		  		'element' => 'portfolio_layout', 
		  		'value'   => array( 'grid-portfolio', 'masonry-portfolio', 'carousel-portfolio' )
		  	)
		),

		// Colorize FX
		array(
			'type' => 'checkbox',
			'heading' => __('Colorize Effect?', AZ_THEME_NAME),
			'param_name' => 'portfolio_colorize',
			'value' => array(
		  		__('Yes, please', AZ_THEME_NAME) => 'yes'
		  	),
		  	'admin_label' => true,
		  	'description' => __('Enable or Disable Portfolio Colorize Effect!', AZ_THEME_NAME),
			'dependency' => array(
		  		'element' => 'portfolio_layout', 
		  		'value'   => array( 'grid-portfolio', 'masonry-portfolio', 'masonry-block-portfolio', 'striped-portfolio', 'scrollable-portfolio', 'carousel-portfolio' )
		  	)
		),

		// Filter
		array(
			'type' => 'dropdown',
			'heading' => __('Portfolio Sortable', AZ_THEME_NAME),
			'param_name' => 'portfolio_sortable_mode',
			'value' => array(
				__('No', AZ_THEME_NAME)  => 'no',
				__('Yes', AZ_THEME_NAME) => 'yes',
			),
			'admin_label' => true,
			'description' => __('Should the sorting options based on categories be displayed? Disable if you want display a custom portfolio categories.', AZ_THEME_NAME),
			'dependency' => array(
		  		'element' => 'portfolio_layout', 
		  		'value'   => array( 'grid-portfolio', 'masonry-portfolio', 'masonry-block-portfolio', 'listed-portfolio' )
		  	)
		),

		array(
			'type' => 'checkbox',
			'heading' => __('Enable Filter Animation?', AZ_THEME_NAME),
			'param_name' => 'portfolio_sortable_animation',
			'value' => array(
		  		__('Yes, please', AZ_THEME_NAME) => 'yes'
		  	),
		  	'admin_label' => false,
		  	'description' => __('Enable or Disable Portfolio Filter Animation!', AZ_THEME_NAME),
			'dependency' => array(
		  		'element' => 'portfolio_sortable_mode', 
		  		'value'   => array( 'yes' )
		  	)
		),

		array(
			'type' => 'textfield',
			'heading' => __('Portfolio Sortable Name', AZ_THEME_NAME),
			'param_name' => 'portfolio_sortable_name',
			'value' => 'All',
			'admin_label' => false,
			'description' => __('Enter sortable name. Default value is All Projects.', AZ_THEME_NAME),
			'dependency' => array(
		  		'element' => 'portfolio_sortable_mode', 
		  		'value'   => array( 'yes' )
		  	)
		),

		// Pagination
		array(
			'type' => 'dropdown',
			'heading' => __('Portfolio Pagination', AZ_THEME_NAME),
			'param_name' => 'portfolio_pagination',
			'value' => array(
				__('No', AZ_THEME_NAME)  => 'no',
				__('Yes', AZ_THEME_NAME) => 'yes',
			),
			'admin_label' => true,
			'description' => __('Select if you want a pagination portfolio.', AZ_THEME_NAME),
			'dependency' => array(
		  		'element' => 'portfolio_layout', 
		  		'value'   => array( 'grid-portfolio', 'masonry-portfolio', 'masonry-block-portfolio', 'listed-portfolio' )
		  	)
		),

		array(
			'type' => 'checkbox',
			'heading' => __('Infinite Scroll?', AZ_THEME_NAME),
			'param_name' => 'portfolio_infinite_scroll',
			'value' => array(
		  		__('Yes, please', AZ_THEME_NAME) => 'yes'
		  	),
		  	'admin_label' => false,
		  	'description' => __('Enable or Disable Infinite Scroll! <strong><em>Remember the Filter dont work with Infinite Scroll</em></strong>', AZ_THEME_NAME),
			'dependency' => array(
		  		'element' => 'portfolio_pagination', 
		  		'value'   => array( 'yes' )
		  	)
		),

		array(
			'type' => 'dropdown',
			'heading' => __('Infinite Scroll Method', AZ_THEME_NAME),
			'param_name' => 'portfolio_infinite_scroll_method',
			'value' => array(
				__('Trigger Button', AZ_THEME_NAME)   => 'twitter',
				__('Automatic Scroll', AZ_THEME_NAME) => 'manual',
			),
			'admin_label' => false,
			'description' => __('Select if you prefereed method.', AZ_THEME_NAME),
			'dependency' => array(
		  		'element' => 'portfolio_infinite_scroll', 
		  		'value'   => array( 'yes' )
		  	)
		),

		// Settings
		array(
			'type' => 'textfield',
			'heading' => __('Post Number', AZ_THEME_NAME),
			'param_name' => 'portfolio_post_number',
			'admin_label' => true,
			'description' => __('How many post to show? Enter number or word "All". Default value is All.', AZ_THEME_NAME)
		),

		array(
			'type' => 'textfield',
			'heading' => __('Portfolio Categories', AZ_THEME_NAME),
			'param_name' => 'portfolio_categories',
			'admin_label' => true,
			'description' => __('If you want to show only certain portfolio categories, not the entire portfolio, please write the categories in this field, separated by commas. Please use the <strong>category slug</strong>, not the title.', AZ_THEME_NAME)
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Order by', AZ_THEME_NAME ),
			'param_name' => 'orderby',
			'value' => array(
				'',
				__( 'Date', AZ_THEME_NAME ) => 'date',
				__( 'ID', AZ_THEME_NAME ) => 'ID',
				__( 'Author', AZ_THEME_NAME ) => 'author',
				__( 'Title', AZ_THEME_NAME ) => 'title',
				__( 'Modified', AZ_THEME_NAME ) => 'modified',
				__( 'Random', AZ_THEME_NAME ) => 'rand',
				__( 'Menu Order', AZ_THEME_NAME ) => 'menu_order'
			),
			'admin_label' => true,
			'description' => sprintf(__('Select how to sort retrieved posts. More at %s.', AZ_THEME_NAME), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>')
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Order way', AZ_THEME_NAME ),
			'param_name' => 'order',
			'value' => array(
				__( 'Descending', AZ_THEME_NAME ) => 'DESC',
				__( 'Ascending', AZ_THEME_NAME ) => 'ASC'
			),
			'admin_label' => true,
			'description' => sprintf(__('Designates the ascending or descending order. More at %s.', AZ_THEME_NAME), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>')
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', AZ_THEME_NAME ),
			'param_name' => 'el_class',
			'admin_label' => true,
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME )
		),

		/* Animations */
		$animated_choice,
		$animated_effects,
		$animated_delay

	)
) );


/*-----------------------------------------------------------------------------------*/
/*	Team Grid
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Team_Grid extends WPBakeryShortCode {}
vc_map( array(
	'name' => __( 'Team Grid', AZ_THEME_NAME ),
	'base' => 'az_team_grid',
	'icon' => 'icon-wpb-single-image',
	'category' => __( 'Content', AZ_THEME_NAME ),
	'description' => __( 'Display Team Posts', AZ_THEME_NAME ),
	'params' => array(

		array(
			'type' => 'dropdown',
			'heading' => __('Layout Mode', AZ_THEME_NAME),
			'param_name' => 'team_layout',
			'value' => array(
				__('Grid', AZ_THEME_NAME)     => 'grid-team',
				__('Listed', AZ_THEME_NAME)   => 'listed-team',
				__('Carousel', AZ_THEME_NAME) => 'carousel-team',
			),
			'admin_label' => true,
			'description' => __('Select Team Layout Mode.', AZ_THEME_NAME),
		),

		// Carousel Mode
		array(
			'type' => 'textfield',
			'heading' => __('Item Number', AZ_THEME_NAME),
			'param_name' => 'carousel_team_item',
			'value' => '6',
			'admin_label' => false,
			'description' => __('', AZ_THEME_NAME),
			'dependency' => array(
		  		'element' => 'team_layout', 
		  		'value'   => array( 'carousel-team' )
		  	)
		),

		array(
			'type' => 'textfield',
			'heading' => __('Item Tablet Number', AZ_THEME_NAME),
			'param_name' => 'carousel_team_item_tablet',
			'value' => '3',
			'admin_label' => false,
			'description' => __('', AZ_THEME_NAME),
			'dependency' => array(
		  		'element' => 'team_layout', 
		  		'value'   => array( 'carousel-team' )
		  	)
		),

		array(
			'type' => 'textfield',
			'heading' => __('Item Mobile Number', AZ_THEME_NAME),
			'param_name' => 'carousel_team_item_mobile',
			'value' => '1',
			'admin_label' => false,
			'description' => __('', AZ_THEME_NAME),
			'dependency' => array(
		  		'element' => 'team_layout', 
		  		'value'   => array( 'carousel-team' )
		  	)
		),

		array(
			'type' => 'dropdown',
			'heading' => __('Carousel Navigation', AZ_THEME_NAME),
			'param_name' => 'carousel_team_navigation',
			'value' => array(
				__('No', AZ_THEME_NAME)  => 'false',
				__('Yes', AZ_THEME_NAME) => 'true',
			),
			'admin_label' => false,
			'description' => __('', AZ_THEME_NAME),
			'dependency' => array(
		  		'element' => 'team_layout', 
		  		'value'   => array( 'carousel-team' )
		  	)
		),

		array(
			'type' => 'dropdown',
			'heading' => __('Carousel Pagination', AZ_THEME_NAME),
			'param_name' => 'carousel_team_pagination',
			'value' => array(
				__('No', AZ_THEME_NAME)  => 'false',
				__('Yes', AZ_THEME_NAME) => 'true',
			),
			'admin_label' => false,
			'description' => __('', AZ_THEME_NAME),
			'dependency' => array(
		  		'element' => 'team_layout', 
		  		'value'   => array( 'carousel-team' )
		  	)
		),

		array(
			'type' => 'dropdown',
			'heading' => __('Carousel Autoplay', AZ_THEME_NAME),
			'param_name' => 'carousel_team_autoplay',
			'value' => array(
				__('No', AZ_THEME_NAME)  => 'false',
				__('Yes', AZ_THEME_NAME) => 'true',
			),
			'admin_label' => false,
			'description' => __('', AZ_THEME_NAME),
			'dependency' => array(
		  		'element' => 'team_layout', 
		  		'value'   => array( 'carousel-team' )
		  	)
		),

		// Columns
		array(
			'type' => 'dropdown',
			'heading' => __('Columns', AZ_THEME_NAME),
			'param_name' => 'team_columns_count',
			'value' => array(
				__('2 Columns', AZ_THEME_NAME) => '2clm',
				__('3 Columns', AZ_THEME_NAME) => '3clm',
				__('4 Columns', AZ_THEME_NAME) => '4clm',
				__('5 Columns (Only Wall Effect Enabled)', AZ_THEME_NAME) => '5clm',
				__('6 Columns (Only Wall Effect Enabled)', AZ_THEME_NAME) => '6clm'
			),
			'admin_label' => true,
			'description' => __('How many columns should be displayed?', AZ_THEME_NAME),
			'dependency' => array(
		  		'element' => 'team_layout', 
		  		'value'   => array( 'grid-team' )
		  	)
		),

		// Wall
		array(
			'type' => 'checkbox',
			'heading' => __('Enable Wall Effect?', AZ_THEME_NAME),
			'param_name' => 'team_wall',
			'value' => array(
		  		__('Yes, please', AZ_THEME_NAME) => 'yes'
		  	),
		  	'admin_label' => true,
		  	'description' => __('Enable or Disable Portfolio Wall Effect!', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'team_layout', 
		  		'value'   => array( 'grid-team', 'carousel-team' )
		  	)
		),

		// Settings
		array(
			'type' => 'textfield',
			'heading' => __('Post Number', AZ_THEME_NAME),
			'param_name' => 'team_post_number',
			'admin_label' => true,
			'description' => __('How many post to show? Enter number or word "All". Default value is All.', AZ_THEME_NAME)
		),

		array(
			'type' => 'textfield',
			'heading' => __('Team Categories', AZ_THEME_NAME),
			'param_name' => 'team_categories',
			'admin_label' => true,
			'description' => __('If you want to show only certain team categories, not the entire team, please write the categories in this field, separated by commas. Please use the <strong>category slug</strong>, not the title.', AZ_THEME_NAME)
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Order by', AZ_THEME_NAME ),
			'param_name' => 'orderby',
			'value' => array(
				'',
				__( 'Date', AZ_THEME_NAME ) => 'date',
				__( 'ID', AZ_THEME_NAME ) => 'ID',
				__( 'Author', AZ_THEME_NAME ) => 'author',
				__( 'Title', AZ_THEME_NAME ) => 'title',
				__( 'Modified', AZ_THEME_NAME ) => 'modified',
				__( 'Random', AZ_THEME_NAME ) => 'rand',
				__( 'Menu Order', AZ_THEME_NAME ) => 'menu_order'
			),
			'admin_label' => true,
			'description' => sprintf(__('Select how to sort retrieved posts. More at %s.', AZ_THEME_NAME), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>')
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Order way', AZ_THEME_NAME ),
			'param_name' => 'order',
			'value' => array(
				__( 'Descending', AZ_THEME_NAME ) => 'DESC',
				__( 'Ascending', AZ_THEME_NAME ) => 'ASC'
			),
			'admin_label' => true,
			'description' => sprintf(__('Designates the ascending or descending order. More at %s.', AZ_THEME_NAME), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>')
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', AZ_THEME_NAME ),
			'param_name' => 'el_class',
			'admin_label' => true,
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME )
		),

		$animated_choice,
		$animated_effects,
		$animated_delay

	)
) );


/*-----------------------------------------------------------------------------------*/
/*	Clients Grid
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Clients extends WPBakeryShortCode {}
vc_map( array(
	'name' => __( 'Clients Grid', AZ_THEME_NAME ),
	'base' => 'az_clients',
	'icon' => 'icon-wpb-single-image',
	'category' => __( 'Content', AZ_THEME_NAME ),
	'description' => __( 'Display Clients Posts', AZ_THEME_NAME ),
	'params' => array(

		array(
			'type' => 'dropdown',
			'heading' => __('Layout Mode', AZ_THEME_NAME),
			'param_name' => 'client_layout',
			'value' => array(
				__('Grid', AZ_THEME_NAME)     => 'grid-clients',
				__('Carousel', AZ_THEME_NAME) => 'carousel-clients',
			),
			'admin_label' => true,
			'description' => __('Select Client Layout Mode.', AZ_THEME_NAME),
		),

		// Carousel Mode
		array(
			'type' => 'textfield',
			'heading' => __('Item Number', AZ_THEME_NAME),
			'param_name' => 'client_item',
			'value' => '6',
			'admin_label' => false,
			'description' => __('', AZ_THEME_NAME),
			'dependency' => array(
		  		'element' => 'client_layout', 
		  		'value'   => array( 'carousel-clients' )
		  	)
		),

		array(
			'type' => 'textfield',
			'heading' => __('Item Tablet Number', AZ_THEME_NAME),
			'param_name' => 'client_item_tablet',
			'value' => '3',
			'admin_label' => false,
			'description' => __('', AZ_THEME_NAME),
			'dependency' => array(
		  		'element' => 'client_layout', 
		  		'value'   => array( 'carousel-clients' )
		  	)
		),

		array(
			'type' => 'textfield',
			'heading' => __('Item Mobile Number', AZ_THEME_NAME),
			'param_name' => 'client_item_mobile',
			'value' => '1',
			'admin_label' => false,
			'description' => __('', AZ_THEME_NAME),
			'dependency' => array(
		  		'element' => 'client_layout', 
		  		'value'   => array( 'carousel-clients' )
		  	)
		),

		array(
			'type' => 'dropdown',
			'heading' => __('Carousel Navigation', AZ_THEME_NAME),
			'param_name' => 'client_navigation',
			'value' => array(
				__('No', AZ_THEME_NAME)  => 'false',
				__('Yes', AZ_THEME_NAME) => 'true',
			),
			'admin_label' => false,
			'description' => __('', AZ_THEME_NAME),
			'dependency' => array(
		  		'element' => 'client_layout', 
		  		'value'   => array( 'carousel-clients' )
		  	)
		),

		array(
			'type' => 'dropdown',
			'heading' => __('Carousel Pagination', AZ_THEME_NAME),
			'param_name' => 'client_pagination',
			'value' => array(
				__('No', AZ_THEME_NAME)  => 'false',
				__('Yes', AZ_THEME_NAME) => 'true',
			),
			'admin_label' => false,
			'description' => __('', AZ_THEME_NAME),
			'dependency' => array(
		  		'element' => 'client_layout', 
		  		'value'   => array( 'carousel-clients' )
		  	)
		),

		array(
			'type' => 'dropdown',
			'heading' => __('Carousel Autoplay', AZ_THEME_NAME),
			'param_name' => 'client_autoplay',
			'value' => array(
				__('No', AZ_THEME_NAME)  => 'false',
				__('Yes', AZ_THEME_NAME) => 'true',
			),
			'admin_label' => false,
			'description' => __('', AZ_THEME_NAME),
			'dependency' => array(
		  		'element' => 'client_layout', 
		  		'value'   => array( 'carousel-clients' )
		  	)
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', AZ_THEME_NAME ),
			'param_name' => 'el_class',
			'admin_label' => true,
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME )
		)

	)
) );


/*-----------------------------------------------------------------------------------*/
/*	Latest Posts
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Latest_Posts extends WPBakeryShortCode {}
vc_map( array(
	'name' => __( 'Latest Blog Posts', AZ_THEME_NAME ),
	'base' => 'az_latest_posts',
	'icon' => 'icon-wpb-single-image',
	'category' => __( 'Content', AZ_THEME_NAME ),
	'description' => __( 'Display Latest Posts', AZ_THEME_NAME ),
	'params' => array(

		array(
			'type' => 'dropdown',
			'heading' => __( 'Layout Mode', AZ_THEME_NAME ),
			'param_name' => 'post_layout',
			'value' => array(
				__('Grid', AZ_THEME_NAME)    => 'grid-layout',
				__('Masonry', AZ_THEME_NAME) => 'masonry-layout',
				__('Listed', AZ_THEME_NAME)  => 'listed-layout'
			),
			'admin_label' => true,
			'description' => __( 'Select Post Layout Mode.', AZ_THEME_NAME )
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Columns', AZ_THEME_NAME ),
			'param_name' => 'post_columns_count',
			'value' => array(
				__( '2 Columns', AZ_THEME_NAME ) => '2clm',
				__( '3 Columns', AZ_THEME_NAME ) => '3clm',
				__( '4 Columns', AZ_THEME_NAME ) => '4clm',
			),
			'admin_label' => true,
			'description' => __( 'How many columns should be displayed?', AZ_THEME_NAME ),
			'dependency' => array(
				'element' => 'post_layout',
				'value' => array( 'grid-layout', 'masonry-layout' )
			)
		),

		// Settings
		array(
			'type' => 'textfield',
			'heading' => __( 'Posts Number', AZ_THEME_NAME ),
			'param_name' => 'post_number',
			'admin_label' => true,
			'description' => __( 'How many post to show? Enter number or word "All". Defaul value is All.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Posts Category', AZ_THEME_NAME ),
			'param_name' => 'post_categories',
			'admin_label' => true,
			'description' => __( 'If you want to show only certain post categories, not the entire blog posts, please write the categories in this field, separated by commas. Please use the <strong>category slug</strong>, not the title.', AZ_THEME_NAME ),
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', AZ_THEME_NAME ),
			'param_name' => 'el_class',
			'admin_label' => true,
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME )
		)

	)
) );


/*-----------------------------------------------------------------------------------*/
/*	Gallery Images
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Gallery_Images extends WPBakeryShortCode {}
vc_map( array(
	'name' => __( 'Gallery Images', AZ_THEME_NAME ),
	'base' => 'az_gallery_images',
	'icon' => 'icon-wpb-single-image',
	'category' => __( 'Content', AZ_THEME_NAME ),
	'description' => __( 'Gallery Images', AZ_THEME_NAME ),
	'params' => array(

		array(
			'type' => 'attach_images',
			'heading' => __( 'Images for Gallery', AZ_THEME_NAME ),
			'param_name' => 'images_gallery',
			'value' => '',
			'description' => __( 'Required. Select images from media library.', AZ_THEME_NAME )
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Gallery Layout Mode', AZ_THEME_NAME ),
			'param_name' => 'gallery_layout',
			'value' => array(
				__('Grid', AZ_THEME_NAME)     => 'grid-gallery',
				__('Masonry', AZ_THEME_NAME)  => 'masonry-gallery',
				__('Carousel', AZ_THEME_NAME) => 'carousel-gallery'
			),
			'admin_label' => true,
			'description' => __( 'Choose Gallery Layout Mode.', AZ_THEME_NAME )
		),

		// Carousel Mode
		array(
			'type' => 'textfield',
			'heading' => __('Item Number', AZ_THEME_NAME),
			'param_name' => 'carousel_gallery_item',
			'value' => '6',
			'admin_label' => false,
			'description' => __('', AZ_THEME_NAME),
			'dependency' => array(
		  		'element' => 'gallery_layout', 
		  		'value'   => array( 'carousel-gallery' )
		  	)
		),

		array(
			'type' => 'textfield',
			'heading' => __('Item Tablet Number', AZ_THEME_NAME),
			'param_name' => 'carousel_gallery_item_tablet',
			'value' => '3',
			'admin_label' => false,
			'description' => __('', AZ_THEME_NAME),
			'dependency' => array(
		  		'element' => 'gallery_layout', 
		  		'value'   => array( 'carousel-gallery' )
		  	)
		),

		array(
			'type' => 'textfield',
			'heading' => __('Item Mobile Number', AZ_THEME_NAME),
			'param_name' => 'carousel_gallery_item_mobile',
			'value' => '1',
			'admin_label' => false,
			'description' => __('', AZ_THEME_NAME),
			'dependency' => array(
		  		'element' => 'gallery_layout', 
		  		'value'   => array( 'carousel-gallery' )
		  	)
		),

		array(
			'type' => 'dropdown',
			'heading' => __('Carousel Navigation', AZ_THEME_NAME),
			'param_name' => 'carousel_gallery_navigation',
			'value' => array(
				__('No', AZ_THEME_NAME)  => 'false',
				__('Yes', AZ_THEME_NAME) => 'true',
			),
			'admin_label' => false,
			'description' => __('', AZ_THEME_NAME),
			'dependency' => array(
		  		'element' => 'gallery_layout', 
		  		'value'   => array( 'carousel-gallery' )
		  	)
		),

		array(
			'type' => 'dropdown',
			'heading' => __('Carousel Pagination', AZ_THEME_NAME),
			'param_name' => 'carousel_gallery_pagination',
			'value' => array(
				__('No', AZ_THEME_NAME)  => 'false',
				__('Yes', AZ_THEME_NAME) => 'true',
			),
			'admin_label' => false,
			'description' => __('', AZ_THEME_NAME),
			'dependency' => array(
		  		'element' => 'gallery_layout', 
		  		'value'   => array( 'carousel-gallery' )
		  	)
		),

		array(
			'type' => 'dropdown',
			'heading' => __('Carousel Autoplay', AZ_THEME_NAME),
			'param_name' => 'carousel_gallery_autoplay',
			'value' => array(
				__('No', AZ_THEME_NAME)  => 'false',
				__('Yes', AZ_THEME_NAME) => 'true',
			),
			'admin_label' => false,
			'description' => __('', AZ_THEME_NAME),
			'dependency' => array(
		  		'element' => 'gallery_layout', 
		  		'value'   => array( 'carousel-gallery' )
		  	)
		),

		// Columns
		array(
			'type' => 'dropdown',
			'heading' => __( 'Columns', AZ_THEME_NAME ),
			'param_name' => 'gallery_columns_count',
			'value' => array(
				__( '2 Columns', AZ_THEME_NAME ) => '2clm',
				__( '3 Columns', AZ_THEME_NAME ) => '3clm',
				__( '4 Columns', AZ_THEME_NAME ) => '4clm',
				__( '5 Columns (Only Wall Effect Enabled)', AZ_THEME_NAME ) => '5clm',
				__( '6 Columns (Only Wall Effect Enabled)', AZ_THEME_NAME ) => '6clm'
			),
			'admin_label' => true,
			'description' => __( 'How many columns should be displayed?', AZ_THEME_NAME ),
			'dependency' => array(
		  		'element' => 'gallery_layout', 
		  		'value'   => array( 'grid-gallery', 'masonry-gallery' )
		  	)
		),

		// Wall
		array(
			'type' => 'checkbox',
			'heading' => __('Enable Wall Effect?', AZ_THEME_NAME),
			'param_name' => 'gallery_wall',
			'value' => array(
		  		__('Yes, please', AZ_THEME_NAME) => 'yes'
		  	),
		  	'admin_label' => true,
		  	'description' => __('Enable or Disable Portfolio Wall Effect!', AZ_THEME_NAME),
		),

		// Randomize
		array(
			'type' => 'checkbox',
			'heading' => __('Randomize Images?', AZ_THEME_NAME),
			'param_name' => 'gallery_random_image',
			'value' => array(
		  		__('Yes, please', AZ_THEME_NAME) => 'yes'
		  	),
		  	'admin_label' => false,
		  	'description' => __('Randomize the Images.', AZ_THEME_NAME)
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', AZ_THEME_NAME ),
			'param_name' => 'el_class',
			'admin_label' => true,
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME )
		)
		
	)
) );


/*-----------------------------------------------------------------------------------*/
/*	List Icon
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_List_Icon extends WPBakeryShortCode {}
vc_map( array(
	'name' => __( 'List Icon', AZ_THEME_NAME ),
	'base' => 'az_list_icon',
	'icon' => 'icon-wpb-single-image',
	'category' => __( 'Content', AZ_THEME_NAME ),
	'description' => __( 'List Items Icons', AZ_THEME_NAME ),
	'params' => array(

		// Icons
		$icon_mode,
		$icon_size,

		array(
			'type' => 'dropdown',
			'heading' => __('Icon Color', AZ_THEME_NAME),
			'param_name' => 'icon_color',
			'value' => array(
				__('Default', AZ_THEME_NAME)      => 'default-color',
				__('Custom Color', AZ_THEME_NAME) => 'custom',
			),
			'admin_label' => false,
			'description' => __('Choose a color for your icon.', AZ_THEME_NAME),
			'dependency' => array(
				'element' => 'icon_mode',
				'value' => 'yes-icon',
			)
		),

		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Icon Custom Color', AZ_THEME_NAME),
		  	'param_name' => 'custom_icon_color',
		  	'description' => __('Select custom color for icon.', AZ_THEME_NAME),
		  	'dependency' => array(
				'element' => 'icon_color',
				'value' => array( 'custom' )
			)
		),

		$icon_dropdown,
		$azfont_icon_pack,
		$azfont_icon_social_pack,
		$linecons_icon_pack,
		$steady_icon_pack,
		$fontawesome_icon_pack,

		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => __('List Content', AZ_THEME_NAME),
			'param_name' => 'content',
			'value' => __("Please use the Unordered List button <img src='".get_template_directory_uri() ."/framework/assets/img/icons/ul.png' alt='unordered list' /> on the editor to create the points of your icon list. Remember to delete this text...", AZ_THEME_NAME),
			'description' => __('', AZ_THEME_NAME)
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', AZ_THEME_NAME ),
			'param_name' => 'el_class',
			'admin_label' => true,
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME )
		),

		/* Responsive Visibility */
		$responsive_lg,
		$responsive_md,
		$responsive_sm,
		$responsive_xs,

		/* Animations */
		$animated_choice,
		$animated_effects,
		$animated_delay
		
	)
) );


/*-----------------------------------------------------------------------------------*/
/*	Box Icon
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Box_Icon extends WPBakeryShortCode {}
vc_map( array(
	'name' => __( 'Box Icon', AZ_THEME_NAME ),
	'base' => 'az_box_icon',
	'icon' => 'icon-wpb-single-image',
	'category' => __( 'Content', AZ_THEME_NAME ),
	'description' => __( 'Boxed Text with Icon', AZ_THEME_NAME ),
	'params' => array(

		array(
			'type' => 'dropdown',
			'heading' => __('Box Style', AZ_THEME_NAME),
			'param_name' => 'icons_select',
			'value' => array(
				__('Click for Select', AZ_THEME_NAME) 		   => '',
				__('Boxed', AZ_THEME_NAME) 					   => 'boxed_version',
				__('Circle Icon', AZ_THEME_NAME)  			   => 'icon_circle',
				__('Icon Only', AZ_THEME_NAME)  			   => 'icon_only',
				__('Standard Icon with Title', AZ_THEME_NAME)  => 'icon_standard',
			),
			'admin_label' => false,
			'description' => __('Select Your Favorite Box Icons Style.', AZ_THEME_NAME),
		),

		// Icons
		$icon_mode,

		array(
			'type' => 'dropdown',
			'heading' => __('Icon Color', AZ_THEME_NAME),
			'param_name' => 'icon_color',
			'value' => array(
				__('Default', AZ_THEME_NAME)      => 'default-color',
				__('Custom Color', AZ_THEME_NAME) => 'custom',
			),
			'admin_label' => false,
			'description' => __('Choose a color for your icon.', AZ_THEME_NAME),
			'dependency' => array(
				'element' => 'icon_mode',
				'value' => 'yes-icon',
			)
		),

		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Icon Custom Color', AZ_THEME_NAME),
		  	'param_name' => 'custom_icon_color',
		  	'description' => __('Select custom color for icon.', AZ_THEME_NAME),
		  	'dependency' => array(
				'element' => 'icon_color',
				'value' => array( 'custom' )
			)
		),

		$icon_dropdown,
		$azfont_icon_pack,
		$azfont_icon_social_pack,
		$linecons_icon_pack,
		$steady_icon_pack,
		$fontawesome_icon_pack,

		array(
			'type' => 'dropdown',
			'heading' => __('Box Position', AZ_THEME_NAME),
			'param_name' => 'position',
			'value' => array(
				__('Left', AZ_THEME_NAME)  => 'left',
				__('Top', AZ_THEME_NAME)   => 'top',
				__('Right', AZ_THEME_NAME) => 'right',
			),
			'admin_label' => true,
			'description' => __('Should the icon be positioned at the left, right or at the top?', AZ_THEME_NAME),
			'dependency' => array(
		  		'element' => 'icons_select', 
		  		'value'   => array( 'icon_circle', 'icon_only' )
		  	)
		),

		array(
			'type' => 'checkbox',
			'heading' => __('Wrap Box Icon in a link?', AZ_THEME_NAME),
			'param_name' => 'box_wrap_link',
			'value' => array(
		  		__('Yes, please', AZ_THEME_NAME) => 'yes'
		  	),
		  	'admin_label' => true
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Link URL', AZ_THEME_NAME ),
			'param_name' => 'box_wrap_link_url',
			'description' => __( 'Where should your box link to?.', AZ_THEME_NAME ),
			'dependency' => array(
				'element' => 'box_wrap_link',
				'value' => array( 'yes' )
			)
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Link Target', AZ_THEME_NAME ),
			'param_name' => 'target',
			'value' => $target_arr,
			'dependency' => array(
				'element' => 'box_wrap_link',
				'value' => array( 'yes' )
			)
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Title', AZ_THEME_NAME ),
			'param_name' => 'title',
			'value' => 'Box Icon Title',
			'description' => __( 'Add an Box Icon title here.', AZ_THEME_NAME ),
			'admin_label' => true
		),

		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => __('Box Icon Text', AZ_THEME_NAME),
			'param_name' => 'content',
			'value' => __('Insert Your Text...', AZ_THEME_NAME),
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', AZ_THEME_NAME ),
			'param_name' => 'el_class',
			'admin_label' => true,
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME )
		),

		/* Responsive Visibility */
		$responsive_lg,
		$responsive_md,
		$responsive_sm,
		$responsive_xs,

		/* Animations */
		$animated_choice,
		$animated_effects,
		$animated_delay

	)
) );


/*-----------------------------------------------------------------------------------*/
/*	Video Embed or Video Self Hosted
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Video_Container extends WPBakeryShortCode {}
vc_map( array(
	'name'		=> __('Video', AZ_THEME_NAME),
	'description' => __( 'Vimeo/Youtube or Self-Hosted Video', AZ_THEME_NAME),
    'base'		=> 'az_video_container',
    'icon'      => 'icon-wpb-ui-empty_space',
	'category' 	=> __('Content', AZ_THEME_NAME),
	'show_settings_on_create' => true,
    'params'	=> array(

		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => __('Video Embed / Video Self Hosted', AZ_THEME_NAME),
			'param_name' => 'content',
			'value' => __('Click here, delete this text and click on AZ Shortcodes Button and select Vimeo Embed or Video Self-Hosted Shortcode...', AZ_THEME_NAME),
			'description' => __("Click on the <strong>AZ Shortcode Button</strong> and select <strong>Video Embed or Video Self Hosted Shortcode</strong>.
	  			<br/><br/>A list of all supported Video Services can be found on <a href='http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F' target='_blank'>WordPress.org</a><br/>
	  			<br/>Working examples, in case you want to use an external service (Video Embed Shortcode):
	  			<br/><strong>https://vimeo.com/charlex/shapeshifter</strong>
	  			<br/><strong>http://www.youtube.com/watch?v=CZIt20emgLY</strong>", AZ_THEME_NAME )
		),

        array(
		  	'type' => 'textfield',
		  	'heading' => __('Extra class name', AZ_THEME_NAME),
		  	'param_name' => 'el_class',
		  	'admin_label' => true,
		  	'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME)
		),

		/* Responsive Visibility */
		$responsive_lg,
		$responsive_md,
		$responsive_sm,
		$responsive_xs,

		/* Animations */
		$animated_choice,
		$animated_effects,
		$animated_delay

    )
) );


/*-----------------------------------------------------------------------------------*/
/*	Audio Self Hosted
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Audio_Container extends WPBakeryShortCode {}
vc_map( array(
	'name'		=> __('Audio', AZ_THEME_NAME),
	'description' => __( 'Audio Self-Hosted', AZ_THEME_NAME),
    'base'		=> 'az_audio_container',
    'icon'      => 'icon-wpb-ui-empty_space',
	'category' 	=> __('Content', AZ_THEME_NAME),
	'show_settings_on_create' => true,
    'params'	=> array(

		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => __('Audio Self Hosted', AZ_THEME_NAME),
			'param_name' => 'content',
			'value' => __('Click here, delete this text and click on AZ Shortcodes Button and select Audio Self-Hosted Shortcode...', AZ_THEME_NAME),
			'description' => __('Click on the <strong>AZ Shortcode Button</strong> and select <strong>Audio Self Hosted Shortcode</strong>', AZ_THEME_NAME )
		),

        array(
		  	'type' => 'textfield',
		  	'heading' => __('Extra class name', AZ_THEME_NAME),
		  	'param_name' => 'el_class',
		  	'admin_label' => true,
		  	'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME)
		),

		/* Responsive Visibility */
		$responsive_lg,
		$responsive_md,
		$responsive_sm,
		$responsive_xs,

		/* Animations */
		$animated_choice,
		$animated_effects,
		$animated_delay

    )
) );


/*-----------------------------------------------------------------------------------*/
/*	Google Map
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Google_Map extends WPBakeryShortCode {}
vc_map( array(
	'name' => __( 'Map', AZ_THEME_NAME ),
	'base' => 'az_google_map',
	'icon' => 'icon-wpb-map-pin',
	'category' => __( 'Content', AZ_THEME_NAME ),
	'description' => __( 'Map Block', AZ_THEME_NAME ),
	'params' => array(

		array(
		  	'type' => 'dropdown',
		  	'heading' => __('Map Color', AZ_THEME_NAME),
		  	'param_name' => 'map_color_select',
		  	'value' => array(
		  		__('Default', AZ_THEME_NAME) 	 => '', 
		  		__('Custom Color', AZ_THEME_NAME) => 'custom'
		  	),
		  	'admin_label' => true,
		  	'description' => __('Choose a color for your map here.', AZ_THEME_NAME)
		),

		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Map Hue Color', AZ_THEME_NAME),
		  	'param_name' => 'map_hue_color',
		  	'description' => __('Indicates the basic color. Clear Value if you want a default google color map.', AZ_THEME_NAME),
		  	'dependency' => array(
				'element' => 'map_color_select',
				'value' => array( 'custom' )
			)
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('Map Saturation', AZ_THEME_NAME),
		  	'param_name' => 'map_saturation',
		  	'value' => '0',
		  	'description' => __('A floating point value between -100 and 100. Indicates the percentage change in intensity of the basic color to apply to the element.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'map_color_select', 
		  		'value' => array( 'custom' )
		  	)
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('Map Lightness', AZ_THEME_NAME),
		  	'param_name' => 'map_lightness',
		  	'value' => '0',
		  	'description' => __('A floating point value between -100 and 100. Indicates the percentage change in brightness of the element. Negative values increase darkness (where -100 specifies black) while positive values increase brightness (where +100 specifies white).', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'map_color_select', 
		  		'value' => array( 'custom' )
		  	)
		),

		array(
		  	'type' => 'dropdown',
		  	'heading' => __('Map Scroll', AZ_THEME_NAME),
		  	'param_name' => 'map_scroll',
		  	'value' => array(
		  		__('Disable', AZ_THEME_NAME) => 'false', 
		  		__('Enable', AZ_THEME_NAME)  => 'true'
		  	),
		  	'admin_label' => true,
		  	'description' => __('Enable/disable Scrollwheel zooming on the map.', AZ_THEME_NAME)
		),

		array(
		  	'type' => 'dropdown',
		  	'heading' => __('Map Draggable', AZ_THEME_NAME),
		  	'param_name' => 'map_drag',
		  	'value' => array(
		  		__('Disable', AZ_THEME_NAME) => 'false', 
		  		__('Enable', AZ_THEME_NAME)  => 'true'
		  	),
		  	'admin_label' => true,
		  	'description' => __('Enable/disable dragged map.', AZ_THEME_NAME)
		),

		array(
		  	'type' => 'dropdown',
		  	'heading' => __('Map Zoom Control', AZ_THEME_NAME),
		  	'param_name' => 'map_zoom_control',
		  	'value' => array(
		  		__('Disable', AZ_THEME_NAME) => 'false', 
		  		__('Enable', AZ_THEME_NAME)  => 'true'
		  	),
		  	'admin_label' => true,
		  	'description' => __('Enable/disable state of the Zoom Control.', AZ_THEME_NAME)
		),

		array(
		  	'type' => 'dropdown',
		  	'heading' => __('Map Double Click', AZ_THEME_NAME),
		  	'param_name' => 'map_double_click',
		  	'value' => array(
		  		__('Disable', AZ_THEME_NAME) => 'false', 
		  		__('Enable', AZ_THEME_NAME)  => 'true'
		  	),
		  	'admin_label' => true,
		  	'description' => __('Enable/disable Zoom and Center on double click.', AZ_THEME_NAME)
		),

		array(
		  	'type' => 'dropdown',
		  	'heading' => __('Map Default UI', AZ_THEME_NAME),
		  	'param_name' => 'map_default',
		  	'value' => array(
		  		__('Disable', AZ_THEME_NAME) => 'false', 
		  		__('Enable', AZ_THEME_NAME)  => 'true'
		  	),
		  	'admin_label' => true,
		  	'description' => __('Enable/disable all default UI.', AZ_THEME_NAME)
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('Map Height', AZ_THEME_NAME),
		  	'param_name' => 'map_height',
		  	'value' => '500',
		  	'admin_label' => true,
		  	'description' => __('Please enter the height for your map in pixel. Default Value 500.', AZ_THEME_NAME),
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('Map Latidude', AZ_THEME_NAME),
		  	'param_name' => 'map_latidude',
		  	'value' => '',
		  	'admin_label' => true,
		  	'description' => __('Please enter the latitude for the maps center point.', AZ_THEME_NAME),
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('Map Longitude', AZ_THEME_NAME),
		  	'param_name' => 'map_longitude',
		  	'value' => '',
		  	'admin_label' => true,
		  	'description' => __('Please enter the longitude for the maps center point.', AZ_THEME_NAME),
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('Map Zoom Level', AZ_THEME_NAME),
		  	'param_name' => 'map_zoom',
		  	'value' => '',
		  	'admin_label' => true,
		  	'description' => __('Value should be between 1-18, 1 being the entire earth and 18 being right at street level.', AZ_THEME_NAME),
		),

		array(
			'type' => 'attach_image',
			'heading' => __( 'Marker Icon', AZ_THEME_NAME ),
			'param_name' => 'image',
			'value' => '',
			'description' => __( 'Required. Please upload an image that will be used for the marker on your map.', AZ_THEME_NAME )
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('Map Title Marker', AZ_THEME_NAME),
		  	'param_name' => 'map_title_marker',
		  	'value' => '',
		  	'admin_label' => true,
		  	'description' => __('Please Enter here your text of Title Marker.', AZ_THEME_NAME),
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('Map Info Window Text', AZ_THEME_NAME),
		  	'param_name' => 'map_infowindow_text',
		  	'value' => '',
		  	'admin_label' => false,
		  	'description' => __('If you would like to display any text in an info window for location, please enter it here.', AZ_THEME_NAME),
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', AZ_THEME_NAME ),
			'param_name' => 'el_class',
			'admin_label' => true,
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME )
		),

		/* Responsive Visibility */
		$responsive_lg,
		$responsive_md,
		$responsive_sm,
		$responsive_xs

	)
) );


/*-----------------------------------------------------------------------------------*/
/*	Call to Action
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Call_Action extends WPBakeryShortCode {}
vc_map( array(
	'name'		=> __('Call to Action', AZ_THEME_NAME),
	'base'		=> 'az_call_action',
	'icon'      => 'icon-wpb-ui-empty_space',
	'category' 	=> __('Content', AZ_THEME_NAME),
	'description' => __( 'Eye catching call to action', AZ_THEME_NAME),
    'params'	=> array(

    	array(
		  	'type' => 'textarea_raw_html',
		  	'holder' => 'div',
		  	'heading' => __('Call Action Text', AZ_THEME_NAME),
		  	'param_name' => 'content_call_action',
		  	'value' => base64_encode('Call to Action Text.'),
		  	'description' => __('Required. Insert your text. HTML is allowed.', AZ_THEME_NAME)
		),

		array(
		  	'type' => 'dropdown',
		  	'heading' => __('Call Action Font Color', AZ_THEME_NAME),
		  	'param_name' => 'call_action_color',
		  	'value' => array(
		  		__('Default', AZ_THEME_NAME) 	 => '', 
		  		__('Custom Color', AZ_THEME_NAME) => 'custom'
		  	),
		  	'admin_label' => true,
		  	'description' => __('Choose a color for your call action text.', AZ_THEME_NAME)
		),

		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Call Action Text Custom Color', AZ_THEME_NAME),
		  	'param_name' => 'custom_call_action_color',
		  	'description' => __('Select custom color for call action text.', AZ_THEME_NAME),
		  	'dependency' => array(
				'element' => 'call_action_color',
				'value' => array( 'custom' )
			)
		),

		// Button
		array(
			'type' => 'textfield',
			'heading' => __( 'Button Label', AZ_THEME_NAME ),
			'param_name' => 'buttonlabel',
			'value'	=> 'Button Title',
			'admin_label' => true,
			'description' => __( 'This is the text that appears on your button.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Button Link URL', AZ_THEME_NAME ),
			'param_name' => 'buttonlink',
			'value'	=> '#',
			'admin_label' => false,
			'description' => __( 'Where should your button link to?', AZ_THEME_NAME )
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Button Link Target', AZ_THEME_NAME ),
			'param_name' => 'target',
			'value' => $target_arr,
			'admin_label' => false
		),

		array(
			'type' => 'dropdown',
			'heading' => __('Button Color', AZ_THEME_NAME),
			'param_name' => 'buttoncolor',
			'value' => array(
				__('Default', AZ_THEME_NAME)      => 'default-color',
				__('Custom Color', AZ_THEME_NAME) => 'custom',
			),
			'admin_label' => true,
			'description' => __('Choose a color for your button here.', AZ_THEME_NAME),
		),

		// Inverted
		array(
			'type' => 'checkbox',
			'heading' => __('Inverted Color?', AZ_THEME_NAME),
			'param_name' => 'inverted',
			'value' => array(
		  		__('Yes, please', AZ_THEME_NAME) => 'yes'
		  	),
		  	'admin_label' => false
		),

		// Custom Colors
		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Button Custom Color', AZ_THEME_NAME),
		  	'param_name' => 'custombuttoncolor',
		  	'description' => __('Select custom color for button.', AZ_THEME_NAME),
		  	'dependency' => array(
				'element' => 'buttoncolor',
				'value' => array( 'custom' )
			)
		),

		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Button Text Custom Color', AZ_THEME_NAME),
		  	'param_name' => 'custombuttontextcolor',
		  	'description' => __('Select custom color for text button.', AZ_THEME_NAME),
		  	'dependency' => array(
				'element' => 'buttoncolor',
				'value' => array( 'custom' )
			)
		),

		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Button Text Hover Custom Color', AZ_THEME_NAME),
		  	'param_name' => 'custombuttontexthovercolor',
		  	'description' => __('Select custom color for text button hover event.', AZ_THEME_NAME),
		  	'dependency' => array(
				'element' => 'buttoncolor',
				'value' => array( 'custom' )
			)
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', AZ_THEME_NAME ),
			'param_name' => 'el_class',
			'admin_label' => true,
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME )
		)

    )
) );


/*-----------------------------------------------------------------------------------*/
/*	Button
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Buttons extends WPBakeryShortCode {}
vc_map( array(
	'name'		=> __('Button', AZ_THEME_NAME),
	'base'		=> 'az_buttons',
	'icon'      => 'icon-wpb-ui-empty_space',
	'category' 	=> __('Content', AZ_THEME_NAME),
	'description' => __( 'Eye catching button', AZ_THEME_NAME),
    'params'	=> array(

    	array(
			'type' => 'textfield',
			'heading' => __( 'Button Label', AZ_THEME_NAME ),
			'param_name' => 'buttonlabel',
			'value'	=> 'Button Title',
			'admin_label' => true,
			'description' => __( 'This is the text that appears on your button.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Button Link URL', AZ_THEME_NAME ),
			'param_name' => 'buttonlink',
			'value'	=> '#',
			'admin_label' => false,
			'description' => __( 'Where should your button link to?', AZ_THEME_NAME )
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Button Link Target', AZ_THEME_NAME ),
			'param_name' => 'target',
			'value' => $target_arr,
			'admin_label' => false
		),

		array(
			'type' => 'dropdown',
			'heading' => __('Button Size', AZ_THEME_NAME),
			'param_name' => 'buttonsize',
			'value' => array(
				__('Mini', AZ_THEME_NAME)   => 'button-mini',
				__('Small', AZ_THEME_NAME)  => 'button-small',
				__('Medium', AZ_THEME_NAME) => 'button-medium',
				__('Large', AZ_THEME_NAME)  => 'button-large',
			),
			'admin_label' => true
		),

		array(
			'type' => 'dropdown',
			'heading' => __('Button Align', AZ_THEME_NAME),
			'param_name' => 'buttonalign',
			'value' => array(
				__('No Align', AZ_THEME_NAME)     => 'noalign',
				__('Align Left', AZ_THEME_NAME)   => 'textalignleft',
				__('Align Center', AZ_THEME_NAME) => 'textaligncenter',
				__('Align Right', AZ_THEME_NAME)  => 'textalignright',
			),
			'admin_label' => true
		),

		// Colors
		array(
			'type' => 'dropdown',
			'heading' => __('Button Color', AZ_THEME_NAME),
			'param_name' => 'buttoncolor',
			'value' => array(
				__('Default', AZ_THEME_NAME)      => 'default-color',
				__('Custom Color', AZ_THEME_NAME) => 'custom',
			),
			'admin_label' => true,
			'description' => __('Choose a color for your button here.', AZ_THEME_NAME),
		),

		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Button Custom Color', AZ_THEME_NAME),
		  	'param_name' => 'custombuttoncolor',
		  	'description' => __('Select custom color for button.', AZ_THEME_NAME),
		  	'dependency' => array(
				'element' => 'buttoncolor',
				'value' => array( 'custom' )
			)
		),

		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Button Text Custom Color', AZ_THEME_NAME),
		  	'param_name' => 'custombuttontextcolor',
		  	'description' => __('Select custom color for text button.', AZ_THEME_NAME),
		  	'dependency' => array(
				'element' => 'buttoncolor',
				'value' => array( 'custom' )
			)
		),

		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Button Text Hover Custom Color', AZ_THEME_NAME),
		  	'param_name' => 'custombuttontexthovercolor',
		  	'description' => __('Select custom color for text button hover event.', AZ_THEME_NAME),
		  	'dependency' => array(
				'element' => 'buttoncolor',
				'value' => array( 'custom' )
			)
		),

		// Inverted
		array(
			'type' => 'checkbox',
			'heading' => __('Inverted Color?', AZ_THEME_NAME),
			'param_name' => 'inverted',
			'value' => array(
		  		__('Yes, please', AZ_THEME_NAME) => 'yes'
		  	),
		  	'admin_label' => true
		),

		// Icons
		$icon_mode,
		$icon_dropdown,
		$azfont_icon_pack,
		$azfont_icon_social_pack,
		$linecons_icon_pack,
		$steady_icon_pack,
		$fontawesome_icon_pack,

    	array(
		  	'type' => 'textfield',
		  	'heading' => __('Extra class name', AZ_THEME_NAME),
		  	'param_name' => 'el_class',
		  	'admin_label' => true,
		  	'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME)
		),

		/* Responsive Visibility */
		$responsive_lg,
		$responsive_md,
		$responsive_sm,
		$responsive_xs,

		/* Animations */
		$animated_choice,
		$animated_effects,
		$animated_delay

    )
) );


/*-----------------------------------------------------------------------------------*/
/*	Social Profiles
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Social_Profile extends WPBakeryShortCode {}
vc_map( array(
	'name'		=> __('Social Profile', AZ_THEME_NAME),
	'base'		=> 'az_social_profile',
	'icon'      => 'icon-wpb-ui-empty_space',
	'category' 	=> __('Content', AZ_THEME_NAME),
	'description' => __( 'Display Social Profile Icon.', AZ_THEME_NAME),
    'params'	=> array(

		array( 
			"type" => "textfield",
			"heading" => __("500PX Profile", AZ_THEME_NAME),
			"param_name" => "px",
			"description" => __("Please enter in your 500PX URL.", AZ_THEME_NAME)
		),

		array( 
			"type" => "textfield",
			"heading" => __("Behance Profile", AZ_THEME_NAME),
			"param_name" => "behance",
			"description" => __("Please enter in your Behance URL.", AZ_THEME_NAME)
		),
		
		array( 
			"type" => "textfield",
			"heading" => __("Bebo Profile", AZ_THEME_NAME),
			"param_name" => "bebo",
			"description" => __("Please enter in your Bebo URL.", AZ_THEME_NAME)
		),
		
		array( 
			"type" => "textfield",
			"heading" => __("Blogger Profile", AZ_THEME_NAME),
			"param_name" => "blogger",
			"description" => __("Please enter in your Blogger URL.", AZ_THEME_NAME)
		),
		
		array( 
			"type" => "textfield",
			"heading" => __("Deviant Art Profile", AZ_THEME_NAME),
			"param_name" => "deviantart",
			"description" => __("Please enter in your Deviant Art URL.", AZ_THEME_NAME)
		),
		
		array( 
			"type" => "textfield",
			"heading" => __("Digg Profile", AZ_THEME_NAME),
			"param_name" => "digg",
			"description" => __("Please enter in your Digg URL.", AZ_THEME_NAME)
		),
		
		array( 
			"type" => "textfield",
			"heading" => __("Dribbble Profile", AZ_THEME_NAME),
			"param_name" => "dribbble",
			"description" => __("Please enter in your Dribbble URL.", AZ_THEME_NAME)
		),

		array( 
			"type" => "textfield",
			"heading" => __("Email Profile", AZ_THEME_NAME),
			"param_name" => "email",
			"description" => __("Please enter in your Email URL.", AZ_THEME_NAME)
		),
		
		array( 
			"type" => "textfield",
			"heading" => __("Envato Profile", AZ_THEME_NAME),
			"param_name" => "envato",
			"description" => __("Please enter in your Envato URL.", AZ_THEME_NAME)
		),
		
		array( 
			"type" => "textfield",
			"heading" => __("Evernote Profile", AZ_THEME_NAME),
			"param_name" => "evernote",
			"description" => __("Please enter in your Evernote URL.", AZ_THEME_NAME)
		),
		
		array( 
			"type" => "textfield",
			"heading" => __("Facebook Profile", AZ_THEME_NAME),
			"param_name" => "facebook",
			"description" => __("Please enter in your Facebook URL.", AZ_THEME_NAME)
		),

		array( 
			"type" => "textfield",
			"heading" => __("Flickr Profile", AZ_THEME_NAME),
			"param_name" => "flickr",
			"description" => __("Please enter in your Flickr URL.", AZ_THEME_NAME)
		),
		
		array( 
			"type" => "textfield",
			"heading" => __("Forrst Profile", AZ_THEME_NAME),
			"param_name" => "forrst",
			"description" => __("Please enter in your Forrst URL.", AZ_THEME_NAME)
		),
		
		array( 
			"type" => "textfield",
			"heading" => __("Github Profile", AZ_THEME_NAME),
			"param_name" => "github",
			"description" => __("Please enter in your Github URL.", AZ_THEME_NAME)
		),
		
		array( 
			"type" => "textfield",
			"heading" => __("Google Plus Profile", AZ_THEME_NAME),
			"param_name" => "googleplus",
			"description" => __("Please enter in your Google Plus URL.", AZ_THEME_NAME)
		),
		
		array( 
			"type" => "textfield",
			"heading" => __("Grooveshark Profile", AZ_THEME_NAME),
			"param_name" => "grooveshark",
			"description" => __("Please enter in your Grooveshark URL.", AZ_THEME_NAME)
		),
		
		array( 
			"type" => "textfield",
			"heading" => __("Instagram Profile", AZ_THEME_NAME),
			"param_name" => "instagram",
			"description" => __("Please enter in your Instagram URL.", AZ_THEME_NAME)
		),
		
		array( 
			"type" => "textfield",
			"heading" => __("Last Fm Profile", AZ_THEME_NAME),
			"param_name" => "lastfm",
			"description" => __("Please enter in your Last Fm URL.", AZ_THEME_NAME)
		),
		
		array( 
			"type" => "textfield",
			"heading" => __("Linked In Profile", AZ_THEME_NAME),
			"param_name" => "linkedin",
			"description" => __("Please enter in your Linked In URL.", AZ_THEME_NAME)
		),
		
		array( 
			"type" => "textfield",
			"heading" => __("PayPal Profile", AZ_THEME_NAME),
			"param_name" => "paypal",
			"description" => __("Please enter in your PayPal URL.", AZ_THEME_NAME)
		),
		
		array( 
			"type" => "textfield",
			"heading" => __("Pinterest Profile", AZ_THEME_NAME),
			"param_name" => "pinterest",
			"description" => __("Please enter in your Pinterest URL.", AZ_THEME_NAME)
		),
		
		array( 
			"type" => "textfield",
			"heading" => __("Quora Profile", AZ_THEME_NAME),
			"param_name" => "quora",
			"description" => __("Please enter in your Quora URL.", AZ_THEME_NAME)
		),
		
		array( 
			"type" => "textfield",
			"heading" => __("Share This Profile", AZ_THEME_NAME),
			"param_name" => "sharethis",
			"description" => __("Please enter in your Share This URL.", AZ_THEME_NAME)
		),
		
		array( 
			"type" => "textfield",
			"heading" => __("Skype Profile", AZ_THEME_NAME),
			"param_name" => "skype",
			"description" => __("Please enter in your Skype URL.", AZ_THEME_NAME)
		),
		
		array( 
			"type" => "textfield",
			"heading" => __("Soundcloud Profile", AZ_THEME_NAME),
			"param_name" => "soundcloud",
			"description" => __("Please enter in your Soundcloud URL.", AZ_THEME_NAME)
		),
		
		array( 
			"type" => "textfield",
			"heading" => __("StumbleUpon Profile", AZ_THEME_NAME),
			"param_name" => "stumbleupon",
			"description" => __("Please enter in your StumbleUpon URL.", AZ_THEME_NAME)
		),
		
		array( 
			"type" => "textfield",
			"heading" => __("Tumblr Profile", AZ_THEME_NAME),
			"param_name" => "tumblr",
			"description" => __("Please enter in your Tumblr URL.", AZ_THEME_NAME)
		),
		
		array( 
			"type" => "textfield",
			"heading" => __("Twitter Profile", AZ_THEME_NAME),
			"param_name" => "twitter",
			"description" => __("Please enter in your Twitter URL.", AZ_THEME_NAME)
		),
		
		array( 
			"type" => "textfield",
			"heading" => __("Viddler Profile", AZ_THEME_NAME),
			"param_name" => "viddler",
			"description" => __("Please enter in your Viddler URL.", AZ_THEME_NAME)
		),
		
		array( 
			"type" => "textfield",
			"heading" => __("Vimeo Profile", AZ_THEME_NAME),
			"param_name" => "vimeo",
			"description" => __("Please enter in your Vimeo URL.", AZ_THEME_NAME)
		),
		
		array( 
			"type" => "textfield",
			"heading" => __("Virb Profile", AZ_THEME_NAME),
			"param_name" => "virb",
			"description" => __("Please enter in your Virb URL.", AZ_THEME_NAME)
		),
		
		array( 
			"type" => "textfield",
			"heading" => __("Wordpress Profile", AZ_THEME_NAME),
			"param_name" => "wordpress",
			"description" => __("Please enter in your Wordpress URL.", AZ_THEME_NAME)
		),
		
		array( 
			"type" => "textfield",
			"heading" => __("Yahoo Profile", AZ_THEME_NAME),
			"param_name" => "yahoo",
			"description" => __("Please enter in your Yahoo URL.", AZ_THEME_NAME)
		),
		
		array( 
			"type" => "textfield",
			"heading" => __("Yelp Profile", AZ_THEME_NAME),
			"param_name" => "yelp",
			"description" => __("Please enter in your Yelp URL.", AZ_THEME_NAME)
		),
		
		array( 
			"type" => "textfield",
			"heading" => __("You Tube Profile", AZ_THEME_NAME),
			"param_name" => "youtube",
			"description" => __("Please enter in your You Tube URL.", AZ_THEME_NAME)
		),
		
		array( 
			"type" => "textfield",
			"heading" => __("Xing Profile", AZ_THEME_NAME),
			"param_name" => "xing",
			"description" => __("Please enter in your Zerply URL.", AZ_THEME_NAME)
		),

		array( 
			"type" => "textfield",
			"heading" => __("Zerply Profile", AZ_THEME_NAME),
			"param_name" => "zerply",
			"description" => __("Please enter in your Zerply URL.", AZ_THEME_NAME)
		),
		
		array(
			"type" => "textfield",
			"heading" => __("Extra class name", AZ_THEME_NAME),
			"param_name" => "el_class",
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", AZ_THEME_NAME)
		)

    )
) );


/*-----------------------------------------------------------------------------------*/
/*	Social Share Buttons
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Social_Share_Button extends WPBakeryShortCode {}
vc_map( array(
	'name'		=> __('Social Share Button', AZ_THEME_NAME),
	'base'		=> 'az_social_share_button',
	'icon'      => 'icon-wpb-ui-empty_space',
	'category' 	=> __('Content', AZ_THEME_NAME),
	'description' => __( 'Display Social Share Buttons.', AZ_THEME_NAME),
    'params'	=> array(

    	array(
			'type' => 'checkbox',
			'heading' => __('Facebook?', AZ_THEME_NAME),
			'param_name' => 'facebook_btn',
			'value' => array(
		  		__('Enabled', AZ_THEME_NAME) => 'enabled'
		  	),
		  	'admin_label' => true
		),

		array(
			'type' => 'checkbox',
			'heading' => __('Twitter?', AZ_THEME_NAME),
			'param_name' => 'twitter_btn',
			'value' => array(
		  		__('Enabled', AZ_THEME_NAME) => 'enabled'
		  	),
		  	'admin_label' => true
		),

		array(
			'type' => 'checkbox',
			'heading' => __('Google Plus?', AZ_THEME_NAME),
			'param_name' => 'googleplus_btn',
			'value' => array(
		  		__('Enabled', AZ_THEME_NAME) => 'enabled'
		  	),
		  	'admin_label' => true
		),

		array(
			'type' => 'checkbox',
			'heading' => __('Pinterest?', AZ_THEME_NAME),
			'param_name' => 'pinterest_btn',
			'value' => array(
		  		__('Enabled', AZ_THEME_NAME) => 'enabled'
		  	),
		  	'admin_label' => true
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('Extra class name', AZ_THEME_NAME),
		  	'param_name' => 'el_class',
		  	'admin_label' => true,
		  	'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME)
		)

    )
) );


/*-----------------------------------------------------------------------------------*/
/*	Big Twitter Feed
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Big_Tweet_Feed extends WPBakeryShortCode {}
vc_map( array(
	'name'		=> __('Big Twitter Feed', AZ_THEME_NAME),
	'base'		=> 'az_big_tweet_feed',
	'icon'      => 'icon-wpb-ui-empty_space',
	'category' 	=> __('Content', AZ_THEME_NAME),
	'description' => __( 'Display tweet feeds.', AZ_THEME_NAME),
    'params'	=> array(

    	array(
			'type' => 'dropdown',
			'heading' => __('Big Twitter Feed Type', AZ_THEME_NAME),
			'param_name' => 'twitter_mode',
			'value' => array(
				__('One Tweet', AZ_THEME_NAME)   => 'one_tweet',
				__('More Tweets', AZ_THEME_NAME) => 'more_tweet',
			),
			'admin_label' => true,
			'description' => __('Select Your Favorite Twitter Style.', AZ_THEME_NAME),
		),

		array(
			'type' => 'textfield',
			'heading' => __('Twitter Username', AZ_THEME_NAME),
			'param_name' => 'twitter_username',
			'value'	=> 'Bluxart',
			'description' => __('Insert here your twitter username only.', AZ_THEME_NAME),
			'admin_label' => true
		),

		array(
			'type' => 'textfield',
			'heading' => __('Number Tweets', AZ_THEME_NAME),
			'param_name' => 'num_tweet',
			'value'	=> '1',
			'description' => __('Display total tweets.', AZ_THEME_NAME),
			'admin_label' => true,
			'dependency' => array(
				'element' => 'twitter_mode',
				'value' => array( 'more_tweet' )
			)
		),

        array(
		  	'type' => 'textfield',
		  	'heading' => __('Extra class name', AZ_THEME_NAME),
		  	'param_name' => 'el_class',
		  	'admin_label' => true,
		  	'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME)
		),

		/* Responsive Visibility */
		$responsive_lg,
		$responsive_md,
		$responsive_sm,
		$responsive_xs,

		/* Animations */
		$animated_choice,
		$animated_effects,
		$animated_delay

    )
) );


/*-----------------------------------------------------------------------------------*/
/*	Progress Bar
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Progress_Bar extends WPBakeryShortCode {}
vc_map( array(
	'name' => __( 'Progress Bar', AZ_THEME_NAME ),
	'base' => 'az_progress_bar',
	'icon' => 'icon-wpb-single-image',
	'category' => __( 'Content', AZ_THEME_NAME ),
	'description' => __( 'Progress Bar charts', AZ_THEME_NAME ),
	'params' => array(

		array(
			'type' => 'checkbox',
			'heading' => __('Animated Bar?', AZ_THEME_NAME),
			'param_name' => 'animated_bar',
			'value' => array(
		  		__('Yes, please', AZ_THEME_NAME) => 'yes'
		  	),
		  	'admin_label' => true,
		  	'description' => __('Choose if you want animate bar when appears.', AZ_THEME_NAME)
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Progress Bar Field', AZ_THEME_NAME ),
			'param_name' => 'field',
			'admin_label' => true,
			'description' => __( 'Enter the Progress Bar Field title here.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Progress in %', AZ_THEME_NAME ),
			'param_name' => 'percentage',
			'admin_label' => true,
			'description' => __( 'Enter a number between 0 and 100.', AZ_THEME_NAME )
		),

		// Bar
		array(
			'type' => 'dropdown',
			'heading' => __('Bar color', AZ_THEME_NAME),
			'param_name' => 'bgcolor',
			'value' => array(
				__('Default', AZ_THEME_NAME) => '',
				__('Custom', AZ_THEME_NAME)  => 'custom',
			),
			'admin_label' => false,
			'description' => __('Choose a color for your progress bar here.', AZ_THEME_NAME)
		),

		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Bar Color', AZ_THEME_NAME),
		  	'param_name' => 'custombarcolor',
		  	'description' => __('Choose a color for your progress bar.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'bgcolor',
		  		'value' => array( 'custom' )
		  	)
		),

		// Icons
		$icon_mode,
		$icon_dropdown,
		$azfont_icon_pack,
		$azfont_icon_social_pack,
		$linecons_icon_pack,
		$steady_icon_pack,
		$fontawesome_icon_pack,

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', AZ_THEME_NAME ),
			'param_name' => 'el_class',
			'admin_label' => true,
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME )
		),

		/* Responsive Visibility */
		$responsive_lg,
		$responsive_md,
		$responsive_sm,
		$responsive_xs,

		/* Animations */
		$animated_choice,
		$animated_effects,
		$animated_delay

	)
) );

/*-----------------------------------------------------------------------------------*/
/*	Circular Progress Bar
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Circular_Progress_Bar extends WPBakeryShortCode {}
vc_map(array(
	'name' => __( 'Circular Progress Bar', AZ_THEME_NAME ),
	'base' => 'az_circular_progress_bar',
	'icon' => 'icon-wpb-single-image',
	'category' => __( 'Content', AZ_THEME_NAME ),
	'description' => __( 'Circular Progress Bar charts', AZ_THEME_NAME ),
	'params' => array(

		array(
			'type' => 'dropdown',
			'heading' => __('Circular Progress Type', AZ_THEME_NAME),
			'param_name' => 'check_circular_type',
			'value' => array(
				__('With Icon', AZ_THEME_NAME) 			 => 'with_icon_mode',
				__('Custom Field', AZ_THEME_NAME)  		 => 'field_mode',
				__('Animated Percentage', AZ_THEME_NAME) => 'ani_percentage',
			),
			'admin_label' => false,
			'description' => __('Choose a color for your progress bar here.', AZ_THEME_NAME)
		),

		// Icons
		$icon_mode,
		$icon_dropdown,
		$azfont_icon_pack,
		$azfont_icon_social_pack,
		$linecons_icon_pack,
		$steady_icon_pack,
		$fontawesome_icon_pack,

		array(
			'type' => 'dropdown',
			'heading' => __('Icon Color', AZ_THEME_NAME),
			'param_name' => 'icon_color',
			'value' => array(
				__('Default', AZ_THEME_NAME)      => '',
				__('Custom Color', AZ_THEME_NAME) => 'custom',
			),
			'admin_label' => false,
			'description' => __('Choose a color for your icon.', AZ_THEME_NAME),
			'dependency' => array(
				'element' => 'icon_mode',
				'value' => 'yes-icon',
			)
		),

		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Icon Custom Color', AZ_THEME_NAME),
		  	'param_name' => 'custom_icon_color',
		  	'description' => __('Select custom color for icon.', AZ_THEME_NAME),
		  	'dependency' => array(
				'element' => 'icon_color',
				'value' => array( 'custom' )
			)
		),

		// Field
		array(
			'type' => 'textfield',
			'heading' => __( 'Circular Progress Bar Field', AZ_THEME_NAME ),
			'param_name' => 'circular_field',
			'admin_label' => true,
			'description' => __( 'Enter the Circular Progress Bar Field title here.', AZ_THEME_NAME ),
			'dependency' => array(
		  		'element' => 'check_circular_type',
		  		'value' => array( 'field_mode' )
		  	)
		),

		array(
			'type' => 'dropdown',
			'heading' => __('Field Color', AZ_THEME_NAME),
			'param_name' => 'field_color',
			'value' => array(
				__('Default', AZ_THEME_NAME) => '',
				__('Custom', AZ_THEME_NAME)  => 'custom',
			),
			'admin_label' => false,
			'description' => __('Choose a color for your field here.', AZ_THEME_NAME),
			'dependency' => array(
		  		'element' => 'check_circular_type',
		  		'value' => array( 'field_mode' )
		  	)
		),

		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Field Custom Color', AZ_THEME_NAME),
		  	'param_name' => 'custom_field_color',
		  	'description' => __('Choose a color for your field text.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'field_color',
		  		'value' => array( 'custom' )
		  	)
		),

		// Percentage
		array(
			'type' => 'textfield',
			'heading' => __( 'Circular Progress in %', AZ_THEME_NAME ),
			'param_name' => 'circular_percentage',
			'admin_label' => true,
			'description' => __( 'Enter a number between 0 and 100.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Circular Percentage Text', AZ_THEME_NAME ),
			'param_name' => 'circular_percentage_text',
			'value' => 'Text',
			'admin_label' => true,
			'description' => __( 'Enter a number between 0 and 100.', AZ_THEME_NAME ),
			'dependency' => array(
		  		'element' => 'check_circular_type',
		  		'value' => array( 'ani_percentage' )
		  	)
		),

		array(
			'type' => 'dropdown',
			'heading' => __('Percentage Text Color', AZ_THEME_NAME),
			'param_name' => 'percentage_color',
			'value' => array(
				__('Default', AZ_THEME_NAME) => '',
				__('Custom', AZ_THEME_NAME)  => 'custom',
			),
			'admin_label' => false,
			'description' => __('Choose a color for your percentage text here.', AZ_THEME_NAME),
			'dependency' => array(
		  		'element' => 'check_circular_type',
		  		'value' => array( 'ani_percentage' )
		  	)
		),

		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Percentage Animate Text Custom Color', AZ_THEME_NAME),
		  	'param_name' => 'custom_percentage_color',
		  	'description' => __('Choose a color for your animate percentage text.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'percentage_color',
		  		'value' => array( 'custom' )
		  	)
		),

		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Percentage Text Custom Color', AZ_THEME_NAME),
		  	'param_name' => 'custom_percentage_text_color',
		  	'value' => '#000000',
		  	'description' => __('Choose a color for your percentage text.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'percentage_color',
		  		'value' => array( 'custom' )
		  	)
		),

		// Circular Graph Settings
		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Circular Bar Color', AZ_THEME_NAME),
		  	'param_name' => 'circular_bgcolor',
		  	'value' => '#FFCF01',
		  	'description' => __('Choose a color for your circular bar.', AZ_THEME_NAME),
		),

		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Circular Track Color', AZ_THEME_NAME),
		  	'param_name' => 'circular_trackcolor',
		  	'value' => '#EBEDEF',
		  	'description' => __('Choose a color of the track for the bar.', AZ_THEME_NAME),
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Circular Progress Size', AZ_THEME_NAME ),
			'param_name' => 'circular_size',
			'admin_label' => true,
			'description' => __( 'Enter a number for the size of your circle progress in px. Default size is 170.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Line Width Circle Progress', AZ_THEME_NAME ),
			'param_name' => 'circular_line',
			'admin_label' => true,
			'description' => __( 'Enter a number for the width of the bar line in px. Default size is 6.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', AZ_THEME_NAME ),
			'param_name' => 'el_class',
			'admin_label' => true,
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME )
		),

		/* Responsive Visibility */
		$responsive_lg,
		$responsive_md,
		$responsive_sm,
		$responsive_xs,

		/* Animations */
		$animated_choice,
		$animated_effects,
		$animated_delay

	)
) );

/*-----------------------------------------------------------------------------------*/
/*	Count Number
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Count_Number extends WPBakeryShortCode {}
vc_map(array(
	'name' => __( 'Count Number', AZ_THEME_NAME ),
	'base' => 'az_count_number',
	'icon' => 'icon-wpb-single-image',
	'category' => __( 'Content', AZ_THEME_NAME ),
	'description' => __( 'Count Number Charts', AZ_THEME_NAME ),
	'params' => array(

		array(
			'type' => 'textfield',
			'heading' => __( 'Count Number Text Field', AZ_THEME_NAME ),
			'param_name' => 'number_field',
			'admin_label' => true,
			'description' => __( 'Enter a number.', AZ_THEME_NAME )
		),

		array(
			'type' => 'dropdown',
			'heading' => __('Field Text Color', AZ_THEME_NAME),
			'param_name' => 'field_color',
			'value' => array(
				__('Default', AZ_THEME_NAME) => '',
				__('Custom', AZ_THEME_NAME)  => 'custom',
			),
			'admin_label' => false,
			'description' => __('Choose a color for your field text.', AZ_THEME_NAME)
		),

		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Field Text Custom Color', AZ_THEME_NAME),
		  	'param_name' => 'custom_field_color',
		  	'description' => __('Choose a color for your field text.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'field_color',
		  		'value' => array( 'custom' )
		  	)
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Count Number From', AZ_THEME_NAME ),
			'param_name' => 'number_value_from',
			'value' => '0',
			'admin_label' => true,
			'description' => __( 'The number to start counting from. Default value is 0.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Count Number To', AZ_THEME_NAME ),
			'param_name' => 'number_value_to',
			'value' => '100',
			'admin_label' => true,
			'description' => __( 'The number to stop counting at. Default value is 100.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Count Number Speed', AZ_THEME_NAME ),
			'param_name' => 'number_speed',
			'value' => '1000',
			'admin_label' => true,
			'description' => __( 'The number of milliseconds it should take to finish counting. Default value is 1000.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Count Number Delay', AZ_THEME_NAME ),
			'param_name' => 'number_delay',
			'value' => '0',
			'admin_label' => true,
			'description' => __( 'The number of milliseconds it should take to delay for start counting. Default value is 0.', AZ_THEME_NAME )
		),

		array(
			'type' => 'dropdown',
			'heading' => __('Counter Number Color', AZ_THEME_NAME),
			'param_name' => 'number_color',
			'value' => array(
				__('Default', AZ_THEME_NAME) => '',
				__('Custom', AZ_THEME_NAME)  => 'custom',
			),
			'admin_label' => false,
			'description' => __('Choose a color for your counter number.', AZ_THEME_NAME)
		),

		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Counter Number Custom Color', AZ_THEME_NAME),
		  	'param_name' => 'custom_number_color',
		  	'description' => __('Choose a color for your counter number.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'number_color',
		  		'value' => array( 'custom' )
		  	)
		),

		// Icons
		$icon_mode,
		$icon_dropdown,
		$azfont_icon_pack,
		$azfont_icon_social_pack,
		$linecons_icon_pack,
		$steady_icon_pack,
		$fontawesome_icon_pack,

		array(
			'type' => 'dropdown',
			'heading' => __('Icon Color', AZ_THEME_NAME),
			'param_name' => 'icon_color',
			'value' => array(
				__('Default', AZ_THEME_NAME)      => '',
				__('Custom Color', AZ_THEME_NAME) => 'custom',
			),
			'admin_label' => false,
			'description' => __('Choose a color for your icon.', AZ_THEME_NAME),
			'dependency' => array(
				'element' => 'icon_mode',
				'value' => 'yes-icon',
			)
		),

		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Icon Custom Color', AZ_THEME_NAME),
		  	'param_name' => 'custom_icon_color',
		  	'description' => __('Select custom color for icon.', AZ_THEME_NAME),
		  	'dependency' => array(
				'element' => 'icon_color',
				'value' => array( 'custom' )
			)
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', AZ_THEME_NAME ),
			'param_name' => 'el_class',
			'admin_label' => true,
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME )
		),

		/* Responsive Visibility */
		$responsive_lg,
		$responsive_md,
		$responsive_sm,
		$responsive_xs,

		/* Animations */
		$animated_choice,
		$animated_effects,
		$animated_delay

	)
) );

/*-----------------------------------------------------------------------------------*/
/*	Icons
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Icon extends WPBakeryShortCode {}
vc_map( array(
	'name' => __( 'Icon', AZ_THEME_NAME ),
	'base' => 'az_icon',
	'icon' => 'icon-wpb-single-image',
	'category' => __( 'Content', AZ_THEME_NAME ),
	'description' => __( 'List of Icons', AZ_THEME_NAME ),
	'params' => array(

		// Icons
		$icon_mode,
		$icon_size,
		$icon_align,

		array(
			'type' => 'checkbox',
			'heading' => __('Wrap Icon in a link?', AZ_THEME_NAME),
			'param_name' => 'icon_wrap_link',
			'value' => array(
		  		__('Yes, please', AZ_THEME_NAME) => 'yes'
		  	),
		  	'admin_label' => true
		),

		array(
			'type' => 'textfield',
			'heading' => __('Link URL', AZ_THEME_NAME),
			'param_name' => 'icon_wrap_link_url',
			'description' => __('Where should your box icon link to?', AZ_THEME_NAME),
			'admin_label' => false,
			'dependency' => array(
				'element' => 'icon_wrap_link',
				'value' => array( 'yes' )
			)
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Link Target', AZ_THEME_NAME ),
			'param_name' => 'target',
			'value' => $target_arr,
			'admin_label' => false,
			'dependency' => array(
				'element' => 'icon_wrap_link',
				'value' => array( 'yes' )
			)
		),

		array(
			'type' => 'dropdown',
			'heading' => __('Icon Color', AZ_THEME_NAME),
			'param_name' => 'icon_color',
			'value' => array(
				__('Default', AZ_THEME_NAME)      => '',
				__('Custom Color', AZ_THEME_NAME) => 'custom',
			),
			'admin_label' => false,
			'description' => __('Choose a color for your icon.', AZ_THEME_NAME),
		),

		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Icon Custom Color', AZ_THEME_NAME),
		  	'param_name' => 'custom_icon_color',
		  	'description' => __('Select custom color for icon.', AZ_THEME_NAME),
		  	'dependency' => array(
				'element' => 'icon_color',
				'value' => array( 'custom' )
			)
		),

		$icon_dropdown,
		$azfont_icon_pack,
		$azfont_icon_social_pack,
		$linecons_icon_pack,
		$steady_icon_pack,
		$fontawesome_icon_pack,

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', AZ_THEME_NAME ),
			'param_name' => 'el_class',
			'admin_label' => true,
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME )
		),

		/* Responsive Visibility */
		$responsive_lg,
		$responsive_md,
		$responsive_sm,
		$responsive_xs,

		/* Animations */
		$animated_choice,
		$animated_effects,
		$animated_delay

	)
) );

/*-----------------------------------------------------------------------------------*/
/*	Pricing Table
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Pricing_Table extends WPBakeryShortCode {}
vc_map( array(
	'name' => __( 'Pricing Table', AZ_THEME_NAME ),
	'base' => 'az_pricing_table',
	'icon' => 'icon-wpb-single-image',
	'category' => __( 'Content', AZ_THEME_NAME ),
	'description' => __( 'Pricing Table', AZ_THEME_NAME ),
	'params' => array(

		array(
			'type' => 'textfield',
			'heading' => __( 'Title', AZ_THEME_NAME ),
			'param_name' => 'title',
			'admin_label' => true
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Price', AZ_THEME_NAME ),
			'param_name' => 'price',
			'admin_label' => true
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Currency Symbol', AZ_THEME_NAME ),
			'param_name' => 'currency',
			'admin_label' => true
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Interval Time', AZ_THEME_NAME ),
			'param_name' => 'interval',
			'admin_label' => false
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Link URL', AZ_THEME_NAME ),
			'param_name' => 'link_url',
			'value' => '#',
			'admin_label' => false
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Link Text', AZ_THEME_NAME ),
			'param_name' => 'link_text',
			'value' => 'Link Text',
			'admin_label' => false
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Link Target', AZ_THEME_NAME ),
			'param_name' => 'target',
			'value' => $target_arr,
			'admin_label' => false
		),

		array(
			'type' => 'checkbox',
			'heading' => __('Highlight Pricing Table?', AZ_THEME_NAME),
			'param_name' => 'highlight',
			'value' => array(
		  		__('Yes, please', AZ_THEME_NAME) => 'yes'
		  	),
		  	'admin_label' => false
		),

		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => __('Lists', AZ_THEME_NAME),
			'param_name' => 'content',
			'value' => __('<ul><li>5 Project</li><li>5GB Storage</li><li>12 Users</li><li>Tasks</li><li>CRM</li><li>Your Domain</li></ul>', AZ_THEME_NAME),
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', AZ_THEME_NAME ),
			'param_name' => 'el_class',
			'admin_label' => true,
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME )
		),

		/* Responsive Visibility */
		$responsive_lg,
		$responsive_md,
		$responsive_sm,
		$responsive_xs,

		/* Animations */
		$animated_choice,
		$animated_effects,
		$animated_delay

	)
) );


?>