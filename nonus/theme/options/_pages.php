<?php

$sections[] = array(
	'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_020_home.png',
	'title' => __('Home', 'ct_theme'),
	'group' => __("Pages", 'ct_theme'),
	'fields' => array(
		array(
			'id' => "pages_home_page",
			'type' => 'pages_select',
			'title' => __("Home page", 'ct_theme'),
			'desc' => __('Which page should be the home page?', 'ct_theme')
		),
		array(
			'id' => 'pages_single_show_title',
			'title' => __("Show titles on pages", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
		array(
			'id' => 'pages_single_show_breadcrumbs',
			'title' => __("Show breadcrumbs on pages", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
		array(
			'id' => 'pages_single_show_comments',
			'title' => __("Comments", 'ct_theme'),
			'type' => 'select_show',
			'std' => 0
		),
		array(
			'id' => 'pages_single_show_comment_form',
			'title' => __("Comment form", 'ct_theme'),
			'type' => 'select_show',
			'std' => 0
		),
	)
);
