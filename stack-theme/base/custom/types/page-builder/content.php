<?php

// Stack Builder

// Map
$marker_full_list_template[] = array(
	'id' => 'marker_info_stack',
	'type' => 'stack_template',
	'title' => __('Marker', 'theme_admin'),
	'description' => __('', 'theme_admin'),
	'options' => array(
		array(
			'type' 			=> 'text',
			'id'			=> 'stack_title',
			'title' 		=> __('Title', 'theme_admin'),
			'description' 	=> '',
		),
		array(
			'type' 			=> 'textarea',
			'id'			=> 'content',
			'row'			=> 5,
			'title' 		=> __('Content', 'theme_admin'),
			'description' 	=> 'this value will show on info box when the marker is clicked',
		),
		array(
			'type' 			=> 'text',
			'id'			=> 'lat',
			'title' 		=> __('Latitude', 'theme_admin'),
			'description' 	=> 'get it <a href="http://www.latlng.org/" target="_blank">here</a>',
		),
		array(
			'type' 			=> 'text',
			'id'			=> 'lng',
			'title' 		=> __('Longitude', 'theme_admin'),
			'description' 	=> 'get it <a href="http://itouchmap.com/latlong.html" target="_blank">here</a>',
		),
	)
);
$stack_template[] = array(
	'id' => 'map',
	'type' => 'stack_template',
	'title' => __('Map & Locations', 'theme_admin'),
	'description' => __('', 'theme_admin'),
	'options' => array(
		array(
			'type' 			=> 'text',
			'id'			=> 'lat',
			'title' 		=> __('Latitude', 'theme_admin'),
			'description' 	=> 'get it <a href="http://www.latlng.org/" target="_blank">here</a>',
		),
		array(
			'type' 			=> 'text',
			'id'			=> 'lng',
			'title' 		=> __('Longitude', 'theme_admin'),
			'description' 	=> 'get it <a href="http://itouchmap.com/latlong.html" target="_blank">here</a>',
		),
		array(
			'type' 			=> 'range',
			'id'			=> 'map_height',
			'title' 		=> __('Height', 'theme_admin'),
			'description' 	=> __('the height of map box', 'theme_admin'),
			'default' 		=> '600',
			'min' 			=> '300',
			'max' 			=> '1000',
			'step' 			=> '50',
			'unit'			=> 'px',
		),
		array(
			'type' 			=> 'range',
			'id'			=> 'map_zoom',
			'title' 		=> __('Zoom Level', 'theme_admin'),
			'description' 	=> __('', 'theme_admin'),
			'default' 		=> '5',
			'min' 			=> '0',
			'max' 			=> '15',
			'step' 			=> '1',
			'unit'			=> '',
		),
		array(
			'type' 			=> 'stack',
			'id'			=> 'marker_full_info_list',
			'title' 		=> __('Marker List', 'theme_admin'),
			'description' 	=> '',
			'templates'		=> $marker_full_list_template,
			'stack_button'	=> __('Add', 'theme_admin')
		),
	)
);

// Callout
$stack_template[] = array(
	'id' => 'callout',
	'type' => 'stack_template',
	'title' => __('Callout', 'theme_admin'),
	'description' => __('', 'theme_admin'),
	'options' => array(
		array(
			'type' 			=> 'textarea',
			'id'			=> 'stack_title',
			'title' 		=> __('Callout Text', 'theme_admin'),
			'description' 	=> 'use <code>'.htmlspecialchars('<em>...</em>').'</code> to emphasize',
		),
		array(
			'type' 			=> 'radio',
			'id'			=> 'style',
			'title' 		=> __('Style', 'theme_admin'),
			'description' 	=> '',
			'default' 		=> 'light',
			'options' 		=> array(
				'light' 	=> __('Light', 'theme_admin'),
				'dark' 		=> __('Dark', 'theme_admin'),
			),
		),
		array(
			'type' 			=> 'radio',
			'id'			=> 'element',
			'toggle'		=> 'toggle-callout-element',
			'title' 		=> __('Element', 'theme_admin'),
			'description' 	=> '',
			'default' 		=> '',
			'options' 		=> array(
				'' 			=> __('None', 'theme_admin'),
				'button' 	=> __('Button', 'theme_admin'),
				'icon' 		=> __('Icon', 'theme_admin'),
			),
		),
		array(
			'type' 			=> 'text',
			'toggle_group'	=> 'toggle-callout-element toggle-callout-element-button',
			'id'			=> 'button_text',
			'title' 		=> __('Button Text', 'theme_admin'),
			'description' 	=> __('example: Purchase Now', 'theme_admin'),
		),
		array(
			'type' 			=> 'text',
			'toggle_group'	=> 'toggle-callout-element toggle-callout-element-button',
			'id'			=> 'button_sub_text',
			'title' 		=> __('Button Sub Text', 'theme_admin'),
			'description' 	=> __('small text for detail', 'theme_admin'),
		),
		array(
			'type' 			=> 'select',
			'toggle_group'	=> 'toggle-callout-element toggle-callout-element-button',
			'id'			=> 'button_icon',
			'title' 		=> __('Button Icon', 'theme_admin'),
			'description' 	=> 'see example at : <a href="http://fortawesome.github.com/Font-Awesome/">Font Awesome</a>',
			'default'		=> '',
			'source'		=> array(
				'font-awesome'	=> ''
			)
		),
		array(
			'type' 			=> 'text',
			'toggle_group'	=> 'toggle-callout-element toggle-callout-element-button',
			'id'			=> 'button_link',
			'title' 		=> __('Button Link', 'theme_admin'),
			'description' 	=> 'example: http://wegrass.com',
		),
		array(
			'type' 			=> 'radio',
			'toggle_group'	=> 'toggle-callout-element toggle-callout-element-button',
			'id'			=> 'link_target',
			'title' 		=> __('Open Link in same Window', 'theme_admin'),
			'description' 	=> __('choose "No" to open link in new Window', 'theme_admin'),
			'default' 		=> '_self',
			'options' 		=> array(
				'_self' 	=> __('Yes', 'theme_admin'),
				'_blank' 	=> __('No', 'theme_admin'),
			),
		),
		array(
			'type' 			=> 'select',
			'toggle_group'	=> 'toggle-callout-element toggle-callout-element-icon',
			'id'			=> 'icon',
			'title' 		=> __('Icon', 'theme_admin'),
			'description' 	=> 'see example at : <a href="http://fortawesome.github.com/Font-Awesome/">Font Awesome</a>',
			'default'		=> '',
			'source'		=> array(
				'font-awesome'	=> ''
			)
		),
	)
);

// Image - Text
$stack_template[] = array(
	'id' => 'image_text',
	'type' => 'stack_template',
	'title' => __('Image with Text', 'theme_admin'),
	'description' => __('', 'theme_admin'),
	'options' => array(
		array(
			'type' 			=> 'text',
			'id'			=> 'stack_title',
			'title' 		=> __('Title', 'theme_admin'),
			'description' 	=> '',
		),
		array(
			'type' 			=> 'radio',
			'id'			=> 'type',
			'title' 		=> __('Type', 'theme_admin'),
			'description' 	=> '',
			'default' 		=> '',
			'options' 		=> array(
				'' 	=> __('Imaeg on the Left', 'theme_admin'),
				'image-right' 	=> __('Image on the Right', 'theme_admin'),
			)
		),
		array(
			'type' 			=> 'radio',
			'id'			=> 'img_width',
			'title' 		=> __('Image Width', 'theme_admin'),
			'description' 	=> '',
			'default' 		=> 'one_third',
			'options' 		=> array(
				'one_third' 	=> __('One Third (width 300px)', 'theme_admin'),
				'one_half' 	=> __('One Half (width )', 'theme_admin'),
			)
		),
		array(
			'type' 			=> 'image',
			'id' 			=> 'image',
			'title' 		=> __('Image', 'theme_admin'),
			'description' 	=> __('use 2x image as recommended to support retina display', 'theme_admin'),
		),
		array(
			'type' 			=> 'textarea',
			'row'			=> '4',
			'id' 			=> 'content_text',
			'title' 		=> __('Content', 'theme_admin'),
			'description' 	=> __('', 'theme_admin'),
		),
		array(
			'type' 			=> 'text',
			'id' 			=> 'button_text',
			'title' 		=> __('Button Text', 'theme_admin'),
			'description' 	=> __('example: Read More &rarr;', 'theme_admin'),
		),
		array(
			'type' 			=> 'text',
			'id' 			=> 'button_link',
			'title' 		=> __('Button Link', 'theme_admin'),
			'description' 	=> __('example: http://wegrass.com', 'theme_admin'),
		),
		array(
			'type' 			=> 'radio',
			'id'			=> 'link_target',
			'title' 		=> __('Open Link in same Window', 'theme_admin'),
			'description' 	=> __('choose "No" to open link in new Window', 'theme_admin'),
			'default' 		=> '_self',
			'options' 		=> array(
				'_self' 	=> __('Yes', 'theme_admin'),
				'_blank' 	=> __('No', 'theme_admin'),
			),
		),
	)
);

// Subscribe
$stack_template[] = array(
	'id' => 'subscribe',
	'type' => 'stack_template',
	'title' => __('Subscribe', 'theme_admin'),
	'description' => __('', 'theme_admin'),
	'options' => array(
		array(
			'type' 			=> 'text',
			'id'			=> 'stack_title',
			'title' 		=> __('Callout Text', 'theme_admin'),
			'description' 	=> '',
		),
		array(
			'type' 			=> 'radio',
			'id'			=> 'service',
			'toggle'		=> 'toggle-subscribe-service',
			'title' 		=> __('Service', 'theme_admin'),
			'description' 	=> __('choose email marketing service', 'theme_admin'),
			'default' 		=> 'mailchimp',
			'options' 		=> array(
				'mailchimp' => 'MailChimp',
				'aweber' 	=> 'Aweber',
			),
		),
		array(
			'type' 			=> 'text',
			'id' 			=> 'mailchimp_api',
			'toggle_group'	=> 'toggle-subscribe-service toggle-subscribe-service-mailchimp',
			'title' 		=> __('MailChimp API Key', 'theme_admin'),
			'description' 	=> __('find it at: ', 'theme_admin').'<a href="http://kb.mailchimp.com/article/where-can-i-find-my-api-key" target="_blank">Link</a>',
		),
		array(
			'type' 			=> 'text',
			'id' 			=> 'mailchimp_list_id',
			'toggle_group'	=> 'toggle-subscribe-service toggle-subscribe-service-mailchimp',
			'title' 		=> __('MailChimp List ID', 'theme_admin'),
			'description' 	=> __('find it at: ', 'theme_admin') .'<a href="http://kb.mailchimp.com/article/how-can-i-find-my-list-id" target="_blank">Link</a>',
		),
		array(
			'type' 			=> 'text',
			'id' 			=> 'aweber_list_id',
			'toggle_group'	=> 'toggle-subscribe-service toggle-subscribe-service-aweber',
			'title' 		=> __('Aweber List ID', 'theme_admin'),
			'description' 	=> __('example: aweberblog', 'theme_admin'),
		),
	)
);

// Features (Icon)
$features_stack[] = array(
	'id' => 'features',
	'type' => 'stack_template',
	'title' => __('Features', 'theme_admin'),
	'description' => __('', 'theme_admin'),
	'options' => array(
		array(
			'type' 			=> 'text',
			'id'			=> 'stack_title',
			'title' 		=> __('Title', 'theme_admin'),
			'description' 	=> 'example: Retina Display Ready',
		),
		array(
			'type' 			=> 'select',
			'id'			=> 'icon',
			'title' 		=> __('Icon', 'theme_admin'),
			'description' 	=> 'see example at : <a href="http://fortawesome.github.com/Font-Awesome/">Font Awesome</a>',
			'default'		=> '',
			'source'		=> array(
				'font-awesome'	=> ''
			)
		),
		array(
			'type' 			=> 'text',
			'id' 			=> 'link',
			'title' 		=> __('Link', 'theme_admin'),
			'description' 	=> __('example: http://wegrass.com', 'theme_admin'),
		),
		array(
			'type' 			=> 'textarea',
			'row'			=> '3',
			'id'			=> 'content_text',
			'title' 		=> __('Content', 'theme_admin'),
			'description' 	=> '',
		)
	)
);

$stack_template[] = array(
	'id' => 'features',
	'type' => 'stack_template',
	'title' => __('Features (icon)', 'theme_admin'),
	'description' => __('', 'theme_admin'),
	'options' => array(
		array(
			'type' 			=> 'text',
			'id'			=> 'stack_title',
			'title' 		=> __('Title', 'theme_admin'),
			'description' 	=> __('title of the stack block', 'theme_admin'),
		),
		array(
			'type' 			=> 'radio',
			'id'			=> 'layout',
			'title' 		=> __('Layout', 'theme_admin'),
			'description' 	=> '',
			'default' 		=> '3',
			'options' 		=> array(
				'2' 	=> __('2 Columns', 'theme_admin'),
				'3' 	=> __('3 Columns', 'theme_admin'),
			),
		),
		array(
			'type' 			=> 'stack',
			'id' 			=> 'features',
			'title' 		=> __('Features', 'theme_admin'),
			'description' 	=> __('', 'theme_admin'),
			'templates'		=> $features_stack,
			'stack_button'	=> __('Add Features', 'theme_admin')
		)
	)
);

// Features (Image)
$features_image_stack[] = array(
	'id' => 'features',
	'type' => 'stack_template',
	'title' => __('Features', 'theme_admin'),
	'description' => __('', 'theme_admin'),
	'options' => array(
		array(
			'type' 			=> 'text',
			'id'			=> 'stack_title',
			'title' 		=> __('Title', 'theme_admin'),
			'description' 	=> 'example: Retina Display Ready',
		),
		array(
			'type' 			=> 'image',
			'id'			=> 'image',
			'title' 		=> __('Image', 'theme_admin'),
			'description' 	=> __('minimum width 300px (use 2x size to support retina display)', 'theme_admin'),
		),
		array(
			'type' 			=> 'text',
			'id' 			=> 'link',
			'title' 		=> __('Link', 'theme_admin'),
			'description' 	=> __('example: http://wegrass.com', 'theme_admin'),
		),
		array(
			'type' 			=> 'textarea',
			'row'			=> '3',
			'id'			=> 'content_text',
			'title' 		=> __('Content', 'theme_admin'),
			'description' 	=> '',
		)
	)
);

$stack_template[] = array(
	'id' => 'features_with_image',
	'type' => 'stack_template',
	'title' => __('Features (Image)', 'theme_admin'),
	'description' => __('', 'theme_admin'),
	'options' => array(
		array(
			'type' 			=> 'text',
			'id'			=> 'stack_title',
			'title' 		=> __('Title', 'theme_admin'),
			'description' 	=> __('title of the stack block', 'theme_admin'),
		),
		array(
			'type' 			=> 'stack',
			'id' 			=> 'features',
			'title' 		=> __('Features', 'theme_admin'),
			'description' 	=> __('', 'theme_admin'),
			'templates'		=> $features_image_stack,
			'stack_button'	=> __('Add Features', 'theme_admin')
		)
	)
);

// Client
$client_stack[] = array(
    'id' => 'client',
    'type' => 'stack_template',
    'title' => __('Client', 'theme_admin'),
    'description' => __('', 'theme_admin'),
    'options' => array(
        array(
            'type'          => 'image',
            'id'            => 'image',
            'title'         => __('Image', 'theme_admin'),
            'description'   => __('minimum width 120px (use 2x size to support retina display)', 'theme_admin'),
        ),
        array(
            'type'          => 'text',
            'id'            => 'link',
            'title'         => __('Link', 'theme_admin'),
            'description'   => __('example: http://wegrass.com', 'theme_admin'),
        ),
        array(
            'type'          => 'radio',
            'id'            => 'target',
            'title'         => __('Open Link in same Window', 'theme_admin'),
            'description'   => __('choose "No" to open link in new Window', 'theme_admin'),
            'default'       => '_blank',
            'options'       => array(
                '_self'     => __('Yes', 'theme_admin'),
                '_blank'    => __('No', 'theme_admin'),
            ),
        ),
    )
);
$stack_template[] = array(
	'id' => 'clients',
	'type' => 'stack_template',
	'title' => __('Clients', 'theme_admin'),
	'description' => __('', 'theme_admin'),
	'options' => array(
		array(
			'type' 			=> 'text',
			'id'			=> 'stack_title',
			'title' 		=> __('Title', 'theme_admin'),
			'description' 	=> __('title of the stack block', 'theme_admin'),
		),
		array(
			'type' 			=> 'on_off',
			'id'			=> 'random_order',
			'title' 		=> __('Random Order', 'theme_admin'),
			'description' 	=> __('show client in random order', 'theme_admin'),
			'default'		=> 'off'
		),
		array(
            'type'          => 'stack',
            'id'            => 'clients',
            'title'         => __('Clients', 'theme_admin'),
            'description'   => __('', 'theme_admin'),
            'templates'     => $client_stack,
            'stack_button'  => __('Add Client', 'theme_admin')
        )
	)
);

// Pricing Table
$plan_row_stack[] = array(
	'id' => 'features',
	'type' => 'stack_template',
	'title' => __('Row', 'theme_admin'),
	'description' => __('', 'theme_admin'),
	'options' => array(
		array(
			'type' 			=> 'text',
			'id'			=> 'stack_title',
			'title' 		=> __('Title', 'theme_admin'),
			'description' 	=> __('example: 5 GB Storage', 'theme_admin'),
		),
	)
);
$plan_stack[] = array(
	'id' => 'features',
	'type' => 'stack_template',
	'title' => __('Plan', 'theme_admin'),
	'description' => __('', 'theme_admin'),
	'options' => array(
		array(
			'type' 			=> 'text',
			'id'			=> 'stack_title',
			'title' 		=> __('Title', 'theme_admin'),
			'description' 	=> __('example: Premium, Standard', 'theme_admin'),
		),
		array(
			'type' 			=> 'text',
			'id' 			=> 'price',
			'title' 		=> __('Price', 'theme_admin'),
			'description' 	=> __('example: ', 'theme_admin') . '<code>' . htmlentities('<strong>$</strong><em>55</em><sup>99</sup><small>month</small>') . '</code>',
		),
		array(
			'type' 			=> 'stack',
			'id' 			=> 'rows',
			'title' 		=> __('Rows', 'theme_admin'),
			'description' 	=> __('', 'theme_admin'),
			'templates'		=> $plan_row_stack,
			'stack_button'	=> __('Add Rows', 'theme_admin')
		),
		array(
			'type' 			=> 'text',
			'id' 			=> 'button_text',
			'title' 		=> __('Button Text', 'theme_admin'),
			'description' 	=> __('example: Order Now', 'theme_admin'),
		),
		array(
			'type' 			=> 'text',
			'id' 			=> 'button_link',
			'title' 		=> __('Button Link', 'theme_admin'),
			'description' 	=> __('example: http://wegrass.com', 'theme_admin'),
		),
		array(
			'type' 			=> 'radio',
			'id'			=> 'button_target',
			'title' 		=> __('Open Link in same Window', 'theme_admin'),
			'description' 	=> __('choose "No" to open link in new Window', 'theme_admin'),
			'default' 		=> '_self',
			'options' 		=> array(
				'_self' 	=> __('Yes', 'theme_admin'),
				'_blank' 	=> __('No', 'theme_admin'),
			),
		),
	)
);
$stack_template[] = array(
	'id' => 'pricing_table',
	'type' => 'stack_template',
	'title' => __('Pricing Table', 'theme_admin'),
	'description' => __('', 'theme_admin'),
	'options' => array(
		array(
			'type' 			=> 'text',
			'id'			=> 'stack_title',
			'title' 		=> __('Title', 'theme_admin'),
			'description' 	=> __('title of the stack block', 'theme_admin'),
		),
		array(
			'type' 			=> 'stack',
			'id' 			=> 'plans',
			'title' 		=> __('Plans', 'theme_admin'),
			'description' 	=> __('recommended 3-4 plans', 'theme_admin'),
			'templates'		=> $plan_stack,
			'stack_button'	=> __('Add Plans', 'theme_admin')
		)
	)
);

// Contact
$contact_info_list_template[] = array(
	'id' => 'contact_info_stack',
	'type' => 'stack_template',
	'title' => __('Info', 'theme_admin'),
	'description' => __('', 'theme_admin'),
	'options' => array(
		array(
			'type' 			=> 'text',
			'id'			=> 'stack_title',
			'title' 		=> __('Name', 'theme_admin'),
			'description' 	=> __('eg. Address, Phone, Email', 'theme_admin'),
		),
		array(
			'type' 			=> 'textarea',
			'id'			=> 'info_detail',
			'title' 		=> __('Detail', 'theme_admin'),
			'description' 	=> '',
		),
	)
);
$marker_list_template[] = array(
	'id' => 'marker_info_stack',
	'type' => 'stack_template',
	'title' => __('Marker', 'theme_admin'),
	'description' => __('', 'theme_admin'),
	'options' => array(
		array(
			'type' 			=> 'text',
			'id'			=> 'lat',
			'title' 		=> __('Latitude', 'theme_admin'),
			'description' 	=> 'get it <a href="http://www.latlng.org/" target="_blank">here</a>',
		),
		array(
			'type' 			=> 'text',
			'id'			=> 'lng',
			'title' 		=> __('Longitude', 'theme_admin'),
			'description' 	=> 'get it <a href="http://itouchmap.com/latlong.html" target="_blank">here</a>',
		),
	)
);
$contact_purpose_list_template[] = array(
	'id' => 'contact_purpose_stack',
	'type' => 'stack_template',
	'title' => __('Purpose', 'theme_admin'),
	'description' => __('', 'theme_admin'),
	'options' => array(
		array(
			'type' 			=> 'text',
			'id'			=> 'stack_title',
			'title' 		=> __('Purpose', 'theme_admin'),
			'description' 	=> __('eg. Enquiry, Feedback, Other', 'theme_admin'),
		),
	)
);
$stack_template[] = array(
	'id' => 'contact',
	'type' => 'stack_template',
	'title' => __('Contact', 'theme_admin'),
	'description' => __('', 'theme_admin'),
	'options' => array(
		
		array(
			'type' 			=> 'text',
			'id'			=> 'lat',
			'title' 		=> __('Latitude', 'theme_admin'),
			'description' 	=> 'get it <a href="http://www.latlng.org/" target="_blank">here</a>',
		),
		array(
			'type' 			=> 'text',
			'id'			=> 'lng',
			'title' 		=> __('Longitude', 'theme_admin'),
			'description' 	=> 'get it <a href="http://itouchmap.com/latlong.html" target="_blank">here</a>',
		),
		array(
			'type' 			=> 'range',
			'id'			=> 'map_height',
			'title' 		=> __('Height', 'theme_admin'),
			'description' 	=> __('the height of map box', 'theme_admin'),
			'default' 		=> '600',
			'min' 			=> '300',
			'max' 			=> '1000',
			'step' 			=> '50',
			'unit'			=> 'px',
		),
		array(
			'type' 			=> 'range',
			'id'			=> 'map_zoom',
			'title' 		=> __('Zoom Level', 'theme_admin'),
			'description' 	=> __('', 'theme_admin'),
			'default' 		=> '5',
			'min' 			=> '0',
			'max' 			=> '15',
			'step' 			=> '1',
			'unit'			=> '',
		),
		array(
			'type' 			=> 'stack',
			'id'			=> 'marker_info_list',
			'title' 		=> __('Marker List', 'theme_admin'),
			'description' 	=> '',
			'templates'		=> $marker_list_template,
			'stack_button'	=> __('Add', 'theme_admin')
		),

		array(
			'type' 			=> 'separator',
			'title' 		=> __('Contact Info Section', 'theme_admin'),
		),
		array(
			'type' 			=> 'textarea',
			'row'			=> 4,
			'id'			=> 'contact_info_text',
			'title' 		=> __('Contact Info Text', 'theme_admin'),
			'description' 	=> '',
		),
		array(
			'type' 			=> 'stack',
			'id'			=> 'contact_info_list',
			'title' 		=> __('Info List', 'theme_admin'),
			'description' 	=> '',
			'templates'		=> $contact_info_list_template,
			'stack_button'	=> __('Add', 'theme_admin')
		),

		array(
			'type' 			=> 'separator',
			'title' 		=> __('Contact Form Section', 'theme_admin'),
		),
		array(
			'type' 			=> 'radio',
			'id'			=> 'contact_form_type',
			'toggle'		=> 'toggle-contact-form-type',
			'title' 		=> __('Type', 'theme_admin'),
			'description' 	=> __('', 'theme_admin'),
			'default'		=> 'stack',
			'options' 		=> array(
				'stack' 	=> __('Stack', 'theme_admin'),
				'contact-form-7' 	=> __('Contact Form 7', 'theme_admin'),
			),
		),
		array(
			'type' 			=> 'text',
			'id'			=> 'contact_form_mail_to',
			'toggle_group'	=> 'toggle-contact-form-type toggle-contact-form-type-stack',
			'title' 		=> __('Send to Email', 'theme_admin'),
			'description' 	=> __('use (,) to separate multiple emails<br />leave blank to send to admin email', 'theme_admin'),
		),
		array(
			'type' 			=> 'stack',
			'id'			=> 'contact_purpose_list',
			'toggle_group'	=> 'toggle-contact-form-type toggle-contact-form-type-stack',
			'title' 		=> __('Purpose List', 'theme_admin'),
			'description' 	=> __('these will be showed as dropdown selection in contact form', 'theme_admin'),
			'templates'		=> $contact_purpose_list_template,
			'stack_button'	=> __('Add', 'theme_admin')
		),
		array(
			'type' 			=> 'select',
			'id'			=> 'contact_form_7_id',
			'toggle_group'	=> 'toggle-contact-form-type toggle-contact-form-type-contact-form-7',
			'title' 		=> __('Contact Form 7', 'theme_admin'),
			'description' 	=> __('create them at "wp-admin > contact > add new"', 'theme_admin'),
			'source'		=> array(
				'post_type'	=> 'wpcf7_contact_form',
			)
		),
	)
);

// Twitter
$stack_template[] = array(
	'id' => 'twitter',
	'type' => 'stack_template',
	'title' => __('Twitter', 'theme_admin'),
	'description' => __('', 'theme_admin'),
	'options' => array(
		array(
			'type' 			=> 'text',
			'id'			=> 'stack_title',
			'title' 		=> __('Username', 'theme_admin'),
			'description' 	=> 'example: twitter',
		),
	)
);

// Testimonial
$stack_template[] = array(
	'id' => 'testimonial',
	'type' => 'stack_template',
	'title' => __('Testimonial', 'theme_admin'),
	'description' => '',
	'options' => array(
		array(
			'type' 			=> 'text',
			'id'			=> 'stack_title',
			'title' 		=> __('Title', 'theme_admin'),
			'description' 	=> '',
			'default'		=> '',
		),
		array(
			'type' 			=> 'radio',
			'id'			=> 'style',
			'title' 		=> __('Display Style', 'theme_admin'),
			'description' 	=> __('Choose the style to show the testimonial.', 'theme_admin'),
			'default' 		=> 'masonry',
			'options' 		=> array(
				'masonry' 	=> __('Masonry', 'theme_admin'),
				'slide' 	=> __('Slide', 'theme_admin'),
			),
		),
		array(
			'type' 			=> 'range',
			'id'			=> 'number',
			'title' 		=> __('Maximum Number', 'theme_admin'),
			'description' 	=> __('set to 0 to show all', 'theme_admin'),
			'default' 		=> '0',
			'min' 			=> '0',
			'max' 			=> '20',
			'step' 			=> '1',
			'unit'			=> '',
		),
		array(
			'type' 			=> 'on_off',
			'id'			=> 'random_order',
			'title' 		=> __('Random Order', 'theme_admin'),
			'description' 	=> __('show entry in random order', 'theme_admin'),
			'default'		=> 'off'
		),
		array(
			'type' 			=> 'Select',
			'id'			=> 'exclude_category',
			'title' 		=> __('Exclude Category', 'theme_admin'),
			'description' 	=> __('OSX: cmd + click<br />Window: ctrl + click ', 'theme_admin'),
			'multiple'		=> 5,
			'default' 		=> '',
			'source'		=> array(
				'taxonomy'	=> 'testimonial_category',
			)
		),
	)
);

// Events
$stack_template[] = array(
	'id' => 'event',
	'type' => 'stack_template',
	'title' => __('Events', 'theme_admin'),
	'description' => __('', 'theme_admin'),
	'options' => array(
		array(
			'type' 			=> 'text',
			'id'			=> 'stack_title',
			'title' 		=> __('Title', 'theme_admin'),
			'description' 	=> __('', 'theme_admin'),
			'default'		=> __('', 'theme_admin'),
		),
		array(
			'type' 			=> 'range',
			'id'			=> 'limit',
			'title' 		=> __('Limit', 'theme_admin'),
			'description' 	=> __('set to 0 to show all', 'theme_admin'),
			'default' 		=> '0',
			'min' 			=> '0',
			'max' 			=> '20',
			'step' 			=> '1',
			'unit'			=> '',
		),
		array(
			'type' 			=> 'Select',
			'id'			=> 'exclude_category',
			'title' 		=> __('Exclude Category', 'theme_admin'),
			'description' 	=> __('OSX: cmd + click<br />Window: ctrl + click ', 'theme_admin'),
			'multiple'		=> 10,
			'default' 		=> '',
			'source'		=> array(
				'taxonomy'	=> 'event_category',
			),
		),
		array(
			'type' 			=> 'radio',
			'id'			=> 'style',
			'title' 		=> __('Display Style', 'theme_admin'),
			'description' 	=> __('Choose the style to show the testimonial.', 'theme_admin'),
			'default' 		=> 'list',
			'options' 		=> array(
				'filter' 	=> __('Filter Grid', 'theme_admin'),
				'slide' 	=> __('Slide Grid', 'theme_admin'),
				'list' 		=> __('List', 'theme_admin'),
			),
		),

		array(
			'type' 			=> 'textarea',
			'id'			=> 'stack_desc',
			'title' 		=> __('Description', 'theme_admin'),
			'description' 	=> __('will show on first block', 'theme_admin'),
		),
		array(
			'type' 			=> 'text',
			'id'			=> 'button_text',
			'title' 		=> __('Button Text', 'theme_admin'),
			'description' 	=> __('example: See All', 'theme_admin'),
		),
		array(
			'type' 			=> 'text',
			'id' 			=> 'button_link',
			'title' 		=> __('Button Link', 'theme_admin'),
			'description' 	=> __('example: http://wegrass.com', 'theme_admin'),
		),
	)
);

// Blog
$stack_template[] = array(
	'id' => 'blog',
	'type' => 'stack_template',
	'title' => __('Blog', 'theme_admin'),
	'description' => '',
	'options' => array(
		array(
			'type' 			=> 'text',
			'id'			=> 'stack_title',
			'title' 		=> __('Title', 'theme_admin'),
			'description' 	=> '',
			'default'		=> '',
		),

		array(
			'type' 			=> 'range',
			'id'			=> 'limit',
			'title' 		=> __('Limit', 'theme_admin'),
			'description' 	=> __('set to 0 to show all', 'theme_admin'),
			'default' 		=> '0',
			'min' 			=> '0',
			'max' 			=> '20',
			'step' 			=> '1',
			'unit'			=> '',
		),
		array(
			'type' 			=> 'Select',
			'id'			=> 'exclude_category',
			'title' 		=> __('Exclude Category', 'theme_admin'),
			'description' 	=> __('OSX: cmd + click<br />Window: ctrl + click ', 'theme_admin'),
			'multiple'		=> 5,
			'default' 		=> '',
			'source'		=> array(
				'taxonomy'	=> 'category',
			)
		),

		array(
			'type' 			=> 'radio',
			'id'			=> 'style',
			'title' 		=> __('Display Style', 'theme_admin'),
			'description' 	=> __('Choose the style to show the testimonial.', 'theme_admin'),
			'default' 		=> 'slide',
			'options' 		=> array(
				'filter' 	=> __('Filter Grid', 'theme_admin'),
				'slide' 	=> __('Slide Grid', 'theme_admin'),
				'list' 		=> __('List', 'theme_admin'),
			),
		),
		
		array(
			'type' 			=> 'textarea',
			'id'			=> 'stack_desc',
			'title' 		=> __('Description', 'theme_admin'),
			'description' 	=> __('will show on first block', 'theme_admin'),
		),
		array(
			'type' 			=> 'text',
			'id'			=> 'button_text',
			'title' 		=> __('Button Text', 'theme_admin'),
			'description' 	=> __('example: See All', 'theme_admin'),
		),
		array(
			'type' 			=> 'text',
			'id' 			=> 'button_link',
			'title' 		=> __('Button Link', 'theme_admin'),
			'description' 	=> __('example: http://wegrass.com', 'theme_admin'),
		),

	)
);

// Gallery
$stack_template[] = array(
	'id' => 'gallery',
	'type' => 'stack_template',
	'title' => __('Gallery', 'theme_admin'),
	'description' => '',
	'options' => array(
		array(
			'type' 			=> 'text',
			'id'			=> 'stack_title',
			'title' 		=> __('Title', 'theme_admin'),
			'description' 	=> '',
			'default'		=> '',
		),
		array(
			'type' 			=> 'radio',
			'id'			=> 'style',
			'title' 		=> __('Display Style', 'theme_admin'),
			'description' 	=> __('Choose the style to show the testimonial.', 'theme_admin'),
			'default' 		=> 'slide',
			'options' 		=> array(
				'masonry' 	=> __('Masonry Grid', 'theme_admin'),
				'slide' 	=> __('Slide Grid', 'theme_admin'),
			),
		),
		array(
			'type' 			=> 'images',
			'id'			=> 'images',
			'title' 		=> __('Images', 'theme_admin'),
			'description' 	=> __('minimum width 290px (use 2x image to support retina display)', 'theme_admin'),
			'default'		=> '',
		),
	)
);

// Skill
$skill_list_template[] = array(
	'id' => 'skill_stack',
	'type' => 'stack_template',
	'title' => __('Skill', 'theme_admin'),
	'description' => __('', 'theme_admin'),
	'options' => array(
		array(
			'type' 			=> 'text',
			'id'			=> 'stack_title',
			'title' 		=> __('Name', 'theme_admin'),
			'description' 	=> __('eg. PHP, CSS, Photoshop', 'theme_admin'),
		),
		array(
			'type' 			=> 'range',
			'id'			=> 'score',
			'title' 		=> __('Score', 'theme_admin'),
			'description' 	=> '',
			'default' 		=> '100',
			'min' 			=> '0',
			'max' 			=> '100',
			'step' 			=> '1',
			'unit'			=> '',
		),
	)
);
$stack_template[] = array(
	'id' => 'skill',
	'type' => 'stack_template',
	'title' => __('Skill', 'theme_admin'),
	'description' => '',
	'options' => array(
		array(
			'type' 			=> 'text',
			'id'			=> 'stack_title',
			'title' 		=> __('Title', 'theme_admin'),
			'description' 	=> '',
			'default'		=> '',
		),
		array(
			'type' 			=> 'textarea',
			'row'			=> '5',
			'id'			=> 'content',
			'title' 		=> __('Content', 'theme_admin'),
			'description' 	=> __('text content on left column', 'theme_admin'),
			'default'		=> '',
		),
		array(
			'type' 			=> 'stack',
			'id'			=> 'skill_list',
			'title' 		=> __('Skill List', 'theme_admin'),
			'description' 	=> '',
			'templates'		=> $skill_list_template,
			'stack_button'	=> __('Add', 'theme_admin')
		),
	)
);

// Portfolio
$stack_template[] = array(
	'id' => 'portfolio',
	'type' => 'stack_template',
	'title' => __('Portfolio', 'theme_admin'),
	'description' => '',
	'options' => array(
		array(
			'type' 			=> 'text',
			'id'			=> 'stack_title',
			'title' 		=> __('Title', 'theme_admin'),
			'description' 	=> '',
			'default'		=> '',
		),

		array(
			'type' 			=> 'range',
			'id'			=> 'limit',
			'title' 		=> __('Limit', 'theme_admin'),
			'description' 	=> __('set to 0 to show all', 'theme_admin'),
			'default' 		=> '0',
			'min' 			=> '0',
			'max' 			=> '20',
			'step' 			=> '1',
			'unit'			=> '',
		),
		array(
			'type' 			=> 'on_off',
			'id'			=> 'random_order',
			'title' 		=> __('Random Order', 'theme_admin'),
			'description' 	=> __('show entry in random order', 'theme_admin'),
			'default'		=> 'off'
		),
		array(
			'type' 			=> 'radio',
			'id'			=> 'category_filter',
			'toggle'		=> 'toggle-category-filter',
			'title' 		=> __('Category Filtering', 'theme_admin'),
			'description' 	=> __('exclude or include', 'theme_admin'),
			'default'		=> 'exclude',
			'options' 		=> array(
				'exclude' 	=> __('Exclude', 'theme_admin'),
				'include' 	=> __('Include', 'theme_admin'),
			),
		),
		array(
			'type' 			=> 'Select',
			'id'			=> 'exclude_category',
			'toggle_group'	=> 'toggle-category-filter toggle-category-filter-exclude',
			'title' 		=> __('Exclude Category', 'theme_admin'),
			'description' 	=> __('OSX: cmd + click<br />Window: ctrl + click ', 'theme_admin'),
			'multiple'		=> 5,
			'default' 		=> '',
			'source'		=> array(
				'taxonomy'	=> 'portfolio_category',
			)
		),
		array(
			'type' 			=> 'Select',
			'id'			=> 'include_category',
			'toggle_group'	=> 'toggle-category-filter toggle-category-filter-include',
			'title' 		=> __('Include Category', 'theme_admin'),
			'description' 	=> __('OSX: cmd + click<br />Window: ctrl + click ', 'theme_admin'),
			'multiple'		=> 5,
			'default' 		=> '',
			'source'		=> array(
				'taxonomy'	=> 'portfolio_category',
			)
		),

		array(
			'type' 			=> 'radio',
			'id'			=> 'style',
			'title' 		=> __('Display Style', 'theme_admin'),
			'description' 	=> __('Choose the style to show the testimonial.', 'theme_admin'),
			'default' 		=> 'slide',
			'options' 		=> array(
				'filter' 	=> __('Filter Grid', 'theme_admin'),
				'slide' 	=> __('Slide Grid', 'theme_admin'),
			),
		),
		
		array(
			'type' 			=> 'textarea',
			'id'			=> 'stack_desc',
			'title' 		=> __('Description', 'theme_admin'),
			'description' 	=> __('will show on first block', 'theme_admin'),
		),
		array(
			'type' 			=> 'text',
			'id'			=> 'button_text',
			'title' 		=> __('Button Text', 'theme_admin'),
			'description' 	=> __('example: See All', 'theme_admin'),
		),
		array(
			'type' 			=> 'text',
			'id' 			=> 'button_link',
			'title' 		=> __('Button Link', 'theme_admin'),
			'description' 	=> __('example: http://wegrass.com', 'theme_admin'),
		),

	)
);

// Person
$stack_template[] = array(
	'id' => 'person',
	'type' => 'stack_template',
	'title' => __('Person', 'theme_admin'),
	'description' => '',
	'options' => array(
		array(
			'type' 			=> 'text',
			'id'			=> 'stack_title',
			'title' 		=> __('Title', 'theme_admin'),
			'description' 	=> '',
			'default'		=> '',
		),

		array(
			'type' 			=> 'select',
			'id'			=> 'exclude_category',
			'title' 		=> __('Exclude Category', 'theme_admin'),
			'description' 	=> __('OSX: cmd + click<br />Window: ctrl + click ', 'theme_admin'),
			'multiple'		=> 5,
			'default' 		=> '',
			'source'		=> array(
				'taxonomy'	=> 'person_category',
			)
		),

		array(
			'type' 			=> 'radio',
			'id'			=> 'style',
			'title' 		=> __('Display Style', 'theme_admin'),
			'description' 	=> __('Choose the style to show the testimonial.', 'theme_admin'),
			'default' 		=> 'slide',
			'options' 		=> array(
				'masonry' 	=> __('Masonry', 'theme_admin'),
				'slide' 	=> __('Slide', 'theme_admin'),
			),
		),
		
		array(
			'type' 			=> 'textarea',
			'id'			=> 'stack_desc',
			'title' 		=> __('Description', 'theme_admin'),
			'description' 	=> __('will show on first block', 'theme_admin'),
		),
		array(
			'type' 			=> 'text',
			'id'			=> 'button_text',
			'title' 		=> __('Button Text', 'theme_admin'),
			'description' 	=> __('example: See All', 'theme_admin'),
		),
		array(
			'type' 			=> 'text',
			'id' 			=> 'button_link',
			'title' 		=> __('Button Link', 'theme_admin'),
			'description' 	=> __('example: http://wegrass.com', 'theme_admin'),
		),

	)
);

// Slider
$stack_template[] = array(
	'id' => 'slider',
	'type' => 'stack_template',
	'title' => __('Slider', 'theme_admin'),
	'description' => __('', 'theme_admin'),
	'options' => array(
		array(
			'type' 			=> 'radio',
			'id'			=> 'stack_title',
			'toggle'		=> 'toggle-slider-type',
			'title' 		=> __('Type', 'theme_admin'),
			'description' 	=> __('choose slider type', 'theme_admin'),
			'default'		=> 'stack',
			'options' 		=> array(
				'stack' 		=> __('Stack Slider', 'theme_admin'),
				'revslider' 	=> __('Revolution Slider', 'theme_admin'),
				'layer-slider' 	=> __('Layer Slider', 'theme_admin'),
			),
		),
		array(
			'type' 			=> 'select',
			'id'			=> 'stack_slider_id',
			'toggle_group'	=>	'toggle-slider-type toggle-slider-type-stack',
			'title' 		=> __('Stack Slider', 'theme_admin'),
			'description' 	=> __('create them at "wp-admin > slider"', 'theme_admin'),
			'source'		=> array(
				'post_type'	=> 'slider',
			)
		),
		array(
			'type' 			=> 'select',
			'id'			=> 'revolution_slider_id',
			'toggle_group'	=>	'toggle-slider-type toggle-slider-type-revslider',
			'title' 		=> __('Revolution Slider', 'theme_admin'),
			'description' 	=> __('<a href="http://codecanyon.net/item/slider-revolution-responsive-wordpress-plugin/2751380">Slider Revolution</a> plugin need to be installed', 'theme_admin'),
			'source'		=> array(
				'revslider'	=> true
			)
		),
		array(
			'type' 			=> 'select',
			'id'			=> 'layer_slider_id',
			'toggle_group'	=>	'toggle-slider-type toggle-slider-type-layer-slider',
			'title' 		=> __('Layer Slider', 'theme_admin'),
			'description' 	=> __('<a href="http://codecanyon.net/item/layerslider-responsive-wordpress-slider-plugin-/1362246">Layer Slider</a> plugin need to be installed', 'theme_admin'),
			'source'		=> array(
				'layer_slider'	=> true
			)
		)
	)
);

// Column
$stack_template[] = array(
	'id' => 'column',
	'type' => 'stack_template',
	'title' => __('Column', 'theme_admin'),
	'description' => __('', 'theme_admin'),
	'options' => array(
		array(
			'type' 			=> 'text',
			'id'			=> 'stack_title',
			'title' 		=> __('Title', 'theme_admin'),
			'description' 	=> __('title of the stack block', 'theme_admin'),
		),
		array(
			'type' 			=> 'select',
			'id'			=> 'layout',
			'toggle'		=> 'column-layout',
			'title' 		=> __('Layout', 'theme_admin'),
			'description' 	=> '',
			'default' 		=> '1',
			'options' 		=> array(
				'1' 	=> __('1 Column  (Full Width )', 'theme_admin'),
				'2-1' 	=> __('2 Columns ( 1:1 )', 'theme_admin'),
				'2-2' 	=> __('2 Columns ( 1:2 )', 'theme_admin'),
				'2-3' 	=> __('2 Columns ( 2:1 )', 'theme_admin'),
				'2-4' 	=> __('2 Columns ( 1:3 )', 'theme_admin'),
				'2-5' 	=> __('2 Columns ( 3:1 )', 'theme_admin'),
				'3' 	=> __('3 Columns ( 1:1:1 )', 'theme_admin'),
				'4' 	=> __('4 Columns ( 1:1:1:1 )', 'theme_admin'),
			),
		),
		array(
			'type' 			=> 'textarea',
			'row'			=> '8',
			'toggle_group'	=> 'column-layout column-layout-1 column-layout-2-1 column-layout-2-2 column-layout-2-3 column-layout-2-4 column-layout-2-5 column-layout-3 column-layout-4',
			'id'			=> 'column_1',
			'title' 		=> 'Column #1',
			'description' 	=> '',
		),
		array(
			'type' 			=> 'textarea',
			'row'			=> '8',
			'toggle_group'	=> 'column-layout column-layout-2-1 column-layout-2-2 column-layout-2-3 column-layout-2-4 column-layout-2-5 column-layout-3 column-layout-4',
			'id'			=> 'column_2',
			'title' 		=> 'Column #2',
			'description' 	=> '',
		),
		array(
			'type' 			=> 'textarea',
			'row'			=> '8',
			'toggle_group'	=> 'column-layout column-layout-3 column-layout-4',
			'id'			=> 'column_3',
			'title' 		=> 'Column #3',
			'description' 	=> '',
		),
		array(
			'type' 			=> 'textarea',
			'row'			=> '8',
			'toggle_group'	=> 'column-layout column-layout-4',
			'id'			=> 'column_4',
			'title' 		=> 'Column #4',
			'description' 	=> '',
		),

	)
);

// RAW
$stack_template[] = array(
	'id' => 'raw_html',
	'type' => 'stack_template',
	'title' => __('RAW HTML', 'theme_admin'),
	'description' => __('', 'theme_admin'),
	'options' => array(
		array(
			'type' 			=> 'textarea',
			'row'			=> '8',
			'id'			=> 'html',
			'title' 		=> 'HTML',
			'description' 	=> '',
		),
	)
);

// Separator
$stack_template[] = array(
	'id' => 'separator',
	'type' => 'stack_template',
	'title' => __('Separator', 'theme_admin'),
	'description' => __('line separator', 'theme_admin'),
	'options' => array()
);

// Page Content
$stack_template[] = array(
	'id' => 'page_content',
	'type' => 'stack_template',
	'title' => __('Main Content', 'theme_admin'),
	'description' => __('this block represent content from WP standard WYSIWYG editor you see above', 'theme_admin'),
	'options' => array()
);


// Sort Stack
sort($stack_template);

$config = array(
	'title' 		=> __('Stack Builder', 'theme_admin'),
	'group_id' 		=> 'stack_builder',
	'types' 		=> array( 'page', 'portfolio', 'event' ),
	'context' 		=> 'normal',
	'priority' 		=> 'low'
);
$options = array(
	array(
		'type' 			=> 'stack',
		'id' 			=> 'stacks',
		'title' 		=> __('Stacks', 'theme_admin'),
		'description' 	=> __('build your page by stacking block of content', 'theme_admin'),
		'templates'		=> $stack_template,
		'stack_button'	=> __('Add Stack', 'theme_admin'),
		'stack_builder' => true // Differenciate from general stack
	)
);
new metaboxes_tool($config, $options);

?>