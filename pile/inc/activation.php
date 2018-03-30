<?php
/**
 * Functions that run on theme activation
 *
 * @link https://jetpack.me/
 *
 * @package Pile
 */

/**
 * Theme activation hook
 */
function wpgrade_callback_geting_active() {

	$activation_settings = array(
		'pixlikes-settings' => array(
			'show_on_post'         => false,
			'show_on_page'         => false,
			'show_on_hompage'      => false,
			'show_on_archive'      => false,
			'like_action'          => 'click',
			'hover_time'           => 1000,
			'free_votes'           => false,
			'load_likes_with_ajax' => false,
		),
		'pixtypes-settings' => array(
			'post_types' => array(
				'pile_portfolio' => array(
					'labels'        => array(
						'name'               => esc_html__( 'Project', 'pile' ),
						'singular_name'      => esc_html__( 'Project', 'pile' ),
						'add_new'            => esc_html__( 'Add New', 'pile' ),
						'add_new_item'       => esc_html__( 'Add New Project', 'pile' ),
						'edit_item'          => esc_html__( 'Edit Project', 'pile' ),
						'new_item'           => esc_html__( 'New Project', 'pile' ),
						'all_items'          => esc_html__( 'All Projects', 'pile' ),
						'view_item'          => esc_html__( 'View Project', 'pile' ),
						'search_items'       => esc_html__( 'Search Projects', 'pile' ),
						'not_found'          => esc_html__( 'No Project found', 'pile' ),
						'not_found_in_trash' => esc_html__( 'No Project found in Trash', 'pile' ),
						'menu_name'          => esc_html__( 'Projects', 'pile' ),
					),
					'public'        => true,
					'rewrite'       => array(
						'slug'       => 'pile_portfolio',
						'with_front' => false,
					),
					'has_archive'   => 'portfolio-archive',
					'menu_icon'     => 'report.png',
					'menu_position' => null,
					'supports'      => array(
						'title',
						'editor',
						'revisions',
						'thumbnail',
						'page-attributes',
					),
					'yarpp_support' => true,
				)
			),
			'taxonomies' => array(
				'pile_portfolio_categories' => array(
					'hierarchical'      => true,
					'labels'            => array(
						'name'              => esc_html__( 'Project Categories', 'pile' ),
						'singular_name'     => esc_html__( 'Project Category', 'pile' ),
						'search_items'      => esc_html__( 'Search Project Categories', 'pile' ),
						'all_items'         => esc_html__( 'All Project Categories', 'pile' ),
						'parent_item'       => esc_html__( 'Parent Project Category', 'pile' ),
						'parent_item_colon' => esc_html__( 'Parent Project Category: ', 'pile' ),
						'edit_item'         => esc_html__( 'Edit Project Category', 'pile' ),
						'update_item'       => esc_html__( 'Update Project Category', 'pile' ),
						'add_new_item'      => esc_html__( 'Add New Project Category', 'pile' ),
						'new_item_name'     => esc_html__( 'New Project Category Name', 'pile' ),
						'menu_name'         => esc_html__( 'Portfolio Categories', 'pile' ),
					),
					'show_admin_column' => true,
					'rewrite'           => array( 'slug' => 'portfolio-category', 'with_front' => false ),
					'sort'              => true,
					'post_types'        => array( 'pile_portfolio' )
				),
			),
			'metaboxes'  => array(
				// Page » Content Builder
				'pile_page_builder'               => array(
					'id'         => 'pilepage_builder',
					'title'      => '&#x1f4dd; ' . esc_html__( 'Page » Content Builder')
									. '<a class="tooltip" title="<p><title>'
									. esc_html__('Content Builder', 'pile')
									. '</title>'
									. esc_html__( ' Add different types of <b>blocks</b> to create a custom page layout. Move, resize and align them to better match your content.', 'pile' )
									. "</p><p><a href='#'>"
									. esc_html__( 'Learn more about the Content Builder', 'pile' ) . '</a></p>"></a>',
					'pages'      => array( 'page' ), // Post type
					'context'    => 'normal',
					'priority'   => 'high',
					'hidden'     => true,
					'show_on'    => array(
						'key'   => 'page-template',
						'value' => array( 'page-templates/page-builder.php' ),
					),
					'show_names' => false, // Show field names on the left
					'fields'     => array(
						array(
							'name'   => esc_html__( 'Builder', 'pile' ),
							'id'     => '_pile_page_builder',
							'type'   => 'pix_builder',
							'hidden' => true
						),
					)
				),

				// Project » Content Builder
				'pile_project_builder'            => array(
					'id'         => 'project_builder',
					'title'      => '&#x1f4dd; ' . esc_html__( 'Project » Content Builder')
									. '<a class="tooltip" title="<p><title>'
									. esc_html__('Content Builder', 'pile')
									. '</title>'
									. esc_html__( ' Add different types of <b>blocks</b> to create a custom page layout. Move, resize and align them to better match your content.', 'pile' )
									. "</p><p><a href='#'>"
									. esc_html__( 'Learn more about the Content Builder', 'pile' ) . '</a></p>"></a>',
					'pages'      => array( 'pile_portfolio' ), // Post type
					'context'    => 'normal',
					'priority'   => 'high',
					'show_names' => false, // Show field names on the left
					'fields'     => array(
						array(
							'name'   => esc_html__( 'Builder', 'pile' ),
							'id'     => '_pile_project_builder',
							'type'   => 'pix_builder',
							'hidden' => true
						),
					)
				),

				// Hero Side Areas
				'page_hero_area_background'       => array(
					'id'         => 'page_hero_area_background',
					'title'      => esc_html__( 'Hero Area » Background', 'pile' ),
					'pages'      => array( 'page' ), // Post type
					'context'    => 'side',
					'priority'   => 'low',
					'show_names' => false, // Show field names on the left
					'show_on'    => array(
						'key'   => 'page-template',
						'value' => array(
							'default',
							'page-templates/page-builder.php',
							'page-templates/portfolio-archive.php'
						),
					),
					'fields'     => array(
						array(
							'name' => esc_html__( 'Gallery Image', 'pile' ),
							'id'   => '_pile_second_image',
							'type' => 'gallery',
						),
						array(
							'name' => esc_html__( 'Playlist', 'pile' ),
							'id'   => '_videos_backgrounds',
							'type' => 'playlist',
						),
						array(
							'name'      => esc_html__( 'Image Opacity', 'pile' ),
							'desc'	 	=> '<strong>' . esc_html__( 'Image Opacity', 'pile' ) . '</strong>',
							'id'        => '_hero_image_opacity',
							'type'      => 'text_range',
							'std'   => '100',
							'html_args' => array(
								'min' => 1,
								'max' => 100
							)
						),
						array(
							'name' => esc_html__( 'Background Color', 'pile' ),
							'desc' => '<strong>' . esc_html__( 'Background Color', 'pile' ) . '</strong> <span class="tooltip" title="<p>' . esc_html__( 'Used as a background color during page transitions.', 'pile' ) . '</p><p>' . esc_html__( 'Tip: It helps if the color matches the background color of the Hero image.', 'pile' ) . '</p>"></span>',
							'id'   => '_hero_background_color',
							'type' => 'colorpicker',
							'std' => '#333333'
						),
					)
				),
				'project_hero_area_background'    => array(
					'id'         => 'project_hero_area_background',
					'title'      => esc_html__( 'Hero Area » Background', 'pile' ),
					'pages'      => array( 'pile_portfolio' ), // Post type
					'context'    => 'side',
					'priority'   => 'low',
					'show_names' => false, // Show field names on the left
					'fields'     => array(
						array(
							'name' => esc_html__( 'Gallery Image', 'pile' ),
							'id'   => '_pile_second_image',
							'type' => 'gallery',
						),
						array(
							'name' => esc_html__( 'Playlist', 'pile' ),
							'id'   => '_videos_backgrounds',
							'type' => 'playlist',
						),
						array(
							'name'      => esc_html__( 'Image Opacity', 'pile' ),
							'desc'	 	=> '<strong>' . esc_html__( 'Image Opacity', 'pile' ) . '</strong>',
							'id'        => '_hero_image_opacity',
							'type'      => 'text_range',
							'std'   => '100',
							'html_args' => array(
								'min' => 1,
								'max' => 100
							)
						),
						array(
							'name' => esc_html__( 'Background Color', 'pile' ),
							'desc' => '<strong>' . esc_html__( 'Background Color', 'pile' ) . '</strong> <span class="tooltip" title="<p>' . esc_html__( 'Used as a background color during page transitions.', 'pile' ) . '</p><p>' . esc_html__( 'Tip: It helps if the color matches the background color of the Hero image.', 'pile' ) . '</p>"></span>',
							'id'   => '_pile_project_color',
							'type' => 'colorpicker',
							'std' => '#333333'
						),
					)
				),

				// $PAGE  Hero Area
				'pile_page_header_area_cover'     => array(
					'id'         => 'pile_page_header_area_cover',
					'title'      => '&#x1f535; ' . esc_html__( 'Hero Area » Content', 'pile' )
									. ' <span class="tooltip" title="<title>'
									. __( 'Hero Area » Content' )
									. '</title><p>'
									. __( 'Use this section to add a <strong>Title</strong> or a summary for this page. Get creative and add different elements like buttons, logos or other headings.', 'pile')
									. '</p><p>'
									. __( 'You can insert a title using a <strong>Heading 1</strong> element, either on the Hero Area or using a <b>Text Block</b> within the above content area.', 'pile')
									. '</p><p>'
									. __('* Note that the <strong>Page Title</strong> written above will <u>not</u> be included automatically on the page, so you have complete freedom in choosing where you place or how it looks.', 'pile')
									. "</p><p><a href='#'>"
									. __('Learn more about Managing the Hero Area', 'pile')
									. '</a></p>"></span>',
					'pages'      => array( 'page' ), // Post type
					'context'    => 'normal',
					'priority'   => 'high',
					'hidden'     => true,
					'show_on'    => array(
						'key'   => 'page-template',
						'value' => array( 'default', 'page-templates/page-builder.php', 'page-templates/portfolio-archive.php' ),
					),
					'show_names' => true, // Show field names on the left
					'fields'     => array(
						array(
							'name'       => esc_html__( 'Description', 'pile' ),
							'id'         => '_pile_header_cover_description',
							'type'       => 'wysiwyg',
							'show_names' => false,
							'std'        => '<h1>[Page Title]</h1>',

							'desc' => '<span class="hero-editor-visibility-status">
								<span class="dashicons  dashicons-visibility"></span>
								<span class="dashicons  dashicons-hidden"></span>
								<span class="hero-visibility-text">' . esc_html__( 'Visible Hero Area', 'pile' ) . '</span>
								<span class="hero-hidden-text">' . esc_html__( 'Hidden Hero Area', 'pile' ) . '</span>
								</span>
								<span class="hero-visibility-description">' . esc_html__( 'To hide the Hero Area section, remove the content above and any item from the Hero Area » Background.' ) . '</span>
								<span class="hero-hidden-description">' . esc_html__( 'Add some content above or an image to the Hero Area » Background to make the Hero Area visible.' ) . '</span>',

							'options'    => array(
								'media_buttons' => true,
								'textarea_rows' => 16,
								'teeny'         => false,
								'tinymce'       => true,
								'quicktags'     => true,
							),
						),

						array(
							'name'    => esc_html__( 'Hero Area Height', 'pile' ),
							'desc'    => '<p>' . esc_html__( 'Set the height of the Hero Area relative to the browser window.', 'pile' ) . '</p>',
							'id'      => '_pile_page_header_height',
							'type'    => 'select',
							'options' => array(
								array(
									'name'  => '&#9673;&#9673;&#9673; ' . esc_html__( 'Full Height', 'pile' ),
									'value' => 'full-height',
								),
								array(
									'name'  => '&#9673;&#9673;&#9711; ' . esc_html__( 'Two Thirds', 'pile' ),
									'value' => 'two-thirds-height',
								),
								array(
									'name'  => '&nbsp; &#9673;&#9711; ' . esc_html__( '&nbsp;Half', 'pile' ),
									'value' => 'half-height',
								)
							),
							'std'     => 'full-height',
						),
						array(
							'name'    => esc_html__( 'Hero Content Alignment', 'pile' ),
							'desc'    => '<p>Considering the background image focal point, you can align the content to make them both more visible.</p> 
							<ul>
								<li>Mix it with a background color overlay to make it pop</li>
								<li>Individual text alignments will override this option</li>
								<li>You can align the content to make them both more visible.</li>
							</ul>',
							'id'      => '_hero_description_alignment',
							'type'    => 'positions_map',
							'options' => array(
								array(
									'name'  => '&#x2196;',
									'value' => 'top left',
								),
								array(
									'name'  => '&#8593;',
									'value' => 'top',
								),

								array(
									'name'  => '&#x2197;',
									'value' => 'top right',
								),

								array(
									'name'  => '&#8592; ',
									'value' => 'left',
								),

								array(
									'name'  => '&#x95;',
									'value' => '',
								),

								array(
									'name'  => '&#8594;',
									'value' => 'right',
								),

								array(
									'name'  => '&#x2199;',
									'value' => 'bottom left',
								),

								array(
									'name'  => '&#8595;',
									'value' => 'bottom',
								),

								array(
									'name'  => '&#x2198;',
									'value' => 'bottom right',
								),
							),
							'std'     => '',
						),

						// array(
						// 	'name'    => esc_html__( 'Social Share', 'pile' ),
						// 	'id'      => '_pile_page_enabled_social_share',
						// 	'type'    => 'select',
						// 	'options' => array(
						// 		array(
						// 			'name'  => esc_html__( 'Enabled', 'pile' ),
						// 			'value' => true
						// 		),
						// 		array(
						// 			'name'  => esc_html__( 'Disabled', 'pile' ),
						// 			'value' => false
						// 		)
						// 	),
						// 	'std'     => false
						// ),


						array(
							'name'    => '&#x1F48E; ' . esc_html__( 'Featured Projects Options', 'pile' ),
							'id'      => 'pile_featured_projects_title',
							'type'    => 'title',
							'display_on' => array(
								'display' => true,
								'on'      => array(
									'field' => 'page_template',
									'value' =>  array( 'page-templates/portfolio-archive.php' )
								)
							),

						),


						array(
							'name'            => esc_html__( 'Selected Projects', 'pile' ),
							'id'              => '_pile_portfolio_featured_projects',
							'desc'            => esc_html__( 'Choose the projects to be part of the Hero Slider.', 'pile' ),
							'type'            => 'pw_multiselect_cpt',
							'options'         => array(
								'args' => array(
									'post_type'   => 'pile_portfolio',
									'post_status' => 'publish'
								),
							),
							'display_on' => array(
								'display' => true,
								'on'      => array(
									'field' => 'page_template',
									'value' =>  array( 'page-templates/portfolio-archive.php' )
								)
							),
							'sanitization_cb' => 'pw_select2_sanitise',
						),
						array(
							'name'    => esc_html__( 'Exclude Featured Projects From Main List', 'pile' ),
							'id'      => '_pile_portfolio_exclude_featured',
							'desc'    => esc_html__( 'To avoid duplicate projects on the same page, you can choose to exclude the featured projects selected above from the main portfolio projects list.', 'pile' ),
							'type'    => 'select',
							'options' => array(
								array(
									'name'  => esc_html__( 'Exclude featured projects', 'pile' ),
									'value' => true,
								),
								array(
									'name'  => esc_html__( 'Do not exclude featured projects', 'pile' ),
									'value' => false,
								),
							),
							'std'     => true,
							'display_on' => array(
								'display' => true,
								'on'      => array(
									'field' => 'page_template',
									'value' =>  array( 'page-templates/portfolio-archive.php' )
								)
							),
						),
						array(
							'name' => esc_html__( '“View Project” Button Label', 'pile' ),
							'id'   => '_pile_portfolio_featured_view_more_label',
							'desc'	=> __( 'Adjust the label for the single project button, displayed on each slide. Empty it if you want to hide the button.', 'pile' ),
							'type' => 'text_medium',
							'std' => esc_html__( 'View project', 'pile' ),
							'display_on' => array(
								'display' => true,
								'on'      => array(
									'field' => 'page_template',
									'value' =>  array( 'page-templates/portfolio-archive.php' )
								)
							),
						),
						array(
							'name' => esc_html__( 'Number of Projects Per Page', 'pile' ),
							'desc'	=> __( 'Set the number of projects displayed at once.', 'pile' ),
							'id'   => '_pile_portfolio_projects_per_page',
							'type' => 'text_small',
							'std'  => '15',
							'display_on' => array(
								'display' => true,
								'on'      => array(
									'field' => 'page_template',
									'value' =>  array( 'page-templates/portfolio-archive.php' )
								)
							),
						),
						array(
							'name'    => esc_html__( 'Pagination Style', 'pile' ),
							'id'      => '_pile_portfolio_infinite_scroll',
							'desc'    => esc_html__( 'Select whether to use a standard pagination or infinite scroll to automatically load more projects as you scroll.', 'pile' ),
							'type'    => 'select',
							'options' => array(
								array(
									'name'  => esc_html__( 'Infinite Scroll', 'pile' ),
									'value' => true,
								),
								array(
									'name'  => esc_html__( 'Standard (Next/Prev)', 'pile' ),
									'value' => false,
								),
							),
							'std'     => true,
							'display_on' => array(
								'display' => true,
								'on'      => array(
									'field' => 'page_template',
									'value' =>  array( 'page-templates/portfolio-archive.php' )
								)
							),
						),

						// PAGE (Regular) Slideshow Options
						// Show by default and hide while "Portfolio Archive"
						array(
							'name'    => '&#x1F307; &nbsp; ' . esc_html__( 'Slideshow Options', 'pile' ),
							'id'      => '_pile_page_slider_options_title',
							'value' => __( 'Add more than one image to the <strong>Hero Area » Background</strong> to enable this section. ', 'pile' ),
							'type'    => 'title',
							'hidden' => true,
							'display_on' => array(
								'display' => false,
								'on'      => array(
									'field' => 'page_template',
									'value' =>  array( 'page-templates/portfolio-archive.php' )
								)
							),

						),

						// FRONTPAGE Slideshow Options
						// Show only while "Portfolio Archive" template is selected
						array(
							'name'    => '&#x1F307; &nbsp; ' . esc_html__( 'Slideshow Options', 'pile' ),
							'id'      => '_pile_portfolio_archive_slider_options_title',
							'value' => __( 'Add at least one project to the <strong>Selected Projects</strong> option above, to enable this section. ', 'pile' ),
							'type'    => 'title',
							'display_on' => array(
								'display' => true,
								'on'      => array(
									'field' => 'page_template',
									'value' =>  array( 'page-templates/portfolio-archive.php' )
								)
							),

						),
						array(
							'name'    => esc_html__( 'Auto Play', 'pile' ),
							'desc'	  => esc_html__( 'The slideshow will automatically move to the next slide, after a period of time.', 'pile' ),
							'id'      => '_pile_post_slider_autoplay',
							'type'    => 'select',
							'options' => array(
								array(
									'name'  => esc_html__( 'Enabled', 'pile' ),
									'value' => true
								),
								array(
									'name'  => esc_html__( 'Disabled', 'pile' ),
									'value' => false
								)
							),
							'std'     => false
						),
						array(
							'name'       => esc_html__( 'Auto Play Delay (s)', 'pile' ),
							'desc'		=> esc_html__( 'Set the number of seconds to wait before moving to the next slide.', 'pile' ),
							'id'         => '_pile_post_slider_delay',
							'type'       => 'text_small',
							'std'        => '5',
							'display_on' => array(
								'display' => true,
								'on'      => array(
									'field' => '_pile_post_slider_autoplay',
									'value' => true
								)
							),
						),
					),
				),

				// $PROJECT Hero Area Options
				'pile_project_header_area_slideshow' => array(
					'id'         => 'pile_project_header_area_slideshow',
					'title'      => '&#x1f535; ' . esc_html__( 'Hero Area » Content', 'pile' )
									. ' <span class="tooltip" title="<title>'
									. __( 'Hero Area » Content' )
									. '</title><p>'
									. __( 'Use this section to add a <strong>Title</strong> or a summary for this page. Get creative and add different elements like buttons, logos or other headings.', 'pile')
									. '</p><p>'
									. __( 'You can insert a title using a <strong>Heading 1</strong> element, either on the Hero Area or using a <b>Text Block</b> within the above content area.', 'pile')
									. '</p><p>'
									. __('* Note that the <strong>Page Title</strong> written above will <u>not</u> be included automatically on the page, so you have complete freedom in choosing where you place or how it looks.', 'pile')
									. "</p><p><a href='#'>"
									. __('Learn more about Managing the Hero Area', 'pile')
									. '</a></p>"></span>',
					'desc'    => '<p>' . esc_html__( 'Set the height of the Hero Area relative to the browser window.', 'pile' ) . '</p>',
					'pages'      => array( 'pile_portfolio' ), // Post type
					'context'    => 'normal',
					'priority'   => 'high',
					'hidden'     => false,
					'show_names' => true, // Show field names on the left
					'fields'     => array(
						array(
							'name'       => esc_html__( 'Description', 'pile' ),
							'id'         => '_pile_header_cover_description',
							'type'       => 'wysiwyg',
							'show_names' => false,
							'std'        => '[project categories]
							<h1>[Project Title]</h1>
							<p class="desc">Optional short description text</p>',
							'desc' => '<span class="hero-editor-visibility-status">
										<span class="dashicons  dashicons-visibility"></span>
										<span class="dashicons  dashicons-hidden"></span>
										<span class="hero-visibility-text">' . esc_html__( 'Visible Hero Area', 'pile' ) . '</span>
										<span class="hero-hidden-text">' . esc_html__( 'Hidden Hero Area', 'pile' ) . '</span>
										</span>
										<span class="hero-visibility-description">' . esc_html__( 'To hide the Hero Area section, empty the above content area and any items from the Hero Area » Background.' ) . '</span>
										<span class="hero-hidden-description">' . esc_html__( 'Add content above or an image to the Hero Area » Background to make the Hero Area visible.' ) . '</span>',
							'options'    => array(
								'media_buttons' => true,
								'textarea_rows' => 16,
								'teeny'         => false,
								'tinymce'       => true,
								'quicktags'     => true,
							),
						),


						array(
							'name'    => esc_html__( 'Hero Area Height', 'pile' ),
							'desc'    => '<p>' . esc_html__( 'Select the height of the header area in relation to the browser window.', 'pile' ) . '</p>',
							'id'      => '_pile_project_header_height',
							'type'    => 'select',
							'options' => array(
								array(
									'name'  => '&#9673;&#9673;&#9673; ' . esc_html__( 'Full Height', 'pile' ),
									'value' => 'full-height',
								),
								array(
									'name'  => '&#9673;&#9673;&#9711; ' . esc_html__( 'Two Thirds', 'pile' ),
									'value' => 'two-thirds-height',
								),
								array(
									'name'  => '&nbsp; &#9673;&#9711; ' . esc_html__( '&nbsp;Half', 'pile' ),
									'value' => 'half-height',
								)
							),
							'std'     => 'full-height',
						),
						array(
							'name'    => esc_html__( 'Hero Content Alignment', 'pile' ),
							'desc'    => __('<p>Considering the background image focal point, you can align the content to make them both more visible.</p> 
							<ul>
								<li>Mix it with a background color overlay to make it pop</li>
								<li>Individual text alignments will override this option</li>
								<li>You can align the content to make them both more visible.</li>
							</ul>', 'pile'),
							'id'      => '_hero_description_alignment',
							'type'    => 'positions_map',
							'options' => array(
								array(
									'name'  => '&#x2196;',
									'value' => 'top left',
								),
								array(
									'name'  => '&#8593;',
									'value' => 'top',
								),

								array(
									'name'  => '&#x2197;',
									'value' => 'top right',
								),

								array(
									'name'  => '&#8592; ',
									'value' => 'left',
								),

								array(
									'name'  => '&#x95;',
									'value' => '',
								),

								array(
									'name'  => '&#8594;',
									'value' => 'right',
								),

								array(
									'name'  => '&#x2199;',
									'value' => 'bottom left',
								),

								array(
									'name'  => '&#8595;',
									'value' => 'bottom',
								),

								array(
									'name'  => '&#x2198;',
									'value' => 'bottom right',
								),
							),
							'std'     => '',
						),

						// Project Slideshow Options
						array(
							'name' => '&#x1F307; &nbsp; ' . esc_html__( 'Slideshow Options', 'pile' ),
							'id'   => '_pile_separator_slideshow_options',
							'value' => __( 'Add more than one image to the <strong>Hero Area » Background</strong> to enable this section. ', 'pile' ),
							'type' => 'title',
							'hidden' => true,
						),
						array(
							'name'    => esc_html__( 'Auto Play', 'pile' ),
							'desc'	  => esc_html__( 'The slideshow will automatically move to the next slide, after a period of time.', 'pile' ),
							'id'      => '_pile_post_slider_autoplay',
							'type'    => 'select',
							'hidden' => true,
							'options' => array(
								array(
									'name'  => esc_html__( 'Enabled', 'pile' ),
									'value' => true
								),
								array(
									'name'  => esc_html__( 'Disabled', 'pile' ),
									'value' => false
								)
							),
							'std'     => false
						),
						array(
							'name'       => esc_html__( 'Auto Play Delay (s)', 'pile' ),
							'desc'		=> esc_html__( 'Set the number of seconds to wait before moving to the next slide.', 'pile' ),
							'id'         => '_pile_post_slider_delay',
							'type'       => 'text_small',
							'std'        => '5',
							'hidden' => true,
							'display_on' => array(
								'display' => true,
								'on'      => array(
									'field' => '_pile_post_slider_autoplay',
									'value' => true
								)
							),
						),
					)
				),

				//for the Contact Page template
				'pile_gmap_settings' => array(
					'id'         => 'pile_gmap_settings',
					'title'      => esc_html__( 'Map Coordinates & Display Options', 'pile' ),
					'pages'      => array( 'page' ), // Post type
					'context'    => 'normal',
					'priority'   => 'high',
					'hidden'     => true,
					'show_on'    => array(
						'key'   => 'page-template',
						'value' => array( 'page-templates/contact.php' ),
						// 'hide' => true, // make this true if you want to hide it
					),
					'show_names' => true, // Show field names on the left
					'fields'     => array(
						array(
							'name'    => esc_html__( 'Map Height', 'pile' ),
							'desc'    => '<p>' . esc_html__( 'Select the height of the Google Map area in relation to the browser window.', 'pile' ) . '</p>',
							'id'      => '_pile_contact_page_header_height',
							'type'    => 'select',
							'options' => array(
								array(
									'name'  => '&nbsp; &#9673;&#9711; ' . esc_html__( '&nbsp;Half', 'pile' ),
									'value' => 'half-height',
								),
								array(
									'name'  => '&#9673;&#9673;&#9711; ' . esc_html__( 'Two Thirds', 'pile' ),
									'value' => 'two-thirds-height',
								),
								array(
									'name'  => '&#9673;&#9673;&#9673; ' . esc_html__( 'Full Height', 'pile' ),
									'value' => 'full-height',
								)
							),
							'std'     => 'full-height',
						),
						array(
							'name' => esc_html__( 'Google Maps URL', 'pile' ),
							'desc' => __( 'Paste here the Share URL you have copied from <a href="http://www.google.com/maps" target="_blank">Google Maps</a>.', 'pile' ),
							'id'   => '_pile_gmap_url',
							'type' => 'textarea_small',
							'std'  => '',
						),
						array(
							'name' => esc_html__( 'Custom Colors', 'pile' ),
							'desc' => esc_html__( 'Allow us to change the map colors to better match your website.', 'pile' ),
							'id'   => '_pile_gmap_custom_style',
							'type' => 'checkbox',
							'std'  => 'on',
						),
						array(
							'name'    => esc_html__( 'Pin Content', 'pile' ),
							'desc'    => esc_html__( 'Insert here the content of the location marker - leave empty for no custom marker.', 'pile' ),
							'id'      => '_pile_gmap_marker_content',
							'type'    => 'wysiwyg',
							'std'     => '',
							'options' => array(
								'media_buttons' => true,
								'textarea_rows' => 3,
								'teeny'         => false,
								'tinymce'       => true,
								'quicktags'     => true,
							),
						),
						// array(
						// 	'name'    => esc_html__( 'Social Share', 'pile' ),
						// 	'id'      => '_pile_gmap_enabled_social_share',
						// 	'type'    => 'select',
						// 	'options' => array(
						// 		array(
						// 			'name'  => esc_html__( 'Enabled', 'pile' ),
						// 			'value' => true
						// 		),
						// 		array(
						// 			'name'  => esc_html__( 'Disabled', 'pile' ),
						// 			'value' => false
						// 		)
						// 	),
						// 	'std'     => false
						// ),
					),
				),
				'pile_custom_css_styles'               => array(
					'id'         => 'pile_custom_css_styles',
					'title'      => esc_html__( 'Custom CSS Styles', 'pile' ),
					'pages'      => array( 'page', 'pile_portfolio', 'product' ), // Post type
					'context'    => 'normal',
					'priority'   => 'low',
					'hidden'     => false,
					'show_names' => false, // Show field names on the left
					'fields'     => array(
						array(
							'name'   => esc_html__( 'CSS Style', 'pile' ),
							'desc'   => esc_html__( 'Add CSS that will only be applied to this post.', 'pile' ),
							'id'     => 'custom_css_style',
							'type'   => 'textarea_code',
							'rows' => '12',
						),
					)
				),

				'pile_disable_ajax_on_page'               => array(
					'id'         => 'pile_disable_ajax_on_page',
					'title'      => esc_html__( 'Page AJAX Exclusion', 'pile' ),
					'pages'      => array( 'post', 'page', 'pile_portfolio' ), // Post type
					'context'    => 'side',
					'priority'   => 'low',
					'hidden'     => true,
					'show_names' => true, // Show field names on the left
					'fields'     => array(
						array(
							'name'   => esc_html__( 'Disable AJAX on this page', 'pile' ),
							'desc'   => esc_html__( 'In case that something breaks due to the AJAX loading, use this checkbox', 'pile' ),
							'id'     => 'pile_disable_ajax_on_page',
							'type'   => 'checkbox',
							'std' => false,
						),
					)
				),

				'product_hero_area_background'    => array(
					'id'         => 'product_hero_area_background',
					'title'      => esc_html__( 'Product Layout Options', 'pile' ),
					'pages'      => array( 'product' ), // Post type
					'context'    => 'side',
					'priority'   => 'low',
					'show_names' => false, // Show field names on the left
					'fields'     => array(
						array(
							'name'    => esc_html__( 'Hero Images Layout', 'pile' ),
							'desc'    => '<p><strong>' . esc_html__( 'Hero Images Layout', 'pile' ) . '</strong> <span class="tooltip" title="<p>' . esc_html__( '*Considering the products images sizes and styles, you can enhance their presentation by adjusting their layout mode.', 'pile' )  . '</p>"></span></p>',
							'id'      => '_product_image_layout',
							'type'    => 'select',
							'options' => array(
								array(
									'name'  => esc_html__( 'Contain', 'pile' ),
									'value' => 'l-contain',
								),
								array(
									'name'  => esc_html__( 'Cover — Half', 'pile' ),
									'value' => 'l-cover l-cover-half',
								),
								array(
									'name'  => esc_html__( 'Cover — Two-Thirds', 'pile' ),
									'value' => 'l-cover l-cover-two-thirds',
								),
								array(
									'name'  => esc_html__( 'Cover — Full-Bleed', 'pile' ),
									'value' => 'l-cover l-cover-full-bleed',
								),
							),
							'std'     => 'contain',
						),
						array(
							'name'      => esc_html__( 'Content Builder', 'pile' ),
							'desc'	 	=> '<strong>' . esc_html__( 'Content Builder', 'pile' ) . '</strong>',
							'id'        => 'enable_builder',
							'type'      => 'select',
							'std'   => 'off',
							'options' => array(
								array(
									'name'  => esc_html__( 'On', 'pile' ),
									'value' => 'on',
								),
								array(
									'name'  => esc_html__( 'Off', 'pile' ),
									'value' => 'off',
								),
							)
						),
						array(
							'name' => esc_html__( 'Background Color', 'pile' ),
							'desc' => '<p><strong>' . esc_html__( 'Hero Background Color', 'pile' ) . '</strong> <span class="tooltip" title="<p>' . esc_html__( 'Used as a background color during page transitions.', 'pile' ) . '</p><p>' . esc_html__( 'Tip: It helps if the color matches the background color of the Hero image.', 'pile' ) . '</p>"></span></p>',
							'id'   => '_hero_background_color',
							'type' => 'colorpicker',
							'std' => '#FFFFFF'
						),
					)
				),

				'pile_product_builder'               => array(
					'id'         => 'pile_product_builder',
					'title'      => '&#x1f4dd; ' . esc_html__( 'Product » Content Builder')
					                . '<a class="tooltip" title="<p><title>'
					                . esc_html__('Content Builder', 'pile')
					                . '</title>'
					                . esc_html__( ' Add different types of <b>blocks</b> to create a custom page layout. Move, resize and align them to better match your content.', 'pile' )
					                . "</p><p><a href='#'>"
					                . esc_html__( 'Learn more about the Content Builder', 'pile' ) . '</a></p>"></a>',
					'pages'      => array( 'product' ),
					'context'    => 'normal',
					'priority'   => 'high',
					'show_names' => false,
					'display_on' => array(
						'display' => true,
						'on'      => array(
							'field' => 'enable_builder',
							'value' =>  'on'
						)
					),
					'fields'     => array(
						array(
							'name'   => esc_html__( 'Builder', 'pile' ),
							'id'     => '_pile_page_builder',
							'type'   => 'pix_builder',
							'hidden' => true
						),
					)
				),

			),
		),
	);

	/**
	 * Make sure pixlikes has the right settings
	 */
	if( isset( $activation_settings['pixlikes-settings'] ) ) {
		$pixlikes_settings = $activation_settings['pixlikes-settings'];
		update_option( 'pixlikes_settings', $pixlikes_settings );
	}

	/**
	 * Create custom post types, taxonomies and metaboxes
	 * These will be taken by pixtypes plugin and converted in their own options
	 */
	if( isset( $activation_settings['pixtypes-settings'] ) ) {

		$pixtypes_conf_settings = $activation_settings['pixtypes-settings'];

		$types_options = get_option( 'pixtypes_themes_settings' );
		if( empty( $types_options ) ) {
			$types_options = array();
		}

		$theme_key                   = 'pile_pixtypes_theme';
		$types_options[ $theme_key ] = $pixtypes_conf_settings;

		update_option( 'pixtypes_themes_settings', $types_options );
	}

	// if we don't have yet a setup for advancet tinymce plugin, Pile would like to propose some once
	$tadv_settings = get_option( 'tadv_settings', false );
	if ( empty( $tadv_settings ) ) {

		// Save the new settings
		update_option( 'tadv_settings', array(
			'toolbar_1' => 'bold,italic,underline,bullist,numlist,blockquote,hr,alignleft,aligncenter,alignright,link,unlink,nonbreaking,removeformat,visualblocks,fontsizeselect,wp_adv',
			'toolbar_2' => 'styleselect,formatselect,forecolor',
			'toolbar_3' => '',
			'toolbar_4' => '',
			'options' => 'advlist',
			'plugins' => 'visualblocks,nonbreaking,advlist',
		) );
		update_option( 'tadv_admin_settings', array( 'options' => array(), 'disabled_plugins' => array(), 'disabled_editors' => array() ) );
		update_option( 'tadv_version', 4000 );
	}
	/**
	 * http://wordpress.stackexchange.com/questions/36152/flush-rewrite-rules-not-working-on-plugin-deactivation-invalid-urls-not-showing
	 */
	delete_option( 'rewrite_rules' );
}

add_action( 'after_switch_theme', 'wpgrade_callback_geting_active' );