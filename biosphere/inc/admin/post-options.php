<?php
/**
 * Initialize the meta boxes. 
 */
add_action( 'admin_init', '_dd_theme_post_options' );

/**
 * Metabox options
 */
function _dd_theme_post_options() {
  
  	global $dd_sn;

	$dd_custom_options = array(
		'id'          => 'post_options',
		'title'       => 'Post Options',
		'desc'        => 'Theme specific options for blog posts.',
		'pages'       => array( 'post' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(
			array(
				'id'      => $dd_sn . 'layout',
				'label'   => 'Layout',
				'desc'    => 'Choose which layout do you want for this post, full content or with sidebar.',
				'std'     => 'cs',
				'type'    => 'select',
				'class'   => '',
				'choices' => array(
					array(
						'value'       => 'fc',
						'label'       => 'Full Content',
					),
					array(
						'value'       => 'cs',
						'label'       => 'Content + Sidebar',
					),
				)
			),
		)
	);
  
  	ot_register_meta_box( $dd_custom_options );

  	$dd_custom_options = array(
		'id'          => 'page_options',
		'title'       => 'Page Options',
		'desc'        => 'Theme specific options for pages.',
		'pages'       => array( 'page' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(
			array(
				'id'      => $dd_sn . 'layout',
				'label'   => 'Layout',
				'desc'    => 'Choose which layout do you want for this page, full content or with sidebar.',
				'std'     => 'fc',
				'type'    => 'select',
				'class'   => '',
				'choices' => array(
					array(
						'value'       => 'fc',
						'label'       => 'Full Content',
					),
					array(
						'value'       => 'cs',
						'label'       => 'Content + Sidebar',
					),
				)
			),
			array(
				'id'      => $dd_sn . 'post_width',
				'label'   => 'Item Width',
				'desc'    => 'Choose the width of the items.',
				'std'     => 'fc',
				'type'    => 'select',
				'class'   => '',
				'choices' => array(
					array(
						'value'       => 'one_fourth',
						'label'       => '1/4',
					),
					array(
						'value'       => 'one_third',
						'label'       => '1/3',
					),
					array(
						'value'       => 'one_half',
						'label'       => '1/2',
					),
				)
			),
			array(
				'id'      => $dd_sn . 'posts_per_page',
				'label'   => 'Posts per Page',
				'desc'    => 'How many posts to show per page.',
				'std'     => '10',
				'type'    => 'text',
				'class'   => '',
			),
		)
	);
  
  	ot_register_meta_box( $dd_custom_options );

  	$dd_custom_options = array(
		'id'          => 'gallery_options',
		'title'       => 'Gallery Options',
		'desc'        => 'Theme specific options for galleries.',
		'pages'       => array( 'dd_gallery' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(
			array(
				'id'      => $dd_sn . 'layout',
				'label'   => 'Layout',
				'desc'    => 'Choose which layout do you want for this post, full content or with sidebar.',
				'std'     => 'cs',
				'type'    => 'select',
				'class'   => '',
				'choices' => array(
					array(
						'value'       => 'fc',
						'label'       => 'Full Content',
					),
					array(
						'value'       => 'cs',
						'label'       => 'Content + Sidebar',
					),
				)
			),
			array(
				'id'      => $dd_sn . 'header_image',
				'label'   => 'Header Image',
				'desc'    => 'Upload an image that will serve as the background image. If none uploaded the default will be used (from theme options).',
				'std'     => '',
				'type'    => 'upload',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'gallery_images',
				'label'   => 'Gallery Images',
				'desc'    => 'Add images for this gallery.',
				'std'     => '',
				'type'    => 'list-item',
				'class'   => '',
				'settings' => array(
					array(
						'label'       => 'Gallery Image',
						'id'          => $dd_sn . 'gallery_image',
						'type'        => 'upload',
					),
				)
			),
		)
	);
  
  	ot_register_meta_box( $dd_custom_options );

  	$dd_custom_options = array(
		'id'          => 'events_options',
		'title'       => 'Events Options',
		'desc'        => 'Theme specific options for event posts.',
		'pages'       => array( 'dd_events' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(
			array(
				'id'      => $dd_sn . 'layout',
				'label'   => 'Layout',
				'desc'    => 'Choose which layout do you want for this event, full content or with sidebar.',
				'std'     => 'cs',
				'type'    => 'select',
				'class'   => '',
				'choices' => array(
					array(
						'value'       => 'fc',
						'label'       => 'Full Content',
					),
					array(
						'value'       => 'cs',
						'label'       => 'Content + Sidebar',
					),
				)
			),
			array(
				'id'      => $dd_sn . 'event_facebook_link',
				'label'   => 'Facebook Page',
				'desc'    => 'Link to the facebook page for this event.',
				'std'     => '',
				'type'    => 'text',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'event_date',
				'label'   => 'Event Date',
				'desc'    => 'By default the date when the event is scheduled is shown.<br><br>This is only to be used if for example an event starts on July 10th and ends on July 12th, this is where you type July 10th and schedule the post for July 12th..',
				'std'     => '',
				'type'    => 'text',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'event_info',
				'label'   => 'Event Info',
				'desc'    => 'Add the info about the event, such as where is it located.',
				'std'     => '',
				'type'    => 'list-item',
				'class'   => '',
				'settings' => array(
					array(
						'label' => 'Value',
						'id' => 'value',
						'type' => 'text',
					),
				)
			),
		)
	);
  
  	ot_register_meta_box( $dd_custom_options );

  	$dd_custom_options = array(
		'id'          => 'product_options',
		'title'       => 'Product Options',
		'desc'        => 'Theme specific options for WooCommerce product posts.',
		'pages'       => array( 'product' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(
			array(
				'id'      => $dd_sn . 'product_bg',
				'label'   => 'Background Color',
				'desc'    => 'Choose the background color for this product.',
				'std'     => '',
				'type'    => 'colorpicker',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'product_color_style',
				'label'   => 'Text Color',
				'desc'    => 'Affects the text color of the title, excerpt and other elements. If you have a dark bg use light color style and vice versa.',
				'std'     => 'light',
				'type'    => 'select',
				'class'   => '',
				'choices' => array(
					array(
						'label' => 'Light',
						'value' => 'light',
					),
					array(
						'label' => 'Dark',
						'value' => 'dark',
					)
				)
			),
		)
	);
  
  	ot_register_meta_box( $dd_custom_options );

  	$dd_custom_options = array(
		'id'          => 'cause_options',
		'title'       => 'Cause Options',
		'desc'        => 'Theme specific options for causes.',
		'pages'       => array( 'dd_causes' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(
			array(
				'id'      => $dd_sn . 'layout',
				'label'   => 'Layout',
				'desc'    => 'Choose which layout do you want for this post, full content or with sidebar.',
				'std'     => 'cs',
				'type'    => 'select',
				'class'   => '',
				'choices' => array(
					array(
						'value'       => 'fc',
						'label'       => 'Full Content',
					),
					array(
						'value'       => 'cs',
						'label'       => 'Content + Sidebar',
					),
				)
			),
			array(
				'id'      => $dd_sn . 'cause_amount_needed',
				'label'   => 'Donation Goal',
				'desc'    => 'How much is the donation goal for this cause.',
				'std'     => '0',
				'type'    => 'text',
			),
			array(
				'id'      => $dd_sn . 'cause_amount_current',
				'label'   => 'Donation Current Amount',
				'desc'    => 'This is increased automatically, but in case you need to change it you can do it here.',
				'std'     => '0',
				'type'    => 'text',
			),
			array(
				'id'      => $dd_sn . 'cause_featured',
				'label'   => 'Staff\'s pick',
				'desc'    => 'Enable if you want to feature the cause (shows in staff\'s pick)',
				'std'     => 'no',
				'type'    => 'select',
				'choices' => array(
					array(
						'value'       => 'yes',
						'label'       => 'Yes',
					),
					array(
						'value'       => 'no',
						'label'       => 'No',
					),
				)
			),
			array(
				'id'      => $dd_sn . 'donate_lightbox_title',
				'label'   => 'Donate Lightbox - Title',
				'desc'    => 'The title for the donate lightbox, if none supplied the one from Theme Options will be shown.',
				'std'     => '',
				'type'    => 'text',
			),
			array(
				'id'      => $dd_sn . 'donate_lightbox_desc',
				'label'   => 'Donate Lightbox - Description',
				'desc'    => 'The description for the donate lightbox, if none supplied the one from Theme Options will be shown.',
				'std'     => '',
				'type'    => 'textarea',
			),
			array(
				'id'      => $dd_sn . 'cause_custom_more_details_link',
				'label'   => 'Cause Single - "More Details" Link - Custom URL',
				'desc'    => 'If you want the more details link (in causes listing) to go to a custom URL enter it here.',
				'std'     => '',
				'type'    => 'text',
			),
			array(
				'id'      => $dd_sn . 'cause_custom_make_donation_link',
				'label'   => 'Cause Listing - "Make Donation" Link - Custom URL',
				'desc'    => 'If you want the make a donation link (in causes listing) to go to a custom URL enter it here.',
				'std'     => '',
				'type'    => 'text',
			),
			array(
				'id'      => $dd_sn . 'cause_single_custom_make_donation_link',
				'label'   => 'Cause Single - "Make Donation" Link - Custom URL',
				'desc'    => 'If you want the make a donation link (in causes single page) to go to a custom URL enter it here.',
				'std'     => '',
				'type'    => 'text',
			),
			array(
				'id'      => $dd_sn . 'cause_info_widget',
				'label'   => 'Cause Single - Info Widget',
				'desc'    => 'The info widget that shows information about donations for the cause. <br><br><strong>Important</strong> If you want to disable it everywhere you can do so in the Theme Options > Causes > Cause Single - Info Widget.',
				'std'     => 'enabled',
				'type'    => 'select',
				'choices' => array(
					array(
						'label' => 'Enabled',
						'value' => 'enabled',
					),
					array(
						'label' => 'Disabled',
						'value' => 'disabled',
					),
				),
			),
		)
	);
  
  	ot_register_meta_box( $dd_custom_options );

  	$dd_custom_options = array(
		'id'          => 'dd_staff_options',
		'title'       => 'Staff Member Options',
		'desc'        => 'Theme specific options for staff members.',
		'pages'       => array( 'dd_staff' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(
			array(
				'id'      => $dd_sn . 'position',
				'label'   => 'Position',
				'desc'    => 'On which position is this staff member employed. Example: Lead Designer',
				'std'     => '',
				'type'    => 'text',
			),
			array(
				'id'      => $dd_sn . 'twitter',
				'label'   => 'Twitter',
				'desc'    => 'Link to the social profile of this person',
				'std'     => '',
				'type'    => 'text',
			),
			array(
				'id'      => $dd_sn . 'facebook',
				'label'   => 'Facebook',
				'desc'    => 'Link to the social profile of this person',
				'std'     => '',
				'type'    => 'text',
			),
			array(
				'id'      => $dd_sn . 'gplus',
				'label'   => 'Google Plus',
				'desc'    => 'Link to the social profile of this person',
				'std'     => '',
				'type'    => 'text',
			),
			array(
				'id'      => $dd_sn . 'linkedin',
				'label'   => 'LinkedIn',
				'desc'    => 'Link to the social profile of this person',
				'std'     => '',
				'type'    => 'text',
			),
			array(
				'id'      => $dd_sn . 'email',
				'label'   => 'Email',
				'desc'    => 'Use the "mailto" version. ( mailto:someone@example.com )',
				'std'     => '',
				'type'    => 'text',
			),
		)
	);
	  
	ot_register_meta_box( $dd_custom_options );

	$dd_custom_options = array(
		'id'          => 'dd_sponsors_options',
		'title'       => 'Sponsor Options',
		'desc'        => 'Theme specific options for sponsors.',
		'pages'       => array( 'dd_sponsors' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(
			array(
				'id'      => $dd_sn . 'sponsor_link',
				'label'   => 'Link',
				'desc'    => 'The URL to the sponsor\'s website.',
				'std'     => '',
				'type'    => 'text',
			),
		)
	);
	  
	ot_register_meta_box( $dd_custom_options );

}