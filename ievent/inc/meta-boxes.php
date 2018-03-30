<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/docs/define-meta-boxes
 */
/********************* META BOX DEFINITIONS ***********************/
add_action( 'admin_init', 'rw_register_meta_boxes' );
function rw_register_meta_boxes()
{
	
	global $meta_boxes;
	global $ievent_data;
	global $wpdb;
	$prefix = 'jx_ievent_';
	$meta_boxes = array();		
	
	
	// REVSLIDER ARRAY
	$revolutionslider = array();
	$layersliders_array = array();
	
	if(class_exists('RevSlider')){
		$revolutionslider[0] = 'Select a Slider';
	    $slider = new RevSlider();
		$arrSliders = $slider->getArrSliders();
		
		foreach($arrSliders as $revSlider) { 
			$revolutionslider[$revSlider->getAlias()] = $revSlider->getTitle();
		}
	}
	else{
		$revolutionslider[0] = 'You have to install RevolutionSlider Plugin';
	}
				
	
	/* ----------------------------------------------------- */
	// Post Settings
	/* ----------------------------------------------------- */
	
	$meta_boxes[] = array(
		'id' => 'pagesettings',
		'title' => 'Page Options',
		'pages' => array( 'post' ),
		'context' => 'normal',
		'priority' => 'high',
	
		// List of meta fields
		'fields' => array(
		
		// HEADING of Post Option 
			array(
			'type' => 'heading',
			'name' => '<h2>'.esc_html__( 'Post Options', 'ievent' ).'</h2>',
			'id' => 'heading_004', // Not used but needed for plugin
			),
			array(
						'name'		=> 'Video Embed Code',
						'id'   => $prefix."video_code",
						'type' => 'text',
						'desc'	=> 'Paste your video or audio link (<strong>E.g. http://www.youtube.com/watch?v=HUTXbBx765</strong>) to play.',
					
			),
			array(
						'name'		=> 'Image Hover Effect',
						'id'		=> $prefix."img_hover",
						'type'		=> 'select',
						'options'	=> array(
							'link'							=> 'Link',
							'Zoom'							=> 'Zoom',
							'Zoom_link'						=> 'Zoom and Link',
							'none'							=> 'None'
						),
						'multiple'	=> false,
						'desc'		=> 'Set image hover effect.',
						'std'		=> true
			),
			
				
			// Title Bar Heading
			array(
			'type' => 'heading',
			'name' => '<h2>'.esc_html__( 'Title Bar Options', 'ievent' ).'</h2>',
			'id' => 'heading_001', // Not used but needed for plugin
			),
			array(
					'name'		=> 'Title Bar',
					'id'		=> $prefix."title_bar",
					'type'		=> 'select',
					'options'	=> array(
						'select_title_bar'	=> 'Select Title Bar',
						'titlebar'			=> 'Title Bar',
						'flexslider'		=> 'Flexslider'
					),
					'desc'		=> 'Set Title Bar style.',
					'multiple'	=> false,
					'std'		=> array( 'title' )
			),
			array(
				'name'		=> 'Show Breadcrumbs?',
				'id'		=> $prefix."breadcrumbs",
				'type'		=> 'checkbox',
				'desc'		=> 'Show / Hide Breadcrumbs.',
				'std'		=> true
			)
			
		)
	);
	
	/* ----------------------------------------------------- */
	// Page Settings
	/* ----------------------------------------------------- */
	
	$meta_boxes[] = array(
		'id' => 'pagesettings',
		'title' => 'Page Options',
		'pages' => array( 'page' ),
		'context' => 'normal',
		'priority' => 'high',
	
		// List of meta fields
		'fields' => array(
		
			// Title Bar Heading
			array(
			'type' => 'heading',
			'name' => '<h2>'.esc_html__( 'Title Bar Options', 'ievent' ).'</h2>',
			'id' => 'heading_001', // Not used but needed for plugin
			),

			array(
					'name'		=> 'Title Bar',
					'id'		=> $prefix."title_bar",
					'type'		=> 'select',
					'options'	=> array(
						'select_title_bar'	=> 'Select Title Bar',
						'titlebar'			=> 'Title Bar',
						'flexslider'		=> 'Flexslider',
						'flexslider-images'		=> 'Flexslider With Sliding Images',
						'revolutionslider'	=> 'Revolution Slider',
						'count-down'		=> 'Count Down',
						'register-form'		=> 'Registration Form',
						'register-form-2'	=> 'Registration Form 2',
						'video'				=> 'Video',
						'title-box'				=> 'Title Box',
					),
					'desc'		=> 'Set Title Bar style.',
					'multiple'	=> false,
					'std'		=> array( 'title' )
			),
			
						
			array(
				'name'		=> 'Show Home Info Box?',
				'id'		=> $prefix."home_info_box",
				'type'		=> 'checkbox',
				'desc'		=> 'Show Home Info Box.',
				'std'		=> true
			),
			
			array(
				'name'		=> 'Show Breadcrumbs?',
				'id'		=> $prefix."breadcrumbs",
				'type'		=> 'checkbox',
				'desc'		=> 'Show / Hide Breadcrumbs.',
				'std'		=> true
			),
			
			array(
			'type' => 'heading',
			'name' => '<h2>'.esc_html__( 'Revolution Slider Title Bar', 'ievent' ).'</h2>',
			'id' => 'heading_001', // Not used but needed for plugin
			),
			
			array(
				'name'		=> 'Revolution Slider',
				'id'		=> $prefix . "revolutionslider",
				'type'		=> 'select',
				'options'	=> $revolutionslider,
				'multiple'	=> false
			),
			
			array(
			'type' => 'heading',
			'name' => '<h2>'.esc_html__( 'Count Down', 'ievent' ).'</h2>',
			'id' => 'heading_001', // Not used but needed for plugin
			),
			
			array(
				'name' => esc_html__( 'Event Start Date', 'ievent' ),
				'id'   => $prefix . 'event_start_date',
				'type' => 'date',
				// jQuery date picker options. See here http://jqueryui.com/demos/datepicker
				'js_options' => array(
					'appendText'      => esc_html__( '(dd-M-yy)', 'ievent' ),
					'autoSize'        => true,
					'buttonText'      => esc_html__( 'Select Date', 'ievent' ),
					'dateFormat'      => esc_html__( 'dd-M-yy', 'ievent' ),
					'numberOfMonths'  => 2,
					'showButtonPanel' => true,
				),
			),
			
			array(
				'name' => esc_html__( 'Event End Date', 'ievent' ),
				'id'   => $prefix . 'event_end_date',
				'type' => 'date',
				// jQuery date picker options. See here http://jqueryui.com/demos/datepicker
				'js_options' => array(
					'appendText'      => esc_html__( '(dd-M-yy)', 'ievent' ),
					'autoSize'        => true,
					'buttonText'      => esc_html__( 'Select Date', 'ievent' ),
					'dateFormat'      => esc_html__( 'dd-M-yy', 'ievent' ),
					'numberOfMonths'  => 2,
					'showButtonPanel' => true,
				),
			),
			
			array(
				'name'		=> 'Event Time',
				'id'		=> $prefix . 'event_time',
				'clone'		=> false,
				'type'		=> 'text',
				'std'		=> '9:00',
				'desc'		=> '9:00'
			),
			
			array(
				'name'		=> 'Event Pre-Title',
				'id'		=> $prefix . 'event_pretitle',
				'clone'		=> false,
				'type'		=> 'text',
				'std'		=> ''
			),
			
			array(
				'name'		=> 'Event Title',
				'id'		=> $prefix . 'event_title',
				'clone'		=> false,
				'type'		=> 'text',
				'std'		=> ''
			),
			
			array(
				'name'		=> 'Event Location',
				'id'		=> $prefix . 'event_location',
				'clone'		=> false,
				'type'		=> 'text',
				'std'		=>'',
				'desc'		=> 'Manama, Kindom of Bahrain'
			),
			
			
			array(
			'type' => 'heading',
			'name' => '<h2>'.esc_html__( 'Video', 'ievent' ).'</h2>',
			'id' => 'heading_001', // Not used but needed for plugin
			),
			
			array(
				'name'		=> 'Paste Video Link',
				'id'		=> $prefix . 'video_link',
				'clone'		=> false,
				'type'		=> 'text',
				'std'		=>'',
				'desc'		=> 'http://www.youtube.com/?v=ew4342rq21'
			),
			
			array(
			'type' => 'heading',
			'name' => '<h2>'.esc_html__( 'Background Image', 'ievent' ).'</h2>',
			'id' => 'heading_001', // Not used but needed for plugin
			),
			
			
			
			array(
				'name'		=> 'Background Image',
				'id'		=> "{$prefix}bg_image",
				'type'      => 'image_advanced',
				'desc'		=> 'Select Background Image.',
				'max_file_uploads' => 1,
					
			),
			
			array(
						'name'		=> 'Background Image Position',
						'id'		=> "{$prefix}bg_image_pos",
						'type'		=> 'select',
						'options'	=> array(
							'top'							=> 'Top',
							'center'							=> 'Center',
							'bottom'						=> 'Bottom'
						),
						'desc'		=> 'Set background image position.',
						'std'		=> true
			),
			
			
					
		)
	);
	
	
	
	
	
	
	/* ----------------------------------------------------- */
	// Testimonial Info Metabox
	/* ----------------------------------------------------- */
	$meta_boxes[] = array(
		'id' => 'testimonial_info',
		'title' => 'Testimonials',
		'pages' => array( 'testimonials' ),
		'context' => 'normal',
		
		
	
		'fields' => array(
			array(
				'type' => 'heading',
				'name' => '<h2>'.esc_html__( 'Testimonials Details', 'ievent' ).'</h2>',
				'id' => 'heading_002', // Not used but needed for plugin
			),
					
			array(
				'name'		=> 'Business / Site Name',
				'id'		=> $prefix . 'testimonial_business_name',
				'type'		=> 'text',
				'std'		=> ''
			),
			array(
				'name'		=> 'link',
				'id'		=> $prefix . 'testimonial_link',
				'clone'		=> false,
				'type'		=> 'text',
				'std'		=> ''
			),
			// HEADING of Page Options 
			array(
				'type' => 'heading',
				'name' => '<h2>'.esc_html__( 'Sidebar Options', 'ievent' ).'</h2>',
				'id' => 'heading_002', // Not used but needed for plugin
			),
			array(
				'name'		=> 'SideBar',
				'id'		=> $prefix."sidebar",
				'type'		=> 'select',
				'options'	=> array(
					'default'					=> 'Default',
					'nosidebar'					=> 'No Sidebar - Full Width',
					'leftsidebar'				=> 'Left Sidebar',
					'rightsidebar'				=> 'Right Sidebar',
				),
				'multiple'	=> false,
				'desc'		=> 'Select sidebar position Left or Right or Full width page.',
				'std'		=> array( 'title' )
			),
			
			
		)
	);

	/* ----------------------------------------------------- */
	// Participants
	/* ----------------------------------------------------- */
	
	$meta_boxes[] = array(
		'id' => 'pagesettings',
		'title' => 'Page Options',
		'pages' => array( 'participants' ),
		'context' => 'normal',
		'priority' => 'high',
	
		// List of meta fields
		'fields' => array(		
			
			
			array(
				'name'		=> 'Email Address',
				'id'		=> $prefix . 'reg_email',
				'clone'		=> false,
				'type'		=> 'text',
				'std'		=> '',
				'desc'		=> ''
			),
			
			array(
				'name'		=> 'Phone',
				'id'		=> $prefix . 'reg_phone',
				'clone'		=> false,
				'type'		=> 'text',
				'std'		=> '',
				'desc'		=> ''
			),
			
			array(
				'name'		=> 'Ticket Type',
				'id'		=> $prefix . 'reg_ticket',
				'clone'		=> false,
				'type'		=> 'text',
				'std'		=> '',
				'desc'		=> ''
			),
			
			array(
				'name'		=> 'Amount',
				'id'		=> $prefix . 'reg_amount',
				'clone'		=> false,
				'type'		=> 'text',
				'std'		=> '',
				'desc'		=> ''
			),
			
			array(
				'name'		=> 'Payment',
				'id'		=> $prefix . 'reg_payment',
				'clone'		=> false,
				'type'		=> 'text',
				'std'		=> '',
				'desc'		=> ''
			)					
		)
	);	
	
	/* ----------------------------------------------------- */
	// Flexslider Info Metabox
	/* ----------------------------------------------------- */
	$meta_boxes[] = array(
		'id' => 'flexslider_info',
		'title' => 'Add Flexslider Information',
		'pages' => array( 'flexslider' ),
		'context' => 'normal',
		
		
	
		'fields' => array(
			
			// Title Bar Heading
			array(
			'type' => 'heading',
			'name' => '<h2>'.esc_html__( 'Title Bar Options', 'ievent' ).'</h2>',
			'id' => 'heading_001', // Not used but needed for plugin
			),
			
			array(
					'name'		=> 'Title Bar',
					'id'		=> $prefix."title_bar",
					'type'		=> 'select',
					'options'	=> array(
						'flexslider'		=> 'Flexslider',
					),
					'desc'		=> 'Set Title Bar style.',
					'multiple'	=> false,
					'std'		=> array( 'title' )
			),
			
			array(
					'name'		=> 'Title Bar',
					'id'		=> $prefix."title_bar_content",
					'type'		=> 'select',
					'options'	=> array(
						'select_title_bar'	=> 'Select Title Bar',
						'count-down'		=> 'Count Down',
						'register-form'		=> 'Registration Form',
						'register-form-2'	=> 'Registration Form 2',
						'video'				=> 'Video',
						'title-box'			=> 'Title Box',
						'title-box-2'		=> 'Title Box #2',
					),
					'desc'		=> 'Set Title Bar style.',
					'multiple'	=> false,
					'std'		=> array( 'title' )
			),
			
			
			array(
				'name'		=> 'Paste Video Link',
				'id'		=> $prefix . 'video_link',
				'clone'		=> false,
				'type'		=> 'text',
				'std'		=>'',
				'desc'		=> 'http://www.youtube.com/?v=ew4342rq21'
			),
			
			array(
			'type' => 'heading',
			'name' => '<h2>'.esc_html__( 'Background Image', 'ievent' ).'</h2>',
			'id' => 'heading_001', // Not used but needed for plugin
			),
			
			
			
			array(
				'name'		=> 'Background Image',
				'id'		=> "{$prefix}bg_image",
				'type'      => 'image_advanced',
				'desc'		=> 'Select Background Image.',
				'max_file_uploads' => 1,
					
			),
			
			array(
						'name'		=> 'Background Image Position',
						'id'		=> "{$prefix}bg_image_pos",
						'type'		=> 'select',
						'options'	=> array(
							'top'							=> 'Top',
							'center'							=> 'Center',
							'bottom'						=> 'Bottom'
						),
						'desc'		=> 'Set background image position.',
						'std'		=> true
			),
			
			array(
			'type' => 'heading',
			'name' => '<h2>'.esc_html__( 'Form', 'ievent' ).'</h2>',
			'id' => 'heading_001', // Not used but needed for plugin
			),
			
			
			array(
				'name' => 'Form Select Values',
				'desc' => 'Insert form select value',
				'id'   => $prefix."form_select",
				'type' => 'textarea',
				'cols' => 5,
				'rows' => 3,
			),	
			
			array(
			'type' => 'heading',
			'name' => '<h2>'.esc_html__( 'Custom Form', 'ievent' ).'</h2>',
			'id' => 'heading_001', // Not used but needed for plugin
			),
			
			
			array(
				'name'		=> 'Custom Form',
				'id'		=> $prefix."form_custom_chkd",
				'type'		=> 'checkbox',
				'desc'		=> 'Enable Custom Form',
				'std'		=> false
			),			
			
			array(
				'name' => 'Add Custom Form Shortcode',
				'desc' => 'Here you can add your own custom form code, such as using Contact Form 7',
				'id'   => $prefix."form_custom_code",
				'type' => 'textarea',
				'cols' => 5,
				'rows' => 3,
			)
			
			
		)
	);
	
	
	/* ----------------------------------------------------- */
	// Partners Logo
	/* ----------------------------------------------------- */
	
	$meta_boxes[] = array(
		'id' => 'pagesettings',
		'title' => 'Page Options',
		'pages' => array( 'partners' ),
		'context' => 'normal',
		'priority' => 'high',
	
		// List of meta fields
		'fields' => array(		
			
			
			array(
				'name'		=> 'Link',
				'id'		=> $prefix . 'partner_link',
				'clone'		=> false,
				'type'		=> 'text',
				'std'		=> '',
				'desc'		=> ''
			),
			
			array(
				'name'		=> 'Partner Logo',
				'id'		=> "{$prefix}partner_logo",
				'type'      => 'image_advanced',
				'desc'		=> 'Upload Partner Logo.',
				'max_file_uploads' => 1,
					
			)	
						
		)
	);
	
	
	/* ----------------------------------------------------- */
	// Speakers Info Metabox
	/* ----------------------------------------------------- */
	$meta_boxes[] = array(
		'id' => 'speaker_info',
		'title' => 'Add Speaker Information',
		'pages' => array( 'speakers' ),
		'context' => 'normal',
		
		
	
		'fields' => array(
			
			array(
				'name'		=> 'Job Position',
				'id'		=> $prefix . 'speaker_position',
				'type'		=> 'text',
				'desc'			=> 'What is you job title?'
			),
			array(
				'name'		=> 'Facebook',
				'id'		=> $prefix . 'speaker_fb',
				'clone'		=> false,
				'type'		=> 'text',
				'desc'			=> 'Type your facebook id'
			),
			array(
				'name'		=> 'Twitter',
				'id'		=> $prefix . 'speaker_twitter',
				'clone'		=> false,
				'type'		=> 'text',
				'desc'			=> 'Type your Twitter id'
			),
			array(
				'name'		=> 'Linkedin',
				'id'		=> $prefix . 'speaker_linkedin',
				'clone'		=> false,
				'type'		=> 'text',
				'desc'			=> 'Type your Linkedin id'
			),
			
			
			//Skills
			
			array(
				'name'		=> 'Skill#1 Label',
				'id'		=> $prefix . 'speaker_skilllabel_1',
				'clone'		=> false,
				'type'		=> 'text',
				'desc'			=> 'Type first skill label'
			),
			
			array(
				'name'		=> 'Skill#1 Percentage',
				'id'		=> $prefix . 'speaker_skillpercentage_1',
				'clone'		=> false,
				'type'		=> 'text',
				'desc'			=> 'Type first skill value in (%) e.g.:70'
			),
			
			array(
				'name'		=> 'Skill#2 Label',
				'id'		=> $prefix . 'speaker_skilllabel_2',
				'clone'		=> false,
				'type'		=> 'text',
				'desc'			=> 'Type first skill label'
			),
			
			array(
				'name'		=> 'Skill#2 Percentage',
				'id'		=> $prefix . 'speaker_skillpercentage_2',
				'clone'		=> false,
				'type'		=> 'text',
				'desc'			=> 'Type first skill value in (%) e.g.:70'
			),
			
			array(
				'name'		=> 'Skill#3 Label',
				'id'		=> $prefix . 'speaker_skilllabel_3',
				'clone'		=> false,
				'type'		=> 'text',
				'desc'			=> 'Type first skill label'
			),
			
			array(
				'name'		=> 'Skill#3 Percentage',
				'id'		=> $prefix . 'speaker_skillpercentage_3',
				'clone'		=> false,
				'type'		=> 'text',
				'desc'			=> 'Type first skill value in (%) e.g.:70'
			),
			
			array(
				'name'		=> 'Skill#4 Label',
				'id'		=> $prefix . 'speaker_skilllabel_4',
				'clone'		=> false,
				'type'		=> 'text',
				'desc'			=> 'Type first skill label'
			),
			
			array(
				'name'		=> 'Skill#4 Percentage',
				'id'		=> $prefix . 'speaker_skillpercentage_4',
				'clone'		=> false,
				'type'		=> 'text',
				'desc'			=> 'Type first skill value in (%) e.g.:70'
			),
		
		)
	);
	
	
	/* ----------------------------------------------------- */
	// Agenda Info Metabox
	/* ----------------------------------------------------- */
	$meta_boxes[] = array(
		'id' => 'agenda_info',
		'title' => 'Add Agenda Information',
		'pages' => array( 'agenda' ),
		'context' => 'normal',
		
		
	
		'fields' => array(
			
			array(
				'name'		=> 'Session Title',
				'id'		=> $prefix . 'session_title',
				'type'		=> 'text',
				'desc'			=> 'Session Title'
			),
			
			array(
				'name'		=> 'Session Time',
				'id'		=> $prefix . 'session_time',
				'type'		=> 'text',
				'desc'			=> 'Session Time'
			),
			
			array(
				'name'		=> 'Session Icon',
				'id'		=> $prefix . 'session_icon',
				'type'		=> 'text',
				'desc'			=> 'Session Icon eg: fa-desktop'
			)
			
			
			
					
		)
	);
	
	
	
	foreach ( $meta_boxes as $meta_box ) {
		new RW_Meta_Box( $meta_box );
	}
}
	
