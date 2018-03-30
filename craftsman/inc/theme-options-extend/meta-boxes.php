<?php
/*	
*	---------------------------------------------------------------------
*	MNKY Custom meta boxes
*	--------------------------------------------------------------------- 
*/


add_action( 'admin_init', 'mnky_custom_meta_boxes' );

function mnky_custom_meta_boxes() {
  
   	if (is_plugin_active('revslider/revslider.php')) {
		global $wpdb;
		$rs = $wpdb->get_results( 
			"
			SELECT id, title, alias
			FROM ".$wpdb->prefix."revslider_sliders
			ORDER BY id ASC LIMIT 999
			"
		);
		$revsliders = array();
		if ($rs) {
			foreach ( $rs as $slider ) {
				$revsliders[] = array('label' => $slider->title, 'value' => $slider->alias);
			}
		} else {
			$revsliders[] = array('label' => 'No sliders found', 'value' => '');
		}
	} else {
		$revsliders[] = array('label' => 'To use this option please install "Slider Revolution"', 'value' => '');
	}	
	
	$rev_on_of = array(
		'label'       => __( 'Revolution slider', 'craftsman' ),
		'id'          => 'rev_on_off',
		'type'        => 'on-off',
		'desc'        => 'Add Revolution slider before content.',
		'std'         => 'off',
		'condition'   => 'pre_content_activation:is(on)'
	);
	$rev_dropdown = array(
		'id'          => 'rev_slider_header',
		'label'       => __( 'Select slider', 'craftsman' ),
		'desc'        => '',
		'std'         => '',
		'type'        => 'select',
		'choices'     => $revsliders,
		'operator'    => 'and',
		'condition'   => 'rev_on_off:is(on),pre_content_activation:is(on)'
	);

	$mnky_meta_page = array(
		'id'          => 'mnky_page_options',
		'title'       => __( 'Advanced Options', 'craftsman' ),
		'desc'        => '',
		'pages'       => array( 'page', 'post', 'essential_grid', 'product', 'portfolio' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(
		    array(
				'label'       => __( 'Custom theme accent color', 'craftsman' ),
				'id'          => 'custom_accent_color',
				'desc'        => __( 'Set different accent color for this page. Leave blank for default color.', 'craftsman' ),
				'std'         => '',
				'type'        => 'colorpicker',
			 ),
			array(
				'label'       => __( 'Page title', 'craftsman' ),
				'id'          => 'page_title',
				'type'        => 'on-off',
				'desc'        => 'Display or hide page/post title',
				'std'         => 'on'
			),      
			array(
				'id'          => 'custom_title_bg',
				'label'       => __( 'Custom title background', 'craftsman' ),
				'desc'        => __( 'You can either use color or upload a background image. Leave blank for default setting.', 'craftsman' ),
				'std'         => '',
				'type'        => 'background',
				'condition'   => 'page_title:is(on)',
			),
			array(
				'label'       => __( 'Pre-content area', 'craftsman' ),
				'id'          => 'pre_content_activation',
				'type'        => 'on-off',
				'desc'        => __( 'Activates additional area before page title and main content', 'craftsman' ),
				'std'         => 'off'
			 ),
			array(
				'label'       => '',
				'id'          => 'bct_textblock',
				'type'        => 'textblock',
				'desc'        => '<div class="section-title">'. __( 'Pre-content area options', 'craftsman' ) .'</div>',
				'condition'   => 'pre_content_activation:is(on)'
			),
			array(
				'label'       => __( 'Height (optional)', 'craftsman' ),
				'id'          => 'pre_content_height',
				'type'        => 'text',
				'desc'        => __( 'Pre-content area height. Example: <code>250px</code>', 'craftsman' ),
				'condition'   => 'pre_content_activation:is(on)'
			),
			$rev_on_of,
			$rev_dropdown,
			array(
				'id'          => 'pre_content_bg',
				'label'       => 'Background',
				'desc'        => 'Set custom background color or image',
				'type'        => 'background',
				'rows'        => '',
				'condition'   => 'pre_content_activation:is(on)'
			),
			array(
				'label'       => __( 'Custom HTML', 'craftsman' ),
				'id'          => 'pre_content_html',
				'type'        => 'textarea',
				'rows'        => '4',
				'desc'        => __( 'Insert any custom code you wish. <code>Shortcodes</code> allowed!', 'craftsman' ),
				'condition'   => 'pre_content_activation:is(on)'
			)
		)
	);
	
	$mnky_meta_post = array(
		'id'          => 'mnky_post_options',
		'title'       => __( 'Post Format Options', 'craftsman' ),
		'desc'        => '',
		'pages'       => array( 'post' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(
			array(
				'label'       => __( 'Image link', 'craftsman' ),
				'id'          => 'image_embed',
				'type'        => 'text',
				'desc'        => sprintf(__('Link to the image (if image post format selected).  Or use "Featured image" option instead. More about supported formats at %s.', 'craftsman'), '<a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">WordPress codex</a>')
			),
			array(
				'label'       => __( 'Audio link', 'craftsman' ),
				'id'          => 'audio_embed',
				'type'        => 'text',
				'desc'        => sprintf(__('Link to the audio (if audio post format selected). Or attach audio file to post instead. More about supported formats at %s.', 'craftsman'), '<a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">WordPress codex</a>')
			),
			array(
				'label'       => __( 'Video link', 'craftsman' ),
				'id'          => 'video_embed',
				'type'        => 'text',
				'desc'        => sprintf(__('Link to the video (if video post format selected). More about supported formats at %s.', 'craftsman'), '<a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">WordPress codex</a>')
			),
			array(
				'label'       => '',
				'id'          => 'gallery_options_textblock',
				'type'        => 'textblock',
				'desc'        => '<div class="section-title">'. __( 'Gallery post format', 'craftsman' ) .'</div>'
			),
			array(
				'id'          => 'gallery_animation',
				'label'       => __('Animation style', 'craftsman' ),
				'desc'        => '',
				'std'         => 'fade',
				'type'        => 'radio',
				'desc'        => __( 'This option will determine the animation type of the slider', 'craftsman' ),
				'choices'     => array( 
					array(
						'value'       => 'fade',
						'label'       => __( 'Fade', 'craftsman' ),
						'src'         => ''
					),
					array(
						'value'       => 'slide',
						'label'       => __( 'Slide', 'craftsman' ),
						'src'         => ''
					)
				)
			),
			array(
				'label'       => __( 'Slide delay (milliseconds)', 'craftsman' ),
				'id'          => 'gallery_delay',
				'type'        => 'text',
				'std'         => '4000',
				'desc'        => __( 'Set the speed of the slideshow cycling, in milliseconds', 'craftsman' ),
			),
			array(
				'label'       => __( 'Slider height (px)', 'craftsman' ),
				'id'          => 'gallery_height',
				'type'        => 'text',
				'std'         => '500',
			),
		)
	);


  
	if ( function_exists( 'ot_register_meta_box' ) ) {
		ot_register_meta_box( $mnky_meta_page );
		ot_register_meta_box( $mnky_meta_post );
	}
}