<?php


$sections[] = array(
	'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_086_display.png',
	'title' => __('Layout', 'ct_theme'),
	'group' => __("Style", 'ct_theme'),
	'fields' => array(
		array(
			'id' => 'style_menu_shadow',
			'title' => __("Add menu shadow?", 'ct_theme'),
			'type' => 'select',
			'options' => array('yes' => __('yes', "ct_theme"), 'no' => __('no', "ct_theme"),),
			'std' => 'no'
		),
		array(
			'id' => 'style_layout_boxed',
			'title' => __("Use boxed layout?", 'ct_theme'),
			'type' => 'select',
			'options' => array('yes' => __('yes', "ct_theme"), 'no' => __('no', "ct_theme"),),
			'std' => 'no'
		),
		array(
			'id' => 'style_layout_background',
			'title' => __("Global background pattern", 'ct_theme'),
			'type' => 'select',
			'options' => array(
				'patnone' => __('none', "ct_theme"),
				'pat0' => __('default', "ct_theme"),
				'pat1' => __('pattern 1', "ct_theme"),
				'pat2' => __('pattern 2', "ct_theme"),
				'pat3' => __('pattern 3', "ct_theme"),
				'pat4' => __('pattern 4', "ct_theme"),
				'pat5' => __('pattern 5', "ct_theme"),
				'pat6' => __('pattern 6', "ct_theme"),
			),
			'std' => 'pat13'
		),
	)
);


$sections[] = array(
	'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_100_font.png',
	'title' => __('Font', 'ct_theme'),
	'group' => __("Style", 'ct_theme'),
	'fields' => array(
		array(
			'id' => 'style_font_style',
			'title' => __("Font style", 'ct_theme'),
			'type' => 'google_webfonts',
			'options' => array('google_webfonts',
            )
		),

		array(
			'id' => 'style_font_size',
			'type' => 'text',
			'std' => '16',
			'title' => __('Default font size (px)', 'ct_theme'),
		),
		array(
			'id' => 'style_font_size_h1',
			'type' => 'text',
			'std'=>50,
			'title' => __('H1 font size (px)', 'ct_theme'),
		),
		array(
			'id' => 'style_font_size_h2',
			'type' => 'text',
			'std'=>24,
			'title' => __('H2 font size (px)', 'ct_theme'),
		), array(
			'id' => 'style_font_size_h3',
			'type' => 'text',
			'std'=>17,
			'title' => __('H3 font size (px)', 'ct_theme'),
		),
		array(
			'id' => 'style_font_size_h4',
			'type' => 'text',
			'std'=>14,
			'title' => __('H4 font size (px)', 'ct_theme'),
		),
		array(
			'id' => 'style_font_size_h5',
			'type' => 'text',
			'std'=>14,
			'title' => __('H5 font size (px)', 'ct_theme'),
		),
		array(
			'id' => 'style_font_size_h6',
			'type' => 'text',
			'std'=>14,
			'title' => __('H6 font size (px)', 'ct_theme'),
		)
	)
);

$sections[] = array(
	'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_091_adjust.png',
	'title' => __('Color', 'ct_theme'),
	'desc' => __(sprintf("To setup colors please use built-in Wordpress Theme Customizer available %s", '<a href="' . admin_url('customize.php') . '">' . __('here', 'ct_theme') . '</a>'), 'ct_theme'),
	'group' => __("Style", 'ct_theme'),
	'fields' => array()
);