<?php

$meta_boxes = array(
	'title' => sprintf( __( 'Testimonial Details', MYSITE_ADMIN_TEXTDOMAIN ), THEME_NAME ),
	'id' => 'mysite_testimonial_meta_box',
	'pages' => array( 'testimonial' ),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __( 'Image', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Select the type of image you\'d liked displayed with your testimonial.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => '_image',
			'options' => array( 
				'use_gravatar' => __( 'Use Gravatar', MYSITE_ADMIN_TEXTDOMAIN ),
				'upload_picture' => __( 'Upload Picture', MYSITE_ADMIN_TEXTDOMAIN ),
				'no_image' => __( 'No Image', MYSITE_ADMIN_TEXTDOMAIN )
			),
			'toggle' => 'toggle_true',
			'type' => 'radio'
		),
		array(
			'name' => __( 'Custom Image', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Upload an image to use for this testimonial.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => '_custom_image',
			'toggle_class' => '_image_upload_picture',
			'type' => 'upload'
		),
		array(
			'name' => __( 'Email <small>(for Gravatar support)</small>', MYSITE_TEXTDOMAIN ),
			'desc' => __( 'Enter the email address for the Gravatar you\'d like displayed, if no Gravatar is found your themes default will be used.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => '_email',
			'toggle_class' => '_image_use_gravatar',
			'type' => 'text'
		),
		array(
			'name' => __( 'Name', MYSITE_TEXTDOMAIN ),
			'desc' => __( 'Enter the name for this testimonial.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => '_name',
			'type' => 'text'
		),
		array(
			'name' => __( 'Website Name', MYSITE_TEXTDOMAIN ),
			'desc' => __( 'Enter the website name for this testimonial.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => '_website_name',
			'type' => 'text'
		),
		array(
			'name' => __( 'Website URL', MYSITE_TEXTDOMAIN ),
			'desc' => __( 'Enter the website url for this testimonial.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => '_website_url',
			'type' => 'text'
		),
		array(
			'name' => __( 'Testimonial', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter your testimonial.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => '_testimonial',
			'no_header' => true,
			'type' => 'editor'
		),
	)
);
return array(
	'load' => true,
	'options' => $meta_boxes
);

?>