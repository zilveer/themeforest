<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct access allowed' );
} ?>
<?php

$child_sections = array();
$tab_key        = basename( __FILE__, '.php' );
$pagepath       = TMM_THEME_PATH . '/admin/theme_options/sections/' . $tab_key . '/custom_html/';

$content = array(
	'skin_composer' => array(
		'title'         => __( 'Skin Composer', 'cardealer' ),
		'type'          => 'custom',
		'default_value' => '',
		'description'   => '',
		'custom_html'   => TMM::draw_free_page( $pagepath . 'skin_composer.php' )
	),
	'block1'        => array(
		'title' => __( 'Text', 'cardealer' ),
		'type'  => 'items_block',
		'items' => array(
			'general_font_family'           => array(
				'title'         => __( 'Website Font Family', 'cardealer' ),
				'type'          => 'google_font_select',
				'default_value' => 'default_font',
				'description'   => '',
				'custom_html'   => '',
				'is_reset'      => true
			),
			'general_font_size'             => array(
				'title'         => __( 'Website Font Size', 'cardealer' ),
				'type'          => 'slider',
				'default_value' => 14,
				'min'           => 10,
				'max'           => 18,
				'description'   => __( 'General website font size in pixels. Do not edit this field to use default theme styling.', 'cardealer' ),
				'custom_html'   => '',
				'show_title'    => true,
				'is_reset'      => true
			),
			'general_text_color'            => array(
				'title'         => __( 'Website Text Color', 'cardealer' ),
				'type'          => 'color',
				'default_value' => '#7e858b',
				'description'   => __( 'General website text color. Do not edit this field to use default theme styling.', 'cardealer' ),
				'custom_html'   => '',
				'is_reset'      => true
			),
			'general_normal_links_color'    => array(
				'title'         => __( 'Website Links Color', 'cardealer' ),
				'type'          => 'color',
				'default_value' => '#ff600a',
				'description'   => __( 'General website links color. Do not edit this field to use default theme styling.', 'cardealer' ),
				'custom_html'   => '',
				'is_reset'      => true
			),
			'general_mouseover_links_color' => array(
				'title'         => __( 'Website Mouseover Links Color', 'cardealer' ),
				'type'          => 'color',
				'default_value' => '#ff600a',
				'description'   => __( 'General website mouseover links color. Do not edit this field to use default theme styling.', 'cardealer' ),
				'custom_html'   => '',
				'is_reset'      => true
			),
		)
	),
	'block2'        => array(
		'title' => __( 'Borders', 'cardealer' ),
		'type'  => 'items_block',
		'items' => array(
			'general_brd_size'  => array(
				'title'         => __( 'Website Borders Width', 'cardealer' ),
				'show_title'    => true,
				'type'          => 'slider',
				'default_value' => '1',
				'description'   => __( 'General website border width in pixels. Do not edit this field to use default theme styling.', 'cardealer' ),
				'custom_html'   => '',
				'min'           => 0,
				'max'           => 5,
				'is_reset'      => true
			),
			'general_brd_color' => array(
				'title'         => __( 'Website Borders Color', 'cardealer' ),
				'type'          => 'color',
				'default_value' => '#7e858b',
				'description'   => __( 'General website borders color. Do not edit this field to use default theme styling.', 'cardealer' ),
				'custom_html'   => '',
				'is_reset'      => true
			),
			'secondary_brd_size'  => array(
				'title'         => __( 'Website Secondary Borders Width', 'cardealer' ),
				'show_title'    => true,
				'type'          => 'slider',
				'default_value' => '1',
				'description'   => __( 'Secondary website border width in pixels. Do not edit this field to use default theme styling.', 'cardealer' ),
				'custom_html'   => '',
				'min'           => 0,
				'max'           => 5,
				'is_reset'      => true
			),
			'secondary_brd_color' => array(
				'title'         => __( 'Website Secondary Borders Color', 'cardealer' ),
				'type'          => 'color',
				'default_value' => '#dddcdc',
				'description'   => __( 'Secondary website borders color. Do not edit this field to use default theme styling.', 'cardealer' ),
				'custom_html'   => '',
				'is_reset'      => true
			),
		)
	),
	'block3'        => array(
		'title' => __( 'Backgrounds', 'cardealer' ),
		'type'  => 'items_block',
		'items' => array(

			'body_pattern_selected' => array(
				'title'         => __( 'Website Background', 'cardealer' ),
				'type'          => 'select',
				'css_class'     => 'showhide',
				'default_value' => 0,
				'values'        => array(
					0 => __( 'Background Color', 'cardealer' ),
					1 => __( 'Custom Background Image', 'cardealer' ),
					2 => __( 'Patterns', 'cardealer' ),
				),
				'description'   => __( 'General website background. Do not edit this field to use default theme styling.', 'cardealer' ),
				'custom_html'   => TMM::draw_free_page( $pagepath . 'body_pattern_selected.php' ),
				'show_title'    => true,
				'is_reset'      => true
			),
		)
	),
	'custom_css'    => array(
		'title'         => __( 'Custom CSS Styles', 'cardealer' ),
		'type'          => 'textarea',
		'default_value' => '',
		'description'   => '',
		'custom_html'   => ''
	),
);

$child_sections['styling_headings'] = array(
	'name'     => __( 'Headings', 'cardealer' ),
	'sections' => array(
		'block1' => array(
			'title' => __( 'H1 Heading', 'cardealer' ),
			'type'  => 'items_block',
			'items' => array(
				'h1_font_family'          => array(
					'title'         => __( 'Font Family', 'cardealer' ),
					'type'          => 'google_font_select',
					'default_value' => 'Roboto+Condensed:300,300italic,regular,italic,700,700italic&subset=vietnamese,latin-ext,greek-ext,cyrillic-ext,latin,cyrillic,greek',
					'description'   => '',
					'custom_html'   => '',
					'is_reset'      => true
				),
				'h1_font_size'            => array(
					'title'         => __( 'Font Size', 'cardealer' ),
					'type'          => 'slider',
					'default_value' => 32,
					'min'           => 12,
					'max'           => 36,
					'description'   => __( 'H1 heading font size in pixels. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'show_title'    => true,
					'is_reset'      => true
				),
				'h1_font_color'           => array(
					'title'         => __( 'Font Color', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#232527',
					'description'   => __( 'H1 heading font color. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				),
				'h1_normal_link_color'    => array(
					'title'         => __( 'Normal Link Color', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#ff600a',
					'description'   => __( 'A normal, visited and unvisited link. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				),
				'h1_mouseover_link_color' => array(
					'title'         => __( 'Mouseover Link Color', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#7d7d7d',
					'description'   => __( 'A link when the user mouses over it. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				)
			)
		),
		'block2' => array(
			'title' => __( 'H2 Heading', 'cardealer' ),
			'type'  => 'items_block',
			'items' => array(
				'h2_font_family'          => array(
					'title'         => __( 'Font Family', 'cardealer' ),
					'type'          => 'google_font_select',
					'default_value' => 'Roboto+Condensed:300,300italic,regular,italic,700,700italic&subset=vietnamese,latin-ext,greek-ext,cyrillic-ext,latin,cyrillic,greek',
					'description'   => '',
					'custom_html'   => '',
					'is_reset'      => true
				),
				'h2_font_size'            => array(
					'title'         => __( 'Font Size', 'cardealer' ),
					'type'          => 'slider',
					'default_value' => 28,
					'min'           => 12,
					'max'           => 36,
					'description'   => __( 'H2 heading font size in pixels. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'show_title'    => true,
					'is_reset'      => true
				),
				'h2_font_color'           => array(
					'title'         => __( 'Font Color', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#7f858b',
					'description'   => __( 'H2 heading font color. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				),
				'h2_normal_link_color'    => array(
					'title'         => __( 'Normal Link Color', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#ff600a',
					'description'   => __( 'A normal, visited and unvisited link. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				),
				'h2_mouseover_link_color' => array(
					'title'         => __( 'Mouseover Link Color', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#7d7d7d',
					'description'   => __( 'A link when the user mouses over it. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				)
			)
		),
		'block3' => array(
			'title' => __( 'H3 Heading', 'cardealer' ),
			'type'  => 'items_block',
			'items' => array(
				'h3_font_family'          => array(
					'title'         => __( 'Font Family', 'cardealer' ),
					'type'          => 'google_font_select',
					'default_value' => 'Roboto+Condensed:300,300italic,regular,italic,700,700italic&subset=vietnamese,latin-ext,greek-ext,cyrillic-ext,latin,cyrillic,greek',
					'description'   => '',
					'custom_html'   => '',
					'is_reset'      => true
				),
				'h3_font_size'            => array(
					'title'         => __( 'Font Size', 'cardealer' ),
					'type'          => 'slider',
					'default_value' => 22,
					'min'           => 12,
					'max'           => 36,
					'description'   => __( 'H3 heading font size in pixels. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'show_title'    => true,
					'is_reset'      => true
				),
				'h3_font_color'           => array(
					'title'         => __( 'Font Color', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#7f858c',
					'description'   => __( 'H3 heading font color. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				),
				'h3_normal_link_color'    => array(
					'title'         => __( 'Normal Link Color', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#ff600a',
					'description'   => __( 'A normal, visited and unvisited link. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				),
				'h3_mouseover_link_color' => array(
					'title'         => __( 'Mouseover Link Color', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#7d7d7d',
					'description'   => __( 'A link when the user mouses over it. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				)
			)
		),
		'block4' => array(
			'title' => __( 'H4 Heading', 'cardealer' ),
			'type'  => 'items_block',
			'items' => array(
				'h4_font_family'          => array(
					'title'         => __( 'Font Family', 'cardealer' ),
					'type'          => 'google_font_select',
					'default_value' => 'Roboto+Condensed:300,300italic,regular,italic,700,700italic&subset=vietnamese,latin-ext,greek-ext,cyrillic-ext,latin,cyrillic,greek',
					'description'   => '',
					'custom_html'   => '',
					'is_reset'      => true
				),
				'h4_font_size'            => array(
					'title'         => __( 'Font Size', 'cardealer' ),
					'type'          => 'slider',
					'default_value' => 18,
					'min'           => 12,
					'max'           => 36,
					'description'   => __( 'H4 heading font size in pixels. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'show_title'    => true,
					'is_reset'      => true
				),
				'h4_font_color'           => array(
					'title'         => __( 'Font Color', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#232527',
					'description'   => __( 'H4 heading font color. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				),
				'h4_normal_link_color'    => array(
					'title'         => __( 'Normal Link Color', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#232527',
					'description'   => __( 'A normal, visited and unvisited link. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				),
				'h4_mouseover_link_color' => array(
					'title'         => __( 'Mouseover Link Color', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#7d7d7d',
					'description'   => __( 'A link when the user mouses over it. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				)
			)
		),
		'block5' => array(
			'title' => __( 'H5 Heading', 'cardealer' ),
			'type'  => 'items_block',
			'items' => array(
				'h5_font_family'          => array(
					'title'         => __( 'Font Family', 'cardealer' ),
					'type'          => 'google_font_select',
					'default_value' => 'Roboto+Condensed:300,300italic,regular,italic,700,700italic&subset=vietnamese,latin-ext,greek-ext,cyrillic-ext,latin,cyrillic,greek',
					'description'   => '',
					'custom_html'   => '',
					'is_reset'      => true
				),
				'h5_font_size'            => array(
					'title'         => __( 'Font Size', 'cardealer' ),
					'type'          => 'slider',
					'default_value' => 16,
					'min'           => 12,
					'max'           => 36,
					'description'   => __( 'H5 heading font size in pixels. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'show_title'    => true,
					'is_reset'      => true
				),
				'h5_font_color'           => array(
					'title'         => __( 'Font Color', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#232527',
					'description'   => __( 'H5 heading font color. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				),
				'h5_normal_link_color'    => array(
					'title'         => __( 'Normal Link Color', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#ff600a',
					'description'   => __( 'A normal, visited and unvisited link. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				),
				'h5_mouseover_link_color' => array(
					'title'         => __( 'Mouseover Link Color', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#7d7d7d',
					'description'   => __( 'A link when the user mouses over it. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				)
			)
		),
		'block6' => array(
			'title' => __( 'H6 Heading', 'cardealer' ),
			'type'  => 'items_block',
			'items' => array(
				'h6_font_family'          => array(
					'title'         => __( 'Font Family', 'cardealer' ),
					'type'          => 'google_font_select',
					'default_value' => 'Roboto+Condensed:300,300italic,regular,italic,700,700italic&subset=vietnamese,latin-ext,greek-ext,cyrillic-ext,latin,cyrillic,greek',
					'description'   => '',
					'custom_html'   => '',
					'is_reset'      => true
				),
				'h6_font_size'            => array(
					'title'         => __( 'Font Size', 'cardealer' ),
					'type'          => 'slider',
					'default_value' => 16,
					'min'           => 12,
					'max'           => 36,
					'description'   => __( 'H6 heading font size in pixels. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'show_title'    => true,
					'is_reset'      => true
				),
				'h6_font_color'           => array(
					'title'         => __( 'Font Color', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#232527',
					'description'   => __( 'H6 heading font color. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				),
				'h6_normal_link_color'    => array(
					'title'         => __( 'Normal Link Color', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#ff600a',
					'description'   => __( 'A normal, visited and unvisited link. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				),
				'h6_mouseover_link_color' => array(
					'title'         => __( 'Mouseover Link Color', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#7d7d7d',
					'description'   => __( 'A link when the user mouses over it. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				)
			)
		),
	)
);

$child_sections['styling_main_navigation'] = array(
	'name'     => __( 'Main Navigation', 'cardealer' ),
	'sections' => array(
		'block1' => array(
			'title' => __( 'General', 'cardealer' ),
			'type'  => 'items_block',
			'items' => array(
				'main_nav_font'                   => array(
					'title'         => __( 'First Level Font Family', 'cardealer' ),
					'type'          => 'google_font_select',
					'default_value' => 'Roboto+Condensed:300,300italic,regular,italic,700,700italic&subset=vietnamese,latin-ext,greek-ext,cyrillic-ext,latin,cyrillic,greek',
					'description'   => __( 'First level navigation menu font family.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				),
				'main_nav_level_2_font'           => array(
					'title'         => __( 'Sublevels Font Family', 'cardealer' ),
					'type'          => 'google_font_select',
					'default_value' => 'Roboto+Condensed:300,300italic,regular,italic,700,700italic&subset=vietnamese,latin-ext,greek-ext,cyrillic-ext,latin,cyrillic,greek',
					'description'   => __( 'Sublevels navigation menu font family.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				),
				'main_nav_first_level_font_size'  => array(
					'title'         => __( 'First Level Font Size', 'cardealer' ),
					'type'          => 'slider',
					'default_value' => 18,
					'min'           => 16,
					'max'           => 21,
					'description'   => __( 'Main navigation first level font size in pixels. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'show_title'    => true,
					'is_reset'      => true
				),
				'main_nav_second_level_font_size' => array(
					'title'         => __( 'Sublevels Font Size', 'cardealer' ),
					'type'          => 'slider',
					'default_value' => 15,
					'min'           => 14,
					'max'           => 17,
					'description'   => __( 'Main navigation second level font size in pixels. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'show_title'    => true,
					'is_reset'      => true
				),
			)
		),
		'block2' => array(
			'title' => __( 'Links Color (First level)', 'cardealer' ),
			'type'  => 'items_block',
			'items' => array(
				'main_nav_def_text_color'   => array(
					'title'         => __( 'Normal', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#fbfafa',
					'description'   => __( 'A normal, visited and unvisited link color for main navigation. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				),
				'main_nav_curr_text_color'  => array(
					'title'         => __( 'Current', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#ff600a',
					'description'   => __( 'Current menu item link color for main navigation. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				),
				'main_nav_hover_text_color' => array(
					'title'         => __( 'Mouseover', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#ff600a',
					'description'   => __( 'A link when the user mouses over it. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				)
			)
		),
		'block3' => array(
			'title' => __( 'Links Color (Second level)', 'cardealer' ),
			'type'  => 'items_block',
			'items' => array(
				'main_nav_dd_def_text_color'   => array(
					'title'         => __( 'Normal', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#fbfafa',
					'description'   => __( 'A normal, visited and unvisited link color for main navigation. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				),
				'main_nav_dd_curr_text_color'  => array(
					'title'         => __( 'Current', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#ffffff',
					'description'   => __( 'Current menu item link color for main navigation. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				),
				'main_nav_dd_hover_text_color' => array(
					'title'         => __( 'Mouseover', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#ffffff',
					'description'   => __( 'A link when the user mouses over it. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				)
			)
		),
		'block4' => array(
			'title' => __( 'Navigation Container Background', 'cardealer' ),
			'type'  => 'items_block',
			'items' => array(
				'main_nav_bg_top'   => array(
					'title'         => __( 'Background Color', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#4e5256',
					'description'   => __( 'Navigation container background color. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				),

			)
		),
		'block5' => array(
			'title' => __( 'Navigation Sublevels Background', 'cardealer' ),
			'type'  => 'items_block',
			'items' => array(
				'main_nav_bg_sub'   => array(
					'title'         => __( 'Background Color', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#4e5256',
					'description'   => __( 'Navigation sublevels background color. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				),

			)
		),
		'block6' => array(
			'title' => __( 'Navigation Current Item Background', 'cardealer' ),
			'type'  => 'items_block',
			'items' => array(
				'main_nav_curr_item_bg_top_color'    => array(
					'title'         => __( 'Background Color', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#5f6366',
					'description'   => __( 'Navigation current item background color. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				),

			)
		),
		'block7' => array(
			'title' => __( 'Navigation Sublevels Current Item Background', 'cardealer' ),
			'type'  => 'items_block',
			'items' => array(
				'main_nav_dd_curr_item_bg_top_color'    => array(
					'title'         => __( 'Background Color', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#5f6366',
					'description'   => __( 'Navigation sublevels current item background color. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				),

			)
		),
	)
);
$child_sections['styling_content'] = array(
	'name'     => __( 'Content Styling', 'cardealer' ),
	'sections' => array(
		'block1' => array(
			'title' => __( 'Main Container', 'cardealer' ),
			'type'  => 'items_block',
			'items' => array(
				'content_font_color' => array(
					'title'         => __( 'Font Color', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#7e858b',
					'description'   => 'Content fonts color. Do not edit this field to use default theme styling.',
					'custom_html'   => '',
					'is_reset'      => true
				)
			)
		)
	)
);

$child_sections['styling_buttons'] = array(
	'name'     => __( 'Buttons Styling', 'cardealer' ),
	'sections' => array(
		'block1' => array(
			'title' => __( 'General Styles', 'cardealer' ),
			'type'  => 'items_block',
			'items' => array(
				'buttons_font_family' => array(
					'title'         => __( 'Font Family', 'cardealer' ),
					'type'          => 'google_font_select',
					'default_value' => 'default_font',
					'description'   => '',
					'custom_html'   => '',
					'is_reset'      => true
				),
				'buttons_font_size' => array(
					'title'         => __( 'Font Size', 'cardealer' ),
					'type'          => 'slider',
					'default_value' => 13,
					'min'           => 13,
					'max'           => 18,
					'description'   => __( 'General buttons font size in pixels. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'show_title'    => true,
					'is_reset'      => true
				),
			),
		),
		'block2' => array(
			'title' => __( 'Normal Color Styles', 'cardealer' ),
			'type'  => 'items_block',
			'items' => array(
				'buttons_text_color' => array(
					'title'         => __( 'Text', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#ffffff',
					'description'   => __( 'A normal, visited and unvisited default button\'s text color. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				),
				'buttons_bg_color'   => array(
					'title'         => __( 'Background', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#7f858b',
					'description'   => __( 'A normal, visited and unvisited default button\'s background color. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				),
			),
		),
		'block3' => array(
			'title' => __( 'Mouseover Styles', 'cardealer' ),
			'type'  => 'items_block',
			'items' => array(
				'buttons_hover_text_color' => array(
					'title'         => __( 'Text', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#fff',
					'description'   => __( 'Default button\'s text color when the user mouses over it. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				),
				'buttons_hover_bg_color'   => array(
					'title'         => __( 'Background', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#ff600a',
					'description'   => __( 'Default button\'s background color when the user mouses over it. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				),
			)
		),
	)
);


$child_sections['styling_widgets'] = array(
	'name'     => __( 'Widgets Styling', 'cardealer' ),
	'sections' => array(
		'block1' => array(
			'title' => __( 'General Styles', 'cardealer' ),
			'type'  => 'items_block',
			'items' => array(
				'widget_title_color'       => array(
					'title'         => __( 'Title Color', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#7f858b',
					'description'   => __( 'Widget\'s title text color. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				),
				'widget_title_first_color' => array(
					'title'         => __( 'Title First Word Color', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#ff600a',
					'description'   => __( 'Widget\'s title first word color. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				),
				'widget_text_color'        => array(
					'title'         => __( 'Text Color', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#7e858b',
					'description'   => __( 'Widget\'s text color. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				),
				'widget_link_color'        => array(
					'title'         => __( 'Normal Link Color', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#232527',
					'description'   => __( 'A normal, visited and unvisited link color. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				),
				'widget_link_hover_color'  => array(
					'title'         => __( 'Mouseover Link Color', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#7d7d7d',
					'description'   => __( 'A link when the user mouses over it. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				)

			)
		),
		'block2' => array(
			'title'  => __( 'Boxed Widgets Styles', 'cardealer' ),
			'type'   => 'items_block',
			'items'  => array(
				'boxed_widget_title_color'       => array(
					'title'         => __( 'Title color', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#232527',
					'description'   => __( 'Boxed widget title text color. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				),
				'boxed_widget_title_first_color' => array(
					'title'         => __( 'Title First Word Color', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#ff600a',
					'description'   => __( 'Boxed widget title first word color. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				),
				'boxed_widget_text_color'        => array(
					'title'         => __( 'Text Color', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#777676',
					'description'   => __( 'Boxed widget text color. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				),
				'boxed_widget_bg_color'          => array(
					'title'         => __( 'Box Background Color', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#f4f4f4',
					'description'   => __( 'Box widget background color. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				),
			),
			'block3' => array(
				'title' => __( 'Footer Widgets Styles', 'cardealer' ),
				'type'  => 'items_block',
				'items' => array(
					'footer_widget_title_color'       => array(
						'title'         => __( 'Title Color', 'cardealer' ),
						'type'          => 'color',
						'default_value' => '#fff',
						'description'   => __( 'Footer widget title text color. Do not edit this field to use default theme styling.', 'cardealer' ),
						'custom_html'   => '',
						'is_reset'      => true
					),
					'footer_widget_title_first_color' => array(
						'title'         => __( 'Title First Word Color', 'cardealer' ),
						'type'          => 'color',
						'default_value' => '#ff600a',
						'description'   => __( 'Footer widget title first word color. Do not edit this field to use default theme styling.', 'cardealer' ),
						'custom_html'   => '',
						'is_reset'      => true
					),
					'footer_widget_text_color'        => array(
						'title'         => __( 'Text Color', 'cardealer' ),
						'type'          => 'color',
						'default_value' => '#b0b0b0',
						'description'   => __( 'Footer widget text color. Do not edit this field to use default theme styling.', 'cardealer' ),
						'custom_html'   => '',
						'is_reset'      => true
					),
					'footer_widget_link_color'        => array(
						'title'         => __( 'Normal Link Color', 'cardealer' ),
						'type'          => 'color',
						'default_value' => '#ff600a',
						'description'   => __( 'A normal, visited and unvisited link color. Do not edit this field to use default theme styling.', 'cardealer' ),
						'custom_html'   => '',
						'is_reset'      => true
					),
					'footer_widget_link_hover_color'  => array(
						'title'         => __( 'Mouseover Link Color', 'cardealer' ),
						'type'          => 'color',
						'default_value' => '#ff600a',
						'description'   => __( 'A link when the user mouses over it. Do not edit this field to use default theme styling.', 'cardealer' ),
						'custom_html'   => '',
						'is_reset'      => true
					),

				)
			)
		)
	)
);

$child_sections['styling_footer'] = array(
	'name'     => __( 'Footer Styling', 'cardealer' ),
	'sections' => array(
		'block1' => array(
			'title' => __( 'General Styles', 'cardealer' ),
			'type'  => 'items_block',
			'items' => array(
				'footer_bg'        => array(
					'title'         => __( 'Footer Background Color', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#4e5256',
					'description'   => __( 'Footer area background color. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				),
				'footer_brd_size'  => array(
					'title'         => __( 'Footer Borders Width', 'cardealer' ),
					'type'          => 'slider',
					'default_value' => 1,
					'min'           => 0,
					'max'           => 5,
					'description'   => __( 'Footer borders width in pixels. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				),
				'footer_brd_color' => array(
					'title'         => __( 'Footer Borders Color', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#696969',
					'description'   => __( 'Footer borders color. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				),
			)
		),
		'block2' => array(
			'title' => __( 'Text Styles', 'cardealer' ),
			'type'  => 'items_block',
			'items' => array(
				'footer_text_color'       => array(
					'title'         => __( 'Color', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#b0b0b0',
					'description'   => __( 'Footer text color. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				),
				'footer_link_color'       => array(
					'title'         => __( 'Normal Link Color', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#ff600a',
					'description'   => __( 'A normal, visited and unvisited link color. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				),
				'footer_link_hover_color' => array(
					'title'         => __( 'Mouseover Link Color', 'cardealer' ),
					'type'          => 'color',
					'default_value' => '#ff600a',
					'description'   => __( 'A link when the user mouses over it. Do not edit this field to use default theme styling.', 'cardealer' ),
					'custom_html'   => '',
					'is_reset'      => true
				)
			)
		)
	)
);

$sections = array(
	'name'              => __( 'Styling', 'cardealer' ),
	'css_class'         => 'shortcut-styling',
	'show_general_page' => true,
	'content'           => $content,
	'child_sections'    => $child_sections,
	'menu_icon'         => 'dashicons-welcome-write-blog'
);

TMM_OptionsHelper::$sections[ $tab_key ] = $sections;


