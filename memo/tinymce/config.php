<?php

// Buttons shortcode config
$tz_shortcodes['button'] = array(
	'params' => array(
		'url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Button URL', 'textdomain'),
			'desc' => __('Add the button\'s url eg http://example.com', 'textdomain')
		),
		'style' => array(
			'type' => 'select',
			'label' => __('Button\'s Style', 'textdomain'),
			'desc' => __('Select the button\'s style, ie the buttons colour', 'textdomain'),
			'options' => array(
				'white' => 'White',
				'black' => 'Black',
				'green' => 'Green',
				'blue' => 'Blue',
				'teal' => 'Teal',
				'purple' => 'Purple',
				'red' => 'Red',
				'orange' => 'Orange',
				'navy' => 'Navy',
				'grey' => 'Grey'
			)
		),
		'size' => array(
			'type' => 'select',
			'label' => __('Button\'s Size', 'textdomain'),
			'desc' => __('Select the button\'s size', 'textdomain'),
			'options' => array(
				'small' => 'Small',
				'large' => 'Large'
			)
		),
		'content' => array(
			'std' => 'Button Text',
			'type' => 'text',
			'label' => __('Button\'s Text', 'textdomain'),
			'desc' => __('Add the button\'s text', 'textdomain'),
		)
	),
	'shortcode' => '[button url="{{url}}" style="{{style}}" size="{{size}}"] {{content}} [/button]',
	'popup_title' => __('Insert Button Shortcode', 'textdomain')
);

// Alerts shortcode config
$tz_shortcodes['alert'] = array(
	'params' => array(
		'style' => array(
			'type' => 'select',
			'label' => __('Alert\'s Style', 'textdomain'),
			'desc' => __('Select the slter\'s style, ie the alert colour', 'textdomain'),
			'options' => array(
				'white' => 'White',
				'red' => 'Red',
				'orange' => 'Orange',
				'green' => 'Green'
			)
		),
		'content' => array(
			'std' => 'Your Alert!',
			'type' => 'textarea',
			'label' => __('Alert\'s Text', 'textdomain'),
			'desc' => __('Add the alert\'s text', 'textdomain'),
		)
		
	),
	'shortcode' => '[alert style="{{style}}"] {{content}} [/alert]',
	'popup_title' => __('Insert Alert Shortcode', 'textdomain')
);

// Toggle content shortcode config
$tz_shortcodes['toggle'] = array(
	'params' => array(
		'title' => array(
			'type' => 'text',
			'label' => __('Toggle Content Title', 'textdomain'),
			'desc' => __('Add the title that will go above the toggle content', 'textdomain'),
			'std' => 'Title'
		),
		'content' => array(
			'std' => 'Content',
			'type' => 'textarea',
			'label' => __('Toggle Content', 'textdomain'),
			'desc' => __('Add the toggle content.', 'textdomain'),
		)
		
	),
	'shortcode' => '[toggle title="{{title}}"] {{content}} [/toggle]',
	'popup_title' => __('Insert Toggle Content Shortcode', 'textdomain')
);

// tabs
$tz_shortcodes['tabs'] = array(
    'params' => array(
        'tabs' => array(
        	'std' => 'Title',
            'type' => 'text',
            'label' => __('Tab Titles', 'textdomain'),
            'desc' => __('Please enter the tab titles here, seperating each by a comma. They must match the tabs that are created below.', 'textdomain')
        )
    ),
    'no_preview' => true,
    'shortcode' => '[tabs tabs="{{tabs}}"] {{child_shortcode}}  [/tabs]',
    'popup_title' => __('Insert Tab Shortcode', 'textdomain'),
    
    'child_shortcode' => array(
        'params' => array(
            'title' => array(
                'std' => 'Title',
                'type' => 'text',
                'label' => __('Tab Title', 'textdomain'),
                'desc' => __('Title of the tab', 'textdomain'),
            ),
            'content' => array(
                'std' => 'Tab Content',
                'type' => 'textarea',
                'label' => __('Tab Content', 'textdomain'),
                'desc' => __('Add the tabs content', 'textdomain')
            )
        ),
        'shortcode' => '[tab title="{{title}}"] {{content}} [/tab]',
        'clone_button' => __('Add Tab', 'textdomain')
    )
);

// columns
$tz_shortcodes['columns'] = array(
	'params' => array(),
	'shortcode' => ' {{child_shortcode}} ', // as there is no wrapper shortcode
	'popup_title' => __('Insert Columns Shortcode', 'textdomain'),
	'no_preview' => true,
	
	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'column' => array(
				'type' => 'select',
				'label' => __('Column Type', 'textdomain'),
				'desc' => __('Select the type, ie width of the column.', 'textdomain'),
				'options' => array(
					'one_third' => 'One Third',
					'one_third_last' => 'One Third Last',
					'two_third' => 'Two Thirds',
					'two_third_last' => 'Two Thirds Last',
					'one_half' => 'One Half',
					'one_half_last' => 'One Half Last',
					'one_fourth' => 'One Fourth',
					'one_fourth_last' => 'One Fourth Last',
					'three_fourth' => 'Three Fourth',
					'three_fourth_last' => 'Three Fourth Last',
					'one_fifth' => 'One Fifth',
					'one_fifth_last' => 'One Fifth Last',
					'two_fifth' => 'Two Fifth',
					'two_fifth_last' => 'Two Fifth Last',
					'three_fifth' => 'Three Fifth',
					'three_fifth_last' => 'Three Fifth Last',
					'four_fifth' => 'Four Fifth',
					'four_fifth_last' => 'Four Fifth Last',
					'one_sixth' => 'One Sixth',
					'one_sixth_last' => 'One Sixth Last',
					'five_sixth' => 'Five Sixth',
					'five_sixth_last' => 'Five Sixth Last'
				)
			),
			'content' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => __('Column Content', 'textdomain'),
				'desc' => __('Add the column content.', 'textdomain'),
			)
		),
		'shortcode' => '[{{column}}] {{content}} [/{{column}}] ',
		'clone_button' => __('Add Column', 'textdomain')
	)
);

?>