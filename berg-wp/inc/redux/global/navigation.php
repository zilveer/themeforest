<?php

return array(
	'icon'   => 'el el-icon-lines',
	'title'  => __( 'Navigation', 'BERG' ),
	'fields' => array(
		array(
			'id' => 'navigation_type',
			'type' => 'select',
			'title' => __('Select navigation type', 'BERG'),
			'options' => array('1' => 'Nav 1', '2' => 'Nav 2 (new)'),
			'select2'  => array( 'allowClear' => false ),
			'default' => '2',
		),
		array(
			'id' => 'berg_nav_show',
			'type' => 'checkbox',
			'title' => __('Open menu at the start', 'BERG'),
			'default' => 1,
		),
		array(
			'id' => 'berg_nav_transparent',
			'type' => 'select',
			'title' => __('Select navigation opacity<br/><small>(opacity 0 - transparent, opacity 100 - solid)</small>', 'BERG'),
			'options' => array( '0' => 'Opacity 0', '10' => 'Opacity 10', '20' => 'Opacity 20', '30' => 'Opacity 30', '40' => 'Opacity 40', '50' => 'Opacity 50', '60' => 'Opacity 60', '70' => 'Opacity 70', '80' => 'Opacity 80', '90' => 'Opacity 90', '100' => 'Opacity 100'),
			'default' => '100',
			'select2'  => array( 'allowClear' => false ),
			'required' => array('navigation_type', '=', '1')
		),

		array(
			'id' => 'navigation_logo_padding',
			'type' => 'spacing',
			'title' => __('Logo padding', 'BERG'),
			'units' => 'px',
			'display_units' => false,
			'left' => false,
			'right' => false,
			'output' => array('.logo img'),
		),

		array(
			'id' => 'navigation_light_colors_divide',
			'title' => __('Light nav colors', 'BERG'),
			'type' => 'divide',
			'required' => array('navigation_type', '=', '2')
		),

		array(
			'id' => 'navigation_light_link_color',
			'type' => 'color',
			'title' => __('Links color', 'BERG'),
			'output' => array('color' => '.nav-alt.nav-light a', 'background-color' =>'.nav-alt.nav-light li:hover a:before, .nav-light .burger-menu span, .nav-light .burger-menu span:before, .nav-light .burger-menu span:after'),
			'default' => '#fff',
			'required' => array('navigation_type', '=', '2')
		),

		array(
			'id' => 'navigation_light_link_active_color',
			'type' => 'color',
			'title' => __('Active links color', 'BERG'),
			'output' => array('color' => '.nav-alt.nav-light .active, .nav-alt.nav-light .current-menu-item > a, .nav-alt.nav-light .current-menu-item > a '),
			'required' => array('navigation_type', '=', '2')
		),

		array(
			'id' => 'navigation_dark_colors_divide',
			'title' => __('Dark nav colors', 'BERG'),
			'type' => 'divide',
			'required' => array('navigation_type', '=', '2')
		),

		array(
			'id' => 'navigation_dark_link_color',
			'type' => 'color',
			'title' => __('Links color', 'BERG'),
			'output' => array('color' => '.nav-alt.nav-dark a', 'background-color' =>'.nav-alt.nav-dark li:hover a:before, .nav-dark .burger-menu span, .nav-dark .burger-menu span:before, .nav-dark .burger-menu span:after'),
			'default' => '#333',
			'required' => array('navigation_type', '=', '2')
		),

		array(
			'id' => 'navigation_dark_link_active_color',
			'type' => 'color',
			'title' => __('Active links color', 'BERG'),
			'output' => array('color' => '.nav-alt.nav-dark .active, .nav-alt.nav-dark .current-menu-item > a, .nav-alt.nav-dark .current-menu-item > a '),
			'default' => '#ca293e',
			'required' => array('navigation_type', '=', '2')
		),

		array(
			'id' => 'navigation_slide_down_divide',
			'title' => __('Slide down navigation', 'BERG'),
			'type' => 'divide',
			'required' => array('navigation_type', '=', '2')
		),

		array(
			'id' => 'navigation_slide_down_link_color',
			'type' => 'color',
			'title' => __('Slide down nav links color', 'BERG'),
			'output' => array('color' => '.nav-fixed-bar .main-nav a', 'background-color' =>'.nav-fixed-bar .main-nav li:hover a:before'),
			'default' => '#333',
			'required' => array('navigation_type', '=', '2')
		),

		array(
			'id' => 'navigation_slide_down_link_active_color',
			'type' => 'color',
			'title' => __('Slide down nav active links color', 'BERG'),
			'output' => array('color' => '.nav-fixed-bar .main-nav .active, .nav-fixed-bar .main-nav .current-menu-item > a, .nav-fixed-bar .main-nav .current-menu-item > a '),
			'default' => '#ca293e',
			'required' => array('navigation_type', '=', '2')
		),

		array(
			'id' => 'navigation_slide_down_background_color',
			'type' => 'color',
			'title' => __('Slide down nav background', 'BERG'),
			'output' => array('background-color' => '.nav-fixed-bar .main-nav, .show-fixed'),
			'default' => '#fff',
			'required' => array('navigation_type', '=', '2')
		),

		array(
			'id' => 'navigation_slide_down_logo',
			'type' => 'button_set',
			'title' => __( 'Logo version', 'BERG' ),
			'options'  => array(
				'light' => __( 'Light', 'BERG' ),
				'dark' => __( 'Dark', 'BERG' ),
			),
			'default' => 'dark',
			'required' => array('navigation_type', '=', '2')
		),

		array(
			'id' => 'navigation_dropdowns_divide',
			'title' => __('Dropdowns', 'BERG'),
			'type' => 'divide',
			'required' => array('navigation_type', '=', '2')
		),

		array(
			'id' => 'navigation_dropdown_link_color',
			'type' => 'color',
			'title' => __('Dropdown links color', 'BERG'),
			'output' => array('color' => '.nav-alt .subnav a, .nav-alt .subnav li'),
			'default' => '#fff',
			'required' => array('navigation_type', '=', '2')
		),

		array(
			'id' => 'navigation_dropdown_background_color',
			'type' => 'color',
			'title' => __('Dropdown background color', 'BERG'),
			'output' => array('background-color' => '.nav-alt .subnav'),
			'default' => '#111',
			'required' => array('navigation_type', '=', '2')
		),
	)
);