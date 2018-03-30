<?php

if ( ! function_exists('add_customify_heap_options') ) {

	function add_customify_heap_options( $config ) {

		// Recommended Fonts List
		// Headings
		$recommended_headings_fonts = array(
			'Open Sans',
			'Playfair Display',
			'Oswald',
			'Lato',
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
			'Open Sans',
			'Source Sans Pro',
			'Lato',
			'PT Sans',
			'Cabin',
			'Gentium Book Basic',
			'PT Serif',
			'Droid Serif'
		);

		// Navigation
		$recommended_nav_fonts = array(
			'Open Sans',
			'Source Sans Pro',
			'Lato',
			'PT Sans',
			'Cabin',
			'Gentium Book Basic',
			'PT Serif',
			'Droid Serif'
		);

		$config['opt-name'] = 'heap_options';

		$config['sections'] = array();

		$config['panels'] = array(
			/**
			 * LAYOUTS - This section will handle different elements backgrounds
			 */
			'layouts_panel' => array(
				'title'    => '&#x1f4bb; &nbsp;&nbsp;' . esc_html__( 'Layout', 'heap' ),
				'sections' => array(
					'header_layouts_section' => array(
						'title'    => esc_html__( 'Header', 'heap' ),
						'options' => array(
							'divider_title_53123785432'  => array(
								'type' => 'html',
								'html' => '<span class="separator label large">' . esc_html__( 'Header', 'heap' ) . '</span>',
							),
							'header_logo_height' => array(
								'type' => 'range',
								'label'         => esc_html__( 'Logo Height', 'heap' ),
								'default'       => 90,
								'live' => true,
								'input_attrs' => array(
									'min'   => 25,
									'max'   => 125,
									'step'  => 1,
									'data-preview' => true
								),
								'css' => array(
									array(
										'property' => 'max-height',
										'selector' => '.site-title--image img',
										'unit' => 'px'
									),
									array(
										'property' => 'font-size',
										'selector' => 'body:not(.header--small) .site-logo--text',
										'unit' => 'px'
									),
								)
							),

							'header_vertical_margins' => array(
								'type' => 'range',
								'label'         => esc_html__( 'Header Vertical Spacing', 'heap' ),
								'default'       => 36,
								'live' => true,
								'input_attrs' => array(
									'min'   => 0,
									'max'   => 100,
									'step'  => 1,
									'data-preview' => true
								),
								'css' => array(
									array(
										'property' => 'padding-top',
										'selector' => '.header',
										'unit' => 'px',
										'media'    => ' screen and (min-width: 900px)'
									),
									array(
										'property' => 'padding-bottom',
										'selector' => '.header',
										'unit' => 'px',
										'media'    => 'screen and (min-width: 900px) '
									),
								)
							),

							'divider_title_9776823121'  => array(
								'type' => 'html',
								'html' => '<span class="separator label large">' . esc_html__( 'Navigation Bar', 'heap' ) . '</span>',
							),

							'nav_always_show' => array(
								'type'          => 'checkbox',
								'label'         => esc_html__( 'Always Show Nav on Scroll (Sticky)', 'heap' ),
								'default'       => '0',
							),

							'nav_placement' => array(
								'type'          => 'select',
								'label'         => esc_html__( 'Nav Placement', 'heap' ),
								'choices'       => array(
									'top'      => esc_html__( 'Top', 'heap' ),
									'bottom' => esc_html__('Bottom', 'heap' ),
								),
								'default'       => 'bottom',
							),
							'navigation_vertical_margins' => array(
								'type' => 'range',
								'label'         => esc_html__( 'Nav Vertical Spacing', 'heap' ),
								'default'       => 10,
								'live' => true,
								'input_attrs' => array(
									'min'   => 1,
									'max'   => 40,
									'step'  => 1,
									'data-preview' => true
								),
								'css' => array(
									array(
										'property' => 'padding-top',
										'selector' => '.nav--main > .menu-item > a',
										'unit' => 'px',
										'media'    => 'screen and (min-width: 900px)'
									),
									array(
										'property' => 'padding-bottom',
										'selector' => '.nav--main > .menu-item > a',
										'unit' => 'px',
										'media'    => 'screen and (min-width: 900px) '
									),
									array(
										'property' => 'margin-top',
										'selector' => '.nav--main > .menu-item > a',
										'unit' => 'px',
										'media'    => ' screen and (min-width: 900px) '
									),
									array(
										'property' => 'margin-bottom',
										'selector' => '.nav--main > .menu-item > a',
										'unit' => 'px',
										'media'    => ' screen and (min-width : 900px) '
									),
								)
							),
							'navigation_menu_items_spacing' => array(
								'type' => 'range',
								'label'         => esc_html__( 'Nav Items Spacing', 'heap' ),
								'default'       => 14,
								'live' => true,
								'input_attrs' => array(
									'min'   => 6,
									'max'   => 75,
									'step'  => 1,
									'data-preview' => true
								),
								'css' => array(
									array(
										'property' => 'padding-left',
										'selector' => '.nav--main > .menu-item > a',
										'unit' => 'px',
										'media'    => 'screen and (min-width: 900px)'
									),
									array(
										'property' => 'padding-right',
										'selector' => '.nav--main > .menu-item > a',
										'unit' => 'px',
										'media'    => 'screen and (min-width: 900px) '
									),
									array(
										'property' => 'margin-right',
										'selector' => '.nav--main > .menu-item > a',
										'unit' => 'px',
										'media'    => ' screen and (min-width: 900px) '
									),
									array(
										'property' => 'margin-left',
										'selector' => '.nav--main > .menu-item > a',
										'unit' => 'px',
										'media'    => ' screen and (min-width : 900px) '
									),
								)
							),

							'nav_borders' => array(
								'type'          => 'checkbox',
								'label'         => esc_html__( 'Show Borders (top/bottom)', 'heap' ),
								'default'       => '1',
							),

							'nav_separators' => array(
								'type'          => 'select',
								'label'         => esc_html__( 'Items Separator', 'heap' ),
								'choices'       => array(
									'default' => esc_html__( 'None', 'heap' ),
									'dots' => esc_html__('Dots', 'heap' ),
									'bars' => esc_html__('Bars', 'heap' ),
								),
								'default'       => 'default',
							),

							'nav_dropdown' => array(
								'type'          => 'select',
								'label'         => esc_html__( 'Dropdown Symbol', 'heap' ),
								'choices'       => array(
									'default' => esc_html__( 'Caret', 'heap' ),
									'plus' => esc_html__('Plus', 'heap' ),
								),
								'default'       => 'default',
							),
						)
					),

					'content_layouts_section' => array(
						'title'    => esc_html__( 'Content', 'heap' ),
						'options' => array(

							'content_width' => array(
								'type' => 'range',
								'label' => esc_html__( 'Site Container Width', 'heap' ),
								'desc' => esc_html__( 'Set the width of the container.', 'heap' ),
								'live' => true,
								'default'       => 1368,
								'input_attrs' => array(
									'min'   => 600,
									'max'   => 2700,
									'step'  => 1,
									'data-preview' => true
								),
								'css' => array(
									array(
										'property' => 'max-width',
										'selector' => '.container, .search__container, .site-header__container, .header--sticky .site-header__container',
										'unit' => 'px',
									),
								)
							),

							'content_horizontal_margins' => array(
								'type' => 'range',
								'label' => esc_html__( 'Container Horizontal Margins', 'heap' ),
								'live' => true,
								'default'       => 96,
								'input_attrs' => array(
									'min'   => 24,
									'max'   => 120,
									'step'  => 6,
									'data-preview' => true
								),
								'css' => array(
									array(
										'property' => 'padding-left',
										'selector' => '.container',
										'unit' => 'px',
										'media'    => 'screen and (min-width: 900px)',
									),
									array(
										'property' => 'padding-right',
										'selector' => '.container',
										'unit' => 'px',
										'media'    => ' screen and (min-width: 900px)',
									),
								)
							),

							'blog_single_show_sidebar' => array(
								'type' => 'checkbox',
								'label' => esc_html__( 'Show Sidebar', 'heap' ),
								'desc'    => esc_html__( 'Show the main sidebar in the single post pages.', 'heap' ),
								'default' => 1,
							),

							'sidebar_width' => array(
								'type' => 'range',
								'label' => esc_html__( 'Sidebar Width', 'heap' ),
								'desc'      => esc_html__( 'Set the width of the sidebar.', 'heap' ),
								'live' => true,
								'default'       => 300,
								'show_on' => array( 'blog_single_show_sidebar' ),
								'input_attrs' => array(
									'min'   => 140,
									'max'   => 500,
									'step'  => 10,
									'data-preview' => true
								),
								'css' => array(
									array(
										'property' => 'width',
										'selector' => '.sidebar--main',
										'unit' => 'px',
										'media'    => ' only screen and (min-width: 900px)',
									),
									array(
										'property' => 'right',
										'selector' => 'body:not(.rtl) .page-content.has-sidebar:after',
										'unit' => 'px',
										'media'    => '  only screen and (min-width: 900px) ',
									),
									array(
										'property' => 'left',
										'selector' => 'body.rtl .page-content.has-sidebar:after',
										'unit' => 'px',
										'media'    => '   only screen and (min-width: 900px) ',
									),
									array(
										'property' => 'margin-right',
										'selector' => 'body:not(.rtl) .page-content.has-sidebar .page-content__wrapper',
										'unit' => 'px',
										'media'    => '    only screen and (min-width : 900px ) ',
									),
									array(
										'property' => 'margin-left',
										'selector' => 'body.rtl .page-content.has-sidebar .page-content__wrapper',
										'unit' => 'px',
										'media'    => '     only screen and (min-width : 900px ) ',
									),
									array( // @TODO make this work with live preview
										'property' => 'margin-right',
										'selector' => 'body:not(.rtl) .page-content.has-sidebar',
										'callback_filter' => 'heap_range_negative_value',
										'unit' => 'px',
										'media'    => '       only screen and (min-width : 900px ) ',
									),
									array( // @TODO make this work with live preview
										'property' => 'margin-left',
										'selector' => 'body.rtl .page-content.has-sidebar',
										'callback_filter' => 'heap_range_negative_value',
										'unit' => 'px',
										'media'    => '        only screen and (min-width : 900px ) ',
									),
								)
							),
							'blog_single_show_breadcrumb' => array(
								'type' => 'checkbox',
								'label' => esc_html__( 'Show Post Breadcrumbs', 'heap' ),
								'desc'    => esc_html__( 'Do you want to show the post breadcrumb?', 'heap' ),
								'default' => 1,
							),
							'blog_single_show_title_meta_info' => array(
								'type' => 'checkbox',
								'label' => esc_html__( 'Show Post Title Extra Info', 'heap' ),
								'desc'    => esc_html__( 'Do you want to show the date and the author under the title?', 'heap' ),
								'default' => 1,
							),
							'blog_single_show_author_box' => array(
								'type' => 'checkbox',
								'label' => esc_html__( 'Show Author Info Box', 'heap' ),
								'desc'    => esc_html__( 'Do you want to show author info box with avatar and description bellow the post?', 'heap' ),
								'default' => 1,
							),
							'divider_title_69211131'  => array(
								'type' => 'html',
								'html' => '<span class="separator label large">' . esc_html__( 'Share Links', 'heap' ) . '</span>',
							),
							'blog_single_show_share_links' => array(
								'type' => 'checkbox',
								'label' => esc_html__( 'Show Share Links', 'heap' ),
								'desc'    => esc_html__( 'Do you want to show share icon links in your articles?', 'heap' ),
								'default' => 1,
							),
							'blog_single_share_links_position' => array(
								'type'          => 'select',
								'label'         => esc_html__( 'Choose where to display the share links.', 'heap' ),
								'choices'       => array(
									'top'    => 'Top',
									'bottom' => 'Bottom',
									'both'   => 'Both Top & Bottom',
								),
								'default'       => 'both',
								'show_on' => array( 'blog_single_show_share_links' )
							),
							'divider_title_69213131'  => array(
								'type' => 'html',
								'html' => '<span class="separator label large">' . esc_html__( 'Comments', 'heap' ) . '</span>',
							),
							'comments_show_avatar' => array(
								'type' => 'checkbox',
								'label' => esc_html__( 'Show Comments Avatars', 'heap' ),
								'desc'    => esc_html__( 'Do you want to show avatars in comments?', 'heap' ),
								'default' => 0,
							),
							'comments_show_numbering' => array(
								'type' => 'checkbox',
								'label' => esc_html__( 'Show Comments Numbers', 'heap' ),
								'desc'    => esc_html__( 'Do you want to show numbers beside each comment?', 'heap' ),
								'default' => 1,
							),
						),
					),

					'archives_layout_settings' => array(
						'title'    => esc_html__( 'Archive', 'heap' ),
						'options' => array(
							'blog_layout'                => array(
								'type'    => 'radio_image',
								'label'   => esc_html__( 'Blog Layout', 'heap' ),
								'desc'   => esc_html__( 'Select between a Masonry Grid or Classic List layout.', 'heap' ),
								'choices' => array(
									'masonry'    => get_template_directory_uri() . '/assets/images/blog-masonry.png',
									'classic' => get_template_directory_uri() . '/assets/images/blog-classic.png'
								),
								'default' => 'masonry'
							),
							'divider_title_123121131'  => array(
								'type' => 'html',
								'html' => __( 'Select the Number of Columns of <b>masonry</b>  archives based on various <b>screen sizes</b>:', 'heap' ),
								'show_on' => array( 'blog_layout', 'masonry' )
							),
							'blog_layout_masonry_big_columns' => array(
								'type'          => 'select',
								'label'         => esc_html__( 'Large screen size', 'heap' ),
								'choices'       => array(
									1 => '1 column',
									2 => '2 columns',
									3 => '3 columns',
									4 => '4 columns',
									5 => '5 columns',
									6 => '6 columns',
								),
								'default'       => 3,
								'show_on' => array( 'blog_layout', 'masonry' )
							),
							'blog_layout_masonry_medium_columns' => array(
								'type'          => 'select',
								'label'         => esc_html__( 'Medium screen size', 'heap' ),
								'choices'       => array(
									1 => '1',
									2 => '2',
									3 => '3',
									4 => '4',
									5 => '5',
								),
								'default'       => 2,
								'show_on' => array( 'blog_layout', 'masonry' ),
							),
							'blog_layout_masonry_small_columns' => array(
								'type'          => 'select',
								'label'         => esc_html__( 'Small screen size', 'heap' ),
								'choices'       => array(
									1 => '1',
									2 => '2',
									3 => '3',
									4 => '4',
									5 => '5',
								),
								'default'       => 1,
								'show_on' => array( 'blog_layout', 'masonry' ),
							),
							'blog_excerpt_length' => array(
								'type' => 'text',
								'label' => esc_html__( 'Excerpt Length', 'heap' ),
								'desc'    => esc_html__( 'Set the number of characters for posts excerpt.', 'heap' ),
								'default' => '140',
							),
							'blog_excerpt_more_text' => array(
								'type' => 'text',
								'label' => esc_html__( 'Excerpt "More" Text', 'heap' ),
								'desc'    => esc_html__( '(leave empty if you want to remove it)', 'heap' ),
								'default' => '..',
							),
							'blog_show_breadcrumb' => array(
								'type' => 'checkbox',
								'label' => esc_html__( 'Show Breadcrumbs', 'heap' ),
								'desc'    => esc_html__( 'Do you want to show the archive breadcrumbs?', 'heap' ),
								'default' => 0,
							),
							'divider_title_1231954'  => array(
								'type' => 'html',
								'html' => '<span class="separator label large">' . esc_html__( 'Posts Meta Data', 'heap' ) . '</span>',

							),
							'blog_show_categories' => array(
								'type' => 'checkbox',
								'label' => esc_html__( 'Categories', 'heap' ),
								'desc'    => esc_html__( 'Display the post categories.', 'heap' ),
								'default' => 1,
							),
							'blog_show_date' => array(
								'type' => 'checkbox',
								'label' => esc_html__( 'Date', 'heap' ),
								'desc'    => esc_html__( 'Display the post publish date.', 'heap' ),
								'default' => 1,
							),
							'blog_show_comments' => array(
								'type' => 'checkbox',
								'label' => esc_html__( 'Comments Number', 'heap' ),
								'desc'    => esc_html__( 'Display the number of comments.', 'heap' ),
								'default' => 1,
							),
							'blog_show_likes' => array(
								'type' => 'checkbox',
								'label' => esc_html__( 'Likes Number', 'heap' ),
								'desc'    => esc_html__( '(only if the PixLikes plugin is active)', 'heap' ),
								'default' => 1,
							),
							'divider_title_1231964'  => array(
								'type' => 'html',
								'html' => '<span class="separator label large">' . esc_html__( 'Navigation Style', 'heap' ) . '</span>',
							),
							'blog_infinitescroll' => array(
								'type' => 'checkbox',
								'label' => esc_html__( 'Infinite Scroll', 'heap' ),
								'desc'    => esc_html__( 'Replace the regular pagination with AJAX loading new items on scroll or button click (will load at once the number posts specified in Settings > Reading).', 'heap' ),
								'default' => 1,
							),
							'blog_infinitescroll_show_button' => array(
								'type' => 'checkbox',
								'label' => esc_html__( 'Show [Load More] Button', 'heap' ),
								'desc'    => esc_html__( 'The next posts will be loaded only on button click.', 'heap' ),
								'default' => 1,
								'show_on' => array( 'blog_infinitescroll' ),
							),
							'blog_infinitescroll_button_text' => array(
								'type' => 'text',
								'label' => esc_html__( '[Load More] Button Text', 'heap' ),
								'desc'    => esc_html__( 'The next posts will be loaded only on button click.', 'heap' ),
								'default' => '+ LOAD MORE',
								'show_on' => array( 'blog_infinitescroll' ),
							),
							'divider_title_1231974'  => array(
								'type' => 'html',
								'html' => '<span class="separator label large">' . esc_html__( 'Sidebar', 'heap' ) . '</span>',
							),
							'blog_show_sidebar' => array(
								'type' => 'checkbox',
								'label' => esc_html__( 'Show Sidebar in the Archive Pages', 'heap' ),
								// 'desc'    => esc_html__( 'Show the main sidebar in the archive pages.', 'heap' ),
								'default' => 1,
							),
						)
					)
				)
			),

			/**
			 * FONTS - This section will handle different elements fonts (eg. headings, body)
			 */
			'typography_panel' => array(
				'title'    => '&#x1f4dd; &nbsp;&nbsp;' . esc_html__( 'Fonts', 'heap' ),
				'sections' => array(

					'navigation_typography_section' => array(
						'title'    => esc_html__( 'Navigation', 'heap' ),
						'options' => array(

							'google_nav_font' => array(
								'type'     => 'typography',
								'label'    => esc_html__( 'Navigation', 'heap' ),
								'desc'       => esc_html__( 'Font for the navigation menu.', 'heap' ),
								'default'  => 'Open Sans',
								'recommended' => $recommended_nav_fonts,
								'selector' => '.navigation a'
							),
							'nav_font-size' => array(
								'type' => 'range',
								'label'         => esc_html__( 'Font Size', 'heap' ),
								'live' => true,
								'default'       => 14,
								'input_attrs' => array(
									'min'   => 8,
									'max'   => 30,
									'step'  => 1,
									'data-preview' => true
								),
								'css' => array(
									array(
										'property' => 'font-size',
										'selector' => '.navigation a',
										'unit' => 'px',
									)
								)
							),

							'nav_letter-spacing' => array(
								'type' => 'range',
								'label'         => esc_html__( 'Letter Spacing', 'heap' ),
								'live' => true,
								'default'       => 0,
								'input_attrs' => array(
									'min'   => -5,
									'max'   => 20,
									'step'  => 1,
									'data-preview' => true
								),
								'css' => array(
									array(
										'property' => 'letter-spacing',
										'selector' => '.navigation a',
										'unit' => 'px',
									)
								)
							),

							'nav_text-transform' => array(
								'type'          => 'select',
								'label'         => esc_html__( 'Text Transform', 'heap' ),
								'choices'       => array(
									'none'       => 'None',
									'capitalize' => 'Capitalize',
									'uppercase'  => 'Uppercase',
									'lowercase'  => 'Lowercase',
								),
								'default'       => 'uppercase',
								'css' => array(
									array(
										'property' => 'text-transform',
										'selector' => '.navigation a',
									)
								)
							),

							'nav_text-decoration' => array(
								'type'          => 'select',
								'label'         => esc_html__( 'Text Decoration', 'heap' ),
								'choices'       => array(
									'none'      => 'None',
									'underline' => 'Underline',
									'overline'  => 'Overline',
								),
								'default'       => 'none',
								'css' => array(
									array(
										'property' => 'text-decoration',
										'selector' => '.nav--main > .menu-item > a',
									)
								)
							),
						)
					),

					'headers_typography_section' => array(
						'title'    => esc_html__( 'Headings', 'heap' ),
						'options' => array(
							'google_titles_font' => array(
								'type'     => 'typography',
								'label'    => esc_html__( 'Headings', 'heap' ),
								'desc'       => esc_html__( 'Font for titles and headings.', 'heap' ),
								'default'  => 'Open Sans',
								'recommended' => $recommended_headings_fonts,
								'load_all_weights' => true,
								'selector' => 'h1, h2, h3, h4, h5, h6, hgroup,
									h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,
									blockquote,
									.tabs__nav, .popular-posts__time,
									.pagination li a, .pagination li span'
							),

						)
					),

					'content_typography_section' => array(
						'title'    => esc_html__( 'Body', 'heap' ),
						'options' => array(
							'google_body_font'     => array(
								'type'    => 'typography',
								'label'   => esc_html__( 'Body', 'heap' ),
								'desc'       => esc_html__( 'Font for content and widget text.', 'heap' ),
								'default' => 'Cabin',
								'recommended' => $recommended_body_fonts,
								'selector' => 'html, .wp-caption-text, .small-link,
									.post-nav-link__label, .author__social-link,
									.comment__links, .score__desc',
								'load_all_weights' => true,
							),
							'body-font-size' => array(
								'type' => 'range',
								'label'         => esc_html__( 'Font Size', 'heap' ),
								'live' => true,
								'default'       => 16,
								'input_attrs' => array(
									'min'   => 8,
									'max'   => 72,
									'step'  => 1,
									'data-preview' => true
								),
								'css' => array(
									array(
										'property' => 'font-size',
										'selector' => 'body, .article, .single .main, .page .main,
											.comment__content,
											.footer__widget-area ',
										'unit' => 'px',
									)
								)
							),
							'body-line-height' => array(
								'type' => 'range',
								'label'         => esc_html__( 'Line Height', 'heap' ),
								'live' => true,
								'default'       => '1.6',
								'input_attrs' => array(
									'min'   => 0,
									'max'   => 3,
									'step'  => 0.1,
									'data-preview' => true
								),
								'css' => array(
									array(
										'property' => 'line-height',
										'selector' => 'body',
									)
								)
							),
						)
					),
				)
			),
		);


		// Colors
		$config['panels']['colors'] = array(
			'title'       => '&#x1f3a8; &nbsp;&nbsp;' . esc_html__( 'Colors', 'heap' ),
			'priority'    => 3,
			'description' => __( 'Using the color pickers you can change the colors of the most important elements. If you want to override the color of individual elements, you can always use Custom CSS code in Appearance → Customizer → CSS Editor.', 'heap' ),
			'sections' => array(
				// General
				'colors_general_section' => array(
					'title'    => esc_html__( 'General', 'heap' ),
					'priority' => 1,
					'description'            => esc_html__( 'Using the color pickers you can change the colors of the most important elements. If you want to override the color of some elements you can always use CSS editor panel.', 'heap' ),
					'options' => array(
						'main_color'   => array(
							'type'      => 'color',
							'label'     => esc_html__( 'Main Color', 'heap' ),
							//'desc'   => esc_html__( 'Use the color picker to change the main color of the site to match your brand color.', 'heap' ),
							'live' => true,
							'default'   => '#0093bf',
							'css'  => array(
								array(
									'property'     => 'color',
									'selector' => 'a, a:hover, .link--light:hover,
										.text-link:hover,
										.heap_popular_posts .article__category:hover,
										.meta-list a.btn:hover,
										.meta-list a.comments_add-comment:hover,
										.meta-list .form-submit a#comment-submit:hover,
										.form-submit .meta-list a#comment-submit:hover,
										.meta-list .widget_tag_cloud a:hover,
										.widget_tag_cloud .meta-list a:hover,
										.meta-list a.load-more__button:hover,
										.article__comments-number:hover,
										.author__social-link:hover,
										.article-archive .article__categories a:hover,

										.link--dark:hover,
										.nav--main a:hover,
										.comment__author-name a:hover,
										.author__title a:hover,
										.site-title--small a:hover,
										.site-header__menu a:hover,
										.widget a:hover,

										.article-archive--quote blockquote:before,
										.menu-item-has-children:hover > a,
										ol.breadcrumb a:hover,
										a:hover > .pixcode--icon,
										.tabs__nav a.current, .tabs__nav a:hover,
										.quote--single-featured:before,
										.site-header__menu .nav--social a:hover:before,
										.widget_nav_menu > div[class*="social"] a:hover:before,

										.price ins, .price > span,
										.shop-categories a.active',
								),
								array(
									'property'     => 'background-color',
									'selector' => '.pagination .pagination-item--current span,
										.pagination li a:hover,
										.pagination li span:hover,
										.rsNavSelected,
										.progressbar__progress,
										.comments_add-comment:hover,
										.form-submit #comment-submit:hover,
										.widget_tag_cloud a:hover,
										.btn--primary,
										.comments_add-comment,
										.form-submit #comment-submit,
										a:hover > .pixcode--icon.circle,
										a:hover > .pixcode--icon.square,
										.pixcode--icon.square:hover, .pixcode--icon.circle:hover,
										.btn--add-to-cart,
										.wpcf7-form-control.wpcf7-submit,
										.pagination--archive ol li a:hover,
										.btn:hover,
										.comments_add-comment:hover,
										.form-submit #comment-submit:hover,
										.widget_tag_cloud a:hover,
										.load-more__button:hover,

										#review-submit:hover, body.woocommerce div.woocommerce-message .button:hover,
										td.actions input.button:hover, form.shipping_calculator button.button:hover,
										body.woocommerce-page input.button:hover,
										body.woocommerce #content input.button.alt:hover,
										body.woocommerce #respond input#submit.alt:hover,
										body.woocommerce a.button.alt:hover,
										body.woocommerce button.button.alt:hover,
										body.woocommerce input.button.alt:hover,
										body.woocommerce-page #content input.button.alt:hover,
										body.woocommerce-page #respond input#submit.alt:hover,
										body.woocommerce-page a.button.alt:hover,
										body.woocommerce-page button.button.alt:hover,
										body.woocommerce-page input.button.alt:hover '
								),
								array(
									'property'     => 'heap-bottom-color',
									'selector' => '.nav--main li:hover, .nav--main li.current-menu-item',
									'media' => '@media only screen and (min-width: 900px)'
								),
								array(
									'property'     => 'border-color',
									'selector' => '.back-to-top a:hover:after, .back-to-top a:hover:before',
									'media' => ' @media only screen and (min-width: 900px)'
								),
								array(
									'property'     => 'outline-color',
									'selector' => 'select:focus, textarea:focus, input[type="text"]:focus, input[type="password"]:focus, input[type="datetime"]:focus, input[type="datetime-local"]:focus, input[type="date"]:focus, input[type="month"]:focus, input[type="time"]:focus, input[type="week"]:focus, input[type="number"]:focus, input[type="email"]:focus, input[type="url"]:focus, input[type="search"]:focus, input[type="tel"]:focus, input[type="color"]:focus, .form-control:focus'
								),
								array(
									'property'     => 'background',
									'selector' => '.team-member__profile',
									'media' => '@media only screen and (min-width: 1201px)',
									'callback_filter' => 'heap_field_with_05rgba_value'
								),
							)
						),
						'text_color' => array(
							'type'      => 'color',
							'label'     => esc_html__( 'Text Color', 'heap' ),
							'live' => true,
							'default'   => '#424242',
							'css'  => array(
								array(
									'property'     => 'color',
									'selector' => 'body'
								),
							)
						),
						'headings_color'     => array(
							'type'      => 'color',
							'label'     => esc_html__( 'Headings Color', 'heap' ),
							'live' => true,
							'default'   => '#1a1919',
							'css'  => array(
								array(
									'property'     => 'color',
									'selector' => 'h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, .article-archive .article__title a, .article-archive .article__title a:hover',
								)
							)
						),
					)
				),

				// Header
				'site_header' => array(
					'title'   => esc_html__( 'Header', 'heap' ),
					'options' => array(
							// Header Background
							'header_background_color'   => array(
								'type'      => 'color',
								'label'     => esc_html__( 'Header Background', 'heap' ),
								'live' => true,
								'default'   => '#ffffff',
								'css'  => array(
									array(
										'property'     => 'background-color',
										'selector' => '.header',
									)
								)
							),
							'header_image_pattern'   => array(
								'type'      => 'custom_background',
								'label'     => esc_html__( 'Header Background', 'heap' ),
								'output'           => array( '.header' ),
							),
							'header_content_color'   => array(
								'type'      => 'color',
								'label'     => esc_html__( 'Header Content', 'heap' ),
								'live' => true,
								'default'   => '#1a1919',
								'css'  => array(
									array(
										'property'     => 'color',
										'selector' => '.site-header__menu .nav--social a:before, .site-header__menu a',
									)
								)
							),

							// Navigation Background
							'navigation_background_color'   => array(
								'type'      => 'color',
								'label'     => esc_html__( 'Navigation Background', 'heap' ),
								'live' => true,
								'default'   => '#ffffff',
								'css'  => array(
									array(
										'property'     => 'background-color',
										'selector' => '.navigation--main, .navigation--main .sub-menu',
										'media'    => 'screen and (min-width: 900px)'
									)
								)
							),
							'nav_image_pattern'   => array(
								'type'      => 'custom_background',
								'label'     => esc_html__( 'Navigation Background', 'heap' ),
								'selector' => '.navigation--main, .navigation--main .sub-menu',
							),
							'nav_content_color'   => array(
								'type'      => 'color',
								'label'     => esc_html__( 'Navigation Content', 'heap' ),
								'live' => true,
								'default'   => '#1a1919',
								'css'  => array(
									array(
										'property'     => 'color',
										'selector' => '.nav--main a',
									)
								)
							),
						
					),
				),

				// Content
				'site_content' => array(
					'title'   => esc_html__( 'Content', 'heap' ),
					'options' => array(

						// Site Background
						'site_background_color'   => array(
							'type'      => 'color',
							'label'     => esc_html__( 'Site Background', 'heap' ),
							'live' => true,
							'default'   => '#eeeeee',
							'css'  => array(
								array(
									'property'     => 'background-color',
									'selector' => 'body',
								)
							)
						),

						'body_image_pattern'   => array(
							'type'      => 'custom_background',
							'label'     => esc_html__( 'Container Background', 'heap' ),
							'desc'         => esc_html__( 'Container background with image.', 'heap' ),
							'output'           => array( 'body' ),
						),

						// Content Background
						'content_background_color'   => array(
							'type'      => 'color',
							'label'     => esc_html__( 'Content Background', 'heap' ),
							'live' => true,
							'default'   => '#ffffff',
							'css'  => array(
								array(
									'property'     => 'background-color',
									'selector' => '.container',
								)
							)
						),

						'container_image_pattern'   => array(
							'type'      => 'custom_background',
							'label'     => esc_html__( 'Container Background', 'heap' ),
							'desc'         => esc_html__( 'Container background with image.', 'heap' ),
							'output'           => array( '.container' ),
						),
					),
				),

				// Footer
				'site_content' => array(
					'title'   => esc_html__( 'Footer', 'heap' ),
					'options' => array(
							'footer_text_color'    => array(
								'type'    => 'color',
								'label'   => esc_html__( 'Text Color', 'heap' ),
								'live'    => true,
								'default' => '#1a1919',
								'css'     => array(
									array(
										'property' => 'color',
										'selector' => '.site-footer, .site-footer a',
									),
								),
							),
							'footer_credits_color' => array(
								'type'    => 'color',
								'label'   => esc_html__( 'Credits Color', 'heap' ),
								'live'    => true,
								'default' => '#919191',
								'css'     => array(
									array(
										'property' => 'color',
										'selector' => '.copyright-text',
									),
								),
							),
						)
				),
			)
		
		);

		$config['panels']['theme_options'] = array(
			'title'    => '&#x1f506; &nbsp;&nbsp;' . esc_html__( 'Theme Options', 'heap' ),
			'priority' => 1,
			'sections' => array(
				'general' => array(
					'title'   => esc_html__( 'General', 'heap' ),
					'options' => array(
						'main_logo'           => array(
							'type'  => 'media',
							'label' => esc_html__( 'Logo', 'heap' ),
						),
						'divider_title_5347719831' => array(
							'type' => 'html',
							'html' => '<span class="separator label">' . esc_html__( 'Smooth Scrolling', 'heap' ) . '</span>',
						),
						'use_smooth_scroll'         => array(
							'type'    => 'checkbox',
							'label'   => esc_html__( 'Enable Smooth Scrolling.', 'heap' ),
							'default' => 1,
						),

						'divider_title_534793921'  => array(
							'type' => 'html',
							'html' => '<span class="separator label large">' . esc_html__( 'Footer', 'heap' ) . '</span>',
						),
						'copyright_text' => array(
							'type'              => 'textarea',
							'label'             => esc_html__( 'Copyright Text', 'heap' ),
							'default'           => esc_html__( '2016 &copy; Handcrafted with love by', 'heap' ) . ' <a href="https://pixelgrade.com">PixelGrade</a> ' . esc_html__( 'Team', 'heap' ),
							'sanitize_callback' => 'wp_kses_post',
							'live'              => array( '.copyright-text' ),
						),
					),
				),

				'header_settings'   => array(
					'title'   => esc_html__( 'Header', 'heap' ),
					'options' => array(
						'divider_title_58692136'  => array(
							'type' => 'html',
							'html' => '<span class="separator label large">' . esc_html__( 'Header Custom Links', 'heap' ) . '</span>',
						),
						'header_search' => array(
							'type'        => 'checkbox',
							'label'       => esc_html__( 'Search Button', 'heap' ),
							'desc'        => esc_html__( 'Adds a fancy search button and form in your site header.', 'heap' ),
							'default' => '1',
						),
						'header_contact'        => array(
							'type'        => 'checkbox',
							'label'       => esc_html__( 'Contact Link', 'heap' ),
							'desc'        => esc_html__( 'Display an envelope icon that link to your profile email address.', 'heap' ),
							'default' => 0,
						),
						'header_rss'        => array(
							'type'        => 'checkbox',
							'label'       => esc_html__( 'RSS Feed', 'heap' ),
							'desc'        => esc_html__( 'Display a RSS feed link.', 'heap' ),
							'default' => 0,
						),
						'header_rss_link' => array(
							'type'        => 'text',
							'label'       => esc_html__( 'RSS Feed URL', 'heap' ),
							'desc'        => esc_html__( 'Enter here the URL you would like the RSS feed icon to link to.', 'heap' ),
							'default' => '#',
							'show_on' => array( 'header_rss' ),
						),

					),
				),

				'share_settings' => array(
					'title'   => esc_html__( 'Sharing', 'heap' ),
					'options' => array(
						'share_buttons_settings'                => array(
							'type'    => 'text',
							'default' => 'more,preferred,preferred,preferred,preferred',
							'label'   => esc_html__( 'Share Services', 'heap' ),
							'desc'    => __( '<p>Add the share services, delimited by a single comma (no spaces). You can find the full list of services <a href="http://www.addthis.com/services/list">here</a>.</p>
								Notes:
								<ul>
								<li>— use the <span style="text-decoration:underline;"><strong>more</strong></span> tag to show the plus sign</li>
								<li>— use the <span style="text-decoration:underline;"><strong>counter</strong></span> for a global share counter</li>
								<li>— use the <span style="text-decoration:underline;"><strong>preferred</strong></span> tag&nbsp;to show your visitors a personalized lists of buttons (read <a href="http://www.addthis.com/academy/preferred-services-personalization/">more</a>)</li>
								</ul>'),
						),

						// Advanced Sharing Options
						'divider_title_538921367821'  => array(
							'type' => 'html',
							'html' => '<p><span class="separator label large">' . esc_html__( 'Advanced Options', 'heap' ) . '</span></p>'
						),
						'share_buttons_enable_tracking'         => array(
							'type'    => 'checkbox',
							'label'   => esc_html__( 'Enable AddThis Sharing Analytics', 'heap' ),
							'default' => false,
						),
						'share_buttons_enable_addthis_tracking' => array(
							'type'     => 'checkbox',
							'label'    => esc_html__( 'Enable AddThis Tracking', 'heap' ),
							'default'  => false,
						),

						'share_buttons_addthis_username' => array(
							'type'    => 'text',
							'label'   => esc_html__( 'AddThis Username', 'heap' ),
							'desc'    => esc_html__( 'Enter here your AddThis username so you will receive analytics data.', 'heap' ),
							'default' => '',
							'show_on' => array( 'share_buttons_enable_addthis_tracking' ),
						),

						'share_buttons_enable_ga_tracking' => array(
							'type'     => 'checkbox',
							'label'    => esc_html__( 'AddThis Google Analytics Tracking', 'heap' ),
							'desc'     => __( 'Read more on <a href="http://bit.ly/1kxPg7K">Integrating with Google Analytics</a> article.', 'heap' ),
							'default'  => false,
						),

						'share_buttons_ga_id' => array(
							'type'    => 'text',
							'label'   => esc_html__( 'GA Property ID', 'heap' ),
							'desc'    => esc_html__( 'Enter here your GA property ID (generally a serial number of the form UA-xxxxxx-x).', 'heap' ),
							'default' => '',
							'show_on' => array( 'share_buttons_enable_ga_tracking' ),
						),

						'share_buttons_enable_ga_social_tracking' => array(
							'type'     => 'checkbox',
							'label'    => esc_html__( 'GA Social Tracking', 'heap' ),
							'desc'     => __( 'If you are using the latest version of GA code, you can take advantage of Google\'s new <a href="http://bit.ly/1iVvkbk">social interaction analytics</a>.', 'heap' ),
							'default'  => false,
							 'show_on' => array( 'share_buttons_enable_ga_tracking' ),
						),
					),
				),

				'custom_js'   => array(
					'title'   => esc_html__( 'Custom JavaScript', 'heap' ),
					'priority' => 999,
					'options' => array(
						'custom_js'        => array(
							'type'        => 'ace_editor',
							'label'       => esc_html__( 'Header', 'heap' ),
							'desc'        => esc_html__( 'Easily add Custom Javascript code. This code will be loaded in the <head> section.', 'heap' ),
							'editor_type' => 'javascript',
						),
						'google_analytics' => array(
							'type'        => 'ace_editor',
							'label'       => esc_html__( 'Footer', 'heap' ),
							'desc'        => esc_html__( 'You can paste here your Google Analytics tracking code (or for what matters any tracking code) and we will put it on every page.', 'heap' ),
							'editor_type' => 'javascript',
						),
					),
				),

				'import_demo_data' => array(
					'title'    => esc_html__( 'Demo Data', 'heap' ),
					'description' => esc_html__( 'If you would like to have a "ready to go" website as the Heap\'s demo page here is the button', 'heap' ),
					'priority' => 999999,
					'options'  => array(
						'import_demodata_button' => array(
							'title' => 'Import',
							'type'  => 'html',
							'html'  => '<input type="hidden" name="Heap-nonce-import-posts-pages" value="' . wp_create_nonce( 'Heap_nonce_import_demo_posts_pages' ) . '" />
										<input type="hidden" name="Heap-nonce-import-theme-options" value="' . wp_create_nonce( 'Heap_nonce_import_demo_theme_options' ) . '" />
										<input type="hidden" name="Heap-nonce-import-widgets" value="' . wp_create_nonce( 'Heap_nonce_import_demo_widgets' ) . '" />
										<input type="hidden" name="Heap_import_ajax_url" value="' . admin_url( "admin-ajax.php" ) . '" />' .
							           '<span class="description customize-control-description">' . esc_html__( '(Note: We cannot serve you the original images due the ', 'heap' ) . '<strong>&copy;</strong>)</span></br>' .
							           '<a href="#" class="button button-primary" id="Heap_import_demodata_button" style="width: 70%; text-align: center; padding: 10px; display: inline-block; height: auto;  margin: 0 15% 10% 15%;">
											' . esc_html__( 'Import demo data', 'heap' ) . '
										</a>

										<div class="Heap-loading-wrap hidden">
											<span class="Heap-loading Heap-import-loading"></span>
											<div class="Heap-import-wait">' .
							           esc_html__( 'Please wait a few minutes (between 1 and 3 minutes usually, but depending on your hosting it can take longer) and ', 'heap' ) .
							           '<strong>' . esc_html__( 'don\'t reload the page', 'heap' ) . '</strong>.' .
							           esc_html__( 'You will be notified as soon as the import has finished!', 'heap' ) . '
											</div>
										</div>

										<div class="Heap-import-results hidden"></div>
										<div class="hr"><div class="inner"><span>&nbsp;</span></div></div>'
						),
					),
				),
			),
		);

		/**
		 * Check if WooCommerce is active
		 **/
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

			$config['panels']['theme_options']['sections']['woocommerce'] = array(
				'title'   => esc_html__( 'WooCommerce', 'rosa' ),
				'options' => array(
					'divider_title_962836192' => array(
						'type' => 'html',
						'html' => '<span class="separator label">' . esc_html__( 'WooCommerce Support', 'rosa' ) . '</span>'
					),
					'enable_woocommerce_support' => array(
						'type'     => 'checkbox',
						'label'    => __( 'Enable WooCommerce Support', 'rosa' ),
						//'desc' => esc_html__( '.', 'rosa' ),
						'default'  => 1,
					),
					'display_product_filters' => array(
						'type'     => 'checkbox',
						'label'    => __( 'Show Category Filter in Shop Page', 'rosa' ),
						'desc' => esc_html__( 'Turn this On to have a product filter on the shop page.', 'rosa' ),
						'default'  => 1,
					)
				)
			);
		}

		return $config;
	}
}
add_filter( 'customify_filter_fields', 'add_customify_heap_options', 10 );

function heap_range_negative_value( $value, $selector, $property, $unit ) {
	// @TODO make this for javascript too
	$output = $selector .'{
		' . $property . ': -' . $value . '' . $unit . ";\n" .
	          "}\n";

	return $output;
}

function heap_field_with_05rgba_value( $value, $selector, $property, $unit ) {
	$rgb = implode(",", heap_hex2rgb($value));
	$output = $selector .'{
		' . $property . ': rgba('. $rgb .", 0.5);\n" .
	          "}\n";

	return $output;
}

/**
 * With the new wp 43 version we've made some big changes in customizer, so we really need a first time save
 * for the old options to work in the new customizer
 */
function convert_heap_for_wp_43_once (){
	if ( ! is_admin() || ! function_exists( 'is_plugin_active' ) || ! is_plugin_active('customify/customify.php') || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
		return;
	}

	$is_not_old = get_option('wpgrade_converted_to_43');

	$this_wp_version = get_bloginfo('version');
	$this_wp_version = explode( '.', $this_wp_version );
	$is_wp43 = false;
	if ( ! $is_not_old && (int) $this_wp_version[0] >= 4 && (int) $this_wp_version[1] >= 3 ) {
		$is_wp43 = true;
		update_option('wpgrade_converted_to_43', true);
		header( 'Location: '.admin_url().'customize.php?save_customizer_once=true');
		die();
	}
}

add_action('admin_init', 'convert_heap_for_wp_43_once');

function heap_hex2rgb($hex) {
	$hex = str_replace("#", "", $hex);

	if(strlen($hex) == 3) {
		$r = hexdec(substr($hex,0,1).substr($hex,0,1));
		$g = hexdec(substr($hex,1,1).substr($hex,1,1));
		$b = hexdec(substr($hex,2,1).substr($hex,2,1));
	} else {
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));
	}
	$rgb = array($r, $g, $b);
	//     return implode(",", $rgb); // returns the rgb values separated by commas
	return $rgb; // returns an array with the rgb values
}

function convert_redux_options_to_customify() {

	$current_options = get_option( 'heap_options' );

	unset($current_options['favicon']);
	unset($current_options['apple_touch_icon']);
	unset($current_options['metro_icon']);
	unset($current_options['social_share_default_image']);
	unset($current_options['remove_parameters_from_static_res']);
	unset($current_options['inject_custom_css']);
	unset($current_options['themeforest_upgrade']);
	unset($current_options['use_retina_logo']);
	unset($current_options['retina_main_logo']);

	if ( is_array( $current_options['main_logo'] ) && isset( $current_options['main_logo']['id'] ) ) {
		$main_logo_id = $current_options['main_logo']['id'];
		unset($current_options['main_logo']);
		$current_options['main_logo'] = $main_logo_id;
	}

	if ( isset( $current_options['custom_css'] ) && ! empty( $current_options['custom_css'] ) ) {
		update_option( 'live_css_edit', trim( $current_options['custom_css'] ) );
		unset($current_options['custom_css']);
	}

	$checkbox_types_ids = array(
		'nav_always_show',
		'nav_borders',
		'blog_single_show_sidebar',
		'blog_single_show_breadcrumb',
		'blog_single_show_title_meta_info',
		'blog_single_show_author_box',
		'blog_single_show_share_links',
		'comments_show_avatar',
		'comments_show_numbering',
		'blog_show_breadcrumb',
		'blog_show_categories',
		'blog_show_date',
		'blog_show_comments',
		'blog_show_likes',
		'blog_infinitescroll',
		'blog_infinitescroll_show_button',
		'blog_show_sidebar',
		'use_smooth_scroll',
		'header_rss',
		'header_contact',
		'header_search',
		'share_buttons_enable_tracking',
		'share_buttons_enable_addthis_tracking',
		'share_buttons_enable_ga_tracking',
		'share_buttons_enable_ga_social_tracking',
		'enable_woocommerce_support',
		'display_product_filters'
	);

	foreach ( $checkbox_types_ids as $key ) {
		if ( isset( $current_options[$key] ) ) {
			if ( $current_options[$key] ) {
				$current_options[$key] = true;
			} else {
				$current_options[$key] = false;
			}
		}
	}

	update_option( 'heap_options', $current_options );

	//heap_convert_fonts();
	heap_convert_social_links( $current_options );

	update_option( 'convert_options_to_customify', 1 );
}

$once = get_option( 'convert_options_to_customify' );
if ( empty( $once ) ) {
	add_action( 'wp', 'convert_redux_options_to_customify' );
}

function heap_convert_social_links( $current_options ) {
//	$current_options = get_option( 'heap_options' );

	if ( ! isset( $current_options['social_icons'] ) ) {
		return;
	}

	$header_links = array();
	$widget_links = array();
	$social_links = $current_options['social_icons'];

	if ( ! empty( $social_links ) ) {
		foreach ( $social_links as $key => $link ) {

			if ( empty( $link['value'] ) || empty( $link['checkboxes'] ) ) {
				continue;
			}

			$checkboxes = $link['checkboxes'];

			if ( isset( $checkboxes['header'] ) ) {
				$header_links[ $key ] = $link['value'];
			}

			if ( isset( $checkboxes['widget'] ) ) {
				$widget_links[ $key ] = $link['value'];
			}
		}
	}

	if ( ! empty( $header_links ) ) {
		// create a widget menu and import links

		$menu_id = wp_create_nav_menu( 'Social Menu' );
		//then get the menu object by its name
		$menu = get_term_by( 'name', 'Social Menu', 'nav_menu' );

		foreach ( $header_links as $key => $link ) {
			//then add the actuall link/ menu item and you do this for each item you want to add
			wp_update_nav_menu_item( $menu->term_id, 0, array(
					'menu-item-title'  => $key,
					'menu-item-url'    => $link,
					'menu-item-status' => 'publish'
				)
			);
		}
		//then you set the wanted theme  location
		$locations                = get_theme_mod( 'nav_menu_locations' );
		$locations['social_menu'] = $menu->term_id;
		set_theme_mod( 'nav_menu_locations', $locations );
	}

	if ( ! empty( $widget_links ) ) {
		// create a widget menu and import links

		$menu_id = wp_create_nav_menu( 'Widget Social Menu' );
		//then get the menu object by its name
		$menu = get_term_by( 'name', 'Widget Social Menu', 'nav_menu' );

		foreach ( $widget_links as $key => $link ) {
			//then add the actuall link/ menu item and you do this for each item you want to add
			wp_update_nav_menu_item( $menu->term_id, 0, array(
					'menu-item-title'  => $key,
					'menu-item-url'    => $link,
					'menu-item-status' => 'publish'
				)
			);
		}
		//then you set the wanted theme  location
		$locations                = get_theme_mod( 'nav_menu_locations' );
		$locations['widget_social_menu'] = $menu->term_id;
		set_theme_mod( 'nav_menu_locations', $locations );
	}

	unset(  $current_options['social_icons'] );
	// save the new options
	update_option( 'heap_options', $current_options );
}

function heap_convert_fonts() {
	$current_options = get_option( 'heap_options' );
	$fonts_keys_list = array(
		'google_nav_font',
		'google_titles_font',
		'google_body_font',
	);

	foreach ( $fonts_keys_list as $font_key ) {
		if ( ! isset( $current_options[ $font_key ] ) || empty( $current_options[ $font_key ] ) ) {
			continue;
		}

		$this_font = $current_options[ $font_key ];
		// this is what we want:
		//{"type":"google","font_family":"Merriweather","variants":{"0":"300","1":"300italic","2":"regular","3":"italic","4":"700","5":"700italic","6":"900","7":"900italic"},"selected_variants":{"0":"300"},"subsets":{"0":"latin-ext","1":"latin"},"selected_subsets":{"0":"latin-ext"}}

		// build a new font array
		// in the past, we could only select google fonts, so now we force google as type
		$new = array(
			'type' => 'google',
			'variants' => array(),
			'subsets' => array(),
		);
		// get the font name
		if ( isset( $this_font['font-family'] ) && ! empty( $this_font['font-family'] ) ) {
			$new['font_family'] = $this_font['font-family'];
		}
		// get the font weight
		if ( isset( $this_font['font-weight'] ) && ! empty( $this_font['font-weight'] ) ) {
			$new['selected_variants'] = array($this_font['font-weight']);
		}
		// get the font subsets
		if ( isset( $this_font['subsets'] ) && ! empty( $this_font['subsets'] ) ) {
			$new['selected_subsets'] = array($this_font['subsets']);
		}

		// get the font size
		if ( isset( $this_font['font-size'] ) && ! empty( $this_font['font-size'] ) ) {
			$current_options[$font_key . '_size'] = str_replace( 'em', '', $this_font['font-size'] );
		}

		// get the line-height
		if ( isset( $this_font['line-height'] ) && ! empty( $this_font['line-height'] ) ) {
			$current_options[$font_key . '_line_height'] = str_replace( 'em', '', $this_font['line-height'] );
		}

		$current_options[ $font_key ] = json_encode( $new );
	}

	// save the new options
	update_option( 'heap_options', $current_options );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function heap_customize_js() {
	wp_enqueue_script( 'heap_customizer', get_template_directory_uri() . '/assets/js/admin/customizer.js', array( 'wp-ajax-response' ), '20130508', true );

	$translation_array = array (
		'import_failed' => esc_html__( 'The import completed partially!', 'heap') . '<br/>' . esc_html__( 'Check out the errors given. You might want to try reloading the page and try again.', 'heap'),
		'import_confirm' => esc_html__( 'Importing the demo data will overwrite your current site content and options. Proceed anyway?', 'heap'),
		'import_phew' => esc_html__( 'Phew...that was a hard one!', 'heap'),
		'import_success_note' => esc_html__( 'The demo data was imported without a glitch! Awesome! ', 'heap') . '<br/><br/>',
		'import_success_reload' => '<i>' . esc_html__( 'We have reloaded the page on the right, so you can see the brand new data!' . '</i>', 'heap'),
		'import_success_warning' => '<p>' . esc_html__( 'Remember to update the passwords and roles of imported users.', 'heap') . '</p><br/>',
		'import_all_done' => esc_html__( 'All done!', 'heap'),
		'import_working' => esc_html__( 'Working...', 'heap'),
		'import_widgets_failed' => esc_html__( 'The setting up of the demo widgets failed...', 'heap'),
		'import_widgets_error' => esc_html__( 'The setting up of the demo widgets failed', 'heap') . '</i><br />' . esc_html__( '(The script returned the following message', 'heap'),
		'import_widgets_done' => esc_html__( 'Finished setting up the demo widgets...', 'heap'),
		'import_theme_options_failed' => esc_html__( "The importing of the theme options has failed...", 'heap'),
		'import_theme_options_error' => esc_html__( 'The importing of the theme options has failed', 'heap') . '</i><br />' . esc_html__( '(The script returned the following message', 'heap'),
		'import_theme_options_done' => esc_html__( 'Finished importing the demo theme options...', 'heap'),
		'import_posts_failed' => esc_html__( "The importing of the theme options has failed...", 'heap'),
		'import_posts_step' => esc_html__( 'Importing posts | Step', 'heap'),
		'import_error' =>  esc_html__( "Error:", 'heap'),
		'import_try_reload' =>  esc_html__( "You can reload the page and try again.", 'heap'),
	);
	wp_localize_script( 'heap_customizer', 'heap_admin_js_texts', $translation_array );
}
add_action( 'customize_controls_enqueue_scripts', 'heap_customize_js' );


// @todo CLEANUP refactor function names
/**
 * Imports the demo data from the demo_data.xml file
 */
if ( ! function_exists( 'Heap_ajax_import_posts_pages' ) ) {
	function Heap_ajax_import_posts_pages() {
		// initialize the step importing
		$stepNumber    = 1;
		$numberOfSteps = 1;

		// get the data sent by the ajax call regarding the current step
		// and total number of steps
		if ( ! empty( $_REQUEST['step_number'] ) ) {
			$stepNumber = $_REQUEST['step_number'];
		}

		if ( ! empty( $_REQUEST['number_of_steps'] ) ) {
			$numberOfSteps = $_REQUEST['number_of_steps'];
		}

		$response = array(
			'what'         => 'import_posts_pages',
			'action'       => 'import_submit',
			'id'           => 'true',
			'supplemental' => array(
				'stepNumber'    => $stepNumber,
				'numberOfSteps' => $numberOfSteps,
			)
		);

		// check if user is allowed to save and if its his intention with
		// a nonce check
		if ( function_exists( 'check_ajax_referer' ) ) {
			check_ajax_referer( 'Heap_nonce_import_demo_posts_pages' );
		}

		require_once( get_template_directory() . '/inc/import/import-demo-posts-pages.php' );

		$response = new WP_Ajax_Response( $response );
		$response->send();
	}

	// hook into wordpress admin.php
	add_action( 'wp_ajax_Heap_ajax_import_posts_pages', 'Heap_ajax_import_posts_pages' );
}

/**
 * Imports the theme options from the demo_data.php file
 */
if ( ! function_exists( 'Heap_ajax_import_theme_options' ) ) {
	function Heap_ajax_import_theme_options() {
		$response = array(
			'what'   => 'import_theme_options',
			'action' => 'import_submit',
			'id'     => 'true',
		);

		// check if user is allowed to save and if its his intention with
		// a nonce check
		if ( function_exists( 'check_ajax_referer' ) ) {
			check_ajax_referer( 'Heap_nonce_import_demo_theme_options' );
		}
		require_once( get_template_directory() . '/inc/import/import-demo-theme-options' . EXT );

		$response = new WP_Ajax_Response( $response );
		$response->send();
	}

	// hook into wordpress admin.php
	add_action( 'wp_ajax_Heap_ajax_import_theme_options', 'Heap_ajax_import_theme_options' );
}

/**
 * This function imports the widgets from the demo_data.php file and the menus
 */
if ( ! function_exists( 'Heap_ajax_import_widgets' ) ) {
	function Heap_ajax_import_widgets() {
		$response = array(
			'what'   => 'import_widgets',
			'action' => 'import_submit',
			'id'     => 'true',
		);

		// check if user is allowed to save and if its his intention with
		// a nonce check
		if ( function_exists( 'check_ajax_referer' ) ) {
			check_ajax_referer( 'Heap_nonce_import_demo_widgets' );
		}

		require_once( get_template_directory() . '/inc/import/import-demo-widgets.php' );

		$response = new WP_Ajax_Response( $response );
		$response->send();
	}

	//hook into wordpress admin.php
	add_action( 'wp_ajax_Heap_ajax_import_widgets', 'Heap_ajax_import_widgets' );
}
