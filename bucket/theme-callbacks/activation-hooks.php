<?php
// theme activation
function wpgrade_callback_geting_active() {

	/**
	 * make sure pixlikes has the right settings
	 */
	$pixlikes_settings = array(
		'show_on_post' => false,
		'show_on_page' => false,
		'show_on_hompage' => false,
		'show_on_archive' => false,
		'like_action' => 'click',
		'hover_time' => 1000,
		'free_votes' => false,
		'load_likes_with_ajax' => false,
	);
	update_option('pixlikes_settings', $pixlikes_settings);

	/**
	 * Create custom post types, taxonomies and metaboxes
	 * These will be taken by pixtypes plugin and converted in their own options
	 */
	$types_options = get_option('pixtypes_themes_settings');
	if ( empty($types_options) ) {
		$types_options = array();
	}
	$theme_key = wpgrade::shortname() . '_pixtypes_theme';
	$types_options[$theme_key] = array();

	$types_options[$theme_key]['metaboxes'] = array(
		'page' => array(
			'id' => 'page',
			'title' => __('Settings', 'bucket' ),
			'pages'      => array('page'), // Post type
			'context' => 'side',
			'priority' => 'low',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' => __('Prevent Duplicate Posts', 'bucket' ),
					'desc' => '<div class="tooltip" title="'.__('Activate this if you want page composer blocks NOT to display posts displayed above them in the page.<br />The Latest Posts block will ignore this setting.', 'bucket' ).'"></div>',
					'id' => wpgrade::prefix() . 'prevent_duplicate_posts',
					'type' => 'checkbox',
					'std' => '0',
				),
			)
		),
		'post' => array(
			'id' => 'post',
			'title' => __('Settings', 'bucket' ),
			'pages'      => array('post'), // Post type
			'context' => 'side',
			'priority' => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' => __('Full Width Featured Image', 'bucket' ),
					'desc' => '<div class="tooltip" title="'.__('The featured image could be full width if you check this on', 'bucket' ).'"></div>',
					'id' => wpgrade::prefix() . 'full_width_featured_image',
					'type' => 'checkbox',
					'std' => '0',
				),
				array(
					'name' => __('Mark as Featured Post', 'bucket' ),
					'desc' => '<div class="tooltip" title="'.__('Is this post more important than others?', 'bucket' ).'"></div>',
					'id' => wpgrade::prefix() . 'featured_post',
					'type' => 'checkbox',
					'std' => '0',
				),
				array(
					'name' => __('Add to Category Slider', 'bucket' ),
					'desc' => '<div class="tooltip" title="'.__('You can add this post to the category slider', 'bucket' ).'" ></div>',
					'id' => wpgrade::prefix() . 'category_slide',
					'type' => 'checkbox',
					'std' => '0',
				),
				array(
					'name' => __('Disable Sidebar', 'bucket' ),
					'desc' => '<div class="tooltip" title="'.__('You may want this post to be full width', 'bucket' ).'" ></div>',
					'id' => wpgrade::prefix() . 'disable_sidebar',
					'type' => 'checkbox',
					'std' => '0',
				)
			)
		),
		'post_video_format' => array(
			'id' => 'post_format_metabox_video',
			'title' => __('Video Settings', 'bucket' ),
			'pages'      => array('post'), // Post type
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' => __('Embed Code', 'bucket' ),
					'desc' => __('Enter here a Youtube, Vimeo (or other online video services) embed code here. The width should be a minimum of 640px. We will use this if filled, not the selfhosted options bellow!', 'bucket' ),
					'id' => wpgrade::prefix() . 'video_embed',
					'type' => 'textarea_small',
					'std' => '',
				),
			)
		),
		'post_gallery_format' => array(
			'id'         => 'post_format_metabox_gallery',
			'title'      => __('Gallery Settings', 'bucket' ),
			'pages'      => array( 'post' ), // Post type
			'context'    => 'normal',
			'priority'   => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' =>  __('Images', 'bucket' ),
					'id'   =>  wpgrade::prefix() . 'main_gallery',
					'type' => 'gallery',
				),
				array(
					'name' => __('Image Scaling', 'bucket' ),
					'desc' => __('<p class="cmb_metabox_description"><strong>Fill</strong> scales image to completely fill slider container (recommended for landscape images)</p>
<p class="cmb_metabox_description"><strong>Fit</strong> scales image to fit the container (recommended for portrait images)</p>
<p class="cmb_metabox_description"><strong>Fit if Smaller</strong> scales image to fit only if size of slider container is less than size of image.</p>
<p class="cmb_metabox_description"><a target="_blank" href="http://bit.ly/slider-image-scaling">Visual explanation</a></p>', 'bucket' ),
					'id' => wpgrade::prefix() . 'post_slider_image_scale',
					'type' => 'select',
					'show_on'    => array( 'key' => 'select_value', 'value' => array( 'project_template' => 'fullwidth', 'project_template' => 'sidebar' ), ),
					'options' => array(
                        array(
                            'name' => __('Fit', 'bucket' ),
                            'value' => 'fit'
                        ),
                        array(
                            'name' => __('Fill', 'bucket' ),
                            'value' => 'fill'
                        ),
                        array(
                            'name' => __('Fit if Smaller', 'bucket' ),
                            'value' => 'fit-if-smaller'
                        )
					),
					'std' => 'fill'					
				),

				array(
					'name' => __('Slider height', 'bucket' ),
					'desc' => __('Enter a slider height here (only digits, without \'px\'). If left blank, it will default to 525px', 'bucket' ),
					'id' => wpgrade::prefix() . 'post_slider_height',
					'type' => 'text_small',
					'std' => '',
				),				
				array(
					'name' => __('Show Nearby Images', 'bucket' ),
					'desc' => __('Enable this if you want to avoid having empty space on the sides of the image when using mostly portrait images.', 'bucket' ),
					'id' => wpgrade::prefix() . 'post_slider_visiblenearby',
					'type' => 'select',
					'options' => array(
						array(
							'name' => __('Enabled', 'bucket' ),
							'value' => true
						),
						array(
							'name' => __('Disabled', 'bucket' ),
							'value' => false
						)
					),
					'std' => false
				),
				array(
					'name' => __('Slider transition', 'bucket' ),
					'id' => wpgrade::prefix() . 'post_slider_transition',
					'type' => 'select',
					'options' => array(
						array(
							'name' => __('Slide/Move', 'bucket' ),
							'value' => 'move'
						),
						array(
							'name' => __('Fade', 'bucket' ),
							'value' => 'fade'
						)
					),
					'std' => 'move'
				),
				array(
					'name' => __('Slider autoplay', 'bucket' ),
					'id' => wpgrade::prefix() . 'post_slider_autoplay',
					'type' => 'select',
					'options' => array(
						array(
							'name' => __('Enabled', 'bucket' ),
							'value' => true
						),
						array(
							'name' => __('Disabled', 'bucket' ),
							'value' => false
						)
					),
					'std' => false
				),
				array(
					'name' => __('Autoplay delay between slides (in milliseconds)', 'bucket' ),
					'id' => wpgrade::prefix() . 'post_slider_delay',
					'type' => 'text_small',
					'std' => '1000'
				),
			)
		),
//		'post_quote_format' => array(
//			'id' => 'post_format_metabox_quote',
//			'title' =>  __('Quote Settings', 'bucket' ),
//			'pages'      => array( 'post' ), // Post type
//			'context' => 'normal',
//			'priority' => 'high',
//			'show_names' => true, // Show field names on the left
//			'fields' => array(
//				array(
//					'name' =>  __('Quote Content', 'bucket' ),
//					'desc' => __('Please type the text of your quote here.', 'bucket' ),
//					'id' => wpgrade::prefix() . 'quote',
//					'type' => 'wysiwyg',
//					'std' => '',
//					'options' => array (
//						'textarea_rows' => 4,
//					),
//				),
//				array(
//					'name' => __('Author Name', 'bucket' ),
//					'desc' => '',
//					'id' => wpgrade::prefix() . 'quote_author',
//					'type' => 'text',
//					'std' => '',
//				),
//				array(
//					'name' => __('Author Title', 'bucket' ),
//					'desc' => '',
//					'id' => wpgrade::prefix() . 'quote_author_title',
//					'type' => 'text',
//					'std' => '',
//				),
//				array(
//					'name' => __('Author Link', 'bucket' ),
//					'desc' => __('Insert here an url if you want the author name to be linked to that address.', 'bucket' ),
//					'id' => wpgrade::prefix() . 'quote_author_link',
//					'type' => 'text',
//					'std' => '',
//				),
//			)
//		),
		'post_audio_format' => array(
			'id' => 'post_format_metabox_audio',
			'title' =>  __('Audio Settings', 'bucket' ),
			'pages'      => array( 'post'), // Post type
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' => __('Embed Code', 'bucket' ),
					'desc' => __('Enter here a embed code here. The width should be a minimum of 640px.', 'bucket' ),
					'id' => wpgrade::prefix() . 'audio_embed',
					'type' => 'textarea_small',
					'std' => '',
				),
				array(
					'name' => __('MP3 File URL', 'bucket' ),
					'desc' => __('Please enter in the URL to the .mp3 file', 'bucket' ),
					'id' => wpgrade::prefix() . 'audio_mp3',
					'type' => 'file',
					'std' => ''
				),
				array(
					'name' => __('M4A File URL', 'bucket' ),
					'desc' => __('Please enter in the URL to the .m4a file', 'bucket' ),
					'id' => wpgrade::prefix() . 'audio_m4a',
					'type' => 'file',
					'std' => ''
				),
				array(
					'name' => __('OGA File URL', 'bucket' ),
					'desc' => __('Please enter in the URL to the .ogg or .oga file', 'bucket' ),
					'id' => wpgrade::prefix() . 'audio_ogg',
					'type' => 'file',
					'std' => ''
				),
				array(
					'name' => __('Poster Image', 'bucket' ),
					'desc' => __('This will be the image displayed above the audio controls. The image should be at least 640px wide. Click the "Upload" button to open the Media Manager, and click "Use as Poster Image" once you have uploaded or chosen an image from the media library.', 'bucket' ),
					'id' => wpgrade::prefix() . 'audio_poster',
					'type' => 'file',
					'std' => ''
				),
			)
		),
	);

	update_option('pixtypes_themes_settings', $types_options);

	// flush permalinks rules on theme activation
	flush_rewrite_rules();
}

add_action('after_switch_theme', 'wpgrade_callback_geting_active');