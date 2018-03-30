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


add_filter( 'rwmb_meta_boxes', 'ct_mb_register_meta_boxes' );

/**
 * Register meta boxes
 *
 * Remember to change "your_prefix" to actual prefix in your project
 *
 * @return void
 */
function ct_mb_register_meta_boxes( $meta_boxes )
{
	/**
	 * prefix of meta keys (optional)
	 * Use underscore (_) at the beginning to make keys hidden
	 * Alt.: You also can make prefix empty to disable it
	 */
	// Better has an underscore as last sign
	$prefix = 'ct_mb_';

	/*-----------------------------------------------------------------------------------*/
	/* PAGE SETTINGS
	/*-----------------------------------------------------------------------------------*/
	$meta_boxes[] = array(
		'id' => 'ct_custom_page_settings',
		'title' => __('Custom Page Settings', 'color-theme-framework'),
		'pages' => array( 'page' ),
		'context' => 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
		'priority' => 'high',
		'fields' => array(
			array(
				'name' => __('Allow Comments', 'color-theme-framework'),
				'id'   => "{$prefix}page_comments",
				'type' => 'checkbox',
				'std'  => 0,
			),
			/*array(
				'name' => __('Custom Page Description', 'color-theme-framework'),
				'desc' => __('Text for page description. Appears under page title.', 'color-theme-framework'),
				'id'   => "{$prefix}page_desc",
				'type' => 'textarea',
				'cols' => '20',
				'rows' => '3',
			),*/
		)
	);


	/*-----------------------------------------------------------------------------------*/
	/* SIDEBAR POSITION
	/*-----------------------------------------------------------------------------------*/
	$meta_boxes[] = array(
		'id'		=> 'ct_sidebar_settings',
		'title'		=> __('Sidebar Position', 'color-theme-framework'),
		'pages'		=> array( 'post', 'page' ),
		'context'	=> 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
		'priority'	=> 'high',
		'fields'	=> array(
			array(
				'name'		=> __('Sidebar Position', 'color-theme-framework'),
				'id'		=> "{$prefix}sidebar_position",
				'type'		=> 'select',
				'std'		=> __('Select Position', 'color-theme-framework'),
				'options'	=> array(	'right-wide'	=> 'Right Wide',
										'left-wide'		=> 'Left Wide',
										'right-narrow'	=> 'Right Narrow',
										'left-narrow'	=> 'Left Narrow'
				),
			),
		)
	);

	/*-----------------------------------------------------------------------------------*/
	/* CUSTOM BACKGROUND SETTINGS
	/*-----------------------------------------------------------------------------------*/
	$meta_boxes[] = array(
		'id'		=> 'ct_custom_backgrounds',
		'title'		=> __('Custom Background Settings', 'color-theme-framework'),
		'pages'		=> array( 'post', 'page' ),
		'context'	=> 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
		'priority'	=> 'high',
		'fields'	=> array(
			array(
				'name'		=> __('Custom Background Image', 'color-theme-framework'),
				'id'		=> "{$prefix}background_image",
				//'type'		=> 'thickbox_image',
				'type'				=> 'image_advanced',
				'max_file_uploads'	=> 2,			
				'desc'		=> __('Upload a custom background image for this page. Once uploaded, click "Insert to Post".', 'color-theme-framework'),
			),
			array(
				'name'     => __('Custom Background Repeat', 'color-theme-framework'),
				'id'       => "{$prefix}background_repeat",
				'type'     => 'select',
				'std'		=> __('Select an Item', 'color-theme-framework'),
				'options'  => array(
					'no-repeat' => 'No Repeat',
					'repeat' => 'Repeat',
					'repeat-x' => 'Repeat Horizontally',
					'repeat-y' => 'Repeat Vertically',
				),
			),
			array(
				'name'     => __('Custom Background Position', 'color-theme-framework'),
				'id'       => "{$prefix}background_position",
				'type'     => 'select',
				'std'		=> __('Select an Item', 'color-theme-framework'),
				'options'  => array(
					'left' => 'Left',
					'right' => 'Right',
					'center' => 'Centered',
					'full' => 'Full Screen',
				),
			),
			array(
				'name'     => __('Custom Background Attachment', 'color-theme-framework'),
				'id'       => "{$prefix}background_attachment",
				'type'     => 'select',
				'std'		=> __('Select an Item', 'color-theme-framework'),
				'options'  => array(
					'fixed' => 'Fixed',
					'scroll' => 'Scroll',
				),
			),
			array(
				'name' => __('Custom Background Color', 'color-theme-framework'),
				'id'   => "{$prefix}background_color",
				'type' => 'color',
				'desc' => __('Select a custom background color for the uploaded image.', 'color-theme-framework'),
				'std' => '',
			),
		)
	);



	/*-----------------------------------------------------------------------------------*/
	/* ADDITIONAL POST SETTINGS
	/*-----------------------------------------------------------------------------------*/
	$meta_boxes[] = array(
		'id'		=> 'ct_post_settings',
		'title'		=> __('Additional Post Settings (applies only to Carousel widget)', 'color-theme-framework'),
		'pages'		=> array( 'post' ),
		'context'	=> 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
		'priority'	=> 'high',
		'fields'	=> array(
			array(
				'name'		=> __('Background Color', 'color-theme-framework'),
				'id'		=> "{$prefix}post_bg_color",
				'type'		=> 'color',
				'desc'		=> __('Select a custom background color', 'color-theme-framework'),
				'std'		=> '',
			),
			array(
				'name'		=> __('Font Color', 'color-theme-framework'),
				'id'		=> "{$prefix}post_font_color",
				'type'		=> 'color',
				'desc'		=> __('Select a custom font color', 'color-theme-framework'),
				'std'		=> '',
			),
		)
	);


	// Metabox for Post Format: Gallery
	$meta_boxes[] = array(
		'title'		=> __('Post Format: Gallery', 'color-theme-framework'),
		'id'		=> 'ct_gallery_format',
		'fields'	=> array(
			array(
				'name'				=> __('Add Images for Gallery', 'color-theme-framework'),
				'id'				=> "{$prefix}gallery",
				'type'				=> 'image_advanced',
				'max_file_uploads'	=> 50,
			),
		)
	);


	// Metabox for Post Format: Video 
	$meta_boxes[] = array(
		'id' => 'ct_video_format',
		'title' => __('Post Format: Video', 'color-theme-framework'),
		'pages' => array( 'post' ),
		'context' => 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
		'priority' => 'high',
		'fields' => array(
			array(
				'name'     => __('Type of Video', 'color-theme-framework'),
				'id'       => "{$prefix}post_video_type",
				'type'     => 'select',
				'std'		=> __('Select an Item', 'color-theme-framework'),
				'options'  => array(
					'vimeo' => 'Vimeo',
					'youtube' => 'Youtube',
					'dailymotion' => 'Dailymotion',
					'custom-video' => 'Custom'
				),
				'multiple' => false,
			),

			array(
				'name'  => __('Video ID', 'color-theme-framework'),
				'id'    => "{$prefix}post_video_file",
				'desc'  => __('Enter Video ID (example: WluQQiXKVc8)', 'color-theme-framework'),
				'type'  => 'text',
				'std'   => '',
				'clone' => false,
			),	
	        array(  
				'name'     => __('Type of Video Thumbnail', 'color-theme-framework'),
				'desc'  => __('Choose the type of thumbnail: auto generated from video service or use featured image', 'color-theme-framework'),
				'id'       => "{$prefix}post_video_thumb",
				'type'     => 'select',
				'std'		=> __('Select an Item', 'color-theme-framework'),
				'options'  => array(
					'player' => 'Iframe player',
					'featured' => 'Featured image'
				),
				'multiple' => false,
	        ),
		)
	);


	// Metabox for Post Format: Audio 
	$meta_boxes[] = array(
		'id' => 'ct_audio_format',
		'title' => __('Post Format: Audio', 'color-theme-framework'),
		'pages' => array( 'post' ),
		'context' => 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
		'priority' => 'high',
		'fields' => array(
			array(
				'name'		=> __('Type of Audio Thumbnail (for the Single post page)', 'color-theme-framework'),
				//'desc'		=> __('Choose the type of thumbnail : iframe player or featured image', 'color-theme-framework' ),
				'id'		=> "{$prefix}post_audio_thumb",
				'type'		=> 'select',
				'std'		=> __('Select an Item', 'color-theme-framework'),
				'options'	=> array(
					'player'	=> 'Iframe Player',
					'featured' => 'Featured Image',
				),
				'multiple' => false,
			),
			array(
				'name'  => __('Code', 'color-theme-framework'),
				'id'    => "{$prefix}sound_code",
				'desc'  => __('Paste the iframe code from any audio\music service', 'color-theme-framework'),
				'type'  => 'textarea',
				'std'   => '',
				'clone' => false,
			),		
		)
	);

	return $meta_boxes;
}