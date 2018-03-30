<?php
// theme activation
function wpgrade_callback_geting_active() {

	/**
	 * make sure pixlikes has the right settings
	 */
	$pixlikes_settings = array(
		'show_on_post'         => true,
		'show_on_page'         => false,
		'show_on_hompage'      => true,
		'show_on_archive'      => true,
		'like_action'          => 'click',
		'hover_time'           => 1000,
		'free_votes'           => false,
		'load_likes_with_ajax' => false,
	);
	update_option( 'pixlikes_settings', $pixlikes_settings );

	/**
	 * Create custom post types, taxonomies and metaboxes
	 * These will be taken by pixtypes plugin and converted in their own options
	 */
	$types_options = get_option( 'pixtypes_themes_settings' );
	if ( empty( $types_options ) ) {
		$types_options = array();
	}
	$theme_key                   = 'heap_pixtypes_theme';
	$types_options[ $theme_key ] = array();

	$types_options[ $theme_key ]['metaboxes'] = array(
		'post_video_format'   => array(
			'id'         => 'post_format_metabox_video',
			'title'      => __( 'Video Settings', 'heap' ),
			'pages'      => array( 'post' ), // Post type
			'context'    => 'normal',
			'priority'   => 'high',
			'show_names' => true, // Show field names on the left
			'fields'     => array(
				array(
					'name' => __( 'Embed Code', 'heap' ),
					'desc' => __( 'Enter here a Youtube, Vimeo (or other online video services) embed code here. The width should be a minimum of 640px. We will use this if filled, not the selfhosted options bellow!', 'heap' ),
					'id'   => '_heap_video_embed',
					'type' => 'textarea_small',
					'std'  => '',
				),
			)
		),
		'post_gallery_format' => array(
			'id'         => 'post_format_metabox_gallery',
			'title'      => __( 'Gallery Settings', 'heap' ),
			'pages'      => array( 'post' ), // Post type
			'context'    => 'normal',
			'priority'   => 'high',
			'show_names' => true, // Show field names on the left
			'fields'     => array(
				array(
					'name' => __( 'Images', 'heap' ),
					'id'   => '_heap_main_gallery',
					'type' => 'gallery',
				),
				array(
					'name'    => __( 'Image Scaling', 'heap' ),
					'desc'    => __( '<p class="cmb_metabox_description"><strong>Fill</strong> scales image to completely fill slider container (recommended for landscape images)</p>
<p class="cmb_metabox_description"><strong>Fit</strong> scales image to fit the container (recommended for portrait images)</p>
<p class="cmb_metabox_description"><strong>Fit if Smaller</strong> scales image to fit only if size of slider container is less than size of image.</p>
<p class="cmb_metabox_description"><a target="_blank" href="http://bit.ly/slider-image-scaling">Visual explanation</a></p>', 'heap' ),
					'id'      => '_heap_post_image_scale_mode',
					'type'    => 'select',
					'options' => array(
						array(
							'name'  => __( 'Fit', 'heap' ),
							'value' => 'fit'
						),
						array(
							'name'  => __( 'Fill', 'heap' ),
							'value' => 'fill'
						),
						array(
							'name'  => __( 'Fit if Smaller', 'heap' ),
							'value' => 'fit-if-smaller'
						)
					),
					'std'     => 'fill'
				),
				array(
					'name' => __( 'Slider height', 'heap' ),
					'desc' => __( '<p class="cmb_metabox_description">Enter a slider height here (only digits, without \'px\').</p>
<p class="cmb_metabox_description">If left blank, it will default to 525px.</p>
<p class="cmb_metabox_description">If 0 it will stretch to each image height.</p>', 'heap' ),
					'id'   => '_heap_post_slider_height',
					'type' => 'text_small',
					'std'  => '',
				),
				array(
					'name'    => __( 'Show Nearby Images', 'heap' ),
					'desc'    => __( 'Enable this if you want to avoid having empty space on the sides of the image when using mostly portrait images.', 'heap' ),
					'id'      => '_heap_post_slider_visiblenearby',
					'type'    => 'select',
					'options' => array(
						array(
							'name'  => __( 'Enabled', 'heap' ),
							'value' => true
						),
						array(
							'name'  => __( 'Disabled', 'heap' ),
							'value' => false
						)
					),
					'std'     => false
				),
				array(
					'name'    => __( 'Slider transition', 'heap' ),
					'id'      => '_heap_post_slider_transition',
					'type'    => 'select',
					'options' => array(
						array(
							'name'  => __( 'Slide/Move', 'heap' ),
							'value' => 'move'
						),
						array(
							'name'  => __( 'Fade', 'heap' ),
							'value' => 'fade'
						)
					),
					'std'     => 'move'
				),
				array(
					'name'    => __( 'Slider autoplay', 'heap' ),
					'id'      => '_heap_post_slider_autoplay',
					'type'    => 'select',
					'options' => array(
						array(
							'name'  => __( 'Enabled', 'heap' ),
							'value' => true
						),
						array(
							'name'  => __( 'Disabled', 'heap' ),
							'value' => false
						)
					),
					'std'     => false
				),
				array(
					'name' => __( 'Autoplay delay between slides (in milliseconds)', 'heap' ),
					'id'   => '_heap_post_slider_delay',
					'type' => 'text_small',
					'std'  => '1000',
					'display_on' => array(
						'display' => true,
						'on'      => array(
							'field' => '_heap_post_slider_autoplay',
							'value' => true
						)
					),
				)
			)
		),
		'post_quote_format'   => array(
			'id'         => 'post_format_metabox_quote',
			'title'      => __( 'Quote Settings', 'heap' ),
			'pages'      => array( 'post' ), // Post type
			'context'    => 'normal',
			'priority'   => 'high',
			'show_names' => true, // Show field names on the left
			'fields'     => array(
				array(
					'name'    => __( 'Quote Content', 'heap' ),
					'desc'    => __( 'Please type the text of your quote here.', 'heap' ),
					'id'      => '_heap_quote',
					'type'    => 'wysiwyg',
					'std'     => '',
					'options' => array(
						'textarea_rows' => 4,
					),
				),
				array(
					'name' => __( 'Author Name', 'heap' ),
					'desc' => '',
					'id'   => '_heap_quote_author',
					'type' => 'text',
					'std'  => '',
				),
				array(
					'name' => __( 'Author Title', 'heap' ),
					'desc' => '',
					'id'   => '_heap_quote_author_title',
					'type' => 'text',
					'std'  => '',
				),
				array(
					'name' => __( 'Author Link', 'heap' ),
					'desc' => __( 'Insert here an url if you want the author name to be linked to that address.', 'heap' ),
					'id'   => '_heap_quote_author_link',
					'type' => 'text',
					'std'  => '',
				),
			)
		),
		'post_audio_format'   => array(
			'id'         => 'post_format_metabox_audio',
			'title'      => __( 'Audio Settings', 'heap' ),
			'pages'      => array( 'post' ), // Post type
			'context'    => 'normal',
			'priority'   => 'high',
			'show_names' => true, // Show field names on the left
			'fields'     => array(
				array(
					'name' => __( 'Embed Code', 'heap' ),
					'desc' => __( 'Enter here a embed code here. The width should be a minimum of 640px.', 'heap' ),
					'id'   => '_heap_audio_embed',
					'type' => 'textarea_small',
					'std'  => '',
				),
			)
		),
	);

	update_option( 'pixtypes_themes_settings', $types_options );

	/**
	 * http://wordpress.stackexchange.com/questions/36152/flush-rewrite-rules-not-working-on-plugin-deactivation-invalid-urls-not-showing
	 * nothing from above works in plugin so ...
	 */
	delete_option( 'rewrite_rules' );

	// Ensure theme defaults
}

add_action( 'after_switch_theme', 'wpgrade_callback_geting_active' );
