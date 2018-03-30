<?php
$sections[] = array(
	'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_114_list.png',
	'title' => __('Index', 'ct_theme'),
	'desc' => __("Setup FAQ index page", 'ct_theme'),
	'group' => __("FAQ", 'ct_theme'),
	'fields' => array(
		array(
			'id' => "faq_index_page",
			'type' => 'pages_select',
			'title' => __("Index page", 'ct_theme'),
			'desc' => __('Which page should be a FAQ index?', 'ct_theme')
		),
		array(
			'id' => 'info',
			'type' => 'info',
			'desc' => __('<h4>Collection options</h4>', 'ct_theme')
		),
		array(
			'id' => 'faq_index_show_title',
			'title' => __("Show FAQ index page title", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
		array(
			'id' => 'faq_index_show_breadcrumbs',
			'title' => __("Show breadcrumbs", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
	)
);