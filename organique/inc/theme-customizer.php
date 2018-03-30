<?php
/**
 * Contains methods for customizing the theme customization screen.
 *
 * @package Organique
 * @link http://codex.wordpress.org/Theme_Customization_API
 */
class Organique_Customize {

	/**
	* This hooks into 'customize_register' (available as of WP 3.4) and allows
	* you to add new sections and controls to the Theme Customize screen.
	*
	* Note: To enable instant preview, we have to actually write a bit of custom
	* javascript. See live_preview() for more.
	*
	* @see add_action('customize_register',$func)
	*/
	public static function register ( $wp_customize ) {
		/**
		 * Settings
		 */

		// styles
		$wp_customize->add_setting( 'theme_primary_clr', array( 'default' => '#71a866' ) );
		$wp_customize->add_setting( 'theme_secondary_clr', array( 'default' => '#413c35' ) );
		$wp_customize->add_setting( 'theme_tertiary_clr', array( 'default' => '#fe6e3a' ) );
		$wp_customize->add_setting( 'navbar_color', array( 'default' => '#ffffff' ) );
		$wp_customize->add_setting( 'footer_secondary_clr', array( 'default' => '#4b463f' ) );

		$wp_customize->add_setting( 'logo_img', array( 'default' => '%s/assets/images/logo.png' ) );
		$wp_customize->add_setting( 'favicon', array( 'default' => '%s/assets/images/favicon.png' ) );
		// $wp_customize->add_setting( 'boxed', array( 'default' => 'no' ) );
		// $wp_customize->add_setting( 'bg_pattern', array( 'default' => '' ) );

		// titles
		$wp_customize->add_setting( 'blog_tagline', array( 'default' => 'This is an Organique blog where smart people write even smarter things :)' ) );

		// front page titles
		$wp_customize->add_setting( 'front_lead', array( 'default' => 'Awesome oppurtunity to save a lof of money on' ) );
		$wp_customize->add_setting( 'front_title', array( 'default' => 'FRESH ORGANIC FOOD' ) );

		// front page appearance
		$wp_customize->add_setting( 'front_bg_pattern', array( 'default' => 'pattern-1' ) );
		$wp_customize->add_setting( 'front_bg_pattern_custom', array( 'default' => '' ) );

		// front page carousel
		$wp_customize->add_setting( 'front_carousel_interval', array( 'default' => '5000' ) );

		// front page buttons
		$wp_customize->add_setting( 'front_btn_1_txt', array( 'default' => 'Buy theme' ) );
		$wp_customize->add_setting( 'front_btn_1_link', array( 'default' => 'http://www.proteusthemes.com' ) );
		$wp_customize->add_setting( 'front_btn_1_style', array( 'default' => 'warning' ) );
		$wp_customize->add_setting( 'front_btn_1_blank', array( 'default' => 'no' ) );

		$wp_customize->add_setting( 'front_btn_2_txt', array( 'default' => 'More details' ) );
		$wp_customize->add_setting( 'front_btn_2_link', array( 'default' => 'http://www.proteusthemes.com' ) );
		$wp_customize->add_setting( 'front_btn_2_style', array( 'default' => 'jumbotron' ) );
		$wp_customize->add_setting( 'front_btn_2_blank', array( 'default' => 'no' ) );

		// layout
		$wp_customize->add_setting( 'products_per_page', array( 'default' => '15' ) );
		$wp_customize->add_setting( 'sale_stamp_text', array( 'default' => 'Sale!' ) );
		$wp_customize->add_setting( 'single_product_sidebar', array( 'default' => 'no' ) );
		$wp_customize->add_setting( 'fixed_static_nav', array( 'default' => 'static' ) );

		// footer and other
		$wp_customize->add_setting( 'footer_left', array( 'default' => '&copy; Copyright 2015' ) );
		$wp_customize->add_setting( 'footer_right', array( 'default' => 'Organique Theme by <a href="http://www.proteusthemes.com">ProteusThemes</a>' ) );

		// google_maps
		$wp_customize->add_setting( 'map_type', array( 'default' => 'ROADMAP' ) );
		$wp_customize->add_setting( 'map_style', array( 'default' => '[{"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":-25},{"saturation":-100}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]}]' ) );
		$wp_customize->add_setting( 'zoom_level', array( 'default' => 7 ) );
		$wp_customize->add_setting( 'google_maps_api_key' );

		/**
		 * Sections
		 */
		$wp_customize->add_section( 'customizer_appearance', array(
			'title'       => _x( 'Appearance', 'backend', 'organique_wp' ),
			'description' => _x( 'Appearance for the Organique theme', 'backend', 'organique_wp' ),
			'priority'    => 30
		) );
		$wp_customize->add_section( 'customizr_front_page', array(
			'title'       => _x( 'Front Page', 'backend', 'organique_wp' ),
			'description' => _x( 'Settings for the front page display', 'backend', 'organique_wp' ),
			'priority'    => 35
		) );
		$wp_customize->add_section( 'customizer_shop', array(
			'title'       => _x( 'Shop', 'backend', 'organique_wp' ),
			'description' => _x( 'Settings for shop and related pages', 'backend', 'organique_wp' ),
			'priority'    => 40
		) );
		$wp_customize->add_section( 'google_maps', array(
			'title'       => _x( 'Google Maps', 'backend', 'organique_wp' ),
			'description' => _x( 'Settings for Google Maps', 'backend', 'organique_wp' ),
			'priority'    => 150
		) );
		$wp_customize->add_section( 'customizer_other', array(
			'title'       => _x( 'Footer &amp; Other', 'backend', 'organique_wp' ),
			'description' => _x( 'Other settings', 'backend', 'organique_wp' ),
			'priority'    => 160
		) );



		/**
		 * Controls
		 */

		// Section: title_tagline
		$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'organique_blog_tagline',
			array(
				'label'    => _x( 'Blog Tagline', 'backend', 'organique_wp' ),
				'section'  => 'title_tagline',
				'settings' => 'blog_tagline',
			)
		) );

		// Section: customizer_appearance
		$wp_customize->add_control( new WP_Customize_Image_Control(
			$wp_customize,
			'organique_logo_img',
			array(
				'label'    => _x( 'Logo image (recommended dimensions: 200 x 90)', 'backend', 'organique_wp' ),
				'section'  => 'customizer_appearance',
				'settings' => 'logo_img',
			)
		) );
		$wp_customize->add_control( new WP_Customize_Upload_Control(
			$wp_customize,
			'organique_favicon',
			array(
				'label'    => _x( 'Favicon image (16 x 16 px), format .ico', 'backend', 'organique_wp' ),
				'section'  => 'customizer_appearance',
				'settings' => 'favicon',
			)
		) );

		// $wp_customize->add_control( new WP_Customize_Control(
		// 	$wp_customize,
		// 	'organique_boxed',
		// 	array(
		// 		'label'    => _x( 'Boxed or wide version?', 'backend', 'organique_wp' ),
		// 		'section'  => 'customizer_appearance',
		// 		'settings' => 'boxed',
		// 		'type'     => 'radio',
		// 		'choices'  => array(
		// 			'no'  => _x( 'Wide', 'backend', 'organique_wp' ),
		// 			'yes' => _x( 'Boxed', 'backend', 'organique_wp' )
		// 		)
		// 	)
		// ) );

		// customizr_front_page
		$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'organique_front_lead',
			array(
				'label'    => _x( 'Lead for front page', 'backend', 'organique_wp'),
				'section'  => 'customizr_front_page',
				'settings' => 'front_lead',
				'priority' => 10,
			)
		) );
		$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'organique_front_title',
			array(
				'label'    => _x( 'Title for front page', 'backend', 'organique_wp'),
				'section'  => 'customizr_front_page',
				'settings' => 'front_title',
				'priority' => 20,
			)
		) );
		$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'organique_front_bg_pattern',
			array(
				'label'    => _x( 'Pattern for the background', 'backend', 'organique_wp'),
				'section'  => 'customizr_front_page',
				'settings' => 'front_bg_pattern',
				'type'     => 'select',
				'priority' => 22,
				'choices'  => array(
					'pattern-1' => _x( 'Pattern 1', 'backend', 'organique_wp'),
					'pattern-2' => _x( 'Pattern 2', 'backend', 'organique_wp'),
					'pattern-3' => _x( 'Pattern 3', 'backend', 'organique_wp'),
					'pattern-4' => _x( 'Pattern 4', 'backend', 'organique_wp'),
					'pattern-5' => _x( 'Pattern 5', 'backend', 'organique_wp'),
				)
			)
		) );
		$wp_customize->add_control( new WP_Customize_Image_Control(
			$wp_customize,
			'organique_front_bg_pattern_custom',
			array(
				'label'    => _x( 'Upload custom pattern for the background', 'backend', 'organique_wp'),
				'section'  => 'customizr_front_page',
				'settings' => 'front_bg_pattern_custom',
				'priority' => 23,
			)
		) );

		// carousel
		$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'organique_front_carousel_interval',
			array(
				'label'    => _x( 'Slider interval (in miliseconds, 1s = 1000ms)', 'backend', 'organique_wp'),
				'section'  => 'customizr_front_page',
				'settings' => 'front_carousel_interval',
				'priority' => 25,
			)
		) );

		// btn_1
		$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'organique_front_btn_1_txt',
			array(
				'label'    => _x( 'Text for button 1', 'backend', 'organique_wp'),
				'section'  => 'customizr_front_page',
				'settings' => 'front_btn_1_txt',
				'priority' => 30,
			)
		) );
		$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'organique_front_btn_1_link',
			array(
				'label'    => _x( 'Link for button 1', 'backend', 'organique_wp'),
				'section'  => 'customizr_front_page',
				'settings' => 'front_btn_1_link',
				'priority' => 32,
			)
		) );
		$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'organique_front_btn_1_style',
			array(
				'label'    => _x( 'Style for button 1', 'backend', 'organique_wp'),
				'section'  => 'customizr_front_page',
				'settings' => 'front_btn_1_style',
				'type'     => 'select',
				'priority' => 34,
				'choices'  => array(
					'jumbotron' => _x( 'Default', 'backend', 'organique_wp'),
					'warning'   => _x( 'Warning', 'backend', 'organique_wp'),
				)
			)
		) );
		$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'organique_front_btn_1_blank',
			array(
				'label'    => _x( 'Open button 1 in a new page?', 'backend', 'organique_wp'),
				'section'  => 'customizr_front_page',
				'settings' => 'front_btn_1_blank',
				'type'     => 'select',
				'priority' => 36,
				'choices'  => array(
					'no'  => _x( 'No', 'backend', 'organique_wp'),
					'yes' => _x( 'Yes', 'backend', 'organique_wp'),
				)
			)
		) );
		// btn_2
		$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'organique_front_btn_2_txt',
			array(
				'label'    => _x( 'Text for button 2', 'backend', 'organique_wp'),
				'section'  => 'customizr_front_page',
				'settings' => 'front_btn_2_txt',
				'priority' => 40,
			)
		) );
		$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'organique_front_btn_2_link',
			array(
				'label'    => _x( 'Link for button 2', 'backend', 'organique_wp'),
				'section'  => 'customizr_front_page',
				'settings' => 'front_btn_2_link',
				'priority' => 42,
			)
		) );
		$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'organique_front_btn_2_style',
			array(
				'label'    => _x( 'Style for button 2', 'backend', 'organique_wp'),
				'section'  => 'customizr_front_page',
				'settings' => 'front_btn_2_style',
				'type'     => 'select',
				'priority' => 44,
				'choices'  => array(
					'jumbotron' => _x( 'Default', 'backend', 'organique_wp'),
					'warning'   => _x( 'Warning', 'backend', 'organique_wp'),
				)
			)
		) );
		$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'organique_front_btn_2_blank',
			array(
				'label'    => _x( 'Open button 2 in a new page?', 'backend', 'organique_wp'),
				'section'  => 'customizr_front_page',
				'settings' => 'front_btn_2_blank',
				'type'     => 'select',
				'priority' => 46,
				'choices'  => array(
					'no'  => _x( 'No', 'backend', 'organique_wp'),
					'yes' => _x( 'Yes', 'backend', 'organique_wp'),
				)
			)
		) );

		// customizer_shop
		if( is_woocommerce_active() ) {
			$wp_customize->add_control( new WP_Customize_Control(
				$wp_customize,
				'organique_products_per_page',
				array(
					'label'    => _x( 'Number of products per page', 'backend', 'organique_wp' ),
					'section'  => 'customizer_shop',
					'settings' => 'products_per_page',
				)
			) );
			$wp_customize->add_control( new WP_Customize_Control(
				$wp_customize,
				'organique_sale_stamp_text',
				array(
					'label'    => _x( 'Sale stamp text', 'backend', 'organique_wp' ),
					'section'  => 'customizer_shop',
					'settings' => 'sale_stamp_text',
				)
			) );
			$wp_customize->add_control( new WP_Customize_Control(
				$wp_customize,
				'webmarket_single_product_sidebar',
				array(
					'label'    => _x( 'Show sidebar on single product page', 'backend', 'organique_wp'),
					'section'  => 'customizer_shop',
					'settings' => 'single_product_sidebar',
					'type'     => 'select',
					'choices'  => array(
						'no'    => _x( 'No', 'backend', 'organique_wp'),
						'left'  => _x( 'Left', 'backend', 'organique_wp'),
						'right' => _x( 'Right', 'backend', 'organique_wp'),
					)
				)
			) );
		}

		// Section: nav
		$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'webmarket_fixed_static_nav',
			array(
				'label'    => _x( 'Fixed or static nav bar?', 'backend', 'organique_wp'),
				'section'  => 'customizer_appearance',
				'settings' => 'fixed_static_nav',
				'type'     => 'select',
				'choices'  => array(
					'static' => _x( 'Static', 'backend', 'organique_wp'),
					'fixed'  => _x( 'Fixed', 'backend', 'organique_wp'),
				)
			)
		) );

		// Section: colors
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize,
			'organique_theme_primary_clr',
			array(
				'label'    => _x( 'Primary theme color', 'backend', 'organique_wp' ),
				'section'  => 'colors',
				'settings' => 'theme_primary_clr',
			)
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize,
			'organique_theme_secondary_clr',
			array(
				'label'    => _x( 'Secondary theme color', 'backend', 'organique_wp' ),
				'section'  => 'colors',
				'settings' => 'theme_secondary_clr',
			)
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize,
			'organique_theme_tertiary_clr',
			array(
				'label'    => _x( 'Tertiary theme color', 'backend', 'organique_wp' ),
				'section'  => 'colors',
				'settings' => 'theme_tertiary_clr',
			)
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize,
			'organique_navbar_color',
			array(
				'label'    => _x( 'Navbar background color', 'backend', 'organique_wp' ),
				'section'  => 'colors',
				'settings' => 'navbar_color',
			)
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize,
			'organique_footer_secondary_clr',
			array(
				'label'    => _x( 'Footer secondary color', 'backend', 'organique_wp' ),
				'section'  => 'colors',
				'settings' => 'footer_secondary_clr',
			)
		) );


		// google maps
		$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'organique_map_type',
			array(
				'label'    => _x( 'Type of Google Maps', 'backend', 'organique_wp'),
				'section'  => 'google_maps',
				'settings' => 'map_type',
				'type'     => 'radio',
				'choices'  => array(
					'ROADMAP'   => _x( 'Normal map', 'backend', 'organique_wp'),
					'SATELLITE' => _x( 'Satellite', 'backend', 'organique_wp'),
					'HYBRID'    => _x( 'Hybrid', 'backend', 'organique_wp'),
					'TERRAIN'   => _x( 'Terrain', 'backend', 'organique_wp'),
				)
			)
		) );
		$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'organique_map_style',
			array(
				'label'    => _x( 'Style of Google Maps (only for Normal map)', 'backend', 'organique_wp'),
				'section'  => 'google_maps',
				'settings' => 'map_style',
				'type'     => 'select',
				'choices'  => array(
					'[]' => _x( 'Default', 'backend', 'organique_wp'),
					'[{"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":-25},{"saturation":-100}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]}]' => _x( 'Subtle Grayscale', 'backend', 'organique_wp'),
					'[{"featureType":"water","stylers":[{"color":"#46bcec"},{"visibility":"on"}]},{"featureType":"landscape","stylers":[{"color":"#f2f2f2"}]},{"featureType":"road","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"transit","stylers":[{"visibility":"off"}]},{"featureType":"poi","stylers":[{"visibility":"off"}]}]' => _x( 'Blue water', 'backend', 'organique_wp'),
					'[{"featureType":"administrative","stylers":[{"visibility":"off"}]},{"featureType":"poi","stylers":[{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"simplified"}]},{"featureType":"water","stylers":[{"visibility":"simplified"}]},{"featureType":"transit","stylers":[{"visibility":"simplified"}]},{"featureType":"landscape","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"visibility":"off"}]},{"featureType":"road.local","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"water","stylers":[{"color":"#84afa3"},{"lightness":52}]},{"stylers":[{"saturation":-17},{"gamma":0.36}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"color":"#3f518c"}]}]' => _x( 'Retro', 'backend', 'organique_wp'),
					'[{"featureType":"water","elementType":"geometry","stylers":[{"color":"#a2daf2"}]},{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"color":"#f7f1df"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"color":"#d0e3b4"}]},{"featureType":"landscape.natural.terrain","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#bde6ab"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi.medical","elementType":"geometry","stylers":[{"color":"#fbd3da"}]},{"featureType":"poi.business","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffe15f"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#efd151"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"color":"black"}]},{"featureType":"transit.station.airport","elementType":"geometry.fill","stylers":[{"color":"#cfb2db"}]}]' => _x( 'Apple Maps-esque', 'backend', 'organique_wp'),
					'[{"featureType":"water","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#aee2e0"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"color":"#abce83"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#769E72"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#7B8758"}]},{"featureType":"poi","elementType":"labels.text.stroke","stylers":[{"color":"#EBF4A4"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#8dab68"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#5B5B3F"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ABCE83"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#A4C67D"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#9BBF72"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#EBF4A4"}]},{"featureType":"transit","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"visibility":"on"},{"color":"#87ae79"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#7f2200"},{"visibility":"off"}]},{"featureType":"administrative","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"},{"visibility":"on"},{"weight":4.1}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#495421"}]},{"featureType":"administrative.neighborhood","elementType":"labels","stylers":[{"visibility":"off"}]}]' => _x( 'Avocado World', 'backend', 'organique_wp'),
				)
			)
		) );

		// helper function
		function zoom_levels() {
			$arr = array();
			for ($i=1; $i < 25; $i++) {
				$arr["{$i}"] = "{$i}";
			}
			return $arr;
		}
		$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'organique_zoom_level',
			array(
				'label'    => _x( 'Zoom of Google Maps (more is closer view)', 'backend', 'organique_wp'),
				'section'  => 'google_maps',
				'settings' => 'zoom_level',
				'type'     => 'select',
				'choices'  => zoom_levels()
			)
		) );

		$wp_customize->add_control( 'google_maps_api_key', array(
			'type'        => 'text',
			'label'       => esc_html__( 'Google maps API key', 'organique_wp' ),
			'description' => sprintf( esc_html__( 'Input the Google maps API key in order for maps to start working. %sGet your API key%s.', 'organique_wp' ), '<a href="https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key" target="_blank">', '</a>' ),
			'section'     => 'google_maps',
		) );

		// customizer_other
		$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'organique_footer_left',
			array(
				'label'    => _x( 'Footer left HTML', 'backend', 'organique_wp'),
				'section'  => 'customizer_other',
				'settings' => 'footer_left',
				'type'     => 'text',
			)
		) );
		$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'organique_footer_right',
			array(
				'label'    => _x( 'Footer right HTML', 'backend', 'organique_wp'),
				'section'  => 'customizer_other',
				'settings' => 'footer_right',
				'type'     => 'text',
			)
		) );
	}


	/**
	* This will output the custom WordPress settings to the live theme's WP head.
	*
	* Used by hook: 'wp_head'
	*
	* @see add_action('wp_head',$func)
	*/
	public static function customizer_styles() {
		// customizer settings
		$theme_mods    = get_theme_mod( 'organique' );
		$primary_color = get_theme_mod( 'theme_primary_clr', '#71a866' );
		$secondary_color = get_theme_mod( 'theme_secondary_clr', '#413c35' );
		$tertiary_color = get_theme_mod( 'theme_tertiary_clr', '#fe6e3a' );
		$navbar_color = get_theme_mod( 'navbar_color', '#ffffff' );
		$footer_color = get_theme_mod( 'footer_secondary_clr', '#4b463f' );

		ob_start();

		if ( ! empty( $primary_color ) ) : ?>

/* WP Customizer */

/******************
Primary theme color
*******************/

a, .secondary-link, .secondary-link:hover, .primary-color, .navbar-default .navbar-nav > .active > a:hover, .glyphicon-search--nav, .nav-blog a, .header-cart:hover, .header-cart:hover .header-cart__text--price, .btn-primary--transition:hover, .btn-primary--reverse-transition, .btn-shop:hover, .table-theme tr.active td, .pagination .active a:hover, .pagination .active a, .pagination .page-numbers:hover, .pagination .page-numbers.next:hover, .pagination .page-numbers.prev:hover, .opening-time .week-day.today, .products__price, .dot-stock-success, .products__price--widgets, .page-not-found .page-not-found__link, .single-product__price, .star-on, .quantity .quantity__input, .blog .blog__comments-link, .shop__amount-filter__link:hover, div.woocommerce .quantity [type="number"], div.woocommerce .meta ins, div.woocommerce .tag .amount, .single_variation .price > .amount, .single_variation ins, .commentlist .star-rating, .navbar-default .navbar-nav > li:hover > a, .pagination .current, .sidebar .widget_nav_menu .dropdown-menu > .active > a, .sidebar .widget_nav_menu .dropdown-menu a, .tagcloud a {
	color: <?php echo $primary_color; ?>;
}

.header .navbar-toggle.collapsed, .search-panel, .search-panel__form .form-control, .search-panel__form .form-control:focus, .header-cart:after, .header-cart__items:after, .header-cart__open-cart, .alert-success, .alert-primary, .btn-primary--transition, .btn-primary--reverse-transition:hover, .progress .progress-bar--success, .pagination .page-numbers.next, .pagination .page-numbers.prev, .nav-sidebar-menu > li.active a:before, .nav-sidebar-menu > li > a:hover:before, .product-overlay__cart, .motivational-stories .motivational-stories__circle, .page-not-found .page-not-found__background, .shop__filter__slider .ui-slider-range, div.woocommerce .single_add_to_cart_button, .widget_price_filter .ui-slider-range, .button.checkout-button, .navbar-default .navbar-nav > li > a:after, .btn-primary {
	background-color: <?php echo $primary_color; ?>;
}

@media (min-width: 992px) {
	.navbar-default .dropdown-menu > li > a {
		background-color: <?php echo $primary_color; ?>;
	}
}

.navbar-default .navbar-nav > li:hover .caret {
	border-top-color: <?php echo $primary_color; ?> !important;
}

.navbar-default .navbar-nav > li:hover .caret {
	border-bottom-color: <?php echo $primary_color; ?>;
}

.header-cart__items:before, .pagination .page-numbers.next, .pagination .page-numbers.prev, div.woocommerce .single_add_to_cart_button, .tagcloud a {
	border-color: <?php echo $primary_color; ?>;
}

a:hover, .sidebar .widget_nav_menu .dropdown-menu a:hover, .tagcloud a:hover {
	color: <?php echo darken_css_color($primary_color, 10); ?>;
}

.navbar-default .dropdown-menu > li:hover > a, .btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, div.woocommerce .single_add_to_cart_button:hover, .header-cart__product:hover {
	background-color: <?php echo darken_css_color($primary_color, 10); ?>;
}

.navbar-default .dropdown-menu > li > a, .navbar-default .dropdown-menu, div.woocommerce .single_add_to_cart_button:hover, .tagcloud a:hover, .header-cart__product:hover, .header-cart__divider {
	border-color: <?php echo darken_css_color($primary_color, 10); ?>;
}

.banners-big {
	background: url('<?php echo get_template_directory_uri(); ?>/assets/images/noise_pattern.png'), -webkit-gradient(linear, left top, right top, from(<?php echo darken_css_color($primary_color, 15); ?>), color-stop(50%, <?php echo $primary_color; ?>), to(<?php echo darken_css_color($primary_color, 15); ?>));
	background: url('<?php echo get_template_directory_uri(); ?>/assets/images/noise_pattern.png'), -webkit-linear-gradient(left, <?php echo darken_css_color($primary_color, 15); ?> 0%, <?php echo $primary_color; ?> 50%, <?php echo darken_css_color($primary_color, 15); ?> 100%);
	background: url('<?php echo get_template_directory_uri(); ?>/assets/images/noise_pattern.png'), linear-gradient(to right, <?php echo darken_css_color($primary_color, 15); ?> 0%, <?php echo $primary_color; ?> 50%, <?php echo darken_css_color($primary_color, 15); ?> 100%);
}

/******************
Secondary theme color
*******************/

body, h1, h2, h3, h4, h5, h6, h2 a, h2 a:hover, h3 a, h3 a:hover, .text, .text-dark, .secondary-color, .navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > li > a, .header-cart__text--price, .header-cart__qty, .header-cart__subtotal, .banners-box:hover, .banners-small--social .social:hover, .banners-small--social .social:hover .zocial-pinterest, .banners-small--social .social:hover .zocial-twitter, .banners-small--social .social:hover .zocial-facebook, .banners-small--social .social:hover .zocial-email, .nav-tabs > li > a:hover, .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus, .btn-darker--transition:hover, .btn-darker--reverse-transition, .btn-jumbotron:hover, .table-theme > thead > tr > th, .table > thead > tr > th, .panel-link, .pagination, .pagination .page-numbers, .social-container:hover > span, .opening-time .week-day, .opening-time .opening-time__title, .nav-sidebar-menu > li.active a, .nav-sidebar-menu > li > a:hover, .products-navigation__arrows .glyphicon-circle:hover, .product-overlay__cart:hover, .products__title a, .testimonials .testimonials__text, .testimonials .glyphicon-circle:hover, .comment-content--nested .comment-author, .comment-content--nestedx2 .comment-author, .comment-content .comment-author, .comment-content--nested .comment-text, .comment-content--nestedx2 .comment-text, .comment-content .comment-text, .quantity .quantity__button, .blog__date, .blog-content__text, .woocommerce .input-text, .shop__amount-filter__link, .nav--filter > li > a, .woocommerce-ordering .orderby, div.woocommerce .product-remove a, div.woocommerce .quantity.buttons_added .minus, div.woocommerce .quantity.buttons_added .plus, div.woocommerce .variations .value select, .cart-empty, pre, .text-highlight, body .su-tabs-nav span.su-tabs-current, body .su-tabs-nav span:hover {
	color: <?php echo $secondary_color; ?>;
}

.top, .top .dropdown-menu > li > a, .header .navbar-toggle, .breadcrumbs, .footer-widgets:after, .footer, .banners-medium, .btn-darker, .btn-darker--transition, .btn-darker--reverse-transition:hover, .progress .progress-bar--even-more-dark, .product-overlay__stock {
	background-color: <?php echo $secondary_color; ?>;
}

.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus, body .su-tabs-nav span.su-tabs-current, body .su-tabs-nav span:hover, .nav-tabs > li > a:hover, .top .dropdown-menu > li > a {
	border-bottom-color: <?php echo $secondary_color; ?>;
}

.top .dropdown-menu > li > a:hover {
	background-color: <?php echo darken_css_color($secondary_color, 10); ?>;
}

/******************
Tertiary theme color
*******************/

.tertiary-color, .warning, .footer a:hover, .footer .footer__text .glyphicon-heart, .footer__link:hover, .btn-warning--transition:hover, .btn-warning--reverse-transition, .available-soon, .woocommerce .required {
	color: <?php echo $tertiary_color; ?>;
}

a:active, .alert-warning, .btn-warning--transition, .btn-warning--reverse-transition:hover, .progress .progress-bar--warning, div.woocommerce .product .stamp, #submit, #searchsubmit, .button, #submitWPComment, .btn-warning {
	background-color: <?php echo $tertiary_color; ?>;
}

.button, #searchsubmit, #submit {
	border-color: <?php echo $tertiary_color; ?>;
}

.btn-warning:hover, #submitWPComment:hover, .button:hover, #searchsubmit:hover, #submit:hover {
	background-color: <?php echo darken_css_color($tertiary_color, 10); ?>;
}

.button:hover, #searchsubmit:hover, #submit:hover {
	border-color: <?php echo darken_css_color($tertiary_color, 10); ?>;
}

/******************
Seconday footer theme color
*******************/

.footer-widgets, .footer-widgets .footer-widgets__heading {
	background-color: <?php echo $footer_color; ?>;
}
<?php
if ( '#ffffff' !== $navbar_color ) : ?>

/******************
Header color
*******************/

.header {
	background: <?php echo $navbar_color; ?>
}

		<?php
		endif; // '#ffffff' !== $navbar_color
		endif;

		echo "/* User Custom CSS */" . PHP_EOL;
		echo ot_get_option( 'user_custom_css', '' );
		/*end of output*/

		$style = ob_get_contents();
		ob_end_clean();

		wp_add_inline_style( 'main', $style );
	}

	/**
	 * Outputs the favicon
	 */
	public static function header_output() {
		$favicon = get_theme_mod( 'favicon', get_template_directory_uri() . '/assets/images/favicon.png' );

		if( ! empty( $favicon ) ) : ?>
		<link rel="shortcut icon" href="<?php echo $favicon; ?>">
		<?php endif;
	}
}

//Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'Organique_Customize', 'register' ) );

//Output custom CSS to live site
add_action( 'wp_enqueue_scripts' , array( 'Organique_Customize', 'customizer_styles' ), 20 );
add_action( 'wp_head' , array( 'Organique_Customize', 'header_output' ) );
