<?php


/**
 * This is built-in config for @theme.neon config. These settings will be available always.
 * Settings in @theme.neon can be changed by theme developer according to the needs of the theme.
 */

return array(
	'customCss' => array(
		'title' => __('Custom CSS', 'ait-admin'),
		'options' => array(
			'css' => array(
				'label' => __('Your custom CSS', 'ait-admin'),
				'type' => 'custom-css',
				'help' => __('Here you can put your own CSS', 'ait-admin'),
				'default' => '',
			),
		),
	),
	'adminBranding' => array(
		'title' => __('Admin branding', 'ait-admin'),
		'options' => array(
			'adminTitle' => array(
				'label'   => __('Admin Title', 'ait-admin'),
				'type'    => 'text',
				'default' => 'Theme Admin',
				'help'    => __('Title displayed in Wordpress menu', 'ait-admin'),
			),
			'loginScreenLogo' => array(
				'label'   => __('Login Screen Logo', 'ait-admin'),
				'type'    => 'image',
				'default' => '/admin/assets/img/ait-login-logo.png',
				'help'    => __('Logo image displayed on Wordpress Login screen', 'ait-admin'),
			),
			'loginScreenLogoLink' => array(
				'label'   => __('Login Screen Logo Link', 'ait-admin'),
				'type'    => 'url',
				'default' => 'http://www.ait-themes.com',
				'help'    => __('Link for Logo image displayed on Wordpress Login screen, use valid URL format with http://', 'ait-admin'),
			),
			'loginScreenLogoTooltip' => array(
				'label'   => __('Login Screen Logo Tooltip', 'ait-admin'),
				'type'    => 'text',
				'default' => 'Powered by AIT WordPress Framework',
				'help'    => __('Tooltip text for logo image displayed on Wordpress Login screen', 'ait-admin'),
			),
			'loginScreenCss' => array(
				'label'   => __('Custom CSS for Login Screen', 'ait-admin'),
				'type'    => 'multiline-code',
				'default' => '',
				'help'    => __('CSS styles for Wordpress Login screen', 'ait-admin'),
			),
			'adminMenuIcon' => array(
				'label'   => __('Small Admin Menu Icon (16x16)', 'ait-admin'),
				'type'    => 'image',
				'default' => '/admin/assets/img/ait-admin-menu-icon16.png',
				'help'    => __('Icon image displayed in menu', 'ait-admin'),
			),
			'adminFooterText' => array(
				'label'   => __('Admin Footer Text', 'ait-admin'),
				'type'    => 'textarea',
				'default' => 'Thank you for creating with <a href="http://wordpress.org/">WordPress</a> and <a href="http://www.ait-themes.com">AIT WordPress Theme Framework 2</a> by <a href="http://www.ait-themes.com">AitThemes.com</a>.',
				'help'    => __('Text displayed in footer of Wordpress Admin screen', 'ait-admin'),
			),
		),
	),
	'administrator' => array(
		'title' => __('Administrator settings', 'ait-admin'),
		'reset' => false,
		'options' => array(
			'devMode' => array(
				'label'         => __('Development mode', 'ait-admin'),
				'type'          => 'on-off',
				'default'       => false,
				'help'          => __('Turn on/off development mode', 'ait-admin'),
				'displayOnlyIf' => 'defined("AIT_SERVER")',
			),
			'devIp' => array(
				'label'         => __("Developer's IP address", 'ait-admin'),
				'type'          => 'code',
				'displayOnlyIf' => 'defined("AIT_SERVER")',
			),
			'deleteCaches' => array(
				'callback' => 'aitRenderDeleteCachesThemeOptionControl',
			),
		),
	),
	'megamenu' => array(
		'title' => __('Megamenu settings', 'ait-admin'),
		'reset' => false,
		'options' => array(
			'enabled' => array(
				'label'   => __('Enable megamenu', 'ait-admin'),
				'type'    => 'on-off',
				'default' => true,
				'help'    => __('Turn on/off megamenu', 'ait-admin'),
			),
		),
	),
);
