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
 * @link http://www.deluxeblogtips.com/meta-box/
 */


add_filter( 'rwmb_meta_boxes', 'thm_register_meta_boxes' );

/**
 * Register meta boxes
 *
 * @return void
 */
function thm_register_meta_boxes( $meta_boxes )
{
	/**
	 * Prefix of meta keys (optional)
	 * Use underscore (_) at the beginning to make keys hidden
	 * Alt.: You also can make prefix empty to disable it
	 */
	// Better has an underscore as last sign
	$prefix = 'thm_';

		// 1st meta box
	$meta_boxes[] = array(
		'id' => 'post-meta-quote',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => __( 'Post Quote Settings', 'themeum' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'post'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			array(
				// Field name - Will be used as label
				'name'  => __( 'Qoute Text', 'themeum' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}qoute",
				'desc'  => __( 'Write Your Qoute Here', 'themeum' ),
				'type'  => 'textarea',
				// Default value (optional)
				'std'   => ''
			),
			array(
				// Field name - Will be used as label
				'name'  => __( 'Qoute Author', 'themeum' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}qoute_author",
				'desc'  => __( 'Write Qoute Author or Source', 'themeum' ),
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			)
			
		)
	);

	$meta_boxes[] = array(
		'id' => 'post-meta-chat',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => __( 'Post Chat Settings', 'themeum' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'post'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			array(
				// Field name - Will be used as label
				'name'  => __( 'Chat Message', 'themeum' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}chat_text",
				'type' => 'wysiwyg',
				'raw'  => false,
				'options' => array(
					'textarea_rows' => 4,
					'teeny'         => false,
					'media_buttons' => false,
				)
			)
			
		)
	);


	$meta_boxes[] = array(
		'id' => 'post-meta-link',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => __( 'Post Link Settings', 'themeum' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'post'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			array(
				// Field name - Will be used as label
				'name'  => __( 'Link URL', 'themeum' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}link",
				'desc'  => __( 'Write Your Link', 'themeum' ),
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			)
			
		)
	);


	$meta_boxes[] = array(
		'id' => 'post-meta-audio',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => __( 'Post Audio Settings', 'themeum' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'post'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			array(
				// Field name - Will be used as label
				'name'  => __( 'Audio Embed Code', 'themeum' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}audio_code",
				'desc'  => __( 'Write Your Audio Embed Code Here', 'themeum' ),
				'type'  => 'textarea',
				// Default value (optional)
				'std'   => ''
			)
			
		)
	);

	$meta_boxes[] = array(
		'id' => 'post-meta-status',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => __( 'Post Status Settings', 'themeum' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'post'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			array(
				// Field name - Will be used as label
				'name'  => __( 'Status URL', 'themeum' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}status_url",
				'desc'  => __( 'Write Facebook, Twitter etc status link', 'themeum' ),
				'type'  => 'textarea',
				// Default value (optional)
				'std'   => ''
			)
			
		)
	);


	$meta_boxes[] = array(
		'id' => 'post-meta-video',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => __( 'Post Video Settings', 'themeum' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'post'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			array(
				// Field name - Will be used as label
				'name'  => __( 'Video Embed Code/ID', 'themeum' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}video",
				'desc'  => __( 'Write Your Vedio Embed Code/ID Here', 'themeum' ),
				'type'  => 'textarea',
				// Default value (optional)
				'std'   => ''
			),
			array(
				'name'     => __( 'Select Vedio Type/Source', 'themeum' ),
				'id'       => "{$prefix}video_source",
				'type'     => 'select',
				// Array of 'value' => 'Label' pairs for select box
				'options'  => array(
					'1' => __( 'Embed Code', 'themeum' ),
					'2' => __( 'YouTube', 'themeum' ),
					'3' => __( 'Vimeo', 'themeum' ),
				),
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => '1'
			),
			
		)
	);


	$meta_boxes[] = array(
		'id' => 'post-meta-gallery',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => __( 'Post Gallery Settings', 'themeum' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'post'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			array(
				'name'             => __( 'Gallery Image Upload', 'themeum' ),
				'id'               => "{$prefix}gallery_images",
				'type'             => 'image_advanced',
				'max_file_uploads' => 6,
			)			
		)
	);

	$meta_boxes[] = array(
		'id' => 'slider-meta-setting',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => __( 'Additional Infomation', 'themeum' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'slider'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			array(
				// Field name - Will be used as label
				'name'  => __( 'Button Text', 'themeum' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}btn_text",
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			),
			array(
				// Field name - Will be used as label
				'name'  => __( 'Button Link', 'themeum' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}btn_link",
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			),
			array(
				// Field name - Will be used as label
				'name'  => __( 'Button Two Text', 'themeum' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}btn_two_text",
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			),
			array(
				// Field name - Will be used as label
				'name'  => __( 'Button Two Link', 'themeum' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}btn_two_link",
				'type'  => 'text',
				// Default value (optional)
				'std'   => ''
			)	
		)
	);
	//Portfolio
	$meta_boxes[] = array(
		'id' => 'portfolio-meta-setting',
		'title' => __( 'Portfolio Infomation', 'themeum' ),
		'pages' => array( 'portfolio'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(

			array(
				'name'  => __( 'Portfolio Name', 'themeum' ),
				'id'    => "{$prefix}portfolio_client",
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'  => __( 'Portfolio Date', 'themeum' ),
				'id'    => "{$prefix}portfolio_date",
				'type'  => 'date',			
			),
			array(
				'name'  => __( 'Portfolio Site Url', 'themeum' ),
				'id'    => "{$prefix}portfolio_url",
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'  => __( 'Portfolio Video Url', 'themeum' ),
				'id'    => "{$prefix}portfolio_video",
				'type'  => 'text',
				'std'   => ''
			),
		)
	);

	//clienta
	$meta_boxes[] = array(
		'id' => 'client-meta-setting',
		'title' => __( 'Additional Infomation', 'themeum' ),
		'pages' => array( 'client'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(

			array(
				'name'  => __( 'Button Link', 'themeum' ),
				'id'    => "{$prefix}btn_link",
				'type'  => 'text',
				'std'   => ''
			),
		)
	);


	//Testimonial
	$meta_boxes[] = array(
		'id' => 'testimonial-meta-setting',
		'title' => __( 'Additional Infomation', 'themeum' ),
		'pages' => array( 'testimonial'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(

			array(
				'name'  => __( 'Website URL', 'themeum' ),
				'id'    => "{$prefix}website_url",
				'type'  => 'text',
				'std'   => ''
			),			

			array(
				'name'  => __( 'Testimonial Image', 'themeum' ),
				'id'    => "{$prefix}image",
				'type'  => 'image_advanced',
				'max_file_uploads' => 1,
			),
		)
	);


	return $meta_boxes;
}