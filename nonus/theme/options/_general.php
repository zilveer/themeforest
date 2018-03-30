<?php

$sections[] = array(
	'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_280_settings.png',
	'group' => __("General", 'ct_theme'),
	'title' => __('Main', 'ct_theme'),
	'desc' => __('Main settingss', 'ct_theme'),
	'fields' => array(
		array(
			'id' => 'general_logo',
			'type' => 'upload',
			'title' => __('Logo', 'ct_theme'),
		),
		array(
			'id' => 'general_logo_html',
			'type' => 'textarea',
			'title' => __('Logo html', 'ct_theme'),
			'desc' => __("You can enter any HTML which will be displayed in place of logo. If image logo is uploaded, it will displayed instead.", 'ct_theme')
		),
		array(
			'id' => 'general_login_logo',
			'type' => 'upload',
			'title' => __('Login logo', 'ct_theme'),
		),
		array(
			'id' => 'general_favicon',
			'type' => 'upload',
			'title' => __('Favicon', 'ct_theme'),
		),
		array(
			'id' => 'general_apple_touch_icon',
			'type' => 'upload',
			'title' => __('Apple touch icon', 'ct_theme'),
		), array(
			'id' => 'general_footer_text',
			'type' => 'text',
			'title' => __('Footer text', 'ct_theme'),
			'desc' => __("Available data: %year% (current year), %name% (site name)", 'ct_theme'),
			'std' => "&copy; %year% %name%"
		),
		array(
			'id' => 'general_show_search',
			'title' => __("Search box?", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
	)
);


$sections[] = array(
	'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_001_leaf.png',
	'group' => __("General", 'ct_theme'),
	'title' => __('Automatic Update', 'ct_theme'),
	'desc' => __('Automatic theme update will check every 12 hours for any new theme updates. A notification in Themes menu will appear (just like any other update info).<br/>In order for automatic updates to work, license key is required. <br/><strong>All your settings will be saved</strong>.<br/><br/><strong>WARNING</strong><br/>If you modified source code, it will be overwritten!', 'ct_theme'),
	'fields' => array(
		array(
			'id' => 'general_envato_license',
			'type' => 'text',
			'title' => __('Envato license', 'ct_theme'),
			'desc' => '<a target="_blank" href="http://outsourcing.createit.pl/envato_license.html">' . __('Click here for instructions how to find license', 'ct_theme') . '</a>'
		))
);