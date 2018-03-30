<?php

/*-----------------------------------------------------------------------------------*/
/*	Button Shortcode
/*-----------------------------------------------------------------------------------*/

$mpc_shortcodes['button'] = array(
	'preview' => 'true',
	'shortcode' => '[button class="{{class}}" background="{{background}}" url="{{url}}" text_color="{{text_color}}" background_hover="{{background_hover}}" text_color_hover="{{text_color_hover}}"] {{content}} [/button]',
	'title' => __('Insert Button Shortcode', 'agera'),
	'fields' => array(
		'content' => array(
			'std' => 'Button Text',
			'type' => 'text',
			'title' => __('Text', 'agera'),
			'desc' => __('Specify text which will be displayed isnide the button.', 'agera')
		),
		'class' => array(
			'std' => 'mpc-button-1',
			'type' => 'text',
			'title' => __('Unique Name', 'agera'),
			'desc' => __('Specify button unique name, no spaces and special characters you can use _ and -', 'agera')
		),
		'url' => array(
			'std' => '#',
			'type' => 'text',
			'title' => __('Button URL', 'agera'),
			'desc' => __('Button URL.', 'agera')
		),
		'background' => array(
			'std' => '#F9625B',
			'type' => 'text',
			'title' => __('Background Color', 'agera'),
			'desc' => __('Button background color.', 'agera')
		),
		'text_color' => array(
			'std' => '#FFFFFF',
			'type' => 'text',
			'title' => __('Text Color', 'agera'),
			'desc' => __('Specify text color.', 'agera')
		),
		'background_hover' => array(
			'std' => '#F9625B',
			'type' => 'text',
			'title' => __('Background Hover Color', 'agera'),
			'desc' => __('Button background color after hover.', 'agera')
		),
		'text_color_hover' => array(
			'std' => '#242424',
			'type' => 'text',
			'title' => __('Text Hover Color', 'agera'),
			'desc' => __('Button text color after hover.', 'agera')
		)
	)
);

/*--------------------------- END Button -------------------------------- */

/*-----------------------------------------------------------------------------------*/
/*	YouTube Shortcode
/*-----------------------------------------------------------------------------------*/

$mpc_shortcodes['youtube'] = array(
	'preview' => 'partial',
	'shortcode' => '[youtube video="{{video}}" width="{{width}}" height="{{height}}"]',
	'title' => __('Insert YouTube Shortcode', 'agera'),
	'fields' => array(
		'video' => array(
			'std' => '',
			'type' => 'text',
			'title' => __('Video ID', 'agera'),
			'desc' => __('Paste YouTube video id, example: 090WQvJAOec', 'agera')
		),
		'width' => array(
			'std' => '375',
			'type' => 'text',
			'title' => __('Video Width', 'agera'),
			'desc' => __('Video width in pixels.', 'agera')
		),
		'height' => array(
			'std' => '225',
			'type' => 'text',
			'title' => __('Video Height', 'agera'),
			'desc' => __('Video height in pixels.', 'agera')
		)
	)
);

/*--------------------------- END YouTube -------------------------------- */

/*-----------------------------------------------------------------------------------*/
/*	Vimeo Shortcode
/*-----------------------------------------------------------------------------------*/

$mpc_shortcodes['vimeo'] = array(
	'preview' => 'partial',
	'shortcode' => '[vimeo id="{{id}}" width="{{width}}" height="{{height}}"]',
	'title' => __('Insert Vimeo Shortcode', 'agera'),
	'fields' => array(
		'id' => array(
			'std' => '',
			'type' => 'text',
			'title' => __('Video ID', 'agera'),
			'desc' => __('Paste Vimeo video id, example: 22945553', 'agera')
		),
		'width' => array(
			'std' => '375',
			'type' => 'text',
			'title' => __('Video Width', 'agera'),
			'desc' => __('Video width in pixels.', 'agera')
		),
		'height' => array(
			'std' => '225',
			'type' => 'text',
			'title' => __('Video Height', 'agera'),
			'desc' => __('Video height in pixels.', 'agera')
		)
	)
);

/*--------------------------- END Vimeo -------------------------------- */

/*-----------------------------------------------------------------------------------*/
/*	Toggle Shortcode
/*-----------------------------------------------------------------------------------*/

$mpc_shortcodes['toggle'] = array(
	'preview' => 'true',
	'shortcode' => '[toggle title="{{title}}"] {{content}} [/toggle]',
	'title' => __('Insert Toggle Shortcode', 'agera'),
	'fields' => array(
		'title' => array(
			'type' => 'text',
			'std' 	=> 'Toggle Title',
			'title' => __('Toggle\'s Title', 'agera'),
			'desc' => __('Input toggle\'s title.', 'agera'),
		),
		'content' => array(
			'std' => 'Here paste the paragraph that you wish to toggle.',
			'type' => 'textarea',
			'title' => __('Toggle\'s Text', 'agera'),
			'desc' => __('Add toggle\'s text.', 'agera'),
		)
	)
);

/*--------------------------- END Toggle -------------------------------- */


/*-----------------------------------------------------------------------------------*/
/*	Tabs Shortcode
/*-----------------------------------------------------------------------------------*/

$mpc_shortcodes['tabs'] = array(
	'preview' => 'partial',
	'shortcode' => '[tabs] {{inside}}[/tabs]',
	'title' => __('Insert Tabbed Content Shortcode', 'agera'),
	'fields' => array(),
	'inside' => array(
		'shortcode' => '[tab title="{{title}}"] {{content}} [/tab] ',
		'add_section' => __('Add Tab', 'agera'),
		'remove_section' => __('Remove Tab', 'agera'),
		'fields' => array(
			'title' => array(
				'type' => 'text',
				'title' => __('Tab Title', 'agera'),
				'desc' => __('Add the title for this tab', 'agera'),
				'std' => 'Tab Title'
			),
			'content' => array(
				'std' => 'Example tab content.',
				'type' => 'textarea',
				'title' => __('Tab Content', 'agera'),
				'desc' => __('Add the tab content.', 'agera'),
			)
		)
	)
);

/*--------------------------- END Tabs -------------------------------- */


/*-----------------------------------------------------------------------------------*/
/*	Columns
/*-----------------------------------------------------------------------------------*/
$mpc_shortcodes['columns'] = array(
	'preview' => 'false',
	'shortcode' => ' {{inside}} ',
	'title' => __('Insert Columns Shortcode', 'agera'),
	'fields' => array(),
	'inside' => array( // when shortcode has two tags you need to define the second one in the inside array
		'shortcode' => '[{{column}}] {{content}} [/{{column}}] ',
		'add_section' => __('Add Column', 'agera'),
		'remove_section' => __('Remove Column', 'agera'),
		'fields' => array(
			'column' => array(
				'type' => 'select',
				'title' => __('Column Type', 'agera'),
				'desc' => __('Select the type, ie width of the column.', 'agera'),
				'options' => array(
					'column1_2' => 'One Half',
					'column1_2_last' => 'One Half Last',
					'column1_3' => 'One Third',
					'column1_3_last' => 'One Third Last',
					'column2_3' => 'Two Thirds',
					'column2_3_last' => 'Two Thirds Last',
					'column1_4' => 'One Fourth',
					'column1_4_last' => 'One Fourth Last',
					'column3_4' => 'Three Fourth',
					'column3_4_last' => 'Three Fourth Last',
					'column1_5' => 'One Fifth',
					'column1_5_last' => 'One Fifth Last',
					'column2_5' => 'Two Fifth',
					'column2_5_last' => 'Two Fifth Last',
					'column3_5' => 'Three Fifth',
					'column3_5_last' => 'Three Fifth Last',
					'column4_5' => 'Four Fifth',
					'column4_5_last' => 'Four Fifth Last',
					'column1_6' => 'One Sixth',
					'column1_6_last' => 'One Sixth Last',
					'column5_6' => 'Five Sixth',
					'column5_6_last' => 'Five Sixth Last'
				)
			),
			'content' => array(
				'std' => '',
				'type' => 'textarea',
				'title' => __('Column Content', 'agera'),
				'desc' => __('Add the column content.', 'agera'),
			)
		)
	)
);
/*--------------------------- END Columns -------------------------------- */

/*-----------------------------------------------------------------------------------*/
/*	Lists
/*-----------------------------------------------------------------------------------*/

$mpc_shortcodes['lists'] = array(
	'preview' => 'true',
	'shortcode' => '[list type="{{type}}"] {{inside}} [/list]',
	'title' => __('Insert Columns Shortcode', 'agera'),
	'fields' => array(
		'type' => array(
			'type' => 'select',
			'title' => __('List Type', 'agera', 'agera'),
			'desc' => __('Specify the list type', 'agera'),
			'options' => array(
					'ordered' => 'Ordered',
					'arrow' => 'Arrow',
					'check' => 'Check',
					'dot' => 'Dot',
					'minus' => 'Minus',
					'plus' => 'Plus'
				)
			)
		),
	'inside' => array(
		'shortcode' => '[litem] {{item}} [/litem]',
		'add_section' => __('Add New List Item', 'agera'),
		'remove_section' => __('Remove List Item', 'agera'),
		'fields' => array(
			'item' => array(
				'type' => 'textarea',
				'title' => __('List Item Content', 'agera'),
				'std' => __('List Item', 'agera'),
				'desc' => __('Specify the list item content.', 'agera'),
			)
		)
	)
);

/*--------------------------- END Lists -------------------------------- */

/*-----------------------------------------------------------------------------------*/
/*	Contact Form
/*-----------------------------------------------------------------------------------*/

$mpc_shortcodes['contact_form'] = array(
	'preview' => 'false',
	'shortcode' => '[contact_form/]',
	'title' => __('Insert Contact Form', 'agera'),
);

/*--------------------------- END Contact Form -------------------------------- */


/*-----------------------------------------------------------------------------------*/
/*	Google Map
/*-----------------------------------------------------------------------------------*/

$mpc_shortcodes['google_maps'] = array(
	'preview' => 'false',
	'shortcode' => '[mpc_google_map src="{{src}}" width="{{width}}" height="{{height}}"]',
	'title' => __('Insert Contact Form Shortcode', 'agera'),
	'fields' => array(
		'src' => array(
			'std' => '',
			'type' => 'text',
			'title' => __('Map Source', 'agera'),
			'desc' => __('Paste the link for a the google maps.', 'agera')
		),
		'width' => array(
			'std' => '',
			'type' => 'text',
			'title' => __('Map Width', 'agera'),
			'desc' => __('Define the width of a google map.', 'agera')
		),
		'height' => array(
			'std' => '',
			'type' => 'text',
			'title' => __('Map Height', 'agera'),
			'desc' => __('Define the height of a google map.', 'agera')
		)
	)
);

/*--------------------------- END Google Map -------------------------------- */

/*-----------------------------------------------------------------------------------*/
/*	FlexSlider
/*-----------------------------------------------------------------------------------*/

$mpc_shortcodes['flexslider'] = array(
	'preview' => 'false',
	'shortcode' => '[flexslider width="{{width}}" height="{{height}}" effect="{{effect}}" slideshowspeed="{{slideshowspeed}}"] {{inside}} [/flexslider]',
	'title' => __('Insert Flex Slider Shortcode', 'agera'),
	'fields' => array(
		'width' => array(
			'std' => '',
			'type' => 'text',
			'title' => __('Slider Width', 'agera'),
			'desc' => __('Specify width of the slider.', 'agera')
			),

		'height' => array(
			'std' => '',
			'type' => 'text',
			'title' => __('Slider Height', 'agera'),
			'desc' => __('Specify height of the slider.', 'agera')
			),
		'effect' => array(
			'type' => 'select',
			'title' => __('Slider Effect', 'agera'),
			'desc' => __('Specify the transition effect type', 'agera'),
			'options' => array(
					'fade' => 'Fade',
					'slide' => 'Slide'
				)
			),
		'slideshowspeed' => array(
			'std' => '3000',
			'type' => 'text',
			'title' => __('Slide Show Speed', 'agera'),
			'desc' => __('Specify slide show speed in milliseconds.', 'agera')
			),
		),
	'inside' => array( // when shortcode has two tags you need to define the second one in the inside array
		'shortcode' => '[flex_image url="{{url}}"]',
		'add_section' => __('Add New Image', 'agera'),
		'remove_section' => __('Remove Image', 'agera'),
		'fields' => array(
			'url' => array(
				'type' => 'text',
				'title' => __('Image URL', 'agera'),
				'desc' => __('Select the image that will be displayed in the slider.', 'agera'),
				'std' => ''
			)
		)
	)
);

/*--------------------------- End FlexSlider -------------------------------- */

?>