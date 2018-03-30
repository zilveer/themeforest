<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$home_header_type  = array(
	'standard' => __( 'Standard', 'wolf' ),
	'video' => __( 'Video background', 'wolf' ),
	'none' => __( 'No header', 'wolf' ),
);

$rev_sliders_option = array();

if ( class_exists( 'RevSlider' ) ) {
	$home_header_type['revslider'] = 'RevSlider';
	$rev_sliders_option = all_rev_sliders_in_array();
}

$wolf_sliders_option = array();

if ( class_exists( 'Wolf_Slider' ) ) {
	$home_header_type['wolf-slider'] = 'Home Slider';
	$home_header_type['featured-slider'] = __( 'Featured post slider', 'wolf' );

	if ( post_type_exists( 'slide' ) ) {
		$wolf_sliders_option = array();
		$wolf_sliders_args = array(
			'taxonomy'     => 'slide_category',
			'orderby'      => 'slug',
			'show_count'   => 0,
			'pad_counts'   => 0,
			'hierarchical' => 0,
			'title_li'     => '',
		);

		$wolf_sliders = get_categories( $wolf_sliders_args );

		if ( array() != $wolf_sliders ) {
			foreach ( $wolf_sliders as $slider ) {
				//var_dump($slider);
				$wolf_sliders_option[$slider->slug] = $slider->name;
			}
		} else {
			$wolf_sliders_option = array( '' => __( 'No slider yet', 'wolf' ) );
		}
	}
}

$wolf_theme_options[] = array(
	'type' => 'open',
	'label' => __( 'Home', 'wolf' ),
);

	$wolf_theme_options[] = array(
		'label' => __( 'Home header settings', 'wolf' ),
 		'type' => 'section_open',
 		'desc' => __( 'What to display if you use the "Home" template', 'wolf' ),
	);

		$wolf_theme_options[] = array(
			'label' => __( 'Home header type', 'wolf' ),
			'desc' => __( 'What do you want to display in your home page header?', 'wolf' ),
			'id' => 'home_header_type',
			'type' => 'select',
			'options' => $home_header_type,
		);

		$wolf_theme_options[] = array(
			'label' => 'Wolf Slider',
			'id' =>'header_wolf_slider',
			'type' => 'select',
			'options' => $wolf_sliders_option,
			'dependency' => array( 'element' => 'home_header_type', 'value' => array( 'wolf-slider' ) ),
		);

		$wolf_theme_options[] = array(
			'label' => 'RevSlider',
			'id' =>'header_revslider',
			'type' => 'select',
			'options' => $rev_sliders_option,
			'dependency' => array( 'element' => 'home_header_type', 'value' => array( 'revslider' ) ),
		);

		$wolf_theme_options[] = array(
			'label' => __( 'Fade header content while scrolling', 'wolf' ),
			'id' =>'hero_fade_while_scroll',
			'type' => 'checkbox',
			'dependency' => array( 'element' => 'home_header_type', 'value' => array( 'standard', 'video' ) ),
		);

		$wolf_theme_options[] = array(
			'label' => __( 'Header effect', 'wolf' ),
			'id' => 'hero_effect',
			'type' => 'select',
			'options' => array(
				'parallax' => __( 'parallax', 'wolf' ),
				'zoom' => __( 'zoom', 'wolf' ),
				'' => __( 'none', 'wolf' ),
			),
			'dependency' => array( 'element' => 'home_header_type', 'value' => array( 'standard' ) ),
			'desc' => __( 'The zoom effect only applies to the "standard" header type (image background). Note the the background position option is disabled with the zoom effect.', 'wolf' ),
		);

		$wolf_theme_options[] = array(
			'label' => __( 'Header font color', 'wolf' ),
			'id' =>'header_bg_font_color',
			'type' => 'select',
			'options' => array(
				'light' => __( 'light', 'wolf' ),
				'dark' => __( 'dark', 'wolf' ),
			),
		);

		// $wolf_theme_options[] = array(
		// 	'label' => __( 'Header Parallax', 'wolf' ),
		// 	'id' =>'hero_parallax',
		// 	'type' => 'checkbox',
		// 	'dependency' => array( 'element' => 'home_header_type', 'value' => array( 'standard', 'video', 'wolf-slider', 'featured-slider' ) ),
		// );

		// $wolf_theme_options[] = array(
		// 	'label' => __( 'Header Zoom Effect', 'wolf' ),
		// 	'id' =>'hero_zoom',
		// 	'type' => 'checkbox',
		// 	'dependency' => array( 'element' => 'home_header_type', 'value' => array( 'standard' ) ),
		// );

		$wolf_theme_options[] = array(
			'label' => __( 'Content editor', 'wolf' ),
			'desc' => __( 'Any content to display in the home page header: text, HTML, shortcodes...', 'wolf' ),
			'id' => 'home_header_content',
			'type' => 'editor',
			'dependency' => array( 'element' => 'home_header_type', 'value' => array( 'standard', 'video' ) ),
		);

	$wolf_theme_options[] = array( 'type' => 'section_close' );

	$wolf_theme_options[] = array(
		'label' => __( 'Home header window', 'wolf' ),
 		'type' => 'section_open',
 		'dependency' => array( 'element' => 'home_header_type', 'value' => array( 'wolf-slider', 'standard', 'video', 'featured-slider' ) ),
	);

		$wolf_theme_options[] = array(
			'label' => __( 'Full window', 'wolf' ),
			'id' =>'full_screen_header',
			'type' => 'select',
			'options' => array(
				'yes' => __( 'Yes', 'wolf' ),
				''   => __( 'No', 'wolf' ),
			),

		);

		$wolf_theme_options[] = array(
			'label' => __( 'Header height', 'wolf' ),
			'id' =>'home_header_height',
			'desc' => __( 'The header height in percent', 'wolf' ),
			'type' => 'int',
			'dependency' => array( 'element' => 'full_screen_header', 'value' => array( '' ) ),
		);

		$wolf_theme_options[] = array(
			'label' => __( 'Scroll down arrow', 'wolf' ),
			'id' =>'scroll_down_arrow',
			'type' => 'checkbox',
			'desc' => __( 'Will not be display on sliders', 'wolf' ),
			'dependency' => array( 'element' => 'full_screen_header', 'value' => array( 'yes' ) ),
		);

	$wolf_theme_options[] = array( 'type' => 'section_close' );

	if ( class_exists( 'Wolf_Slider' ) ) {
		$wolf_theme_options[] = array(
			'label' => __( 'Featured post slider', 'wolf' ),
	 		'type' => 'section_open',
	 		'dependency' => array( 'element' => 'home_header_type', 'value' => array( 'featured-slider' ) ),
		);

			// $wolf_theme_options[] = array(
			// 	'label' => __( 'Effect', 'wolf' ),
			// 	'id' => 'slider_effect',
			// 	'type' => 'select',
			// 	'options' => array(
			// 		'auto' => __( 'auto (fade on desktop and slide on touchable devices)', 'wolf' ),
			// 		'slide' => 'slide',
			// 		'fade' => 'fade',
			// 	),
			// );

			$wolf_theme_options[] = array(
				'label' => __( 'Speed', 'wolf' ),
				'id' => 'slider_speed',
				'type' => 'text',
			);

			$wolf_theme_options[] = array(
				'label' => __( 'Autoplay', 'wolf' ),
				'id' => 'slider_autoplay',
				'type' => 'checkbox',
			);

			$wolf_theme_options[] = array(
				'label' => __( 'Pause on hover', 'wolf' ),
				'id' => 'slider_pause',
				'type' => 'checkbox',
			);

		$wolf_theme_options[] = array( 'type' => 'section_close' );
	} // end if featured post slider

	$wolf_theme_options[] = array(
		'label' => __( 'Video background', 'wolf' ),
		'id' => 'video_header_bg',
		'type' => 'video',
		'dependency' => array( 'element' => 'home_header_type', 'value' => array( 'video' ) ),
 	);

 	$wolf_theme_options[] = array(
		'label' => __( 'Home header background', 'wolf' ),
		'desc' => __( 'A different header background can be set on each page', 'wolf' ),
		'id' =>'header_bg',
		'type' => 'background',
		'font_color' => false,
		'dependency' => array( 'element' => 'home_header_type', 'value' => array( 'standard' ) ),
	);

	$wolf_theme_options[] = array(
		'label' => __( 'Overlay', 'wolf' ),
 		'type' => 'section_open',
 		'id' => 'header_overlay',
 		'dependency' => array( 'element' => 'home_header_type', 'value' => array( 'standard', 'video', 'featured-slider' ) ),
	);

		$wolf_theme_options[] = array(
			'label' => __( 'Overlay color', 'wolf' ),
			'id' =>'header_overlay_color',
			'type' => 'colorpicker',
		);

		$wolf_theme_options[] = array(
			'label' => __( 'Overlay pattern', 'wolf' ),
			'id' =>'header_overlay_img',
			'type' => 'image',
		);

		$wolf_theme_options[] = array(
			'label' => __( 'Overlay opacity in percent', 'wolf' ),
			// 'desc' => __( 'A different header background can be set on each page', 'wolf' ),
			'id' =>'header_overlay_opacity',
			'type' => 'int',
		);

	$wolf_theme_options[] = array( 'type' => 'section_close' );


$wolf_theme_options[] = array( 'type' => 'close' );
