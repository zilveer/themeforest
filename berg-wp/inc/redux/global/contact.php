<?php

return array(
	'icon'   => 'el el-map-marker',
	'title'  => __( 'Contact & map', 'BERG' ),
	'class'  => 'contact_info_section',
	'fields' => array(
		array(
			'id' => 'berg_contact_type',
			'type' => 'select',
			'title' => __('Select settings for:' , 'BERG'),
			'options'  => array(
				'contact1'    => __('Contact Template', 'BERG' ),
				'contact2'    => __('Contact2 Template', 'BERG' ),
			),
			'default'  => 'contact1',
			'select2'  => array( 'allowClear' => false ),
		),
		array(
			'id'       => 'berg_contact_google_api_key',
			'type'     => 'text',
			'title'    => __( 'Google maps API Key', 'BERG' ),
			// 'desc'     => __( 'API key which can be found on themeforest.net in My Account > Settings > API Keys', 'BERG' ),
			'default'  => ''
		),
		array(
			'id'   =>'berg_info_settings',
		    'title' => __('Info section', 'BERG'),
		    'type' => 'divide',
		    'required' => array( 'berg_contact_type', '=', 'contact2' ),
		),
		array(
			'id'       => 'contact_name',
			'type'     => 'text',
			'title'    => __( 'Info header', 'BERG' ),
			'default' => '',
			'required' => array( 'berg_contact_type', '=', 'contact2' ),
		),
		array(
			'id'       => 'contact_desc',
			'type'     => 'editor',
			'title'    => __( 'Description', 'BERG' ),
			'class'	   => 'contact-desc-field',
			'args'   => array(
				'media_buttons' => false, 'tinymce' => array('toolbar'=> 'bold,italic,strikethrough,bullist,numlist,blockquote,hr,alignleft,aligncenter,alignright,link,unlink,wp_more,spellchecker,wp_fullscreen,wp_adv ', 'toolbar2' => 'formatselect,underline,alignjustify,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help,yopress')
			),
			'default' => '',
			'required' => array( 'berg_contact_type', '=', 'contact2' ),
		),	
		array(
			'id' => 'contact_info',
			'type' => 'contact_info',
			'class'	   => 'contact-add-field',
			// 'title' => __( '', 'BERG' ),
			'required' => array( 'berg_contact_type', '=', 'contact2' ),
		),
		array(
			'id' => 'berg_contact_align',
			'title' => __('Text align', 'BERG'),
			'type' => 'select',
			'options' => array(
				'left' => __('Left', 'BERG'),
				'center' => __('Center', 'BERG'),
				'right' => __('Right', 'BERG'),
			),
			'default'  => 'left',
			'select2'  => array( 'allowClear' => false ),
			'required' => array( 'berg_contact_type', '=', 'contact2' ),
		),
		array(
			'id'    	  => 'berg_contact_overlay',
			'type'  	  => 'color',
			'title'    	  => __( 'Overlay color on background image', 'BERG' ),
			'default' 	  => 'rgba(0,0,0,0.6)',
			'transparent' => true,
			'validate' 	  => '',
			'output'	  => array( 'background-color' => '.contact-new-page .bg-overlay'),
			'subtitle'  => __( 'Define the color and transparency level of the overlay background color.', 'BERG' ),  
			'required' => array( 'berg_contact_type', '=', 'contact2' ),
		),	
		array(
			'id'   =>'berg_map_settings',
		    'title' => __('Map settings', 'BERG'),
		    'type' => 'divide',
		    // 'required' => array( 'berg_contact_type', '=', 'contact2' ),
		),
		array(
			'id'       => 'berg_contact_map_height',
			'type'     => 'text',
			'title'    => __( 'Map height', 'BERG' ),
			'default' => '',
			'subtitle' => __('Provide map height in pixels (e.g 500px)', 'BERG'),
			'required' => array( 'berg_contact_type', '=', 'contact2' ),
		),
		array(
			'id' 	=> 'contact_map_type',
			'type' 	=> 'select',
			'title' => __('Map type', 'BERG'),
			'options' => array(
				"custom" => __("Custom style", 'BERG'),
				"roadmap" => __("Roadmap", 'BERG'),
				"satellite" => __("Satellite", 'BERG'),
				"hybrid" => __("Hybrid", 'BERG'),
				"terrain" => __("Terrain", 'BERG'),
			),
			'default' => "custom",
			'subtitle' => __('Select map type to be used. Choose "custom style" if you want to add own styles for map (in JSON code).', 'BERG'),
			// 'required' => array( 'berg_contact_type', '=', 'contact2' ),
			'select2'  => array( 'allowClear' => false ),
		),		
		array(
			'id'       => 'contact_map_styles',
			'type'     => 'textarea',
			'title'    => __( 'Google styled map JSON', 'BERG' ),
			'subtitle'     => __( "<a target='_blank' href='http://gmaps-samples-v3.googlecode.com/svn/trunk/styledmaps/wizard/index.html'>Click here</a> to get the style JSON code for styling your map or clear this field to get our styles.", 'BERG' ),
			'default'  => '',
			'required' => array('contact_map_type', '=', 'custom'),
		),
		array(
			'id' => 'contact_show_locations',
			'type' => 'switch',
			'title' => __('Show info locations below map', 'BERG'),
			'on'		=> 'On',
			'off'		=> 'Off',
			'default' => true,
			'required' => array( 'berg_contact_type', '=', 'contact2' ),
		),
		array(
			'id' => 'contact_locations_align',
			'type' => 'select',
			'title' => __('Info locations alignment', 'BERG'),
			'options' => array(
				'left' => __('Left', 'BERG'),
				'center' => __('Center', 'BERG'),
				'right' => __('Right', 'BERG'),
			),
			'default' => 'left',
			'required' => array( 'contact_show_locations', '=', 1 ),
			'select2'  => array( 'allowClear' => false ),
		),
		// array(
		// 	'id'   =>'berg_map_settings',
		//     'title' => __('Multiple locations settings', 'BERG'),
		//     'type' => 'divide'
		// ),
		array(
			'id' => 'multiple_contact_map_div',
			'type' => 'multiple_map',
		),
		
	),
);