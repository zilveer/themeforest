<?php


return array(
	'pages' => array(
		array(
			'slug'       => 'theme-options',
			'menu-title' => __('Theme Options', 'ait-admin'),
			'sub' => array(
				array(
					'slug'       => 'default-layout',
					'menu-title' => __('Default Layout', 'ait-admin'),
				),
				array(
					'slug'       => 'backup',
					'menu-title' => __('Import / Export', 'ait-admin'),
				),
			),
		),
		array(
			'slug'       => 'pages-options',
			'menu-title' => __('Page Builder', 'ait-admin'),
		),
	)
);
