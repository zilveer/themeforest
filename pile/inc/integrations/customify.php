<?php
/**
 * Customify Compatibility File.
 * This is where the theme's Customizer settings are setup
 *
 * @link https://wordpress.org/plugins/customify/
 *
 * @package Pile
 * @since Pile 2.0
 */

if ( ! function_exists( 'add_customify_pile_options' ) ) {

	function add_customify_pile_options( $config ) {

		// Recommended Fonts List
		// Headings
		$recommended_headings_fonts = array(
			'Trueno',
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
			'Trueno',
			'Source Sans Pro',
			'Lato',
			'Open Sans',
			'PT Sans',
			'Cabin',
			'Gentium Book Basic',
			'PT Serif',
			'Droid Serif'
		);

		// Desc
		$recommended_desc_fonts = array(
			'Libre Baskerville',
			'Trueno',
			'Source Sans Pro',
			'Lato',
			'Open Sans',
			'PT Sans',
			'Cabin',
			'Gentium Book Basic',
			'PT Serif',
			'Droid Serif'
		);

		$config['opt-name'] = 'pile_options';

		/**
		 * Layout - This section will handle different layout elements (eg. header, content)
		 */
		$config['panels']['layouts_panel'] = array(
			'title'    => '&#x1f4bb; &nbsp;&nbsp;' . esc_html__( 'Layout', 'pile' ),
			'priority'    => 2,
			'sections' => array(
				// Header
				'header_layouts_section' => array(
					'title'   => __( 'Header', 'pile' ),
					'options' => array(
						// Logo Height
						'header_logo_height' => array(
							'type'        => 'range',
							'label'       => esc_html__( 'Logo Height', 'pile' ),
							'default'     => 24,
							'live'        => true,
							'input_attrs' => array(
								'min'          => 24,
								'max'          => 240,
								'step'         => 1,
								'data-preview' => true,
							),
							'css'         => array(
								array(
									'property' => 'max-height',
									'selector' => '.logo__img',
									'unit'     => 'px',
								),
								array(
									'property' => 'font-size',
									'selector' => '.logo__text',
								),
							),
						),

						// Header Height
						'header_height' => array(
							'type'        => 'range',
							'label'       => esc_html__( 'Header Height', 'pile' ),
							'default'     => 90,
							'live'        => true,
							'input_attrs' => array(
								'min'          => 40,
								'max'          => 200,
								'step'         => 1,
								'data-preview' => true,
							),
							'css'         => array(
								array(
									'property' => 'height',
									'selector' => '.header-height',
									'unit'     => 'px',
								),
								array(
									'property' => 'padding-top',
									'selector' => '.djax--hidden + .site-content,
									.woocommerce-checkout .woocommerce #customer_details,
									.woocommerce-checkout .woocommerce .woocommerce-checkout-review-order,
									.woocommerce-cart .woocommerce > form,
									.woocommerce-cart .woocommerce > .cart-collaterals,
									.l-contain .images',
									'unit'     => 'px',
								),
								array(
									'property' => 'margin-top',
									'selector' => '.has_sidebar .has-no-thumbnail,
									.body.woocommerce-checkout .woocommerce-error,
									.is--ie .woocommerce > .cart-empty,
									.product .summary,
									.l-cover .thumbnails',
									'unit'     => 'px',
								),
								array(
									'property' => 'margin-bottom',
									'selector' => '.product .summary,
									.l-contain .images,
									.l-contain .thumbnails',
									'unit'     => 'px',
								),
							),
						),

						// Header Width
						'header_width'        => array(
							'type'    => 'select',
							'label'   => esc_html__( 'Header Width', 'pile' ),
							'desc'    => __( '', 'pile' ),
							'choices' => array(
								'full'		=> 'Full Browser Width',
								'content'	=> 'Content Width',
							),
							'default' => 'full',
							'css'         => array(),
						),

						'header_sides_spacing' => array(
							'type'        => 'range',
							'label'       => esc_html__( 'Header Sides Spacing', 'pile' ),
							'default'     => 40,
							'live' => true,
							'input_attrs' => array(
								'min'  => 0,
								'max'  => 100,
								'step' => 1,
							),
							'css'	=> array(
								array(
									'property' => 'left',
									'selector' => '.header-padding .panel',
									'unit'     => 'px',
									'media'    => ' screen and (min-width: 699px)'
								),
								array(
									'property' => 'right',
									'selector' => '.header-padding .panel',
									'unit'     => 'px',
									'media'    => ' screen and (min-width: 699px) ',
								),
							),
						),

						// Header Position
						'header_position' => array(
							'type'    => 'select',
							'label'   => esc_html__( 'Header Position', 'pile' ),
							'desc'    => __( '', 'pile' ),
							'choices' => array(
								'static'    => 'Static',
								'sticky'	=> 'Sticky (fixed)',
							),
							'default' => 'sticky',
							'css'         => array(),
						),

						// Navigation Item Spacing
						'navigation_menu_items_spacing' => array(
							'type'        => 'range',
							'label'       => esc_html__( 'Navigation Items Spacing', 'pile' ),
							'default'     => 24,
							'live'        => true,
							'input_attrs' => array(
								'min'          => 12,
								'max'          => 75,
								'step'         => 1,
								'data-preview' => true,
							),
							'css'         => array(
								array(
									'property' => 'padding-left',
									'selector' => '.nav--main a',
									'unit'     => 'px',
									'media'    => ' screen and (min-width: 699px)',
								),
								array(
									'property' => 'padding-right',
									'selector' => '.nav--main a',
									'unit'     => 'px',
									'media'    => 'screen and (min-width: 699px) ',
								),
							),
						),


						// Navigation Style
						'nav_header_style'        => array(
							'type'    => 'select',
							'label'   => esc_html__( 'Navigation Style', 'pile' ),
							'desc'    => __( '', 'pile' ),
							'choices' => array(
								'standard'	=> esc_html__( 'Standard Menu', 'pile' ),
								'trigger'	=> '☰ ' . esc_html__( 'Hamburger Icon Trigger', 'pile' ),
							),
							'default' => 'standard',
							'css'     => array(),
						),
						'nav_menu_layout'        => array(
							'type'    => 'select',
							'label'   => esc_html__( 'Navigation Trigger Format', 'pile' ),
							// 'desc'    => __( 'Select which type of arrows you want on page headers.', 'pile' ),
							'choices' => array(
								'icon'      => '☰ 		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ' . esc_html__( 'Icon', 'pile' ),
								'text-icon' => esc_html__( 'Menu', 'pile' ) . ' ☰ 	&nbsp;&nbsp;&nbsp; ' . esc_html__( 'Text + Icon', 'pile' ),
								'text'      => esc_html__( 'Menu', 'pile' ) . ' 	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ' . esc_html__( 'Text', 'pile' ),
							),
							'default' => 'icon',
							'css'     => array(),
						),

						'nav_menu_text'          => array(
							'type'    => 'text',
							'label'   => esc_html__( 'Navigation Trigger Text', 'pile' ),
							'default' => esc_html__( 'Menu', 'pile' ),
							'live'    => array( '.navigation-toggle span' ),
							'css'     => array(),
						),
					),
				),

				// Content
				'content_layouts_section' => array(
					'title'   => esc_html__( 'Content', 'pile' ),
					'options' => array(
						'general_content_width' => array(
							'type'        => 'range',
							'label'       => esc_html__( 'General Site Container Width', 'pile' ),
							'desc'        => esc_html__( 'Set the width of the container.', 'pile' ),
							'live'        => true,
							'default'     => 1200,
							'input_attrs' => array(
								'min'          => 600,
								'max'          => 2700,
								'step'         => 1,
								'data-preview' => true,
							),
							'css'         => array(
								array(
									'property' => 'max-width',
									'selector' => '.content-width',
									'unit'     => 'px',
								),
							),
						),
					),
				),

				//Footer
				'footer_layout_section' => array(
					'title'   => esc_html__( 'Footer', 'pile' ),
					'options' => array(
						'footer_number_of_columns' => array(
							'type'    => 'select',
							'label'   => esc_html__( 'Widget Area Number of Columns', 'pile' ),
							'desc'    => esc_html__( 'Select how many number of columns should the Footer widget area have.', 'pile' ),
							'choices' => array(
								'1' => '1',
								'2' => '2',
								'3' => '3',
								'4' => '4',
								'6' => '6',
							),
							'default' => '4',
						),
						'footer_column_width'      => array(
							'type'    => 'select',
							'label'   => esc_html__( 'Widget Column width', 'pile' ),
							'choices' => array(
								'one-third'  => esc_html__( 'One third', 'pile' ),
								'two-thirds' => esc_html__( 'Two thirds', 'pile' ),
								'one-whole'  => esc_html__( 'Whole', 'pile' ),
							),
							'default' => 'one-third',
							//'required'    => array( 'footer_number_of_columns', '=', 1 ),
						),
					),
				),

				// Portfolio Archives
				'archives_layouts_section' => array(
					'title'   => '&#x1f5fb; &nbsp;&nbsp;' . esc_html__( 'Portfolio Archive', 'pile' ),
					'options' => array(
						'archive_content_width' => array(
							'type'        => 'range',
							'label'       => esc_html__( 'Archive Container Width', 'pile' ),
							'live'        => true,
							'default'     => 1200,
							'input_attrs' => array(
								'min'          => 600,
								'max'          => 2700,
								'step'         => 1,
								'data-preview' => true,
							),
							'css'         => array(
								array(
									'property' => 'max-width',
									'selector' => '.page-template-portfolio-archive .content-width,
										.post-type-archive-pile_portfolio .content-width,
										.blog .content-width,
										.archive .content-width',
									'unit'     => 'px',
								),
							),
						),
						'projects_archive_padding' => array(
							'type'        => 'range',
							'label'        => esc_html__( 'Spacing Around the Grid Container', 'pile' ),
							'default'     => 48,
							'live' => true,
							'input_attrs' => array(
								'min'          => 0,
								'max'          => 120,
								'step'         => 6,
								'data-preview' => true,
							),
							'css'         => array(
								array(
									'property' => 'padding-left',
									'selector' => '.post-type-archive-pile_portfolio .site-content.wrapper,
									.page-template-portfolio-archive .site-content.wrapper',
									'unit'     => 'px',
								),
								array(
									'property' => 'padding-right',
									'selector' => '.post-type-archive-pile_portfolio .site-content.wrapper,
									.page-template-portfolio-archive .site-content.wrapper',
									'unit'     => 'px',
								),
							),
						),
						'archive_thumbnails_aspect_ratio' => array(
							'type'    => 'select',
							'label'   => esc_html__( 'Items Aspect Ratio', 'pile' ),
							'choices' => array(
								'original' => esc_html__( 'Original', 'pile' ),
								'square' => esc_html__( 'Square 1:1', 'pile' ),
								'landscape' => esc_html__( 'Landscape 4:3', 'pile' ),
								'portrait' => esc_html__( 'Portrait 3:4', 'pile' ),
							),
							'default' => 'original',
						),
						'pile_horizontal_spacing' => array(
							'type'        => 'range',
							'label'       => esc_html__( 'Items Horizontal Spacing', 'pile' ),
							'default'     => 42,
							'live'        => false,
							'input_attrs' => array(
								'min'          => -240,
								'max'          => 120,
								'step'         => 6,
								'data-preview' => true,
							),
							'css'         => array(
								array(
									'selector' => '.pile--portfolio-archive',
									'property' => '',
									'callback_filter' => 'pile_horizontal_spacing_cb',
									'unit'     => 'px',
								),
							),
						),
						'pile_vertical_spacing' => array(
							'type'        => 'range',
							'label'       => esc_html__( 'Items Vertical Spacing', 'pile' ),
							'default'     => 42,
							'live'        => true,
							'input_attrs' => array(
								'min'          => -240,
								'max'          => 120,
								'step'         => 6,
								'data-preview' => true,
							),
							'css'         => array(
								array(
									'property' => 'margin-bottom',
									'selector' => '.pile-item',
									'unit'     => 'px',
								),
								array(
									'property' => 'margin-top',
									'selector' => '.pile',
									'unit'     => 'px',
								),
							),
						),
						'this_divider_2937812371' => array(
							'type' => 'html',
							'html' => '<span class="separator label large">' . esc_html__( '3D Grid Options', 'pile' ) . '</span>',
						),
						'pile_3d_effect' => array(
							'type'    => 'checkbox',
							'label'   => esc_html__( 'Enable 3D Grid', 'pile' ),
							// 'decription'     => __( 'Transform your portfolio regular grid into a dynamic one.', 'pile' ),
							'default' => 1,
						),
						'pile_3d_target' => array(
							'type'    => 'select',
							'label'   => esc_html__( 'Apply the rules on', 'pile' ),
							'choices' => array(
								'item' => esc_html__( 'Individual items', 'pile' ),
								'column' => esc_html__( 'Columns', 'pile' ),
							),
							'default' => 'item',
						),
						'pile_3d_target_rule' => array(
							'type'    => 'select',
							'label'   => '',
							'choices' => array(
								'odd' => esc_html__( 'Odd', 'pile' ),
								'even' => esc_html__( 'Even', 'pile' ),
							),
							'default' => 'odd',
						),

						'parallax_amount' => array(
							'type'        => 'range',
							'label'       => esc_html__( 'Parallax Scrolling Range', 'pile' ),
							'desc'        => esc_html__( 'Set the distance traveled by items on scroll.', 'pile' ),
							'default'     => 42,
							'input_attrs' => array(
								'min'          => 0,
								'max'          => 120,
								'step'         => 6,
								'data-preview' => true,
							),
						),
						'this_divider_88623071235' => array(
							'type' => 'html',
							'html' => '<span class="separator label large">' . esc_html__( 'Number of columns', 'pile' ) . '</span>',
						),
						'pile_large_columns' => array(
							'type'    => 'select',
							'label'   => esc_html__( 'Big screens', 'pile' ),
							'choices' => array(
								'1' => esc_html( sprintf( _n( '%s column', '%s columns', 1, 'pile' ), 1 ) ),
								'2' => esc_html( sprintf( _n( '%s column', '%s columns', 2, 'pile' ), 2 ) ),
								'3' => esc_html( sprintf( _n( '%s column', '%s columns', 3, 'pile' ), 3 ) ),
								'4' => esc_html( sprintf( _n( '%s column', '%s columns', 4, 'pile' ), 4 ) ),
								'5' => esc_html( sprintf( _n( '%s column', '%s columns', 5, 'pile' ), 5 ) ),
								'6' => esc_html( sprintf( _n( '%s column', '%s columns', 6, 'pile' ), 6 ) ),
							),
							'default' => '3',
						),

						'pile_medium_columns' => array(
							'type'    => 'select',
							'label'   => esc_html__( 'Medium screens', 'pile' ),
							'choices' => array(
								'1' => esc_html( sprintf( _n( '%s column', '%s columns', 1, 'pile' ), 1 ) ),
								'2' => esc_html( sprintf( _n( '%s column', '%s columns', 2, 'pile' ), 2 ) ),
								'3' => esc_html( sprintf( _n( '%s column', '%s columns', 3, 'pile' ), 3 ) ),
								'4' => esc_html( sprintf( _n( '%s column', '%s columns', 4, 'pile' ), 4 ) ),
								'5' => esc_html( sprintf( _n( '%s column', '%s columns', 5, 'pile' ), 5 ) ),
							),
							'default' => '2',
						),

						'pile_small_columns' => array(
							'type'    => 'select',
							'label'   => esc_html__( 'Small screens', 'pile' ),
							'choices' => array(
								'1' => esc_html( sprintf( _n( '%s column', '%s columns', 1, 'pile' ), 1 ) ),
								'2' => esc_html( sprintf( _n( '%s column', '%s columns', 2, 'pile' ), 2 ) ),
								'3' => esc_html( sprintf( _n( '%s column', '%s columns', 3, 'pile' ), 3 ) ),
							),
							'default' => '1',
						),
					),
				),

				// Project Single
				'project_layouts_section'    => array(
					'title'   => '&#x1f5fb; &nbsp;&nbsp;' . esc_html__( 'Single Project', 'pile' ),
					'options' => array(
						'project_content_width' => array(
							'type'        => 'range',
							'label'       => esc_html__( 'Project Container Width', 'pile' ),
							// 'desc'        => __( 'Set the width of the container.', 'pile' ),
							'live'        => true,
							'default'     => 1000,
							'input_attrs' => array(
								'min'          => 600,
								'max'          => 2700,
								'step'         => 1,
								'data-preview' => true,
							),
							'css'         => array(
								array(
									'property' => 'max-width',
									'selector' => '.single-pile_portfolio .content-width',
									'unit'     => 'px',
								),
							),
						),
						'project_single_padding' => array(
							'type'        => 'range',
							'label'        => esc_html__( 'Spacing Around the Container', 'pile' ),
							'default'     => 48,
							'live' => true,
							'input_attrs' => array(
								'min'          => 0,
								'max'          => 120,
								'step'         => 6,
								'data-preview' => true,
							),
							'css'         => array(
								array(
									'property' => 'padding-left',
									'selector' => '.single-pile_portfolio .site-content.wrapper',
									'unit'     => 'px',
								),
								array(
									'property' => 'padding-right',
									'selector' => '.single-pile_portfolio .site-content.wrapper',
									'unit'     => 'px',
								),
							),
						),
						'this_divider_8076273561' => array(
							'type' => 'html',
							'html' => '<span class="separator label large">' . esc_html__( 'Project Grid Options', 'pile' ) . '</span>',
						),
						'pile_single_horizontal_spacing' => array(
							'type'        => 'range',
							'label'       => esc_html__( 'Items Horizontal Spacing', 'pile' ),
							'live'        => true,
							'default'     => 60,
							'input_attrs' => array(
								'min'          => 0,
								'max'          => 120,
								'step'         => 6,
								'data-preview' => true,
							),
							'css'         => array(
								array(
									'property' => 'padding-left',
									'selector' => '.pile-item--single',
									'unit'     => 'px',
								),
								array(
									'property'        => 'margin-left',
									'selector'        => '.pile--single',
									'callback_filter' => 'pile_range_negative_value',
									'unit'            => 'px',
								),
							),
						),

						'pile_single_vertical_spacing' => array(
							'type'        => 'range',
							'label'       => esc_html__( 'Items Vertical Spacing', 'pile' ),
							'live'        => false,
							'default'     => 60,
							'input_attrs' => array(
								'min'          => 0,
								'max'          => 120,
								'step'         => 6,
								'data-preview' => true,
							),
							'css'         => array(
								array(
									'property' 			=> 'dummy',
									'selector' 			=> 'body',
									'unit'     			=> 'px',
									'callback_filter' 	=> 'pile_position_values',
								)
							),
						),

						'this_divider_88962193'            => array(
							'type' => 'html',
							'html' => '<span class="separator label">' . esc_html__( 'Projects Navigation', 'pile' ) . '</span>',
						),
						'this_divider_1238010737682'                 => array(
							'type' => 'html',
							'html' => '<span class="separator label">' . esc_html__( 'Sharing Buttons', 'border' ) . '</span>',
						),
						'portfolio_single_show_share_links' => array(
							'type'    => 'checkbox',
							'label'   => esc_html__( 'Show Share Buttons', 'pile' ),
							'default' => 1,
						),
					),
				),

			),
		);

		$config['panels']['colors'] = array(
			'title'       => '&#x1f3a8; &nbsp;&nbsp;' . esc_html__( 'Colors', 'pile' ),
			'priority'    => 3,
			'description' => __( 'Using the color pickers you can change the colors of the most important elements. If you want to override the color of individual elements, you can always use Custom CSS code in Appearance → Customizer → CSS Editor.', 'pile' ),
			'sections' => array(

				// General
				'site_general' => array(
					'title'   => esc_html__( 'General', 'pile' ),
					'options' => array(
						'main_color'     => array(
							'type'    => 'color',
							'label'   => esc_html__( 'Accent Color', 'pile' ),
							//'desc'   => __( 'Use the color picker to change the main color of the site to match your brand color.', 'pile' ),
							'live'    => true,
							'default' => '#fa5264',
							'css'     => array(
								array(
									'property' => 'color',
									'selector' => 'h1 em, h2 em, h3 em, h4 em, h5 em, h6 em,
											.pixlikes-box.liked i,
											.widget a:hover,
											.widget_blog_subscription input[type="submit"],
											.no-touchevents .site-navigation a:hover,
											.no-touchevents .site-navigation li:hover > a,
											h4,
											.nav--main .current-menu-ancestor > a,
											.nav--main .current-menu-item > a,
											.cart-icon:hover',
								),

								array(
									'property' => 'background-color',
									'selector' => '.btn:hover, input[type="submit"]:hover,
											.btn--primary,
											.pixcode--icon.square:hover, .pixcode--icon.circle:hover,
											a:hover > .pixcode--icon.circle, a:hover > .pixcode--icon.square,
											.pixlikes-box .likes-text:after',
								),
								array(
									'property' => 'border-color',
									'selector' => '.widget_blog_subscription input[type="submit"]',
								),

								array(
									'property' => 'border-left-color',
									'selector' => '.cart-widget-details .wc-forward.checkout:hover:after',
								),
								array(
									'property' => 'outline',
									'selector' => 'select:focus, textarea:focus, input[type="text"]:focus,
											input[type="password"]:focus, input[type="datetime"]:focus,
											input[type="datetime-local"]:focus, input[type="date"]:focus,
											input[type="month"]:focus, input[type="time"]:focus, input[type="week"]:focus,
											input[type="number"]:focus, input[type="email"]:focus, input[type="url"]:focus,
											input[type="search"]:focus, input[type="tel"]:focus, input[type="color"]:focus,
											.form-control:focus',
								),
							),
						),
						'text_color' => array(
							'type'    => 'color',
							'label'   => esc_html__( 'Text Color', 'pile' ),
							'live'    => true,
							'default' => '#3E4858',
							'css'     => array(
								array(
									'property' => 'color',
									'selector' => 'body',
								),
							),
						),
						'headings_color' => array(
							'type'    => 'color',
							'label'   => esc_html__( 'Headings Color', 'pile' ),
							'live'    => true,
							'default' => '#282828',
							'css'     => array(
								array(
									'property' => 'color',
									'selector' => 'h1, h2, h3, h5, h6, .article-archive .article__title a, .article-archive .article__title a:hover',
								),
							),
						),
					),
				),

				// Header
				'site_header' => array(
					'title'   => esc_html__( 'Header', 'pile' ),
					'options' => array(

						// Header Background
						'header_background_color' => array(
							'type'    => 'color',
							'label'   => esc_html__( 'Header Background', 'pile' ),
							'live'    => true,
							'default' => '#ffffff',
							'css'     => array(
								array(
									'property' => 'background-color',
									'selector' => '.site-header, .nav--main ul',
								),
							),
						),

						'header_content_color' => array(
							'type'    => 'color',
							'label'   => esc_html__( 'Header Content', 'pile' ),
							'live'    => true,
							'default' => '#3E4858',
							'css'     => array(
								array(
									'property' => 'color',
									'selector' => '.site-header, .nav--main ul',
								),
							),
						),

						'header_transparent' => array(
							'type'    => 'checkbox',
							'label'   => esc_html__( 'Transparent Header while on Hero Area', 'pile' ),
							'default' => 1,
							'css'     => array(),
						),
						'header_transparent_content_color' => array(
							'type'    => 'color',
							'label'   => esc_html__( '— Header Transparent Content', 'pile' ),
							'live'    => true,
							'default' => '#ffffff',
							'css'     => array(
								array(
									'media'    => 'screen and (min-width: 699px)',
									'property' => 'color',
									'selector' => '.site-header--transparent, .site-header--transparent .nav--main > li > a',
								),
								array(
									'property' => 'color',
									'selector' => '.navigation-toggle, .navigation-toggle:hover',
								),
							),
						),
					),
				),

				// Content
				'site_content' => array(
					'title'   => esc_html__( 'Content', 'pile' ),
					'options' => array(
						'content_background_color' => array(
							'type'    => 'color',
							'label'   => esc_html__( 'Content Background', 'pile' ),
							'live'    => true,
							'default' => '#ffffff',
							'css'     => array(
								array(
									'property' => 'background-color',
									'selector' => '.site-content',
								),
							),
						),

						'container_image_pattern' => array(
							'type'   => 'custom_background',
							'label'  => esc_html__( 'Header Background', 'pile' ),
							'desc'   => esc_html__( 'Container background with image.', 'pile' ),
							'output' => array( '.site-content' ),
						),
					),
				),

				'footer' => array(
					'title'   => esc_html__( 'Footer', 'pile' ),
					'options' => array(
						'footer_background'    => array(
							'type'    => 'color',
							'label'   => esc_html__( 'Background', 'pile' ),
							'live'    => true,
							'default' => '#FFFFFF',
							'css'     => array(
								array(
									'property' => 'background-color',
									'selector' => '.site-footer',
								),
							),
						),
						'footer_text_color'    => array(
							'type'    => 'color',
							'label'   => esc_html__( 'Text Color', 'pile' ),
							'live'    => true,
							'default' => '#262528',
							'css'     => array(
								array(
									'property' => 'color',
									'selector' => '.site-footer',
								),
							),
						),
						'footer_credits_color' => array(
							'type'    => 'color',
							'label'   => esc_html__( 'Credits Color', 'pile' ),
							'live'    => true,
							'default' => '#262528',
							'css'     => array(
								array(
									'property' => 'color',
									'selector' => '.copyright-area',
								),
							),
						),
					)
				),

				// Portfolio
				'site_protfolio' => array(
					'title'   => '&#x1f5fb; &nbsp;' . esc_html__( 'Portfolio Archive', 'pile' ),
					'options' => array(
						'portfolio_item_color'     => array(
							'type'    => 'color',
							'label'   => esc_html__( 'Items Color', 'pile' ),
							//'desc'   => __( 'Use the color picker to change the main color of the site to match your brand color.', 'pile' ),
							'live'    => true,
							'default' => '#FFFFFF',
							'css'     => array(
								array(
									'property' => 'color',
									'selector' => '.pile-item-content',
								)
							),
						),
						'portfolio_item_background'     => array(
							'type'    => 'color',
							'label'   => esc_html__( 'Items Background Color', 'pile' ),
							//'desc'   => __( 'Use the color picker to change the main color of the site to match your brand color.', 'pile' ),
							'live'    => true,
							'default' => '#000000',
							'css'     => array(
								array(
									'property' => 'background',
									'selector' => '.pile-item-bg',
								)
							),
						),
						'portfolio_background_opacity'       => array(
							'type'        => 'range',
							'label'       => esc_html__( 'Items Background Opacity', 'pile' ),
							'live'        => true,
							'default'     => 0.5,
							'input_attrs' => array(
								'min'          => 0,
								'max'          => 1,
								'step'         => 0.1,
								'data-preview' => true,
							),
							'css'         => array(
								array(
									'property' => 'opacity',
									'selector' => '.pile-item-bg.to-animate',
									'unit'     => '',
								),
							),
						),
						'portfolio_border_size'       => array(
							'type'        => 'range',
							'label'       => esc_html__( 'Items Border Size', 'pile' ),
							'live'        => false,
							'default'     => 14,
							'input_attrs' => array(
								'min'          => 0,
								'max'          => 300,
								'step'         => 1,
								'data-preview' => true,
							),
							'css'         => array(
								array(
									'property' => 'font-size',
									'selector' => '.pile .pile-item-border',
									'unit'     => 'px',
								),
							),
						),
					),
				),
			),
		);

		$config['sections'] = array(

			// 'portfolio'      => array(
			// 	'title'    => '&#x1f5fb; &nbsp;&nbsp;' . esc_html__( 'Portfolio', 'pile' ),
			// 	'priority' => 5,
			// 	'options'  => array(

			// 	),
			// ),


			'blog' => array(
				'title'    => '&#x1f4d4; &nbsp;&nbsp;' . esc_html__( 'Blog', 'pile' ),
				'priority' => 6,
				'options'  => array(
					'this_divider_8874320137' => array(
						'type' => 'html',
						'html' => '<span class="separator label large">' . esc_html__( 'Single Post', 'pile' ) . '</span>',
					),

					'this_divider_37986312' => array(
						'type' => 'html',
						'html' => '<span class="separator label">' . esc_html__( 'Sharing Buttons', 'pile' ) . '</span>',
					),

					'blog_single_show_share_links' => array(
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Show Share Buttons', 'pile' ),
						// 'desc'    => esc_html__( 'Do you want to show share icon links for your articles?', 'pile' ),
						'default' => true,
					),

					'this_divider_812329384'  => array(
						'type' => 'html',
						'html' => '<span class="separator label">' . esc_html__( 'Comments', 'pile' ) . '</span>',
					),
					'comments_show_avatar'    => array(
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Show Comments Avatars', 'pile' ),
						// 'desc'    => esc_html__( 'Do you want to show avatars in comments?', 'pile' ),
						'default' => false,
					),
					'comments_show_numbering' => array(
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Show Comments Numbers', 'pile' ),
						// 'desc'    => esc_html__( 'Do you want to show numbers beside each comment?', 'pile' ),
						'default' => true,
					),

					'this_divider_5343879' => array(
						'type' => 'html',
						'html' => '<span class="separator label large">' . esc_html__( 'Blog Archive', 'pile' ) . '</span>',
					),

					'blog_read_more_text' => array(
						'type'    => 'text',
						'label'   => esc_html__( 'Read More Text', 'pile' ),
						'default' => esc_html__( 'Read More', 'pile' ),
					),

					'blog_excerpt_more_text' => array(
						'type'    => 'text',
						'label'   => esc_html__( 'Excerpt "More" Text', 'pile' ),
						'desc'    => esc_html__( 'Change the default [...] with something else.', 'pile' ),
						'default' => '..',
					),
					'blog_excerpt_length'    => array(
						'type'    => 'text',
						'label'   => esc_html__( 'Excerpt Length', 'pile' ),
						'desc'    => esc_html__( 'Set the number of characters for posts excerpt.', 'pile' ),
						'default' => '105',
					),
					'blog_show_date'         => array(
						'type'    => 'text',
						'label'   => esc_html__( 'Date', 'pile' ),
						'desc'    => esc_html__( 'Display the post publish date.', 'pile' ),
						'default' => 1,
					),
				),
			),
		);

		/**
		 * FONTS - This section will handle different elements fonts (eg. headings, body)
		 */
		$config['panels']['typography_panel'] = array(
			'title'    => '&#x1f4dd; &nbsp;&nbsp;' . esc_html__( 'Fonts', 'pile' ),
			'priority'    => 4,
			'sections' => array(

				'headers_typography_section' => array(
					'title'   => esc_html__( 'Headings', 'pile' ),
					'options' => array(
						'google_titles_font'       => array(
							'type'        => 'typography',
							'label'       => esc_html__( 'Headings', 'pile' ),
							'desc'        => esc_html__( 'Font for titles and headings.', 'pile' ),
							'selector'    => '.alpha, h1, h2, h3, h4, h5, h6, blockquote cite, .dropcap, .nocomments, .widget .widget__title, input[type="submit"], .nav-button, .share-container h4, .article__more, .mfp-title .title',
							'recommended' => $recommended_headings_fonts,
							'default' 	  => array('Trueno', '700'),
							'variants'	  => array('400' , '500', '700'),
						),
					),
				),

				'descriptions_typography_section' => array(
					'title'   => esc_html__( 'Descriptions', 'pile' ),
					'options' => array(
						'google_descriptions_font' => array(
							'type'        => 'typography',
							'label'       => esc_html__( 'Descriptions', 'pile' ),
							'desc'        => esc_html__( 'Font for descriptions and subheadings.', 'pile' ),
							'selector'    => 'h1 em, h2 em, .tabs__nav em, h3 em, h4 em, h5 em, h6 em, blockquote, .entry-time, .article-archive--quote, .wpcf7, .desc, .comment-number, .comment-number--dark, .comment-reply-title:before, .add-comment .add-comment__button, .comment__author-name, .comment__timestamp, .comment__links',
							'recommended' => $recommended_desc_fonts,
							'load_all_weights' => true,
						),
					),
				),

				'nav_typography_section' => array(
					'title'   => esc_html__( 'Navigation Text', 'pile' ),
					'options' => array(
						'google_nav_font'     => array(
							'type'        => 'typography',
							'label'       => esc_html__( 'Navigation Font', 'pile' ),
							'default' 	  => array('Trueno', '500'),
							'recommended' => $recommended_body_fonts,
							'variants'	  => array('400' , '500', '700'),
							'selector'    => '.nav--main, .meta, .pile-item-meta, .pile-item-link',
						),
						'nav_font-size'       => array(
							'type'        => 'range',
							'label'       => esc_html__( 'Font Size', 'pile' ),
							'live'        => true,
							'default'     => 13,
							'input_attrs' => array(
								'min'          => 8,
								'max'          => 30,
								'step'         => 1,
								'data-preview' => true,
							),
							'css'         => array(
								array(
									'property' => 'font-size',
									'selector' => '.nav--main a',
									'unit'     => 'px',
								),
							),
						),
						'nav_letter-spacing'  => array(
							'type'        => 'range',
							'label'       => esc_html__( 'Letter Spacing', 'pile' ),
							'live'        => true,
							'default'     => 2,
							'input_attrs' => array(
								'min'          => - 5,
								'max'          => 20,
								'step'         => 1,
								'data-preview' => true,
							),
							'css'         => array(
								array(
									'property' => 'letter-spacing',
									'selector' => '.nav--main a',
									'unit'     => 'px',
								),
							),
						),
						'nav_text-transform'  => array(
							'type'    => 'select',
							'label'   => esc_html__( 'Text Transform', 'pile' ),
							'choices' => array(
								'none'       => esc_html__( 'None', 'pile' ),
								'capitalize' => esc_html__( 'Capitalize', 'pile' ),
								'uppercase'  => esc_html__( 'Uppercase', 'pile' ),
								'lowercase'  => esc_html__( 'Lowercase', 'pile' ),
							),
							'default' => 'uppercase',
							'css'     => array(
								array(
									'property' => 'text-transform',
									'selector' => '.nav--main a',
								),
							),
						),
						// 'nav_text-decoration' => array(
						// 	'type'    => 'select',
						// 	'label'   => __( 'Text Decoration', 'pile' ),
						// 	'choices' => array(
						// 		'none'      => 'None',
						// 		'underline' => 'Underline',
						// 		'overline'  => 'Overline',
						// 	),
						// 	'default' => 'none',
						// 	'css'     => array(
						// 		array(
						// 			'property' => 'text-decoration',
						// 			'selector' => '.nav--main a',
						// 		)
						// 	)
						// ),
					)
				),

				'content_typography_section' => array(
					'title'   => esc_html__( 'Body Text', 'pile' ),
					'options' => array(
						'google_body_font' => array(
							'type'             => 'typography',
							'label'            => esc_html__( 'Body Font', 'pile' ),
							'desc'             => esc_html__( 'Font for content and widget text.', 'pile' ),
//								'default' => 'Cabin',
							'recommended'      => $recommended_body_fonts,
							'selector'         => 'body',
							'load_all_weights' => true,
							'default' 	  	   => array('Trueno'),
						),
						'body-font-size'   => array(
							'type'        => 'range',
							'label'       => esc_html__( 'Font Size', 'pile' ),
							'live'        => true,
							'default'     => 15,
							'input_attrs' => array(
								'min'          => 8,
								'max'          => 72,
								'step'         => 1,
								'data-preview' => true,
							),
							'css'         => array(
								array(
									'property' => 'font-size',
									'selector' => 'body, .pile-item',
									'unit'     => 'px',
								)
							)
						),
						'body-line-height' => array(
							'type'        => 'range',
							'label'       => esc_html__( 'Line Height', 'pile' ),
							'live'        => true,
							'default'     => '1.8',
							'input_attrs' => array(
								'min'          => 0,
								'max'          => 3,
								'step'         => 0.1,
								'data-preview' => true,
							),
							'css'         => array(
								array(
									'property' => 'line-height',
									'selector' => 'body',
								),
							),
						),
					),
				),
			),
		);


		$config['panels']['theme_options'] = array(
			'title'    => '&#x1f506; &nbsp;&nbsp;' . esc_html__( 'Theme Options', 'pile' ),
			'priority' => 1,
			'sections' => array(
				'general' => array(
					'title'   => esc_html__( 'General', 'pile' ),
					'options' => array(
						'main_logo_dark'           => array(
							'type'  => 'media',
							'label' => esc_html__( 'Logo', 'pile' ),
						),
						'main_logo_light'          => array(
							'type'  => 'media',
							'label' => esc_html__( 'Logo while on Transparent Hero Area', 'pile' ),
						),
						'logo_progress'          => array(
							'type'  => 'media',
							'label' => esc_html__( 'Logo while on Progress Bar', 'pile' ),
						),
						'divider_title_5347719831' => array(
							'type' => 'html',
							'html' => '<span class="separator label">' . esc_html__( 'Ajax Loading', 'pile' ) . '</span>',
						),
						'use_ajax_loading'         => array(
							'type'    => 'checkbox',
							'label'   => esc_html__( 'Enable dynamic page content loading using AJAX.', 'pile' ),
							'default' => 1,
						),

						'divider_title_531237062'  => array(
							'type' => 'html',
							'html' => '<span class="separator label">' . esc_html__( 'Right-Click Protection', 'pile' ) . '</span>',
						),
						'enable_copyright_overlay' => array(
							'type'    => 'checkbox',
							'label'   => esc_html__( 'Prevent right-click saving for images', 'pile' ),
							'default' => 0,
						),
						'copyright_overlay_text'   => array(
							'type'    => 'text',
							'desc'    => esc_html__( 'The tooltip message that appears when click.', 'pile' ),
							'default' => esc_html__( 'This content is &copy; 2016 Pile | All rights reserved.', 'pile' ),
							//'required' => array( 'enable_copyright_overlay', '=', 1 ),
						),

						'divider_title_534793921'  => array(
							'type' => 'html',
							'html' => '<span class="separator label large">' . esc_html__( 'Footer', 'pile' ) . '</span>',
						),
						'copyright_text' => array(
							'type'              => 'textarea',
							'label'             => esc_html__( 'Copyright Text', 'pile' ),
							'default'           => __( '2016 &copy; Handcrafted with love by <a href="#">PixelGrade</a> Team', 'pile' ),
							'sanitize_callback' => 'wp_kses_post',
							'live'              => array( '.copyright-text' ),
						),
						'google_maps_api_key' => array(
							'type'    => 'text',
							'label'   => esc_html__( 'Google Maps API key', 'pile' ),
							'default' => '',
							'desc'    => sprintf(
								'<p>%s </p> <a href="//developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key" target="_blank">%s</a>',
								esc_html__( 'To use the Google Maps library you must authenticate your application with an API key.', 'pile' ),
								esc_html__( 'Get a Key', 'pile' )
							)
						)
					),
				),

				'hero_area' => array(
					'title'   => esc_html__( 'Hero Area', 'pile' ),
					'options' => array(
						'hero_scroll_arrow' => array(
							'type'    => 'checkbox',
							'label'   => esc_html__( 'Show Scroll Down Arrows', 'pile' ),
							'default' => 1,
						),

						// 'slideshow_arrows_style' => array(
						// 	'type'    => 'select',
						// 	'label'   => __( 'Slideshow Arrows Style', 'pile' ),
						// 	'desc'    => __( 'Select which type of arrows you want on page headers.', 'pile' ),
						// 	'choices' => array(
						// 		'static' => 'Always Show',
						// 		'hover'  => 'On Hover'
						// 	),
						// 	'default' => 'hover',
						// ),
					),
				),

				'share_settings' => array(
					'title'   => esc_html__( 'Sharing', 'pile' ),
					'options' => array(
						'share_buttons_settings'                => array(
							'type'    => 'text',
							'default' => 'preferred,preferred,preferred,preferred,more',
							'label'   => esc_html__( 'Share Services', 'pile' ),
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
							'html' => '<p><span class="separator label large">' . esc_html__( 'Advanced Options', 'pile' ) . '</span></p>'
						),
						'share_buttons_enable_tracking'         => array(
							'type'    => 'checkbox',
							'label'   => esc_html__( 'Enable AddThis Sharing Analytics', 'pile' ),
							'default' => false,
						),
						'share_buttons_enable_addthis_tracking' => array(
							'type'     => 'checkbox',
							'label'    => esc_html__( 'Enable AddThis Tracking', 'pile' ),
							'default'  => false,
							// 'required' => array( 'share_buttons_enable_tracking', '=', 1 ),
						),

						'share_buttons_addthis_username' => array(
							'type'    => 'text',
							'label'   => esc_html__( 'AddThis Username', 'pile' ),
							'desc'    => esc_html__( 'Enter here your AddThis username so you will receive analytics data.', 'pile' ),
							'default' => '',
							//'required' => array( 'share_buttons_enable_addthis_tracking', '=', 1 ),
						),

						'share_buttons_enable_ga_tracking' => array(
							'type'     => 'checkbox',
							'label'    => esc_html__( 'AddThis Google Analytics Tracking', 'pile' ),
							'desc'     => __( 'Read more on <a href="http://bit.ly/1kxPg7K">Integrating with Google Analytics</a> article.', 'pile' ),
							'default'  => false,
							// 'required' => array( 'share_buttons_enable_tracking', '=', 1 ),
						),

						'share_buttons_ga_id' => array(
							'type'    => 'text',
							'label'   => esc_html__( 'GA Property ID', 'pile' ),
							'desc'    => esc_html__( 'Enter here your GA property ID (generally a serial number of the form UA-xxxxxx-x).', 'pile' ),
							'default' => '',
							//'required' => array( 'share_buttons_enable_ga_tracking', '=', 1 ),
						),

						'share_buttons_enable_ga_social_tracking' => array(
							'type'     => 'checkbox',
							'label'    => esc_html__( 'GA Social Tracking', 'pile' ),
							'desc'     => __( 'If you are using the latest version of GA code, you can take advantage of Google\'s new <a href="http://bit.ly/1iVvkbk">social interaction analytics</a>.', 'pile' ),
							'default'  => false,
							// 'required' => array( 'share_buttons_enable_ga_tracking', '=', 1 ),
						),
					),
				),
				'custom_js'   => array(
					'title'   => esc_html__( 'Custom JavaScript', 'pile' ),
					'priority' => 999,
					'options' => array(
						'custom_js'        => array(
							'type'        => 'ace_editor',
							'label'       => esc_html__( 'Header', 'pile' ),
							'desc'        => esc_html__( 'Easily add Custom Javascript code. This code will be loaded in the <head> section.', 'pile' ),
							'editor_type' => 'javascript',
						),
						'google_analytics' => array(
							'type'        => 'ace_editor',
							'label'       => esc_html__( 'Footer', 'pile' ),
							'desc'        => esc_html__( 'You can paste here your Google Analytics tracking code (or for what matters any tracking code) and we will put it on every page.', 'pile' ),
							'editor_type' => 'javascript',
						),
					),
				),


				'import_demo_data' => array(
					'title'    => __( 'Demo Data', 'pile' ),
					'description' => esc_html__( 'If you would like to have a "ready to go" website as the Pile\'s demo page here is the button', 'pile' ),
					'priority' => 999999,
					'options'  => array(
						'import_demodata_button' => array(
							'title' => 'Import',
							'type'  => 'html',
							'html'  => '<input type="hidden" name="wpGrade-nonce-import-posts-pages" value="' . wp_create_nonce( 'wpGrade_nonce_import_demo_posts_pages' ) . '" />
										<input type="hidden" name="wpGrade-nonce-import-theme-options" value="' . wp_create_nonce( 'wpGrade_nonce_import_demo_theme_options' ) . '" />
										<input type="hidden" name="wpGrade-nonce-import-widgets" value="' . wp_create_nonce( 'wpGrade_nonce_import_demo_widgets' ) . '" />
										<input type="hidden" name="wpGrade_import_ajax_url" value="' . admin_url( "admin-ajax.php" ) . '" />' .
							           '<span class="description customize-control-description">' . esc_html__( '(Note: We cannot serve you the original images due the ', 'pile' ) . '<strong>&copy;</strong>)</span></br>' .
							           '<a href="#" class="button button-primary" id="wpGrade_import_demodata_button" style="width: 70%; text-align: center; padding: 10px; display: inline-block; height: auto;  margin: 0 15% 10% 15%;">
											' . __( 'Import demo data', 'pile' ) . '
										</a>

										<div class="wpGrade-loading-wrap hidden">
											<span class="wpGrade-loading wpGrade-import-loading"></span>
											<div class="wpGrade-import-wait">' .
							           esc_html__( 'Please wait a few minutes (between 1 and 3 minutes usually, but depending on your hosting it can take longer) and ', 'pile' ) .
							           '<strong>' . esc_html__( 'don\'t reload the page', 'pile' ) . '</strong>.' .
							           esc_html__( 'You will be notified as soon as the import has finished!', 'pile' ) . '
											</div>
										</div>

										<div class="wpGrade-import-results hidden"></div>
										<div class="hr"><div class="inner"><span>&nbsp;</span></div></div>'
						),
					),
				),
			),
		);

		/**
		 * Check if WooCommerce is active
		 **/
		if ( class_exists( 'WooCommerce' ) ) {
			$config['panels']['theme_options']['sections']['woocommerce'] = array(

			);

			$config['panels']['woocommerce'] = array(
				'title'   => '&#x1F6CD; &nbsp;&nbsp;' . esc_html__( 'WooCommerce', 'pile' ),
				'sections' => array(

					'woocommerce_options' => array(
						'title'   => '&#x1f506; &nbsp;&nbsp;' . esc_html__( 'Options', 'pile' ),
						'options' => array(
							'divider_title_962836192' => array(
								'type' => 'html',
								'html' => '<span class="separator label">' . esc_html__( 'WooCommerce Support', 'pile' ) . '</span>'
							),
							'enable_woocommerce_support' => array(
								'type'    => 'checkbox',
								'label'   => esc_html__( 'Load WooCommerce CSS and JS files.', 'pile' ),
								'default' => 1
							),
							'show_cart_menu' => array(
								'type'    => 'checkbox',
								'label'   => esc_html__( 'Show cart menu in main navigation.', 'pile' ),
								'default' => 1
							),
						),
					),

					// Product Archives
					'products_layouts_section' => array(
						'title'   => '&#x1f5fb; &nbsp;&nbsp;' . esc_html__( 'Product Archive', 'pile' ),
						'options' => array(
							'products_content_width' => array(
								'type'        => 'range',
								'label'       => esc_html__( 'Archive Container Width', 'pile' ),
								'live'        => true,
								'default'     => 1200,
								'input_attrs' => array(
									'min'          => 600,
									'max'          => 2700,
									'step'         => 1,
									'data-preview' => true,
								),
								'css'         => array(
									array(
										'property' => 'max-width',
										'selector' => '.post-type-archive-product .content-width',
										'unit'     => 'px',
									),
								),
							),
							'products_archive_padding' => array(
								'type'        	=> 'range',
								'label'        	=> esc_html__( 'Spacing Around the Grid Container', 'pile' ),
								'default'     	=> 48,
								'live' 			=> true,
								'input_attrs' 	=> array(
									'min'          => 0,
									'max'          => 120,
									'step'         => 6,
									'data-preview' => true,
								),
								'css'         => array(
									array(
										'property' => 'padding-left',
										'selector' => '.post-type-archive-product .content-width.wrapper',
										'unit'     => 'px',
									),
									array(
										'property' => 'padding-right',
										'selector' => '.post-type-archive-product .content-width.wrapper',
										'unit'     => 'px',
									),
								),
							),
							'products_archive_thumbnails_aspect_ratio' => array(
								'type'    => 'select',
								'label'   => esc_html__( 'Items Aspect Ratio', 'pile' ),
								'choices' => array(
									'original' => esc_html__( 'Original', 'pile' ),
									'square' => esc_html__( 'Square 1:1', 'pile' ),
									'landscape' => esc_html__( 'Landscape 4:3', 'pile' ),
									'portrait' => esc_html__( 'Portrait 3:4', 'pile' ),
								),
								'default' => 'original',
							),
							'products_pile_horizontal_spacing' => array(
								'type'        => 'range',
								'label'       => esc_html__( 'Items Horizontal Spacing', 'pile' ),
								'default'     => 42,
								'live'        => false,
								'input_attrs' => array(
									'min'          => -240,
									'max'          => 120,
									'step'         => 6,
									'data-preview' => true,
								),
								'css'         => array(
									array(
										'selector' => '.post-type-archive-product .pile--portfolio-archive',
										'property' => '',
										'callback_filter' => 'pile_horizontal_spacing_cb',
										'unit'     => 'px',
									),
								),
							),
							'products_pile_vertical_spacing' => array(
								'type'        => 'range',
								'label'       => esc_html__( 'Items Vertical Spacing', 'pile' ),
								'default'     => 42,
								'live'        => true,
								'input_attrs' => array(
									'min'          => -240,
									'max'          => 120,
									'step'         => 6,
									'data-preview' => true,
								),
								'css'         => array(
									array(
										'property' => 'margin-bottom',
										'selector' => '.post-type-archive-product .pile-item',
										'unit'     => 'px',
									),
									array(
										'property' => 'margin-top',
										'selector' => '.post-type-archive-product .pile',
										'unit'     => 'px',
									),
								),
							),
							'this_divider_2937812371' => array(
								'type' => 'html',
								'html' => '<span class="separator label large">' . esc_html__( '3D Grid Options', 'pile' ) . '</span>',
							),
							'products_pile_3d_effect' => array(
								'type'    => 'checkbox',
								'label'   => esc_html__( 'Enable 3D Grid', 'pile' ),
								'default' => 1,
							),
							'products_pile_3d_target' => array(
								'type'    => 'select',
								'label'   => esc_html__( 'Apply the rules on', 'pile' ),
								'choices' => array(
									'item' => esc_html__( 'Individual items', 'pile' ),
									'column' => esc_html__( 'Columns', 'pile' ),
								),
								'default' => 'item',
							),
							'products_pile_3d_target_rule' => array(
								'type'    => 'select',
								'label'   => '',
								'choices' => array(
									'odd' => esc_html__( 'Odd', 'pile' ),
									'even' => esc_html__( 'Even', 'pile' ),
								),
								'default' => 'odd',
							),
							'products_parallax_amount' => array(
								'type'        => 'range',
								'label'       => esc_html__( 'Parallax Scrolling Range', 'pile' ),
								'desc'        => esc_html__( 'Set the distance traveled by items on scroll.', 'pile' ),
								'default'     => 42,
								'input_attrs' => array(
									'min'          => 0,
									'max'          => 120,
									'step'         => 6,
									'data-preview' => true,
								),
							),
							'this_divider_88623071235' => array(
								'type' => 'html',
								'html' => '<span class="separator label large">' . esc_html__( 'Number of columns', 'pile' ) . '</span>',
							),
							'products_pile_large_columns' => array(
								'type'    => 'select',
								'label'   => esc_html__( 'Big screens', 'pile' ),
								'choices' => array(
									'1' => esc_html( sprintf( _n( '%s column', '%s columns', 1, 'pile' ), 1 ) ),
									'2' => esc_html( sprintf( _n( '%s column', '%s columns', 2, 'pile' ), 2 ) ),
									'3' => esc_html( sprintf( _n( '%s column', '%s columns', 3, 'pile' ), 3 ) ),
									'4' => esc_html( sprintf( _n( '%s column', '%s columns', 4, 'pile' ), 4 ) ),
									'5' => esc_html( sprintf( _n( '%s column', '%s columns', 5, 'pile' ), 5 ) ),
									'6' => esc_html( sprintf( _n( '%s column', '%s columns', 6, 'pile' ), 6 ) ),
								),
								'default' => '3',
							),

							'products_pile_medium_columns' => array(
								'type'    => 'select',
								'label'   => esc_html__( 'Medium screens', 'pile' ),
								'choices' => array(
									'1' => esc_html( sprintf( _n( '%s column', '%s columns', 1, 'pile' ), 1 ) ),
									'2' => esc_html( sprintf( _n( '%s column', '%s columns', 2, 'pile' ), 2 ) ),
									'3' => esc_html( sprintf( _n( '%s column', '%s columns', 3, 'pile' ), 3 ) ),
									'4' => esc_html( sprintf( _n( '%s column', '%s columns', 4, 'pile' ), 4 ) ),
									'5' => esc_html( sprintf( _n( '%s column', '%s columns', 5, 'pile' ), 5 ) ),
								),
								'default' => '2',
							),
							'products_pile_small_columns' => array(
								'type'    => 'select',
								'label'   => esc_html__( 'Small screens', 'pile' ),
								'choices' => array(
									'1' => esc_html( sprintf( _n( '%s column', '%s columns', 1, 'pile' ), 1 ) ),
									'2' => esc_html( sprintf( _n( '%s column', '%s columns', 2, 'pile' ), 2 ) ),
									'3' => esc_html( sprintf( _n( '%s column', '%s columns', 3, 'pile' ), 3 ) ),
								),
								'default' => '1',
							),
						),
					),

					// Product Single
					'product_layouts_section'    => array(
						'title'   => '&#x1f5fb; &nbsp;&nbsp;' . esc_html__( 'Single Product', 'pile' ),
						'options' => array(
							'product_content_width' => array(
								'type'        => 'range',
								'label'       => esc_html__( 'Product Container Width', 'pile' ),
								'live'        => true,
								'default'     => 1000,
								'input_attrs' => array(
									'min'          => 600,
									'max'          => 2700,
									'step'         => 1,
									'data-preview' => true,
								),
								'css'         => array(
									array(
										'property' => 'max-width',
										'selector' => '.single-product .content-width',
										'unit'     => 'px',
									),
								),
							),
							'product_single_padding' => array(
								'type'        => 'range',
								'label'        => esc_html__( 'Spacing Around the Container', 'pile' ),
								'default'     => 48,
								'live' => true,
								'input_attrs' => array(
									'min'          => 0,
									'max'          => 120,
									'step'         => 6,
									'data-preview' => true,
								),
								'css'         => array(
									array(
										'media'    => 'only screen and (min-width: 699px)',
										'property' => 'padding-left',
										'selector' => '.single-product .site-content.wrapper',
										'unit'     => 'px',
									),
									array(
										'media'    => 'only screen and (min-width: 699px) ',
										'property' => 'padding-right',
										'selector' => '.single-product .site-content.wrapper',
										'unit'     => 'px',
									),
								),
							),
							'this_divider_8076273531' => array(
								'type' => 'html',
								'html' => '<span class="separator label large">' . esc_html__( 'Product Grid Options', 'pile' ) . '</span>',
							),
							'pile_single_product_horizontal_spacing' => array(
								'type'        => 'range',
								'label'       => esc_html__( 'Items Horizontal Spacing', 'pile' ),
								'live'        => true,
								'default'     => 60,
								'input_attrs' => array(
									'min'          => 0,
									'max'          => 120,
									'step'         => 6,
									'data-preview' => true,
								),
								'css'         => array(
									array(
										'property' => 'padding-left',
										'selector' => '.single-product .pile-item--single',
										'unit'     => 'px',
									),
									array(
										'property'        => 'margin-left',
										'selector'        => '.single-product .pile--single',
										'callback_filter' => 'pile_range_negative_value',
										'unit'            => 'px',
									),
								),
							),

							'pile_single_product_vertical_spacing' => array(
								'type'        => 'range',
								'label'       => esc_html__( 'Items Vertical Spacing', 'pile' ),
								'live'        => false,
								'default'     => 60,
								'input_attrs' => array(
									'min'          => 0,
									'max'          => 120,
									'step'         => 6,
									'data-preview' => true,
								),
								'css'         => array(
									array(
										'property' 			=> 'dummy',
										'selector' 			=> '.single-product',
										'unit'     			=> 'px',
										'callback_filter' 	=> 'pile_position_values',
									)
								),
							),
							'product_enquiry_text' => array(
								'type'              => 'textarea',
								'label'             => esc_html__( 'Product Enquiry Text', 'pile' ),
								'description'       => esc_html__( 'Text to be displayed under the product summary for enquiry purposes (HTML Allowed)', 'pile' ),
								'default'           => __( 'Have a question? <a href="mailto:hello@pixelgrade.com">Just ask us</a>', 'pile' ),
								'sanitize_callback' => 'wp_kses_post',
								'live'              => array( '.copyright-text' ),
							),
							'this_divider_1238010737682'                 => array(
								'type' => 'html',
								'html' => '<span class="separator label">' . esc_html__( 'Sharing Buttons', 'border' ) . '</span>',
							),
							'product_single_show_share_links' => array(
								'type'    => 'checkbox',
								'label'   => esc_html__( 'Show Share Buttons', 'pile' ),
								'default' => 0,
							),
						),
					),
				),
			);

		}

		return $config;
	}

}
add_filter( 'customify_filter_fields', 'add_customify_pile_options', 11 );

function pile_field_with_05rgba_value( $value, $selector, $property, $unit ) {
	$rgb    = implode( ",", pile_hex2rgb( $value ) );
	$output = $selector . '{
		' . $property . ': rgba(' . $rgb . ", 0.5);\n" .
	          "}\n";

	return $output;
}

function pile_range_negative_value( $value, $selector, $property, $unit ) {

	$output = $selector . '{
		' . $property . ': -' . $value . '' . $unit . ";\n" .
	          "}\n";

	return $output;
}

function pile_range_negative_value_customizer_preview() { ?>
	<script>
		function pile_range_negative_value( $value, $selector, $property, $unit ) {
			var css = $selector + ' { ' + $property + ': -' + $value + $unit + '; }';
			var style = document.getElementById('pile_range_negative_style_tag'),
				head = document.head || document.getElementsByTagName('head')[0];

			if ( style !== null ) {
				style.innerHTML = css;
			} else {
				style = document.createElement("style");
				style.setAttribute('id', 'pile_range_negative_style_tag');

				style.type = 'text/css';
				if (style.styleSheet){
					style.styleSheet.cssText = css;
				} else {
					style.appendChild(document.createTextNode(css));
				}

				head.appendChild(style);
			}
		}
	</script>
<?php }

function pile_position_values( $value, $selector, $property, $unit ) {
	$output =
			$selector . " .pile--single { margin-top: " . $value . $unit . "; }
		" . $selector . " .pile-item--single { margin-bottom: " . $value . $unit . "; }
		" . $selector . " .top-2 { margin-top: -" . $value . $unit . "; }
		" . $selector . " .top-3 { margin-top: -" . 2*$value . $unit . "; }
		" . $selector . " .left-2 { left: -" . $value . $unit . "; }
		" . $selector . " .left-3 { left: -" . 2*$value . $unit . "; }
		" . $selector . " .bottom-2 { margin-bottom: 0; }
		" . $selector . " .bottom-3 { margin-bottom: -" . $value . $unit . "; }
		" . $selector . " .right-2 { left: " . $value . $unit . "; }
		" . $selector . " .right-3 { left: " . 2*$value . $unit . "; }";

	return $output;
}


function pile_horizontal_spacing_cb( $value, $selector, $property, $unit ) {
	if ( $value > 0 ) {
		$output = '
		@media only screen and (min-width: 699px) {
			' . $selector . ' {
				margin-left: ' . -1 * $value . $unit . '
			}

			' . $selector . ' .pile-item,
			' . $selector . ' .js-3d .pile-item-even-spacing,
			' . $selector . ' .pile-item-portrait-spacing {
				padding-left: ' . $value . $unit . '
			}

			' . $selector . ' .js-3d .pile-item-even-spacing,
			' . $selector . ' .pile-item-portrait-spacing {
				padding-right: ' . $value . $unit . '
			}
		}
		';
	} else {
		$output = '
		@media only screen and (min-width: 699px) {
			' . $selector . ' {
				margin-left: ' . 2.5*$value . $unit . ';
				margin-right: ' . 2.5*$value . $unit . ';
				padding-left: ' . -3*$value . $unit . ';
				padding-right: ' . -3*$value . $unit . ';
			}
			' . $selector . ' .pile-item-negative-spacing {
				margin-left: ' . $value/2 . $unit . ';
				margin-right: ' . $value/2 . $unit . ';
			}
		}
		';
	}
	return $output;
}
function pile_horizontal_spacing_customizer_preview() { ?>
	<script>
		function pile_horizontal_spacing_cb( $value, $selector, $property, $unit ) {
			var css = '';
			if ( $value > 0 ) {
				css = "\
				@media only screen and (min-width: 699px) { \
					" + $selector + " .pile { \
						margin-left: " + (-1 * $value) + $unit + "; \
						margin-right: 0; \
						padding-right: 0; \
						padding-left: 0; \
					} \
					" + $selector + " .pile-item, \
					" + $selector + " .js-3d .pile-item-even-spacing, \
					" + $selector + " .pile-item-portrait-spacing { \
						padding-left: " + $value + $unit + "; \
						padding-right: 0; \
					} \
					" + $selector + " .pile-item-negative-spacing {\
						margin-left: 0; \
						margin-right: 0; \
					}\
					" + $selector + " .js-3d .pile-item-even-spacing, \
					" + $selector + " .pile-item-portrait-spacing { \
						padding-right: " + $value + $unit + " \
					} \
				} ";
			} else {
				css = "\
				@media only screen and (min-width: 699px) { \
					" + $selector + " .pile { \
						margin-left: " + (2.5*$value) + $unit + "; \
						margin-right: " + (2.5*$value) + $unit + "; \
						padding-left: " + (-3*$value) + $unit + "; \
						padding-right: " + (-3*$value) + $unit + "; \
					} \
					" + $selector + " .pile-item { \
						padding-left: 0; \
						padding-right: 0; \
					} \
					" + $selector + " .pile-item-negative-spacing { \
						margin-left: " + ($value/2) + $unit + "; \
						margin-right: " + ($value/2) + $unit + "; \
					} \
				}";
			}

			var style = document.getElementById('horizontal_spacing_style_tag'),
				head = document.head || document.getElementsByTagName('head')[0];

			if ( style !== null ) {
				style.innerHTML = css;
			} else {
				style = document.createElement("style");
				style.setAttribute('id', 'horizontal_spacing_style_tag');

				style.type = 'text/css';
				if (style.styleSheet){
					style.styleSheet.cssText = css;
				} else {
					style.appendChild(document.createTextNode(css));
				}

				head.appendChild(style);
			}
		}
	</script>
	<?php
}
//add_action( 'customize_preview_init', 'pile_horizontal_spacing_customizer_preview' );
add_action( 'customize_preview_init', 'pile_range_negative_value_customizer_preview' );
/**
 * With the new wp 43 version we've made some big changes in customizer, so we really need a first time save
 * for the old options to work in the new customizer
 */
function convert_pile_for_wp_43_once() {
	if ( ! is_admin() || ! function_exists( 'is_plugin_active' ) || ! is_plugin_active( 'customify/customify.php' ) || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
		return;
	}

	$is_not_old = get_option( 'wpgrade_converted_to_43' );

	$this_wp_version = get_bloginfo( 'version' );
	$this_wp_version = explode( '.', $this_wp_version );
	$is_wp43         = false;
	if ( ! $is_not_old && (int) $this_wp_version[0] >= 4 && (int) $this_wp_version[1] >= 3 ) {
		$is_wp43 = true;
		update_option( 'wpgrade_converted_to_43', true );
		header( 'Location: ' . admin_url() . 'customize.php?save_customizer_once=true' );
		die();
	}
}

add_action( 'admin_init', 'convert_pile_for_wp_43_once' );


function pile_hex2rgb( $hex ) {
	$hex = str_replace( "#", "", $hex );

	if ( strlen( $hex ) == 3 ) {
		$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
		$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
		$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
	} else {
		$r = hexdec( substr( $hex, 0, 2 ) );
		$g = hexdec( substr( $hex, 2, 2 ) );
		$b = hexdec( substr( $hex, 4, 2 ) );
	}
	$rgb = array( $r, $g, $b );

//     return implode(",", $rgb); // returns the rgb values separated by commas
	return $rgb; // returns an array with the rgb values
}

function convert_redux_options_to_customify() {

	$current_options = get_option( 'pile_options' );

	if ( is_array( $current_options['main_logo_light'] ) && isset( $current_options['main_logo_light']['id'] ) ) {
		$current_options['main_logo_light'] = $current_options['main_logo_light']['id'];
	}
	if ( is_array( $current_options['main_logo_dark'] ) && isset( $current_options['main_logo_dark']['id'] ) ) {
		$current_options['main_logo_dark'] = $current_options['main_logo_dark']['id'];
	}

	// @todo check here
	$checkbox_types_ids = array(
		'use_smooth_scroll',
		'use_ajax_loading',
		'enable_copyright_overlay',
		'contact_gmap_custom_style',
		'galleries_enable_pagination',
		'galleries_infinitescroll',
		'galleries_archive_filtering',
		'galleries_show_archive_title',
		'portfolio_single_show_share_links',
		'portfolio_enable_pagination',
		'portfolio_infinitescroll',
		'portfolio_projects_filtering',
		'portfolio_show_archive_title',
		'blog_single_show_share_links',
		'header_inverse'
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

	if ( isset( $current_options['custom_css'] ) && ! empty( $current_options['custom_css'] ) ) {
		$current_ccss = get_option('live_css_edit');
		update_option( 'live_css_edit', trim( $current_options['custom_css'] ) . "\n" . $current_ccss );
	}

	update_option( 'pile_options', $current_options );
	update_option( 'convert_options_to_customify', 1 );

//	header( 'Location: ' . admin_url() . 'customize.php?save_customizer_once=true' );
//	die();
}
//delete_option('convert_options_to_customify');
$once = get_option( 'convert_options_to_customify' );
if ( empty( $once ) ) {
	add_action( 'init', 'convert_redux_options_to_customify' );
}


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function pile_customize_js() {
	wp_enqueue_script( 'pile_customizer', get_template_directory_uri() . '/assets/js/admin/customizer.js', array( 'wp-ajax-response' ), '20130508', true );

	$translation_array = array (
		'import_failed' => esc_html__( 'The import completed partially!', 'pile') . '<br/>' . esc_html__( 'Check out the errors given. You might want to try reloading the page and try again.', 'pile'),
		'import_confirm' => esc_html__( 'Importing the demo data will overwrite your current site content and options. Proceed anyway?', 'pile'),
		'import_phew' => esc_html__( 'Phew...that was a hard one!', 'pile'),
		'import_success_note' => esc_html__( 'The demo data was imported without a glitch! Awesome! ', 'pile') . '<br/><br/>',
		'import_success_reload' => '<i>' . esc_html__( 'We have reloaded the page on the right, so you can see the brand new data!' . '</i>', 'pile'),
		'import_success_warning' => '<p>' . esc_html__( 'Remember to update the passwords and roles of imported users.', 'pile') . '</p><br/>',
		'import_all_done' => esc_html__( 'All done!', 'pile'),
		'import_working' => esc_html__( 'Working...', 'pile'),
		'import_widgets_failed' => esc_html__( 'The setting up of the demo widgets failed...', 'pile'),
		'import_widgets_error' => esc_html__( 'The setting up of the demo widgets failed', 'pile') . '</i><br />' . esc_html__( '(The script returned the following message', 'pile'),
		'import_widgets_done' => esc_html__( 'Finished setting up the demo widgets...', 'pile'),
		'import_theme_options_failed' => esc_html__( "The importing of the theme options has failed...", 'pile'),
		'import_theme_options_error' => esc_html__( 'The importing of the theme options has failed', 'pile') . '</i><br />' . esc_html__( '(The script returned the following message', 'pile'),
		'import_theme_options_done' => esc_html__( 'Finished importing the demo theme options...', 'pile'),
		'import_posts_failed' => esc_html__( "The importing of the theme options has failed...", 'pile'),
		'import_posts_step' => esc_html__( 'Importing posts | Step', 'pile'),
		'import_error' =>  esc_html__( "Error:", 'pile'),
		'import_try_reload' =>  esc_html__( "You can reload the page and try again.", 'pile'),
	);
	wp_localize_script( 'pile_customizer', 'pile_admin_js_texts', $translation_array );
}

add_action( 'customize_controls_enqueue_scripts', 'pile_customize_js' );


// @todo CLEANUP refactor function names
/**
 * Imports the demo data from the demo_data.xml file
 */
if ( ! function_exists( 'wpGrade_ajax_import_posts_pages' ) ) {
	function wpGrade_ajax_import_posts_pages() {
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
			check_ajax_referer( 'wpGrade_nonce_import_demo_posts_pages' );
		}

		require_once( get_template_directory() . '/inc/import/import-demo-posts-pages.php' );

		$response = new WP_Ajax_Response( $response );
		$response->send();
	}

	// hook into wordpress admin.php
	add_action( 'wp_ajax_wpGrade_ajax_import_posts_pages', 'wpGrade_ajax_import_posts_pages' );
}

/**
 * Imports the theme options from the demo_data.php file
 */
if ( ! function_exists( 'wpGrade_ajax_import_theme_options' ) ) {
	function wpGrade_ajax_import_theme_options() {
		$response = array(
			'what'   => 'import_theme_options',
			'action' => 'import_submit',
			'id'     => 'true',
		);

		// check if user is allowed to save and if its his intention with
		// a nonce check
		if ( function_exists( 'check_ajax_referer' ) ) {
			check_ajax_referer( 'wpGrade_nonce_import_demo_theme_options' );
		}
		require_once( get_template_directory() . '/inc/import/import-demo-theme-options' . EXT );

		$response = new WP_Ajax_Response( $response );
		$response->send();
	}

	// hook into wordpress admin.php
	add_action( 'wp_ajax_wpGrade_ajax_import_theme_options', 'wpGrade_ajax_import_theme_options' );
}

/**
 * This function imports the widgets from the demo_data.php file and the menus
 */
if ( ! function_exists( 'wpGrade_ajax_import_widgets' ) ) {
	function wpGrade_ajax_import_widgets() {
		$response = array(
			'what'   => 'import_widgets',
			'action' => 'import_submit',
			'id'     => 'true',
		);

		// check if user is allowed to save and if its his intention with
		// a nonce check
		if ( function_exists( 'check_ajax_referer' ) ) {
			check_ajax_referer( 'wpGrade_nonce_import_demo_widgets' );
		}

		require_once( get_template_directory() . '/inc/import/import-demo-widgets.php' );

		$response = new WP_Ajax_Response( $response );
		$response->send();
	}

	//hook into wordpress admin.php
	add_action( 'wp_ajax_wpGrade_ajax_import_widgets', 'wpGrade_ajax_import_widgets' );
}
