<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_Header_setting_menu {

	public $title = 'Header Settings';
	public $icon = 'fa-th-large';

	public function crazyblog_menu() {
		$return = array(
			array(
				'type' => 'section',
				'title' => esc_html__( 'Header Setting', 'crazyblog' ),
				'name' => 'headers_setting',
				'fields' => array(
					array(
						'type' => 'radioimage',
						'name' => 'custom_header',
						'label' => esc_html__( 'Choose Header', 'crazyblog' ),
						'item_max_height' => '150',
						'item_max_width' => '400',
						'items' => array(
							array(
								'value' => 'header_1',
								'label' => esc_html__( 'Header Style One', 'crazyblog' ),
								'img' => crazyblog_URI . 'assets/images/header/header1.jpg',
							),
							array(
								'value' => 'header_2',
								'label' => esc_html__( 'Header Style Two', 'crazyblog' ),
								'img' => crazyblog_URI . 'assets/images/header/header2.jpg',
							),
							array(
								'value' => 'header_3',
								'label' => esc_html__( 'Header Style Three', 'crazyblog' ),
								'img' => crazyblog_URI . 'assets/images/header/header3.jpg',
							),
							array(
								'value' => 'header_4',
								'label' => esc_html__( 'Header Style Fourth', 'crazyblog' ),
								'img' => crazyblog_URI . 'assets/images/header/header4.jpg',
							),
							array(
								'value' => 'header_5',
								'label' => esc_html__( 'Header Style Five', 'crazyblog' ),
								'img' => crazyblog_URI . 'assets/images/header/header5.jpg',
							),
						),
						'default' => array(
							'header_1',
						),
					),
					array(
						'type' => 'select',
						'name' => 'subMenuStyle',
						'label' => esc_html__( 'Sub Menu Style', 'crazyblog' ),
						'items' => array(
							array(
								'value' => 'not',
								'label' => esc_html__( 'Simple', 'crazyblog' ),
							),
							array(
								'value' => 'menu-style2',
								'label' => esc_html__( 'Modern', 'crazyblog' )
							)
						),
					),
				),
			),
			array(
				'type' => 'section',
				'title' => esc_html__( 'Header One Setting', 'crazyblog' ),
				'name' => 'header_one_setting',
				'fields' => array(
					array(
						'type' => 'toggle',
						'name' => 'header_one_sticky',
						'label' => esc_html__( 'Sticky Header', 'crazyblog' ),
						'description' => esc_html__( 'Make sticky header or not', 'crazyblog' ),
					),
					array(
						'type' => 'toggle',
						'name' => 'show_topbar',
						'label' => esc_html__( 'Show Topbar', 'crazyblog' ),
						'description' => esc_html__( 'Show/Hide Header Topbar', 'crazyblog' ),
					),
					array(
						'type' => 'toggle',
						'name' => 'show_topbar_nav',
						'label' => esc_html__( 'Navigation', 'crazyblog' ),
						'description' => esc_html__( 'Show/Hide Topbar Navigation', 'crazyblog' ),
						'dependency' => array(
							'field' => 'show_topbar',
							'function' => 'vp_dep_boolean',
						),
					),
					array(
						'type' => 'toggle',
						'name' => 'show_topbar_social',
						'label' => esc_html__( 'Social Media', 'crazyblog' ),
						'description' => esc_html__( 'Show/Hide Topbar Social Media icons', 'crazyblog' ),
						'dependency' => array(
							'field' => 'show_topbar',
							'function' => 'vp_dep_boolean',
						),
					),
					array(
						'type' => 'radiobutton',
						'name' => 'header_one_color',
						'label' => esc_html__( 'Header Color', 'crazyblog' ),
						'items' => array(
							array(
								'value' => 'light',
								'label' => esc_html__( 'Light', 'crazyblog' ),
							),
							array(
								'value' => 'dark',
								'label' => esc_html__( 'Dark', 'crazyblog' ),
							),
						),
						'default' => array(
							'light',
						),
					),
					array(
						'type' => 'upload',
						'name' => 'upload_logobar_bg',
						'label' => esc_html__( 'Upload', 'crazyblog' ),
						'description' => esc_html__( 'Upload an image for background in logo area', 'crazyblog' ),
						'default' => crazyblog_URI . 'assets/images/pagetop.jpg',
					)
				),
				'dependency' => array(
					'field' => 'custom_header',
					'function' => 'vp_dep_header_1',
				),
			), //Header One Settings.
			array(
				'type' => 'section',
				'title' => esc_html__( 'Header Two Setting', 'crazyblog' ),
				'name' => 'header_two_setting',
				'fields' => array(
					array(
						'type' => 'radiobutton',
						'name' => 'header_two_styles',
						'label' => esc_html__( 'Header', 'crazyblog' ),
						'items' => array(
							array(
								'value' => 'transparent-header bg-layer',
								'label' => esc_html__( 'Transparent Header', 'crazyblog' ),
							),
							array(
								'value' => 'transparent-header style2 bg-layer',
								'label' => esc_html__( 'Transparent Header 2', 'crazyblog' ),
							),
							array(
								'value' => 'simple-header',
								'label' => esc_html__( 'Simple Header', 'crazyblog' ),
							),
							array(
								'value' => 'simple-header simpleheader2 stick2',
								'label' => esc_html__( 'Simple Header 2', 'crazyblog' ),
							),
						),
						'default' => array(
							'transparent-header',
						),
					),
					array(
						'type' => 'toggle',
						'name' => 'header_two_sticky',
						'label' => esc_html__( 'Sticky Header', 'crazyblog' ),
						'description' => esc_html__( 'Make sticky header or not', 'crazyblog' ),
					),
					array(
						'type' => 'toggle',
						'name' => 'header_two_search',
						'label' => esc_html__( 'Search', 'crazyblog' ),
						'description' => esc_html__( 'Show Search on header', 'crazyblog' ),
					),
					array(
						'type' => 'toggle',
						'name' => 'header_two_social',
						'label' => esc_html__( 'Social Icons', 'crazyblog' ),
						'description' => esc_html__( 'Show Social Media Icons on header', 'crazyblog' ),
						'dependency' => array(
							'field' => 'header_two_styles',
							'function' => 'vp_dep_show_social_option',
						),
					),
					array(
						'type' => 'toggle',
						'name' => 'header_two_color_scheme',
						'label' => esc_html__( 'Light', 'crazyblog' ),
						'description' => esc_html__( 'enable this option to make this header in light color', 'crazyblog' ),
						'dependency' => array(
							'field' => 'header_two_styles',
							'function' => 'vp_dep_show_light_option',
						),
					),
				),
				'dependency' => array(
					'field' => 'custom_header',
					'function' => 'vp_dep_header_2',
				),
			),
			// start header three settings
			array(
				'type' => 'section',
				'title' => esc_html__( 'Header Three Setting', 'crazyblog' ),
				'name' => 'header_three_setting',
				'dependency' => array(
					'field' => 'custom_header',
					'function' => 'vp_dep_header_3',
				),
				'fields' => array(
					array(
						'type' => 'toggle',
						'name' => 'header_three_topbar',
						'label' => esc_html__( 'Header Topbar', 'crazyblog' ),
						'description' => esc_html__( 'Show header top bar', 'crazyblog' ),
					),
					array(
						'type' => 'toggle',
						'name' => 'header_three_topnav',
						'label' => esc_html__( 'Show Navigation', 'crazyblog' ),
						'description' => esc_html__( 'Show topbar navigation', 'crazyblog' ),
						'dependency' => array(
							'field' => 'header_three_topbar',
							'function' => 'vp_dep_boolean',
						),
					),
					array(
						'type' => 'toggle',
						'name' => 'header_three_social',
						'label' => esc_html__( 'Social Icons', 'crazyblog' ),
						'description' => esc_html__( 'Show Social Media Icons on header', 'crazyblog' ),
						'dependency' => array(
							'field' => 'header_three_topbar',
							'function' => 'vp_dep_boolean',
						),
					),
				),
			), //Header three Settings.
			// start header fourth settings
			array(
				'type' => 'section',
				'title' => esc_html__( 'Header Four Setting', 'crazyblog' ),
				'name' => 'header_4_setting',
				'dependency' => array(
					'field' => 'custom_header',
					'function' => 'vp_dep_header_4',
				),
				'fields' => array(
					array(
						'type' => 'toggle',
						'name' => 'header_4_topbar',
						'label' => esc_html__( 'Header Topbar', 'crazyblog' ),
						'description' => esc_html__( 'Show header top bar', 'crazyblog' ),
					),
					array(
						'type' => 'toggle',
						'name' => 'header_4_social',
						'label' => esc_html__( 'Social Icons', 'crazyblog' ),
						'description' => esc_html__( 'Show Social Media Icons on header', 'crazyblog' ),
						'dependency' => array(
							'field' => 'header_4_topbar',
							'function' => 'vp_dep_boolean',
						),
					),
					array(
						'type' => 'textbox',
						'name' => 'header_4_contact',
						'label' => esc_html__( 'Tobbar Contact No', 'crazyblog' ),
						'description' => esc_html__( 'Enter header topbar contact number', 'crazyblog' ),
						'dependency' => array(
							'field' => 'header_4_topbar',
							'function' => 'vp_dep_boolean',
						),
					),
					array(
						'type' => 'textbox',
						'name' => 'header_4_email',
						'label' => esc_html__( 'Tobbar Email', 'crazyblog' ),
						'description' => esc_html__( 'Enter header topbar Email', 'crazyblog' ),
						'dependency' => array(
							'field' => 'header_4_topbar',
							'function' => 'vp_dep_boolean',
						),
					),
					array(
						'type' => 'toggle',
						'name' => 'header_4_cart',
						'label' => esc_html__( 'Cart Button', 'crazyblog' ),
						'description' => esc_html__( 'Show header cart button', 'crazyblog' ),
					),
					array(
						'type' => 'toggle',
						'name' => 'header_4_search',
						'label' => esc_html__( 'Search Box', 'crazyblog' ),
						'description' => esc_html__( 'Show header seach box', 'crazyblog' ),
					),
					array(
						'type' => 'upload',
						'name' => 'header_4_bg',
						'label' => esc_html__( 'Header Background', 'crazyblog' ),
						'description' => esc_html__( 'Upload image for header background', 'crazyblog' ),
					),
				),
			), //Header fourth Settings.
			//Header One Settings.
			array(
				'type' => 'section',
				'title' => esc_html__( 'Header Five Setting', 'crazyblog' ),
				'name' => 'header_five_setting',
				'fields' => array(
					array(
						'type' => 'select',
						'name' => 'h_5_style',
						'label' => esc_html__( 'Style', 'crazyblog' ),
						'items' => array(
							array( 'label' => esc_html__( 'Light', 'crazyblog' ), 'value' => 'style2' ),
							array( 'label' => esc_html__( 'Dark', 'crazyblog' ), 'value' => '' )
						),
						'description' => esc_html__( 'Select header style', 'crazyblog' ),
					),
					array(
						'type' => 'upload',
						'name' => 'header_5_bg',
						'label' => esc_html__( 'Header Background', 'crazyblog' ),
						'description' => esc_html__( 'Upload image for header background', 'crazyblog' ),
					),
					array(
						'type' => 'toggle',
						'name' => 'header_five_search',
						'label' => esc_html__( 'Search', 'crazyblog' ),
						'description' => esc_html__( 'Show Search on header', 'crazyblog' ),
					),
					array(
						'type' => 'toggle',
						'name' => 'header_five_social',
						'label' => esc_html__( 'Social Icons', 'crazyblog' ),
						'description' => esc_html__( 'Show Social Media Icons on header', 'crazyblog' )
					),
					array(
						'type' => 'select',
						'name' => 'h_5_logo_type',
						'label' => esc_html__( 'Logo Style', 'crazyblog' ),
						'items' => array(
							array( 'label' => esc_html__( 'Center Logo', 'crazyblog' ), 'value' => 'center' ),
							array( 'label' => esc_html__( 'Left Logo', 'crazyblog' ), 'value' => 'left' )
						),
						'description' => esc_html__( 'Select logo style', 'crazyblog' ),
					),
					array(
						'type' => 'radiobutton',
						'name' => 'header_5_ad_type',
						'label' => esc_html__( 'AD Type', 'crazyblog' ),
						'items' => array(
							array(
								'value' => 'crazyblog_own_image',
								'label' => esc_html__( 'Own Image', 'crazyblog' ),
							),
							array(
								'value' => 'crazyblog_google_script',
								'label' => esc_html__( 'Google AD Script', 'crazyblog' ),
							),
						),
						'default' => array(
							'crazyblog_own_image',
						),
						'dependency' => array(
							'field' => 'h_5_logo_type',
							'function' => 'vp_dep_h_5',
						),
					),
					array(
						'type' => 'upload',
						'name' => 'upload_5_ad_image',
						'label' => esc_html__( 'Upload', 'crazyblog' ),
						'description' => esc_html__( 'Upload ad image to show on header', 'crazyblog' ),
						'dependency' => array(
							'field' => 'header_5_ad_type,h_5_logo_type',
							'function' => 'vp_dep_header_own_image2',
						)
					),
					array(
						'type' => 'textbox',
						'name' => 'ad_5_image_link',
						'label' => esc_html__( 'Link', 'crazyblog' ),
						'description' => esc_html__( 'Enter the link for ad image', 'crazyblog' ),
						'dependency' => array(
							'field' => 'header_5_ad_type,h_5_logo_type',
							'function' => 'vp_dep_header_own_image2',
						),
					),
					array(
						'type' => 'textarea',
						'name' => 'crazyblog_5_google_ad_code',
						'label' => esc_html__( 'Adsense Code', 'crazyblog' ),
						'description' => esc_html__( 'Enter Your Ad Sens Code here to show your ad on header', 'crazyblog' ),
						'dependency' => array(
							'field' => 'header_5_ad_type,h_5_logo_type',
							'function' => 'vp_dep_header_google_ad2',
						),
					),
					array(
						'type' => 'select',
						'name' => 'h_5_menu_pos',
						'label' => esc_html__( 'Menu Position', 'crazyblog' ),
						'items' => array(
							array( 'label' => esc_html__( 'Center', 'crazyblog' ), 'value' => 'center' ),
							array( 'label' => esc_html__( 'Left', 'crazyblog' ), 'value' => '' )
						),
						'description' => esc_html__( 'Select menu position', 'crazyblog' ),
					),
				),
				'dependency' => array(
					'field' => 'custom_header',
					'function' => 'vp_dep_header_5',
				),
			),
			// header five settings
			array(
				'type' => 'section',
				'title' => esc_html__( 'Header Upper Area', 'crazyblog' ),
				'name' => 'above_header_setting',
				'fields' => array(
					array(
						'type' => 'notebox',
						'name' => 'header_upper_notebox',
						'label' => esc_html__( 'Important Note', 'crazyblog' ),
						'description' => esc_html__( 'This option is only work with "Simple Header 2" style', 'crazyblog' ),
						'status' => 'normal',
					),
					array(
						'type' => 'toggle',
						'name' => 'before_header',
						'label' => esc_html__( 'Show Before Header', 'crazyblog' ),
					),
					array(
						'type' => 'select',
						'name' => 'header_upper_area_type',
						'label' => esc_html__( 'Select Header Upper Area Type', 'crazyblog' ),
						'items' => array(
							array( 'label' => esc_html__( 'Text Carousel', 'crazyblog' ), 'value' => 'carousel' ),
							array( 'label' => esc_html__( 'Video', 'crazyblog' ), 'value' => 'video' )
						),
					),
					array(
						'type' => 'textbox',
						'name' => 'header_upper_area_video',
						'label' => esc_html__( 'Enter mp4 Video url', 'crazyblog' ),
						'dependency' => array(
							'field' => 'header_upper_area_type',
							'function' => 'vp_header_upper_video',
						),
					),
					array(
						'type' => 'upload',
						'name' => 'header_upper_bg',
						'label' => esc_html__( 'Upload Background Image', 'crazyblog' ),
						'dependency' => array(
							'field' => 'header_upper_area_type',
							'function' => 'vp_header_upper_carousel',
						),
					),
					array(
						'type' => 'builder',
						'repeating' => true,
						'sortable' => true,
						'label' => esc_html__( 'Routating Text', 'crazyblog' ),
						'name' => 'crazyblog_header_routating_text',
						'fields' => array(
							array(
								'type' => 'textbox',
								'name' => 'heading',
								'label' => esc_html__( 'Routating Heading', 'crazyblog' ),
							),
							array(
								'type' => 'textbox',
								'name' => 'sub_heading',
								'label' => esc_html__( 'Routating Heading', 'crazyblog' ),
							),
						),
					),
					array(
						'type' => 'toggle',
						'name' => 'before_header_scroll_down',
						'label' => esc_html__( 'Show Scroll Down', 'crazyblog' ),
					),
				),
				'dependency' => array(
					'field' => 'custom_header',
					'function' => 'vp_dep_header_2',
				),
			),
			array(
				'type' => 'section',
				'title' => esc_html__( 'Logo Setting', 'crazyblog' ),
				'name' => 'logo_setting',
				'fields' => array(
					array(
						'type' => 'radiobutton',
						'name' => 'logo_type',
						'label' => esc_html__( 'Logo Type', 'crazyblog' ),
						'items' => array(
							array(
								'value' => 'image',
								'label' => esc_html__( 'Image', 'crazyblog' ),
							),
							array(
								'value' => 'text',
								'label' => esc_html__( 'Text', 'crazyblog' ),
							),
						),
						'default' => array(
							'image',
						),
					),
				),
			),
			array(
				'type' => 'section',
				'title' => esc_html__( 'Logo with Image', 'crazyblog' ),
				'name' => 'logo_with_image',
				'dependency' => array(
					'field' => 'logo_type',
					'function' => 'vp_dep_is_image',
				),
				'fields' => array(
					array(
						'type' => 'upload',
						'name' => 'logo_image',
						'label' => esc_html__( 'Logo Image', 'crazyblog' ),
						'description' => esc_html__( 'Inser the logo image', 'crazyblog' ),
						'default' => crazyblog_URI . 'assets/images/crazy-logo.png'
					),
					array(
						'type' => 'slider',
						'name' => 'logo_width',
						'label' => esc_html__( 'Logo Width', 'crazyblog' ),
						'description' => esc_html__( 'choose the logo width', 'crazyblog' ),
						'default' => '136',
						'min' => 20,
						'max' => 400
					),
					array(
						'type' => 'slider',
						'name' => 'logo_height',
						'label' => esc_html__( 'Logo Height', 'crazyblog' ),
						'description' => esc_html__( 'choose the logo height', 'crazyblog' ),
						'default' => '28',
						'min' => 20,
						'max' => 400
					),
				),
			),
			array(
				'type' => 'section',
				'title' => esc_html__( 'Custom Logo Text', 'crazyblog' ),
				'name' => 'section_custom_logo_text',
				'dependency' => array(
					'field' => 'logo_type',
					'function' => 'vp_dep_is_text',
				),
				'fields' => array(
					array(
						'type' => 'textbox',
						'name' => 'logo_heading',
						'label' => esc_html__( 'Logo Heading', 'crazyblog' ),
						'description' => esc_html__( 'Enter the website heading instead of logo', 'crazyblog' ),
						'default' => 'CrazyBlog'
					),
					array(
						'type' => 'slider',
						'name' => 'logo_font_size',
						'label' => esc_html__( 'Logo Font Size', 'crazyblog' ),
						'description' => esc_html__( 'Choose the logo font size', 'crazyblog' ),
						'default' => 40,
						'min' => 12,
						'max' => 45
					),
					array(
						'type' => 'select',
						'name' => 'logo_font_face',
						'label' => esc_html__( 'Logo Font Face', 'crazyblog' ),
						'description' => esc_html__( 'Select Font', 'crazyblog' ),
						'items' => array(
							'data' => array(
								array(
									'source' => 'function',
									'value' => 'vp_get_gwf_family',
								),
							),
						),
					),
					array(
						'type' => 'radiobutton',
						'name' => 'logo_font_weight',
						'label' => esc_html__( 'Logo Font Weight', 'crazyblog' ),
						'items' => array(
							array(
								'value' => 'noraml',
								'label' => esc_html__( 'Normal', 'crazyblog' ),
							),
							array(
								'value' => 'bold',
								'label' => esc_html__( 'Bold', 'crazyblog' ),
							),
						),
						'default' => array(
							'normal',
						),
					),
					array(
						'type' => 'color',
						'name' => 'logo_color',
						'label' => esc_html__( 'Logo Color', 'crazyblog' ),
						'description' => esc_html__( 'Choose the default color for logo.', 'crazyblog' ),
						'default' => '#ff5050',
					),
				),
			),
			array(
				'type' => 'codeeditor',
				'name' => 'header_css',
				'label' => esc_html__( 'Header CSS', 'crazyblog' ),
				'description' => esc_html__( 'Write your custom css to include in header.', 'crazyblog' ),
				'theme' => 'github',
				'mode' => 'css',
			),
		);
		return apply_filters( 'crazyblog_vp_opt_header_', $return );
	}

}
