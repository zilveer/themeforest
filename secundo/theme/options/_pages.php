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
/*
$sections[] = array(
	'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_027_search.png',
	'title' => __('Search', 'ct_theme'),
	'group' => __("Pages", 'ct_theme'),
	'fields' => array(
		array(
			'id' => "pages_search_page",
			'type' => 'pages_select',
			'title' => __("Search page",'ct_theme'),
			'desc'=>__('Which page should be the search page?','ct_theme')
		)
	)
);

$sections[] = array(
	'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_194_circle_question_mark.png',
	'title' => __('Error 404', 'ct_theme'),
	'group' => __("Pages", 'ct_theme'),
	'fields' => array(
		array(
			'id' => "pages_error404_page",
			'type' => 'pages_select',
			'title' => __("Error 404 page",'ct_theme'),
			'desc'=>__('Which page should be the 404 page?','ct_theme')
		)
	)
);*/
