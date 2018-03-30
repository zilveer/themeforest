<?php
/**
 * Listable Options Config
 *
 * @package Listable
 * @since Listable 1.0
 */

/**
 * Hook into the Customify's fields and settings
 *
 * @param $options array - Contains the plugin's options array right before they are used, so edit with care
 *
 * @return mixed
 */
if ( ! function_exists( 'listable_add_customify_options' ) ) :
	function listable_add_customify_options( $options ) {

		// Recommended Fonts List
		// Headings
		$recommended_headings_fonts = array(
			'Playfair Display',
			'Oswald',
			'Lato',
			'Open Sans',
			'Exo',
			'PT Sans',
			'Ubuntu',
			'Vollkorn',
			'Lora',
			'Arvo',
			'Josefin Slab',
			'Crete Round',
			'Kreon',
			'Bubblegum Sans',
			'The Girl Next Door',
			'Pacifico',
			'Handlee',
			'Satify',
			'Pompiere'
		);

		// Body
		$recommended_body_fonts = array(
			'Source Sans Pro',
			'Lato',
			'Open Sans',
			'PT Sans',
			'Cabin',
			'Gentium Book Basic',
			'PT Serif',
			'Droid Serif'
		);

		$options['opt-name'] = 'listable_options';

		// keep this empty now
		$options['sections'] = array();

		$options['sections']['style_presets'] = array(
			'title'   => '&#x1f3ad; ' . esc_html__( 'Style Presets', 'listable' ),
			'options' => array(
				'theme_style' => array(
					'type'         => 'preset',
					'label'        => __( 'Select a style:', 'listable' ),
					'desc'         => __( 'Conveniently change the design of your site with built-in style presets. Easy as pie.', 'patch' ),
					'default'      => 'listable',
					'choices_type' => 'awesome',
					'choices'      => array(
						'listable' => array(
							'label'   => __( 'Listable', 'listable' ),
							'preview' => array(
								'color-text'       => '#ffffff',
								'background-card'  => '#ff4d55',
								'background-label' => '#f13d46',
								'font-main'        => 'Hanken',
								'font-alt'         => 'Source Sans Pro',
							),
							'options' => array(

								// COLORS
								// Site Header
								'header_transparent'          => true,
								'header_background_color'     => '#ffffff',
								'site_title_color'            => '#484848',
								'search_color'                => '#484848',
								'nav_link_color'              => '#919191',
								'nav_active_color'            => '#FF4D55',
								'nav_button_color'            => '#EBEBEB',

								// Main Content
								'content_background'          => '#ffffff',
								'page_background'             => '#F9F9F9',
								'page_titles_color'           => '#484848',
								'page_subtitles_color'        => '#919191',
								'text_color'                  => '#484848',
								'buttons_color'               => '#FF4D55',

								// Cards
								'cards_background'            => '#ffffff',
								'cards_radius'                => '8',
								'thumbs_radius'               => '4',
								'cards_title_color'           => '#FF4D55',
								'cards_text_color'            => '#ababab',
								'cards_icon_color'            => '#FF4D5A',
								'cards_icon_border_color'     => '#FF4D5A',
								'cards_icon_background_color' => '#FFFFFF',
								'pin_background_color'        => '#FFFFFF',
								'pin_icon_color'              => '#FF4D5A',

								// Pre Footer
								'prefooter_background'        => '#2F2929',
								'prefooter_text_color'        => '#FFFFFF',

								// Footer
								'footer_background'           => '#261E1E',
								'footer_text_color'           => '#ADADB2',
								'footer_credits_color'        => '#706C6C',

								// Other Colors
								'accent_color'                => '#FF4D58',
								'fields_color'                => '#919191',
								'micro_color'                 => '#ABABAB',

								// FONTS
								'site_title_font'             => array(
									'font_family'       => 'Hanken',
									'selected_variants' => '400'
								),
								'site_title_font_size'        => '24',
								'site_title_text_transform'   => 'None',
								'site_title_letter-spacing'   => '0',

								'navigation_font'           => array(
									'font_family'       => 'Hanken',
									'selected_variants' => '400'
								),
								'navigation_font_size'      => '14.95',
								'navigation_text_transform' => 'Capitalize',
								'navigation_letter-spacing' => '0',

								'body_font'        => array( 'font_family' => 'Source Sans Pro', 'selected_variants' => 'regular' ),
								'page_titles_font'    => array( 'font_family' => 'Hanken', 'selected_variants' => '700' ),
								'page_subtitles_font' => array( 'font_family'       => 'Hanken', 'selected_variants' => '400' ),
								'meta_font'        => array( 'font_family'       => 'Hanken', 'selected_variants' => '400' ),
								'card_font'        => array( 'font_family'       => 'Hanken', 'selected_variants' => '400' ),

								'card_title_font'           => array( 'font_family'       => 'Hanken', 'selected_variants' => '700' ),
								'card_title_font_size'      => '24',
								'card_title_text_transform' => 'None',
								'card_title_letter-spacing' => '0',

							)
						),



						// Royal Preset
						'royal'    => array(
							'label'   => __( 'Royal', 'listable' ),
							'preview' => array(
								'color-text'       => '#ffffff',
								'background-card'  => '#10324e',
								'background-label' => '#bdae6a',
								'font-main'        => 'Playfair Display',
								'font-alt'         => 'Source Sans Pro',
							),
							'options' => array(

								// COLORS
								// Site Header
								'header_transparent'          => true,
								'header_background_color'     => '#ffffff',
								'site_title_color'            => '#10324e',
								'search_color'                => '#484848',
								'nav_link_color'              => '#86898c',
								'nav_active_color'            => '#10324e',
								'nav_button_color'            => '#ebebeb',

								// Main Content
								'content_background'          => '#ffffff',
								'page_background'             => '#f9f9f9',
								'page_titles_color'           => '#10324e',
								'page_subtitles_color'		  => '#86898c',
								'text_color'                  => '#10324e',
								'buttons_color'               => '#bdae6a',

								// Cards
								'cards_background'            => '#ffffff',
								'cards_radius'                => '4',
								'thumbs_radius'               => '16',
								'cards_title_color'           => '#bdae6a',
								'cards_text_color'            => '#86898c',
								'cards_icon_color'            => '#ffffff',
								'cards_icon_border_color'     => '#bdae6a',
								'cards_icon_background_color' => '#bdae6a',
								'pin_background_color'        => '#ffffff',
								'pin_icon_color'              => '#bdae6a',

								// Pre Footer
								'prefooter_background'        => '#1c486d',
								'prefooter_text_color'        => '#ffffff',

								// Footer
								'footer_background'           => '#10324e',
								'footer_text_color'           => '#d9dae0',
								'footer_credits_color'        => '#b0b5b7',

								// Other Colors
								'accent_color'                => '#bdae6a',
								'fields_color'                => '#919191',
								'micro_color'                 => '#ababab',

								// FONTS
								'site_title_font'             => array('font_family' => 'Playfair Display', 'selected_variants' => '700'),
								'site_title_font_size'        => '24',
								'site_title_text_transform'   => 'None',
								'site_title_letter-spacing'   => '0',

								'navigation_font'           => array( 'font_family' => 'Source Sans Pro', 'selected_variants' => '200' ),
								'navigation_font_size'      => '15',
								'navigation_text_transform' => 'Capitalize',
								'navigation_letter-spacing' => '0',

								'body_font'        => 'Source Sans Pro',

								'page_titles_font'    => array( 'font_family' => 'Playfair Display', 'selected_variants' => '700' ),
								'page_subtitles_font' => array( 'font_family' => 'Source Sans Pro', 'selected_variants' => '300' ),

								'card_title_font'           => array( 'font_family' => 'Playfair Display', 'selected_variants' => 'regular' ),
								'card_title_font_size'      => '24',
								'card_title_text_transform' => 'None',
								'card_title_letter-spacing' => '0',

								'card_font'        => array( 'font_family' => 'Source Sans Pro', 'selected_variants' => '300' ),

								'meta_font'        => array( 'font_family' => 'Source Sans Pro', 'selected_variants' => '300' ),

							)
						),
						//Silkberry Preset

						'silkberry'    => array(
							'label'   => __( 'Silkberry', 'listable' ),
							'preview' => array(
								'color-text'       => '#ffffff',
								'background-card'  => '#3D3235',
								'background-label' => '#FCC5BE',
								'font-main'        => 'Yeseva One',
								'font-alt'         => 'Source Sans Pro',
							),
							'options' => array(

								// COLORS
								// Site Header
								'header_transparent'          => true,
								'header_background_color'     => '#161314',
								'site_title_color'            => '#fcc5be',
								'search_color'                => '#484848',
								'nav_link_color'              => '#b2b2b2',
								'nav_active_color'            => '#fcc5be',
								'nav_button_color'            => '#9e9e9e',

								// Main Content
								'content_background'          => '#3d3235',
								'page_background'             => '#2b2427',
								'page_titles_color'           => '#fcc5be',
								'page_subtitles_color'        => '#bf8989',
								'text_color'                  => '#f9f9f9',
								'buttons_color'               => '#fcc5be',

								// Cards
								'cards_background'            => '#312a2d',
								'cards_radius'                => '24',
								'thumbs_radius'               => '22',
								'cards_title_color'           => '#fcc5be',
								'cards_text_color'            => '#ffffff',
								'cards_icon_color'            => '#3c3133',
								'cards_icon_border_color'     => '#fcc5be',
								'cards_icon_background_color' => '#fcc5be',
								'pin_background_color'        => '#ffffff',
								'pin_icon_color'              => '#ffadad',

								// Pre Footer
								'prefooter_background'        => '#2F2929',
								'prefooter_text_color'        => '#ffffff',

								// Footer
								'footer_background'           => '#261E1E',
								'footer_text_color'           => '#868889',
								'footer_credits_color'        => '#a3a09b',

								// Other Colors
								'accent_color'                => '#fcc5be',
								'fields_color'                => '#6d6d6d',
								'micro_color'                 => '#dddddd',

								// FONTS
								'site_title_font'             => array('font_family' => 'Libre Baskerville', 'selected_variants' => '700'),
								'navigation_font'           => array(
									'font_family'       => 'Raleway',
									'selected_variants' => '300'
								),
								'navigation_font_size'      => '14.95',
								'navigation_text_transform' => 'None',
								'navigation_letter-spacing' => '0',
								'body_font'        => 'Raleway',

								'page_titles_font'    => array(
									'font_family'       => 'Libre Baskerville',
									'selected_variants' => 'regular'
								),
								'page_subtitles_font'  => array(
									'font_family'       => 'Raleway',
									'selected_variants' => '300'
								),
								'meta_font'         => array(
									'font_family'       => 'Raleway',
									'selected_variants' => '300'
								),
								'card_font'        => array(
									'font_family'       => 'Raleway',
									'selected_variants' => '300'
								),

								'card_title_font'            => array(
									'font_family'       => 'Raleway',
									'selected_variants' => '300'
								),
								'card_title_font_size'      => '28',
								'card_title_text_transform' => 'None',
								'card_title_letter-spacing' => '0',

							)
						),

						//Orangina Preset
						'Orangina'    => array(
							'label'   => __( 'Orangina', 'listable' ),
							'preview' => array(
								'color-text'       => '#ffffff',
								'background-card'  => '#01a7ba',
								'background-label' => '#e58500',
								'font-main'        => 'Delius',
								'font-alt'         => 'Lato',
							),
							'options' => array(

								// COLORS
								// Site Header
								'header_transparent'          => true,
								'header_background_color'     => '#01a7ba',
								'site_title_color'            => '#ffffff',
								'search_color'                => '#ffffff',
								'nav_link_color'              => '#ffffff',
								'nav_active_color'            => '#3d3d3d',
								'nav_button_color'            => '#3d3d3d',

								// Main Content
								'content_background'          => '#ffffff',
								'page_background'             => '#ffffff',
								'page_titles_color'           => '#01a7ba',
								'page_subtitles_color'		  => '#86898c',
								'text_color'                  => '#3d3d3d',
								'buttons_color'               => '#f79f07',

								// Cards
								'cards_background'            => '#ffffff',
								'cards_radius'                => '20',
								'thumbs_radius'               => '6',
								'cards_title_color'           => '#f79f07',
								'cards_text_color'            => '#9b9b9b',
								'cards_icon_color'            => '#ffffff',
								'cards_icon_border_color'     => '#01a7ba',
								'cards_icon_background_color' => '#01a7ba',
								'pin_background_color'        => '#ffffff',
								'pin_icon_color'              => '#01a7ba',

								// Pre Footer
								'prefooter_background'        => '#01a7ba',
								'prefooter_text_color'        => '#ffffff',

								// Footer
								'footer_background'           => '#f79f07',
								'footer_text_color'           => '#ffffff',
								'footer_credits_color'        => '#000000',

								// Other Colors
								'accent_color'                => '#f79f07',
								'fields_color'                => '#848484',
								'micro_color'                 => '#000000',

								// FONTS
								'site_title_font'             => array('font_family' => 'Delius', 'selected_variants' => '700'),
								'navigation_font'           => array(
									'font_family'       => 'Raleway',
									'selected_variants' => '300'
								),
								'navigation_font_size'      => '14.95',
								'navigation_text_transform' => 'None',
								'navigation_letter-spacing' => '0',
								'body_font'        => array(
									'font_family'       => 'Raleway',
									'selected_variants' => 'regular'
								),
								'page_titles_font'    => array(
									'font_family'       => 'Delius',
									'selected_variants' => 'regular'
								),
								'meta_font'         => array(
									'font_family'       => 'Raleway',
									'selected_variants' => '300'
								),
								'page_subtitles_font'  => array(
									'font_family'       => 'Raleway',
									'selected_variants' => '300'
								),
								'card_font'        => array(
									'font_family'       => 'Raleway',
									'selected_variants' => 'regular'
								),

								'card_title_font'            => array(
									'font_family'       => 'Delius',
									'selected_variants' => 'regular'
								),
								'card_title_font_size'      => '28',
								'card_title_text_transform' => 'None',
								'card_title_letter-spacing' => '0',


							)
						),
						//Jolly Preset

						'Jolly'    => array(
							'label'   => __( 'Jolly', 'listable' ),
							'preview' => array(
								'color-text'       => '#ffffff',
								'background-card'  => '#ea6f4d',
								'background-label' => '#ea481c',
								'font-main'        => 'Flamenco',
								'font-alt'         => 'Lato',
							),
							'options' => array(

								// COLORS
								// Site Header
								'header_transparent'          => true,
								'header_background_color'     => '#ea6f4d',
								'site_title_color'            => '#ffffff',
								'search_color'                => '#474747',
								'nav_link_color'              => '#ffffff',
								'nav_active_color'            => '#9b3030',
								'nav_button_color'            => '#000000',

								// Main Content
								'content_background'          => '#ffffff',
								'page_background'             => '#ffffff',
								'page_titles_color'           => '#ea6f4d',
								'page_subtitles_color'		  => '#86898c',
								'text_color'                  => '#494949',
								'buttons_color'               => '#ea6f4d',

								// Cards
								'cards_background'            => '#ffffff',
								'cards_radius'                => '6',
								'thumbs_radius'               => '6',
								'cards_title_color'           => '#ea481c',
								'cards_text_color'            => '#666666',
								'cards_icon_color'            => '#ffffff',
								'cards_icon_border_color'     => '#ea6f4d',
								'cards_icon_background_color' => '#ea6f4d',
								'pin_background_color'        => '#ffffff',
								'pin_icon_color'              => '#ea481c',

								// Pre Footer
								'prefooter_background'        => '#ea481c',
								'prefooter_text_color'        => '#ffffff',

								// Footer
								'footer_background'           => '#ea6f4d',
								'footer_text_color'           => '#ffffff',
								'footer_credits_color'        => '#ffbaba',

								// Other Colors
								'accent_color'                => '#ea481c',
								'fields_color'                => '#898989',
								'micro_color'                 => '#777777',

								// FONTS
								'site_title_font'             => array('font_family' => 'Flamenco', 'selected_variants' => '700'),
								'navigation_font'           => array(
									'font_family'       => 'Lato',
									'selected_variants' => '300'
								),
								'navigation_font_size'      => '14.95',
								'navigation_text_transform' => 'None',
								'navigation_letter-spacing' => '0',
								'body_font'        => array(
									'font_family'       => 'Lato',
									'selected_variants' => '300'
								),

								'page_titles_font'    => array(
									'font_family'       => 'Flamenco',
									'selected_variants' => 'regular'
								),

								'page_subtitles_font'  => array(
									'font_family'       => 'Lato',
									'selected_variants' => '300'
								),

								'meta_font'         => array(
									'font_family'       => 'Lato',
									'selected_variants' => '300'
								),
								'card_font'        => array(
									'font_family'       => 'Lato',
									'selected_variants' => '300'
								),

								'card_title_font'            => array(
									'font_family'       => 'Flamenco',
									'selected_variants' => 'regular'
								),
								'card_title_font_size'      => '28',
								'card_title_text_transform' => 'None',
								'card_title_letter-spacing' => '0',


							)
						),
					//Navy Preset

						'Navy'    => array(
							'label'   => __( 'Navy', 'listable' ),
							'preview' => array(
								'color-text'       => '#ffffff',
								'background-card'  => '#001f63',
								'background-label' => '#3a3a3a',
								'font-main'        => 'Vidaloka',
								'font-alt'         => 'Lato',
							),
							'options' => array(

								// COLORS
								// Site Header
								'header_transparent'          => true,
								'header_background_color'     => '#ffffff',
								'site_title_color'            => '#001f63',
								'search_color'                => '#3a3a3a',
								'nav_link_color'              => '#001f63',
								'nav_active_color'            => '#4a5463',
								'nav_button_color'            => '#000000',

								// Main Content
								'content_background'          => '#ffffff',
								'page_background'             => '#ffffff',
								'page_titles_color'           => '#161400',
								'page_subtitles_color'		  => '#86898c',
								'text_color'                  => '#3d3d3d',
								'buttons_color'               => '#000144',

								// Cards
								'cards_background'            => '#ffffff',
								'cards_radius'                => '6',
								'thumbs_radius'               => '6',
								'cards_title_color'           => '#001f63',
								'cards_text_color'            => '#666666',
								'cards_icon_color'            => '#001f63',
								'cards_icon_border_color'     => '#001f63',
								'cards_icon_background_color' => '#ffffff',
								'pin_background_color'        => '#ffffff',
								'pin_icon_color'              => '#001f63',

								// Pre Footer
								'prefooter_background'        => '#002847',
								'prefooter_text_color'        => '#ffffff',

								// Footer
								'footer_background'           => '#00133f',
								'footer_text_color'           => '#ffffff',
								'footer_credits_color'        => '#c1c1c1',

								// Other Colors
								'accent_color'                => '#001f63',
								'fields_color'                => '#848484',
								'micro_color'                 => '#000000',

								// FONTS
								'site_title_font'             => 'Vidaloka',
								'navigation_font'           => array(
									'font_family'       => 'Lato',
									'selected_variants' => 'regular'
								),
								'body_font'                   => 'Lato',
								'page_titles_font'               => 'Vidaloka',
								'meta_font'         => array(
									'font_family'       => 'Lato',
									'selected_variants' => 'regular'
								),
								'page_subtitles_font'            => 'Lato',
								'meta_font'         => array(
									'font_family'       => 'Lato',
									'selected_variants' => 'regular'

								),
								'card_title_font'             => 'Vidaloka',

							)
						),
						//Grass Preset

						'Grass'    => array(
							'label'   => __( 'Grass', 'listable' ),
							'preview' => array(
								'color-text'       => '#ffffff',
								'background-card'  => '#64a97b',
								'background-label' => '#213847',
								'font-main'        => 'Copse',
								'font-alt'         => 'Raleway',
							),
							'options' => array(

								// COLORS
								// Site Header
								'header_transparent'          => true,
								'header_background_color'     => '#ffffff',
								'site_title_color'            => '#3a5465',
								'search_color'                => '#231e1c',
								'nav_link_color'              => '#090c11',
								'nav_active_color'            => '#64a97b',
								'nav_button_color'            => '#3d3931',

								// Main Content
								'content_background'          => '#ffffff',
								'page_background'             => '#ffffff',
								'page_titles_color'           => '#2f4859',
								'page_subtitles_color'		  => '#86898c',
								'text_color'                  => '#3d3d3d',
								'buttons_color'               => '#64a97b',

								// Cards
								'cards_background'            => '#ffffff',
								'cards_radius'                => '36',
								'thumbs_radius'               => '36',
								'cards_title_color'           => '#3a5465',
								'cards_text_color'            => '#474747',
								'cards_icon_color'            => '#ffffff',
								'cards_icon_border_color'     => '#64a97b',
								'cards_icon_background_color' => '#64a97b',
								'pin_background_color'        => '#ffffff',
								'pin_icon_color'              => '#64a97b',

								// Pre Footer
								'prefooter_background'        => '#64a97b',
								'prefooter_text_color'        => '#ffffff',

								// Footer
								'footer_background'           => '#3a5465',
								'footer_text_color'           => '#ffffff',
								'footer_credits_color'        => '#0c0c0c',

								// Other Colors
								'accent_color'                => '#001f63',
								'fields_color'                => '#848484',
								'micro_color'                 => '#000000',

								// FONTS
								'site_title_font'             => 'Copse',

								'navigation_font'           => array(
									'font_family'       => 'Raleway',
									'selected_variants' => '300'
								),
								'navigation_font_size'      => '14.95',
								'navigation_text_transform' => 'None',
								'navigation_letter-spacing' => '0',

								'body_font'                   => 'Raleway',
								'page_titles_font'    => array(
									'font_family'       => 'Copse',
									'selected_variants' => '700'
								),
								'meta_font'         => array(
									'font_family'       => 'Raleway',
									'selected_variants' => 'regular'
								),
								'page_subtitles_font'            => 'Raleway',
								'card_font'        => array(
									'font_family'       => 'Raleway',
									'selected_variants' => '300'
								),
								'card_title_font'             => 'Montserrat',

							)
						)



					)
				),
			)
		);

		$options['panels']['theme_options'] = array(
			'title'    => '&#x1f506; ' . esc_html__( 'Theme Options', 'listable' ),
			'sections' => array(
				'general'     => array(
					'title'   => esc_html__( 'General', 'listable' ),
					'options' => array(
						'footer_copyright' => array(
							'type'              => 'textarea',
							'label'             => esc_html__( 'Footer Copyright Text', 'listable' ),
							//'desc' => esc_html__( 'The copyright text which should appear in footer.', 'listable' ),
							'default'           => esc_html__( 'Copyright &copy; 2015 Company Inc.   &bull;   Address  &bull;   Tel: 42-898-4363', 'listable' ),
							'sanitize_callback' => 'wp_kses_post',
							'live'              => array( '.site-info .site-text-area' )
						),
					)
				),
				'map_options' => array(
					'title'   => esc_html__( 'Map Options', 'listable' ),
					'options' => array(
						'mapbox_token' => array(
							'type'    => 'text',
							'label'   => esc_html__( 'Mapbox Integration (optional)', 'listable' ),
							'default' => '',
							// 'desc'      => __( 'Listable uses the Mapbox API for different reasons. <a href="https://www.mapbox.com/help/create-api-access-token/">Get an API token</a> for best performances.', 'listable' ),
							'desc'    => sprintf(
								'<p>%s <a href="https://www.mapbox.com/" target="_blank">%s</a> %s.</p><p><a href="https://www.mapbox.com/help/create-api-access-token/" target="_blank">%s</a> %s.</p>',
								esc_html__( 'We are offering integration with the', 'listable' ),
								esc_html__( 'Mapbox', 'listable' ),
								esc_html__( 'service, so you can have better looking and highly performance maps', 'listable' ),
								esc_html__( 'Get a FREE token', 'listable' ),
								esc_html__( 'and paste it below. If there is nothing added, we will fallback to the Google Maps service', 'listable' )
							)
						),
						'mapbox_style' => array(
							'type'    => 'radio_image',
							'label'   => esc_html__( 'Mapbox Style', 'listable' ),
							'default' => 'mapbox.streets-basic',
							'choices' => array(
								'mapbox.streets-basic' => get_template_directory_uri() . '/assets/img/streets-basic.png',
								'mapbox.streets'       => get_template_directory_uri() . '/assets/img/streets.png',
								'mapbox.outdoors'      => get_template_directory_uri() . '/assets/img/outdoors.png',
								'mapbox.light'         => get_template_directory_uri() . '/assets/img/light.png',
								'mapbox.emerald'       => get_template_directory_uri() . '/assets/img/emerald.png',
								'mapbox.satellite'     => get_template_directory_uri() . '/assets/img/satellite.png',
								'mapbox.pencil'        => get_template_directory_uri() . '/assets/img/pencil.png',
								'mapbox.pirates'       => get_template_directory_uri() . '/assets/img/pirates.png'
							),
							'desc'    => esc_html__( 'Custom styles works only if you have set a valid Mapbox API token in the field above.', 'listable' ),
						),
						'google_maps_api_key' => array(
							'type'    => 'text',
							'label'   => esc_html__( 'Google Maps API key', 'listable' ),
							'default' => '',
							'desc'    => sprintf(
								'<p>%s </p> <a href="//developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key" target="_blank">%s</a>',
								esc_html__( 'To use the Google Maps library you must authenticate your application with an API key.', 'listable' ),
								esc_html__( 'Get a Key', 'listable' )
							)
						)

					)
				),
				'custom_js'   => array(
					'title'   => esc_html__( 'Custom JavaScript', 'listable' ),
					'options' => array(
						'custom_js'        => array(
							'type'        => 'ace_editor',
							'label'       => esc_html__( 'Header', 'listable' ),
							'desc'        => esc_html__( 'Easily add Custom Javascript code. This code will be loaded in the <head> section.', 'listable' ),
							'editor_type' => 'javascript',
						),
						'custom_js_footer' => array(
							'type'        => 'ace_editor',
							'label'       => esc_html__( 'Footer', 'listable' ),
							'desc'        => esc_html__( 'You can paste here your Google Analytics tracking code (or for what matters any tracking code) and we will put it on every page.', 'listable' ),
							'editor_type' => 'javascript',
						),
					)
				),

				'import_demo_data' => array(
					'title'    => __( 'Demo Data', 'listable' ),
					'description' => esc_html__( 'If you would like to have a "ready to go" website as the Listable\'s demo page here is the button', 'listable' ),
					'priority' => 999999,
					'options'  => array(
						'import_demodata_button' => array(
							'title' => 'Import',
							'type'  => 'html',
							'html'  => '<input type="hidden" name="wpGrade-nonce-import-posts-pages" value="' . wp_create_nonce( 'wpGrade_nonce_import_demo_posts_pages' ) . '" />
										<input type="hidden" name="wpGrade-nonce-import-theme-options" value="' . wp_create_nonce( 'wpGrade_nonce_import_demo_theme_options' ) . '" />
										<input type="hidden" name="wpGrade-nonce-import-widgets" value="' . wp_create_nonce( 'wpGrade_nonce_import_demo_widgets' ) . '" />
										<input type="hidden" name="wpGrade_import_ajax_url" value="' . admin_url( "admin-ajax.php" ) . '" />' .
										'<span class="description customize-control-description">' . esc_html__( '(Note: We cannot serve you the original images due the ', 'listable' ) . '<strong>&copy;</strong>)</span></br>' .
										'<a href="#" class="button button-primary" id="wpGrade_import_demodata_button" style="width: 70%; text-align: center; padding: 10px; display: inline-block; height: auto;  margin: 0 15% 10% 15%;">
											' . __( 'Import demo data', 'listable' ) . '
										</a>

										<div class="wpGrade-loading-wrap hidden">
											<span class="wpGrade-loading wpGrade-import-loading"></span>
											<div class="wpGrade-import-wait">' .
												esc_html__( 'Please wait a few minutes (between 1 and 3 minutes usually, but depending on your hosting it can take longer) and ', 'listable' ) .
												'<strong>' . esc_html__( 'don\'t reload the page', 'listable' ) . '</strong>.' .
												esc_html__( 'You will be notified as soon as the import has finished!', 'listable' ) . '
											</div>
										</div>

										<div class="wpGrade-import-results hidden"></div>
										<div class="hr"><div class="inner"><span>&nbsp;</span></div></div>'
						)
					)
				)
			)
		);


		$options['panels']['colors'] = array(
			'title'    => '&#x1f3a8; ' . esc_html__( 'Colors', 'listable' ),
			'sections' => array(
				'site_header' => array(
					'title'   => esc_html__( 'Site Header', 'listable' ),
					'options' => array(
						'header_transparent'      => array(
							'type'    => 'checkbox',
							'default' => true,
							'label'   => esc_html__( 'Transparent on Front Page Hero', 'listable' ),
						),
						'header_background_color' => array(
							'type'    => 'color',
							'label'   => esc_html__( 'Header Background Color', 'listable' ),
							'live'    => true,
							'default' => '#FFFFFF',
							'css'     => array(
								array(
									'property' => 'background-color',
									'selector' => '.bar, .bar--fixed, .site-header,
									.primary-menu ul .children, ul.primary-menu .sub-menu, .search-suggestions-menu,
									.search-suggestions-menu .sub-menu,
									.site-header .search-form .search-field,
									.site-header .search-form.is--active,
									.search_jobs--frontpage .chosen-container .chosen-results'
								),
								array(
									'property' => 'border-top-color',
									'selector' => 'ul.primary-menu > .menu-item.menu-item-has-children > .sub-menu:before,
												  .site-header .search-suggestions-menu:before',
								),
								array(
									'property'        => 'border-top-color',
									'media'           => 'only screen and  (min-width: 900px)',
									'selector'        => '.primary-menu ul .children, ul.primary-menu .sub-menu',
									'callback_filter' => 'listable_customify_darker_callback'
								),
								array(
									'property' => 'background-color',
									'media'    => 'not screen and (min-width: 900px)',
									'selector' => '.menu-wrapper, .search-form input.search-field',
								),
								array(
									'property'        => 'background-color',
									'media'           => 'not screen  and (min-width: 900px)',
									'selector'        => '.primary-menu ul .children, ul.primary-menu .sub-menu',
									'callback_filter' => 'listable_customify_darker_callback'
								),
							)
						),
						'site_title_color'        => array(
							'type'    => 'color',
							'label'   => __( 'Site Title Color', 'listable' ),
							'live'    => true,
							'default' => '#484848',
							'css'     => array(
								array(
									'property' => 'color',
									'selector' => '.site-header .site-title,
									.menu-trigger, .search-trigger--mobile'
								),
							),
						),
						'search_color'            => array(
							'type'    => 'color',
							'label'   => __( 'Search Color', 'listable' ),
							'live'    => true,
							'default' => '#484848',
							'css'     => array(
								array(
									'property' => 'color',
									'selector' => '.search-form .search-field,
									.search-form .search-submit',
								),
							)
						),
						'nav_link_color'          => array(
							'type'    => 'color',
							'label'   => __( 'Nav Link Color', 'listable' ),
							'live'    => true,
							'default' => '#919191',
							'css'     => array(
								array(
									'property' => 'color',
									'selector' => '.header--transparent .primary-menu ul .children a,
										.primary-menu ul .header--transparent .children a,
										.header--transparent ul.primary-menu .sub-menu a,
										ul.primary-menu .header--transparent .sub-menu a,
										div.sd-social.sd-social .inner a span'
								),
								array(
									'property' => 'color',
									'selector' => '.primary-menu ul a, ul.primary-menu a, .menu-wrapper a,
										.primary-menu ul .page_item a,
										ul.primary-menu .menu-item a,
										.primary-menu ul .page_item_has_children > a,
										ul.primary-menu .menu-item-has-children > a'
								),
								array(
									'property' => 'border-top-color',
									'selector' => '.sub-menu .primary-menu ul .page_item_has_children:after,
										.primary-menu ul .sub-menu .page_item_has_children:after,
										.sub-menu ul.primary-menu .menu-item-has-children:after,
										ul.primary-menu .sub-menu .menu-item-has-children:after,
										.primary-menu ul .page_item_has_children:after,
										ul.primary-menu .menu-item-has-children:after,
										.primary-menu ul > .cta.page_item:after,
										ul.primary-menu > .cta.menu-item:after',
								),
							)
						),
						'nav_active_color'        => array(
							'type'    => 'color',
							'label'   => __( 'Nav Active Color', 'listable' ),
							'live'    => true,
							'default' => '#FF4D55',
							'css'     => array(
								array(
									'property' => 'border-top-color',
									'selector' => '.primary-menu.primary-menu ul .page_item_has_children:hover:after,
													ul.primary-menu.primary-menu .menu-item-has-children:hover:after,
													.hover.menu-item-has-children > a:after, .hover.page_item_has_children > a:after,
													.page-template-front_page .is--active .search-field-wrapper:after',
								),
								array(
									'property' => 'border-left-color',
									'selector' => '.search-suggestions-menu .menu-item-has-children:hover:after',
								),
								array(
									'property' => 'color',
									'selector' => '.primary-menu > ul li:hover > a, ul.primary-menu li:hover > a,
														.search-suggestions-menu li:hover > a,
														.header--transparent .primary-menu ul .page_item_has_children:hover > a,
														.header--transparent .primary-menu ul .page_item:hover > a,
														.header--transparent ul.primary-menu .menu-item-has-children:hover > a,
														.header--transparent ul.primary-menu .menu-item:hover > a'
								),
								array(
									'property' => 'background-color',
									'selector' => '.page-template-front_page .search-suggestions-menu > .menu-item:hover > a,
									.search_jobs--frontpage .chosen-container .chosen-results li:hover'
								)
							)
						),
						'nav_button_color'        => array(
							'type'    => 'color',
							'label'   => __( 'Nav Button Color', 'listable' ),
							'live'    => true,
							'default' => '#EBEBEB',
							'css'     => array(
								array(
									'property' => 'border-color',
									'media'    => 'screen and (min-width: 900px) ',
									'selector' => '.primary-menu ul > .cta.page_item, ul.primary-menu > .cta.menu-item',
								),
							)
						),
					)
				),

				'main_content' => array(
					'title'   => esc_html__( 'Main Content', 'listable' ),
					'options' => array(
						'content_background' => array(
							'type'    => 'color',
							'label'   => __( 'Content Background', 'listable' ),
							'live'    => true,
							'default' => '#FFFFFF',
							'css'     => array(
								array(
									'property' => 'background-color',
									'selector' => 'html, .job_filters, .page-package-selection .hentry.hentry, .single-job_listing .entry-header:before,
									.listing-sidebar--main .widget:not(.widget_listing_tags):not(.widget_listing_actions):not(.widget_listing_comments),
									.listing-sidebar--top .widget,
									.listing-sidebar--bottom,
									.listing-sidebar--main .comment-respond,
									.page-add-listing .entry-content,
									.page-add-listing fieldset:first-child,
									.woocommerce-account:not(.logged-in) .entry-content .woocommerce form,
									.post-password-form,
									.page-listings div.job_listings .load_more_jobs strong',
								),
								array(
									'property' => 'border-right-color',
									'selector' => '.widget_listing_comments #add_post_rating:not(:empty):before',
								)
							)
						),
						'page_background'    => array(
							'type'    => 'color',
							'label'   => __( 'Page Background', 'listable' ),
							'live'    => true,
							'default' => '#F9F9F9',
							'css'     => array(
								array(
									'property' => 'background-color',
									'selector' => '.front-page-section:nth-child(2n),
										.blog, .archive, .woocommerce.archive,
										.page-header, .page-header-background,
										.single:not(.single-job_listing) .entry-featured, .page .entry-featured,
										.error404 .entry-header, .search-no-results .entry-header,
										.single-job_listing,
										.page-add-listing .hentry,
										.job_filters .showing_jobs,
										.job_listing_packages,
										.page-listings,
										.tax-job_listing_category,
										.tax-job_listing_tag,
										.single-action-buttons .action__icon,
										.woocommerce-account:not(.logged-in) .site-content,
										.woocommerce-account:not(.logged-in) .entry-content,
										.mobile-buttons, .tabs.wc-tabs,
										.woocommerce-cart,
										.woocommerce-checkout',
								),
								array(
									'property' => 'background-color',
									// 'media' 		=> 'screen and (min-width: 1000px) ',
									'selector' => '.job_listing_packages,',
								),
								array(
									'media'    => 'not screen and (min-width: 480px)',
									'property' => 'background-color',
									'selector' => '.grid.job_listings > .grid__item,
												.job_listings.product-content > .grid__item,
												.product-content.job_listings > *'
								),

							)
						),
						'page_titles_color'  => array(
							'type'    => 'color',
							'label'   => __( 'Page Titles Color', 'listable' ),
							'live'    => true,
							'default' => '#484848',
							'css'     => array(
								array(
									'property' => 'color',
									'selector' => '.page-title,
										.widget_title--frontpage,
										.single:not(.single-job_listing) .entry-title, .page .entry-title,

										.card__title.card__title,
										.card__title.card__title a,
										.package__price,
										.product .card__title.card__title,

										h1, h2, h3, h4, h5, h6,
										.results,
										.intro,
										.listing-sidebar .widget_sidebar_title',
								),
							)
						),

						'page_subtitles_color'     => array(
							'type'    => 'color',
							'label'   => __( 'Page Subtitles Color', 'listable' ),
							'live'    => true,
							'default' => '#919191',
							'css'     => array(
								array(
									'property' => 'color',
									'selector' => '.widget_subtitle--frontpage',
								),
							)
						),
						'text_color'         => array(
							'type'    => 'color',
							'label'   => __( 'Text Color', 'listable' ),
							'live'    => true,
							'default' => '#484848',
							'css'     => array(
								array(
									'property' => 'color',
									'selector' => '.entry-content a:hover, .comment-content a:hover,
										label, html,

										.widget--footer .search-form .search-field,
										.entry-content a.listing-contact,
										.single-action-buttons .action__text, .single-action-buttons .action__text--mobile,
										div.sd-social.sd-social > div.sd-content.sd-content ul li > a span,

										.listing-sidebar,
										.widget_listing_content,
										.widget_listing_comments h3.pixrating_title,
										.widget_listing_sidebar_categories .category-text,
										.widget_listing_tags .tag__text,
										ol.comment-list .fn,
										ol.comment-list .fn a,
										ol.comment-list .comment-content,
										ol.comment-list .reply,
										.comment-respond label,
										.page-template-front_page .search-form .search-field,
										.woocommerce-account:not(.logged-in) .woocommerce form.login .form-row .required,
										.mobile-buttons .btn--view, .search_jobs--frontpage .chosen-container .chosen-results li'
								),

								array(
									'property' => 'border-color',
									'selector' => 'input[type="checkbox"]:focus,
													.package__btn.package__btn:hover',
								),

								array(
									'property' => 'background-color',
									'selector' => '.btn:hover, input[type="submit"]:hover,
										.job-manager-form fieldset .job-manager-uploaded-files .job-manager-uploaded-file .job-manager-uploaded-file-preview a:hover,
										.woocommerce-account:not(.logged-in) .woocommerce form.login input[type="submit"]:hover,
										.woocommerce .button:hover, .btn:focus, input[type="submit"]:focus,
										.job-manager-form fieldset .job-manager-uploaded-files .job-manager-uploaded-file .job-manager-uploaded-file-preview a:focus,
										.woocommerce-account:not(.logged-in) .woocommerce form.login input[type="submit"]:focus, .woocommerce .button:focus,
										.package__btn.package__btn:hover,
										.job_listing_preview_title input[name="edit_job"],
										 .page-template-front_page .search-form .search-submit:hover',
								),
							)
						),
						'buttons_color'      => array(
							'type'    => 'color',
							'label'   => __( 'Buttons Color', 'listable' ),
							'live'    => true,
							'default' => '#FF4D55',
							'css'     => array(
								array(
									'property' => 'background-color',
									'selector' => '.btn, input[type="submit"],
										.page-template-front_page .search-form .search-submit,
										.job-manager-form fieldset .job-manager-uploaded-files .job-manager-uploaded-file .job-manager-uploaded-file-preview a,
										.woocommerce-account:not(.logged-in) .woocommerce form.login input[type="submit"],
										.woocommerce .button,
										.popup__rating,
										.single-action-buttons .action:hover .action__icon,
										.action--favorite.bookmarked .action__icon,
										.package--featured .package__btn.package__btn,
										.featured-label,
										.product .product__tag,
										.wc-bookings-date-picker .ui-datepicker td > a:hover,
										.wc-bookings-date-picker .ui-datepicker table .bookable-range a,
										.wc-bookings-date-picker .ui-datepicker table .ui-datepicker-current-day a,
										.block-picker > li a.selected,
										.block-picker > li a:hover,
										.lwa-form input[type="submit"]:hover',
								),
								array(
									'property' => 'color',
									'selector' => '.package__btn.package__btn',
								),
								array(
									'property' => 'fill',
									'selector' => '.heart.is--bookmarked #hearshape',
								),
							)
						),
					)
				),

				'cards' => array(
					'title'   => esc_html__( 'Cards', 'listable' ),
					'options' => array(
						'cards_background'            => array(
							'type'    => 'color',
							'label'   => __( 'Cards Background', 'listable' ),
							'live'    => true,
							'default' => '#FFFFFF',
							'css'     => array(
								array(
									'property' => 'background-color',
									'selector' => '.card, .package, .leaflet-popup-content, .leaflet-popup-tip'
								),
							)
						),
						'cards_radius'                => array(
							'type'        => 'range',
							'label'       => 'Cards Radius',
							'live'        => true,
							'default'     => 8,
							'input_attrs' => array(
								'min'  => 0,
								'max'  => 36,
								'step' => 2,
							),
							'css'         => array(
								array(
									'selector' => '.card',
									'property' => 'border-radius',
									'unit'     => 'px'
								)
							)
						),
						'thumbs_radius'               => array(
							'type'        => 'range',
							'label'       => 'Thumbs Radius',
							'live'        => true,
							'default'     => 4,
							'input_attrs' => array(
								'min'  => 0,
								'max'  => 36,
								'step' => 2,
							),
							'css'         => array(
								array(
									'selector' => 'ul.categories--widget .category-cover',
									'property' => 'border-radius',
									'unit'     => 'px'
								)
							)
						),
						'cards_title_color'           => array(
							'type'    => 'color',
							'label'   => __( 'Title Color', 'listable' ),
							'live'    => true,
							'default' => '#FF4D55',
							'css'     => array(
								array(
									'property' => 'color',
									'selector' => '.card--listing .card__title.card__title,
														.card--post a:hover,
														.grid__item--widget .posted-on a:hover,
														.grid__item--widget .card--post a:hover,
														.popup__title.popup__title',
								),
							)
						),
						'cards_text_color'            => array(
							'type'    => 'color',
							'label'   => __( 'Text Color', 'listable' ),
							'live'    => true,
							'default' => '#ababab',
							'css'     => array(
								array(
									'property' => 'color',
									'selector' => '.card, .card__content, .card--post.sticky,
									.popup__address, .package__description,
									.single-job_listing .entry-subtitle',
								),
							)
						),
						'cards_icon_color'            => array(
							'type'    => 'color',
							'label'   => __( 'Icons Color', 'listable' ),
							'live'    => true,
							'default' => '#FF4D5A',
							'css'     => array(
								array(
									'property' => 'color',
									'selector' => '.card .pin,
														.card .pin__icon,
														.card--listing .card__rating.rating,
														.widget_listing_sidebar_categories .category-icon',
								),
							)
						),
						'cards_icon_border_color'     => array(
							'type'    => 'color',
							'label'   => __( 'Icons Border Color', 'listable' ),
							'live'    => true,
							'default' => '#FF4D5A',
							'css'     => array(
								array(
									'property' => 'border-color',
									'selector' => '.card__tag,
													.card__rating.rating,
													.single-action-buttons .action__icon,
													.widget_listing_sidebar_categories .category-icon',
								),
								array(
									'property' => 'fill',
									'selector' => '.pin--selected #selected',
								),
								array(
									'property' => 'color',
									'selector' => '.card__rating.card__pin',
								),
							)
						),
						'cards_icon_background_color' => array(
							'type'    => 'color',
							'label'   => __( 'Icon Background Color', 'listable' ),
							'live'    => true,
							'default' => '#FFFFFF',
							'css'     => array(
								array(
									'property' => 'background-color',
									'selector' => '.card__tag,
										.card__rating.rating,
										.widget_listing_sidebar_categories .category-icon',
								),
							)
						),
						'pin_background_color'        => array(
							'type'    => 'color',
							'label'   => __( 'Pin Background Color', 'listable' ),
							'live'    => true,
							'default' => '#FFFFFF',
							'css'     => array(
								array(
									'property' => 'fill',
									'selector' => '.pin #selected,
										.marker-cluster svg #svgCluster2,
										.marker-cluster svg #svgCluster3,
										.marker-cluster svg #svgCluster4,
										.pin #oval',
								),
							)
						),
						'pin_icon_color'              => array(
							'type'    => 'color',
							'label'   => __( 'Pin Color', 'listable' ),
							'live'    => true,
							'default' => '#FF4D5A',
							'css'     => array(
								array(
									'property' => 'fill',
									'selector' => '.pin--selected #selected,
										.marker-cluster svg #svgCluster1,
										.heart.is--bookmarked #heartshape',
								),
								array(
									'property' => 'color',
									'selector' => '.marker-cluster, .pin__icon',
								),
							)
						),
					)
				),

				'prefooter' => array(
					'title'   => esc_html__( 'Pre Footer', 'listable' ),
					'options' => array(
						'prefooter_background' => array(
							'type'    => 'color',
							'label'   => __( 'Background', 'listable' ),
							'live'    => true,
							'default' => '#2F2929',
							'css'     => array(
								array(
									'property' => 'background-color',
									'selector' => '.footer-widget-area'
								),
							)
						),
						'prefooter_text_color' => array(
							'type'    => 'color',
							'label'   => __( 'Text Color', 'listable' ),
							'live'    => true,
							'default' => '#FFFFFF',
							'css'     => array(
								array(
									'property' => 'color',
									'selector' => '.widget--footer',
								)
							)
						),
					)
				),

				'footer' => array(
					'title'   => esc_html__( 'Footer', 'listable' ),
					'options' => array(
						'footer_background'    => array(
							'type'    => 'color',
							'label'   => __( 'Background', 'listable' ),
							'live'    => true,
							'default' => '#261E1E',
							'css'     => array(
								array(
									'property' => 'background-color',
									'selector' => '.site-footer'
								),
							)
						),
						'footer_text_color'    => array(
							'type'    => 'color',
							'label'   => __( 'Text Color', 'listable' ),
							'live'    => true,
							'default' => '#ADADB2',
							'css'     => array(
								array(
									'property' => 'color',
									'selector' => '.site-info',
								),
							)
						),
						'footer_credits_color' => array(
							'type'    => 'color',
							'label'   => __( 'Credits Color', 'listable' ),
							'live'    => true,
							'default' => '#706C6C',
							'css'     => array(
								array(
									'property' => 'color',
									'selector' => '.theme-info',
								),
							)
						),
					)
				),

				'other_color' => array(
					'title'   => esc_html__( 'Other Colors', 'listable' ),
					'options' => array(
						'accent_color' => array(
							'type'    => 'color',
							'label'   => __( 'Accent Color', 'listable' ),
							'live'    => true,
							'default' => '#FF4D58',
							'css'     => array(
								array(
									'property' => 'color',
									'selector' => '.not-entry-content a,
													.comment-content a,
													.single-categories-breadcrumb a:hover,
													.single-rating > i, .widget_listing_comments .comment .review_rate > i,
													.single-action-buttons .action:hover .action__text,
													.action--favorite.bookmarked .action__icon,
													.tags-links a:hover, .tags-links a:focus,
													.loader,
													.listing-sidebar a:hover,
													.listing-sidebar .action__icon,
													.widget_listing_comments #add_comment_rating_wrap i,
													ol.comment-list .fn a:hover,
													.single-job_listing .entry-title,
													.page-listings div.job_listings .load_more_jobs:hover strong,
													.tax-job_listing_category div.job_listings .load_more_jobs:hover strong,
													.tax-job_listing_tag div.job_listings .load_more_jobs:hover strong,
													.chosen-container-single .chosen-single span,
													.chosen-container .chosen-results li.highlighted,
													progress,
													.single-product .stars a:before,
													.product-content .price,
													.tabs.wc-tabs li.active a,
													.color-accent,
													.entry-content a, .comment-content a,
													.gallery-arrow,
													.job-manager-form fieldset .job-manager-uploaded-files .job-manager-uploaded-file .job-manager-uploaded-file-preview a:hover,
													.job-manager-form fieldset .job-manager-uploaded-files .job-manager-uploaded-file .job-manager-uploaded-file-preview a:focus,
													.package__btn.package__btn:hover,
													.nav-links a:hover, .site-footer a:hover, .facetwp-pager a:hover,
													.facetwp-pager a.first-page:hover:before, .facetwp-pager a.first-page:hover:after,
													.facetwp-pager a.last-page:hover:before, .facetwp-pager a.last-page:hover:after,
													.widget_listing_sidebar_claim_listing .listing-claim-button, .lwa-form .lwa-action-link,
													.pac-container .pac-item:hover .pac-item-query',
								),
								array(
									'property' => 'background-color',
									'selector' => '.secondary-menu, .secondary-menu-wrapper:before, .product__remove,
													.page-template-front_page .pac-container .pac-item:hover,
													.page-template-front_page .search_jobs--frontpage .search-submit,
													.facetwp-type-slider .noUi-connect,
													.card__featured-tag, .woocommerce-message',
								),
								array(
									'property' => 'background',
									'selector' => 'progress::-webkit-progress-bar',
								),
								array(
									'property' => 'background',
									'selector' => 'progress::-webkit-progress-value',
								),
								array(
									'property' => 'background',
									'selector' => 'progress::-moz-progress-bar',
								),
								array(
									'property' => 'border-top-color',
									'selector' => '.page-template-front_page .is--active .search-field-wrapper.has--menu:after,
									ul.secondary-menu > .menu-item.menu-item-has-children > .sub-menu:after',
								)
							)
						),

						'fields_color' => array(
							'type'    => 'color',
							'label'   => __( 'Meta Fields Color', 'listable' ),
							'live'    => true,
							'default' => '#919191',
							'css'     => array(
								array(
									'property' => 'color',
									'selector' => '.description, .tabs.wc-tabs,

														.single-categories-breadcrumb a,
														.single-categories-breadcrumb a:after,
														.single-rating .rating-value, .widget_listing_comments .comment .review_rate .rating-value,
														div.sd-social.sd-social > div.sd-content.sd-content ul li > a,
														.sharedaddy div.sd-social-icon .sd-content ul li[class*="share-"].share-press-this a.sd-button,
														.sharedaddy div.sd-social-icon .sd-content ul li[class*="share-"].share-press-this a.sd-button:before,
														.tags-links,
														.tags-links a,
														.listing-sidebar a,
														.widget_listing_comments .comment-meta a,
														.comment-meta a,
														.single:not(.single-job_listing) .entry-subtitle, .page .entry-subtitle,
														.single:not(.single-job_listing) .entry-meta a, .page .entry-meta a,
														.tax-job_listing_category div.job_listings .load_more_jobs strong, .tax-job_listing_tag div.job_listings .load_more_jobs strong,

														.search_jobs select,
														.chosen-container-multi .chosen-choices li.search-field input[type=text], .chosen-container-single .chosen-single span,
														.active-tag,
														.select-tags .chosen-container-multi .chosen-choices,

														.chosen-results,
														.job-manager-form .field small.field-description,
														.uploader-btn .spacer .text,
														.page-add-listing .chosen-container-multi .chosen-choices li.search-choice,
														.woocommerce-account:not(.logged-in) .woocommerce form.login label[for=rememberme],
														.woocommerce-account:not(.logged-in) .lost_password a,
														.woocommerce-breadcrumb,
														.product-content .price del,
														.mfp-iframe-scaler.mfp-wp-login .mfp-close,
														.nav-links a, .facetwp-pager a'
								),
								array(
									'property' => 'color',
									'selector' => '.page-template-front_page .search-form .search-field::-webkit-input-placeholder'
								),
								array(
									'property' => 'color',
									'selector' => '.page-template-front_page .search-form .search-field::-moz-placeholder'
								),
								array(
									'property' => 'color',
									'selector' => '.page-template-front_page .search-form .search-field::-moz-placeholder'
								),
								array(
									'property' => 'color',
									'selector' => '.select-tags .chosen-container-multi .chosen-choices li.search-field::-webkit-input-placeholder'
								),
								array(
									'property' => 'color',
									'selector' => '.select-tags .chosen-container-multi .chosen-choices li.search-field:-moz-placeholder'
								),
								array(
									'property' => 'color',
									'selector' => '.select-tags .chosen-container-multi .chosen-choices li.search-field::-moz-placeholder'
								),
								array(
									'property' => 'color',
									'selector' => '.select-tags .chosen-container-multi .chosen-choices li.search-field:-ms-input-placeholder'
								),
								array(
									'property' => 'color',
									'selector' => '.description_tooltip',
								),
							)
						),
						'micro_color'  => array(
							'type'    => 'color',
							'label'   => __( 'Micro Elements', 'listable' ),
							'live'    => true,
							'default' => '#ABABAB',
							'css'     => array(
								array(
									'property' => 'color',
									'selector' => '.job_filters .showing_jobs,
										.tax-job_listing_category div.job_listings .load_more_jobs strong,
										.tax-job_listing_tag div.job_listings .load_more_jobs strong'
								),
								array(
									'property' => 'border-top-color',
									'selector' => '
										.chosen-container-single .chosen-single div b:after,
										.select-tags .chosen-container-multi .chosen-choices:after'
								),
								array(
									'property' => 'background-color',
									'selector' => '
										.remove-tag:before,
										.remove-tag:after'
								),
							)
						),

					)
				),
			)
		);

		$options['panels']['fonts'] = array(
			'title'    => '&#x1f4dd; ' . esc_html__( 'Fonts', 'listable' ),
			'sections' => array(
				'site_title_font' => array(
					'title'   => esc_html__( 'Site Title', 'listable' ),
					'options' => array(
						'site_title_font'           => array(
							'type'        => 'typography',
							// 'label'            => esc_html__( 'Site Title', 'listable' ),
							'desc'        => __( 'The font used for Site Title when you do not have a Logo image.', 'listable' ),
							'selector'    => '.site-header .site-title',
							'default'     => array( 'Hanken', '700' ),
							'recommended' => $recommended_headings_fonts
						),

						// Font Size
						'site_title_font_size'      => array(
							'type'        => 'range',
							'label'       => __( 'Font Size', 'listable' ),
							'live'        => true,
							'default'     => 24,
							'input_attrs' => array(
								'min'          => 8,
								'max'          => 40,
								'step'         => 1,
								'data-preview' => true
							),
							'css'         => array(
								array(
									'property' => 'font-size',
									'selector' => '.site-header .site-title',
									'unit'     => 'px',
								)
							)
						),

						// Text Transform
						'site_title_text_transform' => array(
							'label'   => __( 'Text Transform', 'listable' ),
							'live'    => true,
							'type'    => 'select',
							'choices' => array(
								'none'       => 'None',
								'capitalize' => 'Capitalize',
								'uppercase'  => 'Uppercase',
								'lowercase'  => 'Lowercase',
							),
							'default' => 'None',
							'css'     => array(
								array(
									'property' => 'text-transform',
									'selector' => '.site-header .site-title',
								)
							)
						),

						// Letter Spacing
						'site_title_letter-spacing' => array(
							'type'        => 'range',
							'label'       => __( 'Letter Spacing', 'listable' ),
							'live'        => true,
							'default'     => 0,
							'input_attrs' => array(
								'min'          => - 2,
								'max'          => 20,
								'step'         => 1,
								'data-preview' => true
							),
							'css'         => array(
								array(
									'property' => 'letter-spacing',
									'selector' => '.site-header .site-title',
									'unit'     => 'px',
								)
							)
						),
					)
				),

				'navigation_font' => array(
					'title'   => esc_html__( 'Navigation Text', 'listable' ),
					'options' => array(
						'navigation_font'           => array(
							'type'             => 'typography',
							'label'            => esc_html__( 'Navigation Text', 'listable' ),
							'selector'         => '.primary-menu > ul, ul.primary-menu a',
							'load_all_weights' => false,
							'subsets'          => false,
							'default'          => array( 'Hanken', '400' ),
							'recommended'      => $recommended_body_fonts
						),

						// Font Size
						'navigation_font_size'      => array(
							'type'        => 'range',
							'label'       => __( 'Font Size', 'listable' ),
							'live'        => true,
							'default'     => 14.95,
							'input_attrs' => array(
								'min'          => 10,
								'max'          => 20,
								'step'         => 0.1,
								'data-preview' => true
							),
							'css'         => array(
								array(
									'property' => 'font-size',
									'selector' => '.primary-menu > ul a, ul.primary-menu a,
											.search-suggestions-menu li a',
									'unit'     => 'px',
								)
							)
						),

						// Text Transform
						'navigation_text_transform' => array(
							'label'   => __( 'Text Transform', 'listable' ),
							'live'    => true,
							'type'    => 'select',
							'choices' => array(
								'none'       => 'None',
								'capitalize' => 'Capitalize',
								'uppercase'  => 'Uppercase',
								'lowercase'  => 'Lowercase',
							),
							'default' => 'Capitalize',
							'css'     => array(
								array(
									'property' => 'text-transform',
									'selector' => '.primary-menu > ul a, ul.primary-menu a,
											.search-suggestions-menu li a',
								)
							)
						),

						// Letter Spacing
						'navigation_letter-spacing' => array(
							'type'        => 'range',
							'label'       => __( 'Letter Spacing', 'listable' ),
							'live'        => true,
							'default'     => 0,
							'input_attrs' => array(
								'min'          => - 2,
								'max'          => 20,
								'step'         => 1,
								'data-preview' => true
							),
							'css'         => array(
								array(
									'property' => 'letter-spacing',
									'selector' => '.primary-menu > ul a, ul.primary-menu a,
											.search-suggestions-menu li a',
									'unit'     => 'px',
								)
							)
						),
					)
				),

				'body_font' => array(
					'title'   => esc_html__( 'Body Text', 'listable' ),
					'options' => array(
						'body_font' => array(
							'type'             => 'typography',
							'label'            => esc_html__( 'Body Font', 'listable' ),
							'selector'         => 'input,
								textarea,
								label,
								html,
								.entry-content blockquote cite,
								.comment-content blockquote cite,
								.card--feature .card__content,
								.rating,
								.widget--footer .search-form .search-field,
								.featured-label,
								.package__description,
								.footer-text-area,
								.widget_listing_comments h3.pixrating_title,
								.chosen-container-multi .chosen-choices,
								.chosen-container-single .chosen-single,
								.product .product__price,
								.product .product__tag',
							'load_all_weights' => true,
							'default'          => array( 'type' => 'google', 'font_family' => 'Source Sans Pro', 'variants' => 'regular' ),
							'recommended'      => $recommended_body_fonts
						),
					)
				),

				// $Headings
				'page_titles_font' => array(
					'title'   => esc_html__( 'Page Titles', 'listable' ),
					'options' => array(
						'page_titles_font' => array(
							'type'             => 'typography',
							'label'            => esc_html__( 'Headings', 'listable' ),
							'selector'         => '.entry-title, .archive-title,
									h1, h2, h3,
									.card--feature .card__title,
									.results,
									.page-title,
									.search_location input,
									.package__title, .package__price,
									h2.comments-title,
									.page-add-listing fieldset:first-child label,
									.product-content .price',
							'load_all_weights' => false,
							'subsets'          => true,
							'default'          => array( 'Hanken', '700' ),
							'recommended'      => $recommended_headings_fonts
						),
					)
				),

				'page_subtitles_font' => array(
					'title'   => esc_html__( 'Page Subtitles', 'listable' ),
					'options' => array(
						'page_subtitles_font' => array(
							'type'             => 'typography',
							'label'            => esc_html__( 'Page Subtitles', 'listable' ),
							'selector'         => '.intro,
									.description,
									.tabs.wc-tabs,
									.job-manager-form fieldset .job-manager-uploaded-files .job-manager-uploaded-file .job-manager-uploaded-file-preview a,
									.widget_subtitle--frontpage,
									.category-list a,
									.single:not(.single-job_listing) .entry-subtitle,
									.page .entry-subtitle,
									.single-job_listing .entry-subtitle',
							'load_all_weights' => false,
							'subsets'          => false,
							'default'          => array( 'Hanken', '400' ),
							'recommended'      => $recommended_headings_fonts
						),
					)
				),

				'card_title_font' => array(
					'title'   => esc_html__( 'Card Title Font', 'listable' ),
					'options' => array(
						'card_title_font'           => array(
							'type'             => 'typography',
							'label'            => esc_html__( 'Card Title Font', 'listable' ),
							'selector'         => '.card__title.card__title, ul.categories--widget .category-count,
									ul.categories--widget .category-text',
							'load_all_weights' => false,
							'default'          => array( 'Hanken', '700' ),
							'recommended'      => $recommended_headings_fonts
						),
						// Font Size
						'card_title_font_size'      => array(
							'type'        => 'range',
							'label'       => __( 'Font Size', 'listable' ),
							'live'        => true,
							'default'     => 24,
							'input_attrs' => array(
								'min'          => 10,
								'max'          => 40,
								'step'         => 1,
								'data-preview' => true
							),
							'css'         => array(
								array(
									'property' => 'font-size',
									'selector' => '.card__title.card__title,
									ul.categories--widget .category-text',
									'unit'     => 'px',
								)
							)
						),

						// Text Transform
						'card_title_text_transform' => array(
							'label'   => __( 'Text Transform', 'listable' ),
							'live'    => true,
							'type'    => 'select',
							'choices' => array(
								'none'       => 'None',
								'capitalize' => 'Capitalize',
								'uppercase'  => 'Uppercase',
								'lowercase'  => 'Lowercase',
							),
							'default' => 'None',
							'css'     => array(
								array(
									'property' => 'text-transform',
									'selector' => '.card__title.card__title, ul.categories--widget .category-count,
									ul.categories--widget .category-text',
								)
							)
						),

						// Letter Spacing
						'card_title_letter-spacing' => array(
							'type'        => 'range',
							'label'       => __( 'Letter Spacing', 'listable' ),
							'live'        => true,
							'default'     => 0,
							'input_attrs' => array(
								'min'          => - 2,
								'max'          => 20,
								'step'         => 1,
								'data-preview' => true
							),
							'css'         => array(
								array(
									'property' => 'letter-spacing',
									'selector' => '.card__title.card__title, ul.categories--widget .category-count,
									ul.categories--widget .category-text',
									'unit'     => 'px',
								)
							)
						),
					)
				),

				'card_font' => array(
					'title'   => esc_html__( 'Card Font', 'listable' ),
					'options' => array(
						'card_font' => array(
							'type'             => 'typography',
							'label'            => esc_html__( 'Card Font', 'listable' ),
							'selector'         => '.card',
							'load_all_weights' => false,
							'default'          => array( 'Hanken', '400' ),
							'recommended'      => $recommended_body_fonts
						),
					)
				),

				'meta_font' => array(
					'title'   => esc_html__( 'Meta & Forms', 'listable' ),
					'options' => array(
						'meta_font' => array(
							'type'             => 'typography',
							'label'            => esc_html__( 'Meta & Forms', 'listable' ),
							'selector'         => '.single:not(.single-job_listing) .entry-meta,
								.page .entry-meta,
								.single:not(.single-job_listing) div.sd-social.sd-social > div.sd-content.sd-content ul li > a,
								.page div.sd-social.sd-social > div.sd-content.sd-content ul li > a,
								.search_jobs select,
								.search-form .search-field,
								.search_jobs--frontpage .chosen-container .chosen-results li,
								.search_jobs--frontpage .chosen-container-multi .chosen-choices li.search-field input[type=text],
								.search_jobs--frontpage .chosen-container-single .chosen-single span,
								.search_jobs .chosen-container .chosen-results li,
								.search_jobs .chosen-container-multi .chosen-choices li.search-field input[type=text],
								.search_jobs .chosen-container-single .chosen-single span,
								.search_jobs--frontpage-facetwp,
								.search_jobs--frontpage-facetwp input,
								.search_jobs--frontpage-facetwp select,
								.search_jobs--frontpage-facetwp .facetwp-filter-title,
								.header-facet-wrapper .facetwp-facet input,
								.header-facet-wrapper .facetwp-facet select,
								.header-facet-wrapper .facetwp-facet label,
								.active-tag,
								.chosen-results,
								.job_filters .search_jobs div.search_location input,
								.search-suggestions-menu li a,
								.page-template-front_page .search-form .search-submit,
								.btn,
								input[type="submit"],
								button[type="submit"],
								.woocommerce-account:not(.logged-in) .woocommerce form.login input[type="submit"],
								.woocommerce .button,
								.search_jobs--frontpage #search_location',
							'load_all_weights' => false,
							'default'          => array( 'Hanken', '400' ),
							'subsets'          => false,
							'recommended'      => $recommended_body_fonts
						),
					)
				),
			)
		);

		/**
		 * Register a second logo option which will be moved in the title_tagline section
		 */
		$options['sections']['to_be_removed'] = array(
			'options' => array(
				'logo_invert'           => array(
					'type'  => 'media',
					'label' => esc_html__( 'Logo while on Transparent Hero Area', 'listable' ),
					'desc' => esc_html__( 'Replace the default logo on the Front Page Hero.', 'listable' ),
					'show_on' => array( 'header_transparent' ),
				),
			)
		);
		// $options['panels'] = array();
		return $options;
	}
endif;


add_action( 'customize_register', 'listabe_adjust_cusotmizer_settings', 35 );

/**
 * Use this function to move or reorder options between sections
 * @param $wp_customize
 */
function listabe_adjust_cusotmizer_settings( $wp_customize ) {

	// move the `logo_invert` option to the title_tagline section(just to keep the well grouped)
	$logo_invert = $wp_customize->get_control( 'listable_options[logo_invert]_control' );
	$logo_invert->section = 'title_tagline';
	$logo_invert->priority = 9;
}

add_filter( 'customify_filter_fields', 'listable_add_customify_options' );

if ( ! function_exists( 'isLight' ) ) {
	function isLight( $color = '#ffffff' ) {
		// Get our color
		$color = ( $color ) ? $color : '#ffffff';
		// Calculate straight from rbg
		$r = hexdec( $color[0] . $color[1] );
		$g = hexdec( $color[2] . $color[3] );
		$b = hexdec( $color[4] . $color[5] );

		return ( ( $r * 299 + $g * 587 + $b * 114 ) / 1000 > 90 );
	}
}

if ( ! function_exists( 'listable_color_darken' ) ) {
	function listable_color_darken( $color, $dif = 20 ) {

		$color = str_replace( '#', '', $color );
		if ( strlen( $color ) != 6 ) {
			return '000000';
		}
		$rgb = '';

		for ( $x = 0; $x < 3; $x ++ ) {
			$c = hexdec( substr( $color, ( 2 * $x ), 2 ) ) - $dif;
			$c = ( $c < 0 ) ? 0 : dechex( $c );
			$rgb .= ( strlen( $c ) < 2 ) ? '0' . $c : $c;
		}

		return '#' . $rgb;
	}
}

if ( ! function_exists( 'listable_customify_darker_callback' ) ) {
	function listable_customify_darker_callback( $value, $selector, $property, $unit ) {
		$darkenValue = 30;
		if ( $value == '#ffffff' ) {
			$darkenValue = 6;
		} // #FFFFFF -> #F9F9F9
		$output = $selector . '{' . $property . ': ' . listable_color_darken( $value, $darkenValue ) . '}';

		return $output;
	}
}

function timber_add_customify_font_std_font( $fonts ) {
	$new_fonts = array();
	$new_fonts['Hanken'] = array(
		'font_family' => 'Hanken',
		'variants'    => array( '400', '700' )
	);

	return $new_fonts + $fonts;
}

add_filter( 'customify_filter_standard_fonts_list', 'timber_add_customify_font_std_font' );
