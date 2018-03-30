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
		'label'       => __( 'Revolution slider', 'care' ),
		'id'          => 'rev_on_off',
		'type'        => 'on-off',
		'desc'        => 'Add Revolution slider before content.',
		'std'         => 'off',
		'condition'   => 'pre_content_activation:is(on)'
	);
	$rev_dropdown = array(
		'id'          => 'rev_slider_header',
		'label'       => __( 'Select slider', 'care' ),
		'desc'        => '',
		'std'         => '',
		'type'        => 'select',
		'choices'     => $revsliders,
		'operator'    => 'and',
		'condition'   => 'rev_on_off:is(on),pre_content_activation:is(on)'
	);

	$mnky_meta_page = array(
		'id'          => 'mnky_page_options',
		'title'       => __( 'Advanced Options', 'care' ),
		'desc'        => '',
		'pages'       => array( 'page', 'post', 'essential_grid', 'product' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(
			array(
				'label'       => __( 'Show Title', 'care' ),
				'id'          => 'page_title',
				'type'        => 'on-off',
				'desc'        => 'Display or hide page title',
				'std'         => 'on'
			),
			array(
				'label'       => __( 'Pre-content area', 'care' ),
				'id'          => 'pre_content_activation',
				'type'        => 'on-off',
				'desc'        => __( 'Activates additional area before page title and main content', 'care' ),
				'std'         => 'off'
			 ),
			array(
				'label'       => '',
				'id'          => 'bct_textblock',
				'type'        => 'textblock',
				'desc'        => '<div class="section-title">'. __( 'Pre-content area options', 'care' ) .'</div>',
				'condition'   => 'pre_content_activation:is(on)'
			),
			array(
				'label'       => __( 'Height (optional)', 'care' ),
				'id'          => 'pre_content_height',
				'type'        => 'text',
				'desc'        => __( 'Pre-content area height. Example: <code>250px</code>', 'care' ),
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
				'label'       => __( 'Custom HTML', 'care' ),
				'id'          => 'pre_content_html',
				'type'        => 'textarea',
				'rows'        => '4',
				'desc'        => __( 'Insert any custom code you wish. <code>Shortcodes</code> allowed!', 'care' ),
				'condition'   => 'pre_content_activation:is(on)'
			)
		)
	);
	
	$mnky_meta_post = array(
		'id'          => 'mnky_post_options',
		'title'       => __( 'Post Format Options', 'care' ),
		'desc'        => '',
		'pages'       => array( 'post' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(
			array(
				'label'       => __( 'Image link', 'care' ),
				'id'          => 'image_embed',
				'type'        => 'text',
				'desc'        => sprintf(__('Link to the image (if image post format selected).  Or use "Featured image" option instead. More about supported formats at %s.', 'care'), '<a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">WordPress codex</a>')
			),
			array(
				'label'       => __( 'Audio link', 'care' ),
				'id'          => 'audio_embed',
				'type'        => 'text',
				'desc'        => sprintf(__('Link to the audio (if audio post format selected). Or attach audio file to post instead. More about supported formats at %s.', 'care'), '<a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">WordPress codex</a>')
			),
			array(
				'label'       => __( 'Video link', 'care' ),
				'id'          => 'video_embed',
				'type'        => 'text',
				'desc'        => sprintf(__('Link to the video (if video post format selected). More about supported formats at %s.', 'care'), '<a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">WordPress codex</a>')
			),
			array(
				'label'       => '',
				'id'          => 'gallery_options_textblock',
				'type'        => 'textblock',
				'desc'        => '<div class="section-title">'. __( 'Gallery post format', 'care' ) .'</div>'
			),
			array(
				'id'          => 'gallery_animation',
				'label'       => __('Animation style', 'care' ),
				'desc'        => '',
				'std'         => 'fade',
				'type'        => 'radio',
				'desc'        => __( 'This option will determine the animation type of the slider', 'care' ),
				'choices'     => array( 
					array(
						'value'       => 'fade',
						'label'       => __( 'Fade', 'care' ),
						'src'         => ''
					),
					array(
						'value'       => 'slide',
						'label'       => __( 'Slide', 'care' ),
						'src'         => ''
					)
				)
			),
			array(
				'label'       => __( 'Slide delay (milliseconds)', 'care' ),
				'id'          => 'gallery_delay',
				'type'        => 'text',
				'std'         => '4000',
				'desc'        => __( 'Set the speed of the slideshow cycling, in milliseconds', 'care' ),
			),
			array(
				'label'       => __( 'Slider height (px)', 'care' ),
				'id'          => 'gallery_height',
				'type'        => 'text',
				'std'         => '500',
			),
		)
	);
	
		$mnky_meta_portfolio = array(
		'id'          => 'mnky_portfolio_options',
		'title'       => __( 'Portfolio Item Options', 'care' ),
		'desc'        => '',
		'pages'       => array( 'portfolio' ),
		'context'     => 'side',
		'priority'    => 'core',
		'fields'      => array(
			array(
				'id'          => 'portfolio_layout',
				'label'       => __('Portfolio Item Layout', 'care' ),
				'std'         => 'fixed-width',
				'type'        => 'radio',
				'desc'        => '',
				'choices'     => array( 
					array(
						'value'       => 'fixed-width',
						'label'       => __( 'Fixed width', 'care' ),
						'src'         => ''
					),
					array(
						'value'       => 'full-width',
						'label'       => __( 'Full width', 'care' ),
						'src'         => ''
					)
				)
			),
			array(
				'label'       => __( 'Featured Image In Post', 'care' ),
				'id'          => 'portfolio_featured_image',
				'type'        => 'on-off',
				'desc'        => '',
				'std'         => 'on'
			),
			array(
				'label'       => __( 'Image Width', 'care' ),
				'id'          => 'portfolio_image_width',
				'type'        => 'text',
				'desc'        => '',
				'std'         => '1100',
				'condition'   => 'portfolio_featured_image:is(on)'
			),			
			array(
				'label'       => __( 'Image Height', 'care' ),
				'id'          => 'portfolio_image_height',
				'type'        => 'text',
				'desc'        => '',
				'std'         => '400',
				'condition'   => 'portfolio_featured_image:is(on)'
			),
		)
	);


  
	if ( function_exists( 'ot_register_meta_box' ) ) {
		ot_register_meta_box( $mnky_meta_page );
		ot_register_meta_box( $mnky_meta_post );
		ot_register_meta_box( $mnky_meta_portfolio );
	}
}