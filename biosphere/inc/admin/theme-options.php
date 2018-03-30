<?php

/**
 * Initialize the options before anything else. 
 */
add_action( 'admin_init', 'dd_theme_options', 1 );

/**
 * Build the custom settings & update OptionTree.
 */
function dd_theme_options() {
  	
	global $dd_sn;
	global $sitepress;

	/**
	 * Revolution Slider
	 */

	$rev_sliders = dd_revslider_get_slides();
  	$rev_choices = array();
  	$rev_choices[] = array(
  		'label' => 'Disabled',
  		'value' => 'disabled'
  	);
  	if ( ! empty( $rev_sliders ) ) {
	  	foreach ( $rev_sliders as $rev_slider ) {
	  		$rev_choices[] = array(
	  			'label' => $rev_slider->title,
	  			'value' => $rev_slider->alias
	  		);
	  	}
	}

	/**
	 * WPML COMPATIBILITY
	 */

		if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {

			// Language vars
			$dd_langs = icl_get_languages('skip_missing=0&orderby=id&order=asc');
			$dd_lang_default = $sitepress->get_default_language();
			$dd_lang_current = ICL_LANGUAGE_CODE;

		}

		/**
		 * Get Slider Settings
		 */

			if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {

				foreach ( $dd_langs as $dd_lang ) {					

					// Switch lang
					$sitepress->switch_lang( $dd_lang['language_code'] );

					// Blog Posts

					$blog_posts = get_posts( array( 'numberposts' => -1, 'suppress_filters' => 0 ) );

					$blog_posts_array = array();

					foreach ( $blog_posts as $blog_post ) {
						
						$post_id = $blog_post->ID;
						$post_title = $blog_post->post_title;

						$blog_posts_array[] = array(
							'label' => $post_title,
							'value' => $post_id
						);

					}

					// Events

					$events = get_posts( array( 'numberposts' => -1, 'post_type' => 'dd_events', 'post_status' => array( 'publish', 'future' ), 'suppress_filters' => 0  ) );

					$events_array = array();

					foreach ( $events as $event ) {
						
						$post_id = $event->ID;
						$post_title = $event->post_title;

						$events_array[] = array(
							'label' => $post_title,
							'value' => $post_id
						);

					}

					// Causes

					$causes = get_posts( array( 'numberposts' => -1, 'post_type' => 'dd_causes', 'suppress_filters' => 0  ) );

					$causes_array = array();

					foreach ( $causes as $cause ) {
						
						$post_id = $cause->ID;
						$post_title = $cause->post_title;

						$causes_array[] = array(
							'label' => $post_title,
							'value' => $post_id
						);

					}					

					// Back to default lang
					$sitepress->switch_lang( $dd_lang_current );

					// Generate settings

					$slider_settings_var_name = 'slider_settings' . $dd_lang['language_code'];
					$$slider_settings_var_name = array(
						array(
							'label' => 'Type',
							'id' => 'type',
							'type' => 'select',
							'std' => 'none',
							'choices' => array(
								array(
									'label' => 'Choose',
									'value' => 'none',
								),
								array(
									'label' => 'Custom',
									'value' => 'custom',
								),
								array(
									'label' => 'Blog',
									'value' => 'blog',
								),
								array(
									'label' => 'Event',
									'value' => 'event',
								),
								array(
									'label' => 'Cause',
									'value' => 'cause',
								),
							),
						),
						array(
							'label' => 'Blog Post',
							'id' => 'blog_post',
							'type' => 'select',
							'std' => '',
							'choices' => $blog_posts_array
						),
						array(
							'label' => 'Event',
							'id' => 'event',
							'type' => 'select',
							'std' => '',
							'choices' => $events_array
						),
						array(
							'label' => 'Cause',
							'id' => 'cause',
							'type' => 'select',
							'std' => '',
							'choices' => $causes_array
						),
						array(
							'label' => 'Image',
							'id' => 'image',
							'type' => 'upload',
						),
						array(
							'label' => 'Description',
							'id' => 'description',
							'type' => 'textarea_simple',
						),
						array(
							'label' => 'Link',
							'id' => 'link',
							'type' => 'text',
						)
					);

				}

			}



		/**
		 * Generate Sections
		 */

			$sections_append = array();
			$settings_append = array();
			$sections_append_comb = array();
			$settings_append_comb = array();

			if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {

				// Loop all languages and generate content

				foreach ( $dd_langs as $dd_lang ) {

					// If not the default language

					if ( $dd_lang_default != $dd_lang['language_code'] ) {

						// Switch lang
						$sitepress->switch_lang( $dd_lang['language_code'] );

						/**
						 * Blog Categories (for usage in options)
						 */

						$blog_cats = get_categories();
						$blog_cats_array = array();

						$blog_cats_array[] = array(
							'label' => 'All',
							'value' => 'all'
						);

						if ( ! empty( $blog_cats ) ) {

							foreach ( $blog_cats as $blog_cat ) {
								
								$blog_cats_array[] = array(
									'label' => $blog_cat->name,
									'value' => $blog_cat->term_id
								);

							}

						}

						/**
						 * Causes Categories (for usage in options)
						 */

						$causes_cats = get_terms( 'dd_causes_cats' );
						$causes_cats_array = array();

						$causes_cats_array[] = array(
							'label' => 'All',
							'value' => 'all'
						);

						if ( ! empty( $causes_cats ) ) {

							foreach ( $causes_cats as $causes_cat ) {
								
								$causes_cats_array[] = array(
									'label' => $causes_cat->name,
									'value' => $causes_cat->slug
								);

							}

						}

						// Back to default lang
						$sitepress->switch_lang( $dd_lang_current );

						// Get the language info

						$dd_lang_code = $dd_lang['language_code'];
						$dd_lang_name = $dd_lang['native_name'];
						$slider_settings_var_name = 'slider_settings' . $dd_lang_code;

						// Generate new sections

						$sections_append = 	array( 
							array(
								'id'    => $dd_sn . $dd_lang_code . 'general',
								'title' => $dd_lang_name . ' General'
							),
							array(
								'id'    => $dd_sn . $dd_lang_code . 'header',
								'title' => $dd_lang_name . ' Header'
							),
							array(
								'id'    => $dd_sn . $dd_lang_code . 'slider',
								'title' => $dd_lang_name . ' Slider'
							),
							array(
								'id'    => $dd_sn . $dd_lang_code . 'footer',
								'title' => $dd_lang_name . ' Footer'
							),
							array(
								'id'    => $dd_sn . $dd_lang_code . 'homepage',
								'title' => $dd_lang_name . ' Homepage'
							),
							array(
								'id'    => $dd_sn . $dd_lang_code . 'other',
								'title' => $dd_lang_name . ' Other'
							),
						);

						// Generate new options

						$settings_append = array(

							// General

							array(
								'id'      => $dd_sn . $dd_lang_code . 'logo',
								'label'   => 'Logo',
								'desc'    => 'Upload the logo.',
								'std'     => '',
								'type'    => 'upload',
								'section' => $dd_sn . $dd_lang_code . 'general',
								'class'   => '',
							),
							array(
								'id'      => $dd_sn . $dd_lang_code . 'favicon',
								'label'   => 'Favicon',
								'desc'    => 'Upload the favicon. That\'s the little icon that shows up in the browser tab.',
								'std'     => '',
								'type'    => 'upload',
								'section' => $dd_sn . $dd_lang_code . 'general',
								'class'   => '',
							),					

							// Header

							array(
								'id'      => $dd_sn . $dd_lang_code . 'header_search',
								'label'   => 'Search',
								'desc'    => 'Located at the end of the social section.',
								'std'     => 'enabled',
								'type'    => 'select',
								'section' => $dd_sn . $dd_lang_code . 'header',
								'choices' => array(
									array(
										'label' => 'Enabled',
										'value' => 'enabled'
									),
									array(
										'label' => 'Disabled',
										'value' => 'disabled'
									),
								)
							),
							array(
								'id'      => $dd_sn . $dd_lang_code . 'social_twitter',
								'label'   => 'Twitter URL',
								'desc'    => 'Shown in the social section in the bottom right corner of the header. Enter full URL.',
								'std'     => '',
								'type'    => 'text',
								'section' => $dd_sn . $dd_lang_code . 'header',
							),
							array(
								'id'      => $dd_sn . $dd_lang_code . 'social_facebook',
								'label'   => 'Facebook URL',
								'desc'    => 'Shown in the social section in the bottom right corner of the header. Enter full URL.',
								'std'     => '',
								'type'    => 'text',
								'section' => $dd_sn . $dd_lang_code . 'header',
							),
							array(
								'id'      => $dd_sn . $dd_lang_code . 'social_vimeo',
								'label'   => 'Vimeo URL',
								'desc'    => 'Shown in the social section in the bottom right corner of the header. Enter full URL.',
								'std'     => '',
								'type'    => 'text',
								'section' => $dd_sn . $dd_lang_code . 'header',
							),
							array(
								'id'      => $dd_sn . $dd_lang_code . 'social_googleplus',
								'label'   => 'Google+ URL',
								'desc'    => 'Shown in the social section in the bottom right corner of the header. Enter full URL.',
								'std'     => '',
								'type'    => 'text',
								'section' => $dd_sn . $dd_lang_code . 'header',
							),
							array(
								'id'      => $dd_sn . $dd_lang_code . 'social_flickr',
								'label'   => 'Flickr URL',
								'desc'    => 'Shown in the social section in the bottom right corner of the header. Enter full URL.',
								'std'     => '',
								'type'    => 'text',
								'section' => $dd_sn . $dd_lang_code . 'header',
							),
							array(
								'id'      => $dd_sn . $dd_lang_code . 'social_pinterest',
								'label'   => 'Pinterest URL',
								'desc'    => 'Shown in the social section in the bottom right corner of the header. Enter full URL.',
								'std'     => '',
								'type'    => 'text',
								'section' => $dd_sn . $dd_lang_code . 'header',
							),
							array(
								'id'      => $dd_sn . $dd_lang_code . 'social_linkedin',
								'label'   => 'Linkedin URL',
								'desc'    => 'Shown in the social section in the bottom right corner of the header. Enter full URL.',
								'std'     => '',
								'type'    => 'text',
								'section' => $dd_sn . $dd_lang_code . 'header',
							),
							array(
								'id'      => $dd_sn . $dd_lang_code . 'social_dribbble',
								'label'   => 'Dribbble URL',
								'desc'    => 'Shown in the social section in the bottom right corner of the header. Enter full URL.',
								'std'     => '',
								'type'    => 'text',
								'section' => $dd_sn . $dd_lang_code . 'header',
							),
							array(
								'id'      => $dd_sn . $dd_lang_code . 'social_instagram',
								'label'   => 'Instagram URL',
								'desc'    => 'Shown in the social section in the bottom right corner of the header. Enter full URL.',
								'std'     => '',
								'type'    => 'text',
								'section' => $dd_sn . $dd_lang_code . 'header',
							),
							array(
								'id'      => $dd_sn . $dd_lang_code . 'social_behance',
								'label'   => 'Behance URL',
								'desc'    => 'Shown in the social section in the bottom right corner of the header. Enter full URL.',
								'std'     => '',
								'type'    => 'text',
								'section' => $dd_sn . $dd_lang_code . 'header',
							),

							// Slider						

							array(
								'id'      => $dd_sn . $dd_lang_code . 'slider_regrev',
								'label'   => 'Slider Type',
								'desc'    => 'Choose the type of the slider, regular that comes with the theme or revolution slider.',
								'std'     => 'regular',
								'type'    => 'select',
								'section' => $dd_sn . $dd_lang_code . 'slider',
								'class'   => '',
								'choices' => array(
									array(
										'label' => 'Regular',
										'value' => 'regular',
									),
									array(
										'label' => 'Revolution',
										'value' => 'revolution',
									)
								),
							),

							array(
								'id'      => $dd_sn . $dd_lang_code . 'slider_revolution',
								'label'   => 'Revolution Slider',
								'desc'    => 'Choose the revolution slider you want to show on the homepage.',
								'std'     => 'disabled',
								'type'    => 'select',
								'section' => $dd_sn . $dd_lang_code . 'slider',
								'class'   => '',
								'choices' => $rev_choices
							),

							array(
								'id'      => $dd_sn . $dd_lang_code . 'slider',
								'label'   => 'Regular Slider - Slides',
								'desc'    => 'Slides to be used for the regular slider on the homepage.',
								'std'     => '',
								'type'    => 'list-item',
								'section' => $dd_sn . $dd_lang_code . 'slider',
								'class'   => '',
								'settings' => $$slider_settings_var_name
							),	

							// Footer

							array(
								'id'      => $dd_sn . $dd_lang_code . 'footer_banner_img',
								'label'   => 'Banner - BG Image',
								'desc'    => 'Upload the image for the background.',
								'std'     => '',
								'type'    => 'upload',
								'section' => $dd_sn . $dd_lang_code . 'footer',
								'class'   => '',
							),
							array(
								'id'      => $dd_sn . $dd_lang_code . 'footer_banner_title',
								'label'   => 'Banner - Title',
								'desc'    => 'Enter the title for the banner',
								'std'     => 'Create a nice banner like this one with a few simple clicks',
								'type'    => 'text',
								'section' => $dd_sn . $dd_lang_code . 'footer',
								'class'   => '',
							),
							array(
								'id'      => $dd_sn . $dd_lang_code . 'footer_banner_descr',
								'label'   => 'Banner - Description',
								'desc'    => 'Enter the description for the banner.',
								'std'     => 'Etiam molestie, quam eget dignissim dapibus, diam libero auctor justo, a eleifend urna tellus et ligula. Curabitur elementum diam nec lacus pretium.',
								'type'    => 'text',
								'section' => $dd_sn . $dd_lang_code . 'footer',
								'class'   => '',
							),
							array(
								'id'      => $dd_sn . $dd_lang_code . 'footer_banner_button_text',
								'label'   => 'Banner - Button Text',
								'desc'    => 'Enter the text for the button.',
								'std'     => 'MAKE A DONATION NOW',
								'type'    => 'text',
								'section' => $dd_sn . $dd_lang_code . 'footer',
								'class'   => '',
							),
							array(
								'id'      => $dd_sn . $dd_lang_code . 'footer_banner_button_link',
								'label'   => 'Banner - Button Link',
								'desc'    => 'Enter the full URL the button will link to.',
								'std'     => '#',
								'type'    => 'text',
								'section' => $dd_sn . $dd_lang_code . 'footer',
								'class'   => '',
							),

							// Homepage

							array(
								'id'      => $dd_sn . $dd_lang_code . 'home_sections',
								'label'   => 'Home Sections',
								'desc'    => 'Choose which sections you want to show and in which order..',
								'std'     => '',
								'type'    => 'list-item',
								'section' => $dd_sn . $dd_lang_code . 'homepage',
								'settings' => array(
									array(
										'label' => 'Module',
										'id' => $dd_sn . 'module',
										'type' => 'select',
										'choices' => array(
											array(
												'label' => 'Causes',
												'value' => 'causes'
											),
											array(
												'label' => 'News',
												'value' => 'news'
											),
											array(
												'label' => 'Events',
												'value' => 'events'
											),
											array(
												'label' => 'Staff',
												'value' => 'staff'
											),
											array(
												'label' => 'Products',
												'value' => 'products'
											),
											array(
												'label' => 'Sponsors',
												'value' => 'sponsors'
											),
											array(
												'label' => 'Textual',
												'value' => 'text'
											),
										)
									),
									array(
										'label' => 'Amount of Posts',
										'id' => $dd_sn . 'module_amount_posts',
										'std' => '8',
										'type' => 'text',
									),
									array(
										'label' => 'Post Width',
										'id' => $dd_sn . 'module_post_width',
										'std' => 'one_fourth',
										'type' => 'select',
										'desc' => 'If using <strong>news module</strong> or <strong>causes module</strong> choose the post width here',
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
										'label' => 'Blog Category',
										'id' => $dd_sn . 'module_blog_cat',
										'std' => 'all',
										'type' => 'select',
										'desc' => 'If using <strong>blog module</strong> choose the category here.',
										'choices' => $blog_cats_array
									),
									array(
										'label' => 'Causes Category',
										'id' => $dd_sn . 'module_causes_cat',
										'std' => 'all',
										'type' => 'select',
										'desc' => 'If using <strong>causes module</strong> choose the category here.',
										'choices' => $causes_cats_array
									),
									array(
										'label' => 'Content',
										'id' => $dd_sn . 'module_text_content',
										'std' => '',
										'type' => 'textarea',
										'desc' => 'If using <strong>text module</strong> add your content here. You can use HTML here.'
									),
								)
							),

							array(
								'id'      => $dd_sn . $dd_lang_code . 'donate_page_title',
								'label'   => 'Donate Page - Title',
								'desc'    => 'The title that shows on the donate page.',
								'std'     => '',
								'type'    => 'text',
								'section' => $dd_sn . $dd_lang_code . 'other',
								'class'   => '',
							),
							array(
								'id'      => $dd_sn . $dd_lang_code . 'donate_page_description',
								'label'   => 'Donate Page - Description',
								'desc'    => 'The description that shows on the donate page.',
								'std'     => '',
								'type'    => 'text',
								'section' => $dd_sn . $dd_lang_code . 'other',
								'class'   => '',
							),
							array(
								'id'      => $dd_sn . $dd_lang_code . 'donate_overlay_title',
								'label'   => 'Donate Lightbox - Title',
								'desc'    => 'The title that shows in the donate lightbox (donating to specific cause).',
								'std'     => '',
								'type'    => 'text',
								'section' => $dd_sn . $dd_lang_code . 'other',
								'class'   => '',
							),
							array(
								'id'      => $dd_sn . $dd_lang_code . 'donate_overlay_description',
								'label'   => 'Donate Lightbox - Description',
								'desc'    => 'The description that shows in the donate lightbox (donating to specific cause).',
								'std'     => '',
								'type'    => 'text',
								'section' => $dd_sn . $dd_lang_code . 'other',
								'class'   => '',
							),
							array(
								'id'      => $dd_sn . $dd_lang_code . 'signin_overlay_title',
								'label'   => 'Sign In Lightbox - Title',
								'desc'    => 'The title that shows in the members sign in lightbox.',
								'std'     => '',
								'type'    => 'text',
								'section' => $dd_sn . $dd_lang_code . 'other',
								'class'   => '',
							),
								array(
								'id'      => $dd_sn . $dd_lang_code . 'signin_overlay_description',
								'label'   => 'Sign In Lightbox - Description',
								'desc'    => 'The description that shows in the members sign in lightbox.',
								'std'     => '',
								'type'    => 'text',
								'section' => $dd_sn . $dd_lang_code . 'other',
								'class'   => '',
							),


						);

					}

					// Append to the combined array

					$sections_append_comb = array_merge( $sections_append_comb, $sections_append );
					$settings_append_comb = array_merge( $settings_append_comb, $settings_append );

			}

		}

	/**
	 * SLIDER SETTINGS
	 */

		$args = array(
			'hierarchical' => 0,
			'parent' => 0,
		); 
		$pages = get_pages($args);

		$pages_array = array();

		$pages_array[] = array(
				'label' => 'Disabled',
				'value' => 'disabled'
			);

		foreach ( $pages as $page) {

			$page_id = $page->ID;
			$page_title = $page->post_title;

			$pages_array[] = array(
				'label' => $page_title,
				'value' => $page_id
			);
		}

		/**
		 * Blog Posts (for usage in options)
		 */

		$blog_posts = get_posts( array( 'numberposts' => -1 ) );

		$blog_posts_array = array();

		foreach ( $blog_posts as $blog_post ) {
			
			$post_id = $blog_post->ID;
			$post_title = $blog_post->post_title;

			$blog_posts_array[] = array(
				'label' => $post_title,
				'value' => $post_id
			);

		}

		/**
		 * Events (for usage in options)
		 */

		$events = get_posts( array( 'numberposts' => -1, 'post_type' => 'dd_events', 'post_status' => array( 'publish', 'future' ) ) );

		$events_array = array();

		foreach ( $events as $event ) {
			
			$post_id = $event->ID;
			$post_title = $event->post_title;

			$events_array[] = array(
				'label' => $post_title,
				'value' => $post_id
			);

		}

		/**
		 * Causes (for usage in options)
		 */

		$causes = get_posts( array( 'numberposts' => -1, 'post_type' => 'dd_causes' ) );

		$causes_array = array();

		foreach ( $causes as $cause ) {
			
			$post_id = $cause->ID;
			$post_title = $cause->post_title;

			$causes_array[] = array(
				'label' => $post_title,
				'value' => $post_id
			);

		}

		/**
		 * Blog Categories (for usage in options)
		 */

		$blog_cats = get_categories();
		$blog_cats_array = array();

		$blog_cats_array[] = array(
			'label' => 'All',
			'value' => 'all'
		);

		if ( ! empty( $blog_cats ) ) {

			foreach ( $blog_cats as $blog_cat ) {
				
				$blog_cats_array[] = array(
					'label' => $blog_cat->name,
					'value' => $blog_cat->term_id
				);

			}

		}

		/**
		 * Causes Categories (for usage in options)
		 */

		$causes_cats = get_terms( 'dd_causes_cats' );
		$causes_cats_array = array();

		$causes_cats_array[] = array(
			'label' => 'All',
			'value' => 'all'
		);

		if ( ! empty( $causes_cats ) ) {

			foreach ( $causes_cats as $causes_cat ) {
				
				$causes_cats_array[] = array(
					'label' => $causes_cat->name,
					'value' => $causes_cat->slug
				);

			}

		}
		

	/**
	 * SLIDE SETTING
	 */


	/**
 	 * Get a copy of the saved settings array. 
	 */
	$saved_settings = get_option( 'option_tree_settings', array() );

	/**
	 * Custom settings array that will eventually be 
	 * passes to the OptionTree Settings API Class.
	 */
	$custom_settings = array(

		/**
		* The help text.
		*/
		'contextual_help' => array(
			'content' => array( 
				array(
					'id'      => $dd_sn . 'general_help',
					'title'   => 'General',
					'content' => '&nbsp;'
				)
			),
			'sidebar' => '&nbsp;',
		),
		/**
		* Define sections.
		*/
		'sections' => array(
			array(
				'id'    => $dd_sn . 'general',
				'title' => 'General'
			),
			array(
				'id'    => $dd_sn . 'header',
				'title' => 'Header'
			),
			array(
				'id'    => $dd_sn . 'slider',
				'title' => 'Slider'
			),
			array(
				'id'    => $dd_sn . 'homepage',
				'title' => 'Homepage'
			),
			array(
				'id'    => $dd_sn . 'donations',
				'title' => 'Donations (Causes)'
			),
			array(
				'id'    => $dd_sn . 'footer',
				'title' => 'Footer'
			),
			array(
				'id'    => $dd_sn . 'code',
				'title' => 'Custom Code'
			),
			array(
				'id'    => $dd_sn . 'other',
				'title' => 'Other'
			),
		),
		
		/**
		 * Settings
		 */
		'settings' => array(

			/**
			 * General
			 */
			array(
				'id'      => $dd_sn . 'logo',
				'label'   => 'Logo',
				'desc'    => 'Upload the logo.',
				'std'     => '',
				'type'    => 'upload',
				'section' => $dd_sn . 'general',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'favicon',
				'label'   => 'Favicon',
				'desc'    => 'Upload the favicon. That\'s the little icon that shows up in the browser tab.',
				'std'     => '',
				'type'    => 'upload',
				'section' => $dd_sn . 'general',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'analytics',
				'label'   => 'Analytics',
				'desc'    => 'Copy your complete analytics code you got from Google Analytics or whichever analytics solution you are using.',
				'std'     => '',
				'type'    => 'textarea_simple',
				'section' => $dd_sn . 'general',
				'class'   => '',
			),

			/**
			 * Header
			 */
			array(
				'id'      => $dd_sn . 'header_sticky',
				'label'   => 'Sticky Header',
				'desc'    => 'Enable/Disable the sticky header.',
				'std'     => 'disabled',
				'type'    => 'select',
				'section' => $dd_sn . 'header',
				'class'   => '',
				'choices' => array(
					array(
						'label' => 'Enabled',
						'value' => 'enabled',
					),
					array(
						'label' => 'Disabled',
						'value' => 'disabled',
					)
				),
			),
			array(
				'id'      => $dd_sn . 'header_bt_donate',
				'label'   => 'Button - Donate',
				'desc'    => 'Enable/Disable the donation button. You need to have a page with the <strong>Donate</strong> template for this button to show up.',
				'std'     => 'enabled',
				'type'    => 'select',
				'section' => $dd_sn . 'header',
				'class'   => '',
				'choices' => array(
					array(
						'label' => 'Enabled',
						'value' => 'enabled',
					),
					array(
						'label' => 'Disabled',
						'value' => 'disabled',
					)
				),
			),
			array(
				'id'      => $dd_sn . 'header_bt_language',
				'label'   => 'Button - Language (WPML)',
				'desc'    => 'Enable/Disable the language button. WPML needs to be installed for this button to show up.',
				'std'     => 'enabled',
				'type'    => 'select',
				'section' => $dd_sn . 'header',
				'class'   => '',
				'choices' => array(
					array(
						'label' => 'Enabled',
						'value' => 'enabled',
					),
					array(
						'label' => 'Disabled',
						'value' => 'disabled',
					)
				),
			),
			array(
				'id'      => $dd_sn . 'header_bt_cart',
				'label'   => 'Button - Shoping Cart (WooCommerce)',
				'desc'    => 'Enable/Disable the donation button. WooCommerce needs to be installed for this button to show up.',
				'std'     => 'enabled',
				'type'    => 'select',
				'section' => $dd_sn . 'header',
				'class'   => '',
				'choices' => array(
					array(
						'label' => 'Enabled',
						'value' => 'enabled',
					),
					array(
						'label' => 'Disabled',
						'value' => 'disabled',
					)
				),
			),
			array(
				'id'      => $dd_sn . 'header_user_links',
				'label'   => 'User Links',
				'desc'    => 'Enable/Disable the log in and register links.',
				'std'     => 'enabled',
				'type'    => 'select',
				'section' => $dd_sn . 'header',
				'class'   => '',
				'choices' => array(
					array(
						'label' => 'Enabled',
						'value' => 'enabled',
					),
					array(
						'label' => 'Disabled',
						'value' => 'disabled',
					)
				),
			),
			array(
				'id'      => $dd_sn . 'header_search',
				'label'   => 'Search',
				'desc'    => 'Located at the end of the social section.',
				'std'     => 'enabled',
				'type'    => 'select',
				'section' => $dd_sn . 'header',
				'choices' => array(
					array(
						'label' => 'Enabled',
						'value' => 'enabled'
					),
					array(
						'label' => 'Disabled',
						'value' => 'disabled'
					),
				)
			),
			array(
				'id'      => $dd_sn . 'social_twitter',
				'label'   => 'Twitter URL',
				'desc'    => 'Shown in the social section in the bottom right corner of the header. Enter full URL.',
				'std'     => '',
				'type'    => 'text',
				'section' => $dd_sn . 'header',
			),
			array(
				'id'      => $dd_sn . 'social_facebook',
				'label'   => 'Facebook URL',
				'desc'    => 'Shown in the social section in the bottom right corner of the header. Enter full URL.',
				'std'     => '',
				'type'    => 'text',
				'section' => $dd_sn . 'header',
			),
			array(
				'id'      => $dd_sn . 'social_vimeo',
				'label'   => 'Vimeo URL',
				'desc'    => 'Shown in the social section in the bottom right corner of the header. Enter full URL.',
				'std'     => '',
				'type'    => 'text',
				'section' => $dd_sn . 'header',
			),
			array(
				'id'      => $dd_sn . 'social_googleplus',
				'label'   => 'Google+ URL',
				'desc'    => 'Shown in the social section in the bottom right corner of the header. Enter full URL.',
				'std'     => '',
				'type'    => 'text',
				'section' => $dd_sn . 'header',
			),
			array(
				'id'      => $dd_sn . 'social_flickr',
				'label'   => 'Flickr URL',
				'desc'    => 'Shown in the social section in the bottom right corner of the header. Enter full URL.',
				'std'     => '',
				'type'    => 'text',
				'section' => $dd_sn . 'header',
			),
			array(
				'id'      => $dd_sn . 'social_pinterest',
				'label'   => 'Pinterest URL',
				'desc'    => 'Shown in the social section in the bottom right corner of the header. Enter full URL.',
				'std'     => '',
				'type'    => 'text',
				'section' => $dd_sn . 'header',
			),
			array(
				'id'      => $dd_sn . 'social_linkedin',
				'label'   => 'Linkedin URL',
				'desc'    => 'Shown in the social section in the bottom right corner of the header. Enter full URL.',
				'std'     => '',
				'type'    => 'text',
				'section' => $dd_sn . 'header',
			),
			array(
				'id'      => $dd_sn . 'social_dribbble',
				'label'   => 'Dribbble URL',
				'desc'    => 'Shown in the social section in the bottom right corner of the header. Enter full URL.',
				'std'     => '',
				'type'    => 'text',
				'section' => $dd_sn . 'header',
			),
			array(
				'id'      => $dd_sn . 'social_instagram',
				'label'   => 'Instagram URL',
				'desc'    => 'Shown in the social section in the bottom right corner of the header. Enter full URL.',
				'std'     => '',
				'type'    => 'text',
				'section' => $dd_sn . 'header',
			),
			array(
				'id'      => $dd_sn . 'social_behance',
				'label'   => 'Behance URL',
				'desc'    => 'Shown in the social section in the bottom right corner of the header. Enter full URL.',
				'std'     => '',
				'type'    => 'text',
				'section' => $dd_sn . 'header',
			),
			array(
				'id'      => $dd_sn . 'social_youtube',
				'label'   => 'YouTube URL',
				'desc'    => 'Shown in the social section in the bottom right corner of the header. Enter full URL.',
				'std'     => '',
				'type'    => 'text',
				'section' => $dd_sn . 'header',
			),
			array(
				'id'      => $dd_sn . 'social_email',
				'label'   => 'Email URL',
				'desc'    => 'Shown in the social section in the bottom right corner of the header. Enter the "mailto" version ( mailto:someone@example.com )',
				'std'     => '',
				'type'    => 'text',
				'section' => $dd_sn . 'header',
			),


			/**
			 * Slider
			 */
			array(
				'id'      => $dd_sn . 'slider_regrev',
				'label'   => 'Slider Type',
				'desc'    => 'Choose the type of the slider, regular that comes with the theme or revolution slider.',
				'std'     => 'regular',
				'type'    => 'select',
				'section' => $dd_sn . 'slider',
				'class'   => '',
				'choices' => array(
					array(
						'label' => 'Regular',
						'value' => 'regular',
					),
					array(
						'label' => 'Revolution',
						'value' => 'revolution',
					)
				),
			),

			array(
				'id'      => $dd_sn . 'slider_revolution',
				'label'   => 'Revolution Slider',
				'desc'    => 'Choose the revolution slider you want to show on the homepage.',
				'std'     => 'disabled',
				'type'    => 'select',
				'section' => $dd_sn . 'slider',
				'class'   => '',
				'choices' => $rev_choices
			),

			array(
				'id'      => $dd_sn . 'slider',
				'label'   => 'Slides',
				'desc'    => 'Slides to be used in the slider on the homepage.',
				'std'     => '',
				'type'    => 'list-item',
				'section' => $dd_sn . 'slider',
				'class'   => '',
				'settings' => array(
					array(
						'label' => 'Type',
						'id' => 'type',
						'type' => 'select',
						'std' => 'none',
						'choices' => array(
							array(
								'label' => 'Choose',
								'value' => 'none',
							),
							array(
								'label' => 'Custom',
								'value' => 'custom',
							),
							array(
								'label' => 'Blog',
								'value' => 'blog',
							),
							array(
								'label' => 'Event',
								'value' => 'event',
							),
							array(
								'label' => 'Cause',
								'value' => 'cause',
							),
						),
					),
					array(
						'label' => 'Blog Post',
						'id' => 'blog_post',
						'type' => 'select',
						'std' => '',
						'choices' => $blog_posts_array
					),
					array(
						'label' => 'Event',
						'id' => 'event',
						'type' => 'select',
						'std' => '',
						'choices' => $events_array
					),
					array(
						'label' => 'Cause',
						'id' => 'cause',
						'type' => 'select',
						'std' => '',
						'choices' => $causes_array
					),
					array(
						'label' => 'Image',
						'id' => 'image',
						'type' => 'upload',
					),
					array(
						'label' => 'Description',
						'id' => 'description',
						'type' => 'textarea_simple',
					),
					array(
						'label' => 'Link',
						'id' => 'link',
						'type' => 'text',
					)

				)
			),
			
			array(
				'id'      => $dd_sn . 'slider_height',
				'label'   => 'Slides Height',
				'desc'    => 'To which height should the slide images be resized to.',
				'std'     => '570',
				'type'    => 'text',
				'section' => $dd_sn . 'slider',
				'class'   => '',
			),

			array(
				'id'      => $dd_sn . 'slider_animation',
				'label'   => 'Animation',
				'desc'    => 'Choose the animation you want between the slides.',
				'std'     => 'slide',
				'type'    => 'select',
				'section' => $dd_sn . 'slider',
				'class'   => '',
				'choices' => array(
					array(
						'label' => 'Slide',
						'value' => 'slide',
					),
					array(
						'label' => 'Fade',
						'value' => 'fade',
					)
				),
			),
			array(
				'id'      => $dd_sn . 'slider_autoplay',
				'label'   => 'Autoplay',
				'desc'    => 'If you want the slider to autoplay enter the amount of miliseconds between the slides here. If you don\'t want autoplay the value should be 0.',
				'std'     => '0',
				'type'    => 'text',
				'section' => $dd_sn . 'slider',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'slider_loop',
				'label'   => 'Looping',
				'desc'    => 'Enable/Disable looping. If enabled, after the last slide the first one will be shown. If disabled, it will stop at the last slide.',
				'std'     => 'enabled',
				'type'    => 'select',
				'section' => $dd_sn . 'slider',
				'class'   => '',
				'choices' => array(
					array(
						'label' => 'Enabled',
						'value' => 'enabled',
					),
					array(
						'label' => 'Disabled',
						'value' => 'disabled',
					)
				),
			),

			/**
			 * Footer
			 */
			array(
				'id'      => $dd_sn . 'footer_banner',
				'label'   => 'Banner',
				'desc'    => 'Enable/Disable the footer banner section.',
				'std'     => 'enabled',
				'type'    => 'select',
				'section' => $dd_sn . 'footer',
				'class'   => '',
				'choices' => array(
					array(
						'label' => 'Disabled',
						'value' => 'disabled',
					),
					array(
						'label' => 'Enabled',
						'value' => 'enabled',
					),
				),
			),
			array(
				'id'      => $dd_sn . 'footer_banner_img',
				'label'   => 'Banner - BG Image',
				'desc'    => 'Upload the image for the background.',
				'std'     => '',
				'type'    => 'upload',
				'section' => $dd_sn . 'footer',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'footer_banner_title',
				'label'   => 'Banner - Title',
				'desc'    => 'Enter the title for the banner',
				'std'     => 'Create a nice banner like this one with a few simple clicks',
				'type'    => 'text',
				'section' => $dd_sn . 'footer',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'footer_banner_descr',
				'label'   => 'Banner - Description',
				'desc'    => 'Enter the description for the banner.',
				'std'     => 'Etiam molestie, quam eget dignissim dapibus, diam libero auctor justo, a eleifend urna tellus et ligula. Curabitur elementum diam nec lacus pretium.',
				'type'    => 'text',
				'section' => $dd_sn . 'footer',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'footer_banner_button_text',
				'label'   => 'Banner - Button Text',
				'desc'    => 'Enter the text for the button.',
				'std'     => 'MAKE A DONATION NOW',
				'type'    => 'text',
				'section' => $dd_sn . 'footer',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'footer_banner_button_link',
				'label'   => 'Banner - Button Link',
				'desc'    => 'Enter the full URL the button will link to.',
				'std'     => '#',
				'type'    => 'text',
				'section' => $dd_sn . 'footer',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'footer_banner_button_color',
				'label'   => 'Banner - Button Color',
				'desc'    => 'Choose the color for the button.',
				'std'     => 'green',
				'type'    => 'select',
				'section' => $dd_sn . 'footer',
				'class'   => '',
				'choices' => array(
					array(
						'label' => 'Green',
						'value' => 'green',
					),
					array(
						'label' => 'Orange',
						'value' => 'orange',
					),
					array(
						'label' => 'Light Orange',
						'value' => 'orange-light',
					),
					array(
						'label' => 'Purple',
						'value' => 'purple',
					),
					array(
						'label' => 'Blue',
						'value' => 'blue',
					),
					array(
						'label' => 'Light Blue',
						'value' => 'blue-light',
					),
				),
			),
			array(
				'id'      => $dd_sn . 'footer_widget_cols',
				'label'   => 'Footer - Columns',
				'desc'    => 'Choose the amount of columns for the footer widgets.',
				'std'     => 'four',
				'type'    => 'select',
				'section' => $dd_sn . 'footer',
				'class'   => '',
				'choices' => array(
					array(
						'label' => 'Two',
						'value' => 'eight',
					),
					array(
						'label' => 'Three',
						'value' => 'one-third',
					),
					array(
						'label' => 'Four',
						'value' => 'four',
					),
				),
			),

			/**
			 * Homepage
			 */

			array(
				'id'      => $dd_sn . 'home_sections',
				'label'   => 'Home Sections',
				'desc'    => 'Choose which sections you want to show and in which order..',
				'std'     => '',
				'type'    => 'list-item',
				'section' => $dd_sn . 'homepage',
				'settings' => array(
					array(
						'label' => 'Module',
						'id' => $dd_sn . 'module',
						'type' => 'select',
						'choices' => array(
							array(
								'label' => 'Causes',
								'value' => 'causes'
							),
							array(
								'label' => 'News',
								'value' => 'news'
							),
							array(
								'label' => 'Events + Calendar',
								'value' => 'events'
							),
							array(
								'label' => 'Events',
								'value' => 'events_no_cal'
							),
							
							array(
								'label' => 'Staff',
								'value' => 'staff'
							),
							array(
								'label' => 'Products',
								'value' => 'products'
							),
							array(
								'label' => 'Sponsors',
								'value' => 'sponsors'
							),
							array(
								'label' => 'Textual',
								'value' => 'text'
							),
						)
					),
					array(
						'label' => 'Type',
						'id' => $dd_sn . 'module_type',
						'std' => 'carousel',
						'type' => 'select',
						'choices' => array(
							array(
								'label' => 'Carousel',
								'value' => 'carousel'
							),
							array(
								'label' => 'Grid',
								'value' => 'grid'
							),
						),
						'desc' => 'In miliseconds ( 1000 miliseconds = 1 second ). If set to 0 autoplay will be disabled.<br><br><strong>Note:</strong> Works for News, Events ( without calendar ), Staff, Causes and Sponsors.'
					),
					array(
						'label' => 'Amount of Posts',
						'id' => $dd_sn . 'module_amount_posts',
						'std' => '8',
						'type' => 'text',
					),
					array(
						'label' => 'Autoplay',
						'id' => $dd_sn . 'module_autoplay',
						'std' => '0',
						'type' => 'text',
						'desc' => 'In miliseconds ( 1000 miliseconds = 1 second ). If set to 0 autoplay will be disabled.'
					),
					array(
						'label' => 'Post Width',
						'id' => $dd_sn . 'module_post_width',
						'std' => 'one_fourth',
						'type' => 'select',
						'desc' => 'If using <strong>news module</strong> or <strong>causes module</strong> choose the post width here',
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
						'label' => 'Blog Category',
						'id' => $dd_sn . 'module_blog_cat',
						'std' => 'all',
						'type' => 'select',
						'desc' => 'If using <strong>news module</strong> choose the category here.',
						'choices' => $blog_cats_array
					),
					array(
						'label' => 'Causes Category',
						'id' => $dd_sn . 'module_causes_cat',
						'std' => 'all',
						'type' => 'select',
						'desc' => 'If using <strong>causes module</strong> choose the category here.',
						'choices' => $causes_cats_array
					),
					array(
						'label' => 'Content',
						'id' => $dd_sn . 'module_text_content',
						'std' => '',
						'type' => 'textarea',
						'desc' => 'If using <strong>text module</strong> add your content here. You can use HTML here.'
					),
				)
			),

			/**
			 * CODE
			 */

			array(
				'id'      => $dd_sn . 'code_css',
				'label'   => 'Custom CSS Code',
				'desc'    => 'Enter your custom CSS code here.',
				'std'     => '',
				'type'    => 'textarea_simple',
				'section' => $dd_sn . 'code',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'code_js',
				'label'   => 'Custom JavaScript Code',
				'desc'    => '<p>Enter your custom JavaScript code here.</p><p>jQuery is enabled, just make sure to wrap it within:</p>jQuery(document).ready(function($){<br>&nbsp;&nbsp;&nbsp;&nbsp;/* your code here */<br> });',
				'std'     => '',
				'type'    => 'textarea_simple',
				'section' => $dd_sn . 'code',
				'class'   => '',
			),

			/**
			 * Donations
			 */

			array(
				'id'      => $dd_sn . 'paypal_sandbox',
				'label'   => 'PayPal - Sandbox mode',
				'desc'    => 'Enable if you want to test the processing of the donations.',
				'std'     => 'disabled',
				'type'    => 'select',
				'section' => $dd_sn . 'donations',
				'class'   => '',
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
			array(
				'id'      => $dd_sn . 'paypal_email',
				'label'   => 'PayPal - Email',
				'desc'    => 'The paypal account email on which the donations will arrive.',
				'std'     => '',
				'type'    => 'text',
				'section' => $dd_sn . 'donations',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'paypal_currency',
				'label'   => 'PayPal - Currency Code',
				'desc'    => 'Which currency do you want to receive the donations in.',
				'std'     => 'USD',
				'type'    => 'text',
				'section' => $dd_sn . 'donations',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'paypal_currency_char',
				'label'   => 'PayPal - Currency Character',
				'desc'    => 'The character of the currency.',
				'std'     => '$',
				'type'    => 'text',
				'section' => $dd_sn . 'donations',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'donation_default_amount',
				'label'   => 'Donations - Default amount',
				'desc'    => 'The default amount for donations. <strong>Important:</strong> Use a number only, example: 150',
				'std'     => '50',
				'type'    => 'text',
				'section' => $dd_sn . 'donations',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'cause_funded_show',
				'label'   => 'Funded Cause - Show',
				'desc'    => 'When a cause is 100% funded, should it still show in the listing or only on the "Succesfuly funded" page.',
				'std'     => 'enabled',
				'type'    => 'select',
				'section' => $dd_sn . 'donations',
				'class'   => '',
				'choices' => array(
					array(
						'label' => 'Show',
						'value' => 'enabled',
					),
					array(
						'label' => 'Hide',
						'value' => 'disabled',
					),
				),
			),
			array(
				'id'      => $dd_sn . 'regular_donation_spread',
				'label'   => 'Regular Donation - Spread to Causes',
				'desc'    => 'When a donation is made from the regular donation page (not a cause), should the donation be spread to all the causes.',
				'std'     => 'enabled',
				'type'    => 'select',
				'section' => $dd_sn . 'donations',
				'class'   => '',
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
			array(
				'id'      => $dd_sn . 'causes_filter_featured',
				'label'   => 'Cause Listing - Staff\'s Pick',
				'desc'    => 'Enable disable the filter on the cause listing page.',
				'std'     => 'enabled',
				'type'    => 'select',
				'section' => $dd_sn . 'donations',
				'class'   => '',
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
			array(
				'id'      => $dd_sn . 'causes_filter_finished',
				'label'   => 'Cause Listing - Succesfuly Funded',
				'desc'    => 'Enable disable the filter on the cause listing page.',
				'std'     => 'enabled',
				'type'    => 'select',
				'section' => $dd_sn . 'donations',
				'class'   => '',
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
			array(
				'id'      => $dd_sn . 'causes_filter_lastmiles',
				'label'   => 'Cause Listing - Last Miles',
				'desc'    => 'Enable disable the filter on the cause listing page.',
				'std'     => 'enabled',
				'type'    => 'select',
				'section' => $dd_sn . 'donations',
				'class'   => '',
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
			array(
				'id'      => $dd_sn . 'cause_info_widget',
				'label'   => 'Cause Single - Info Widget',
				'desc'    => 'The info widget that shows information about donations for the cause. <br><br><strong>Important</strong> If <strong>enabled</strong> you can still disable it for specific causes (in cause post admin), if <strong>disabled</strong> it will be disabled everywhere.',
				'std'     => 'enabled',
				'type'    => 'select',
				'section' => $dd_sn . 'donations',
				'class'   => '',
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
			array(
				'id'      => $dd_sn . 'causes_donation_amount_state',
				'label'   => 'Cause Elements - Donation Amount',
				'desc'    => 'Enable/disable the donation amount.',
				'std'     => 'enabled',
				'type'    => 'select',
				'section' => $dd_sn . 'donations',
				'class'   => '',
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
			array(
				'id'      => $dd_sn . 'causes_donation_amount_commas',
				'label'   => 'Cause Elements - Donation Amount - Commas',
				'desc'    => 'Enable/disable commas for the donation amount.',
				'std'     => 'disabled',
				'type'    => 'select',
				'section' => $dd_sn . 'donations',
				'class'   => '',
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
			array(
				'id'      => $dd_sn . 'causes_donation_perc_state',
				'label'   => 'Cause Elements - Donation Percentage',
				'desc'    => 'Enable/disable the donation percentage.',
				'std'     => 'enabled',
				'type'    => 'select',
				'section' => $dd_sn . 'donations',
				'class'   => '',
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

			/**
			 * OTHER
			 */

			array(
				'id'      => $dd_sn . 'responsive',
				'label'   => 'Responsive',
				'desc'    => 'Enable disable the responsive feature.',
				'std'     => 'enabled',
				'type'    => 'select',
				'section' => $dd_sn . 'other',
				'class'   => '',
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
			array(
				'id'      => $dd_sn . 'multicol_colors',
				'label'   => 'Multi-column Colors',
				'desc'    => 'The multicolumn colors on top of the header, bottom of the footer, top of the slide info...',
				'std'     => array(
					array(
						'title' => 'Blue',
						$dd_sn . 'color' => '#0095da'
					),
					array(
						'title' => 'Green',
						$dd_sn . 'color' => '#a6ce38'
					),
					array(
						'title' => 'Yellow',
						$dd_sn . 'color' => '#ffcb0c'
					),
					array(
						'title' => 'Red',
						$dd_sn . 'color' => '#d7151a'
					),
					array(
						'title' => 'Purple',
						$dd_sn . 'color' => '#a54886'
					),
					array(
						'title' => 'Blue',
						$dd_sn . 'color' => '#0095da'
					),
					array(
						'title' => 'Green',
						$dd_sn . 'color' => '#a6ce38'
					),
					array(
						'title' => 'Yellow',
						$dd_sn . 'color' => '#ffcb0c'
					),
					array(
						'title' => 'Red',
						$dd_sn . 'color' => '#d7151a'
					),
					array(
						'title' => 'Purple',
						$dd_sn . 'color' => '#a54886'
					),
					array(
						'title' => 'Blue',
						$dd_sn . 'color' => '#0095da'
					),
					array(
						'title' => 'Green',
						$dd_sn . 'color' => '#a6ce38'
					),
					array(
						'title' => 'Yellow',
						$dd_sn . 'color' => '#ffcb0c'
					),
				),
				'type'    => 'list-item',
				'section' => $dd_sn . 'other',
				'settings' => array(
					array(
						'label' => 'Color',
						'id' => $dd_sn . 'color',
						'type' => 'colorpicker',
					),
				)
			),
			array(
				'id'      => $dd_sn . 'archives_layout',
				'label'   => 'Archives - Layout',
				'desc'    => 'Choose the layout of archive pages.',
				'std'     => 'fc',
				'type'    => 'select',
				'section' => $dd_sn . 'other',
				'class'   => '',
				'choices' => array(
					array(
						'label' => 'Full Content',
						'value' => 'fc',
					),
					array(
						'label' => 'Content + Sidebar',
						'value' => 'cs',
					),
				),
			),
			array(
				'id'      => $dd_sn . 'donate_page_title',
				'label'   => 'Donate Page - Title',
				'desc'    => 'The title that shows on the donate page.',
				'std'     => '',
				'type'    => 'text',
				'section' => $dd_sn . 'other',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'donate_page_description',
				'label'   => 'Donate Page - Description',
				'desc'    => 'The description that shows on the donate page.',
				'std'     => '',
				'type'    => 'text',
				'section' => $dd_sn . 'other',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'donate_overlay_title',
				'label'   => 'Donate Lightbox - Title',
				'desc'    => 'The title that shows in the donate lightbox (donating to specific cause).',
				'std'     => '',
				'type'    => 'text',
				'section' => $dd_sn . 'other',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'donate_overlay_description',
				'label'   => 'Donate Lightbox - Description',
				'desc'    => 'The description that shows in the donate lightbox (donating to specific cause).',
				'std'     => '',
				'type'    => 'text',
				'section' => $dd_sn . 'other',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'signin_overlay_title',
				'label'   => 'Sign In Lightbox - Title',
				'desc'    => 'The title that shows in the members sign in lightbox.',
				'std'     => '',
				'type'    => 'text',
				'section' => $dd_sn . 'other',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'signin_overlay_description',
				'label'   => 'Sign In Lightbox - Description',
				'desc'    => 'The description that shows in the members sign in lightbox.',
				'std'     => '',
				'type'    => 'text',
				'section' => $dd_sn . 'other',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'pagination_type',
				'label'   => 'Pagination - Type',
				'desc'    => 'Choose the type of the pagination.',
				'std'     => 'enabled',
				'type'    => 'select',
				'section' => $dd_sn . 'other',
				'class'   => '',
				'choices' => array(
					array(
						'label' => 'Numbered',
						'value' => 'numbers',
					),
					array(
						'label' => 'Previous and Next',
						'value' => 'prevnext',
					),
				),
			),
			array(
				'id'      => $dd_sn . 'slug_causes',
				'label'   => 'Permalink Slug - Causes Single',
				'desc'    => 'The slug for the causes single page. <br><br><strong>Important:</strong> If you change this go to Settings > Permalinks and click "Save Changes" so WP refreshes the permalinks.',
				'std'     => 'cause-view',
				'type'    => 'text',
				'section' => $dd_sn . 'other',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'slug_causes_tax',
				'label'   => 'Permalink Slug - Causes Category',
				'desc'    => 'The slug for the causes category archive. <br><br><strong>Important:</strong> If you change this go to Settings > Permalinks and click "Save Changes" so WP refreshes the permalinks.',
				'std'     => 'dd_causes_cats',
				'type'    => 'text',
				'section' => $dd_sn . 'other',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'slug_events',
				'label'   => 'Permalink Slug - Events Single',
				'desc'    => 'The slug for the events single page. <br><br><strong>Important:</strong> If you change this go to Settings > Permalinks and click "Save Changes" so WP refreshes the permalinks.',
				'std'     => 'event-view',
				'type'    => 'text',
				'section' => $dd_sn . 'other',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'slug_staff',
				'label'   => 'Permalink Slug - Staff Single',
				'desc'    => 'The slug for the staff single page. <br><br><strong>Important:</strong> If you change this go to Settings > Permalinks and click "Save Changes" so WP refreshes the permalinks.',
				'std'     => 'staff-view',
				'type'    => 'text',
				'section' => $dd_sn . 'other',
				'class'   => '',
			),
			array(
				'id'      => $dd_sn . 'slug_staff_tax',
				'label'   => 'Permalink Slug - Staff Category',
				'desc'    => 'The slug for the staff category archive. <br><br><strong>Important:</strong> If you change this go to Settings > Permalinks and click "Save Changes" so WP refreshes the permalinks.',
				'std'     => 'dd_staff_cats',
				'type'    => 'text',
				'section' => $dd_sn . 'other',
				'class'   => '',
			),
			
		)
	);

	$custom_settings['sections'] = array_merge( $custom_settings['sections'], $sections_append_comb );
	$custom_settings['settings'] = array_merge( $custom_settings['settings'], $settings_append_comb );
	  
	/* settings are not the same update the DB */
	if ( $saved_settings !== $custom_settings ) {
		update_option( 'option_tree_settings', $custom_settings ); 
	}
  
}