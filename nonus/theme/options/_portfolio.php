<?php
$sections[] = array(
	'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_114_list.png',
	'title' => __('Index', 'ct_theme'),
	'desc' => __("Setup Portfolio index page", 'ct_theme'),
	'group' => __("Portfolio", 'ct_theme'),
	'fields' => array(
		array(
			'id' => "portfolio_index_page",
			'type' => 'pages_select',
			'title' => __("Index page", 'ct_theme'),
			'desc' => __('Which page should be a portfolio index?', 'ct_theme')
		),
		array(
			'id' => 'info',
			'type' => 'info',
			'desc' => __('<h4>Collection options</h4>', 'ct_theme')
		),
		array(
			'id' => 'portfolio_index_show_p_title',
			'title' => __("Show portfolio index page title", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
		array(
			'id' => 'portfolio_index_show_breadcrumbs',
			'title' => __("Show breadcrumbs", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
		array(
			'id' => 'portfolio_index_max_items',
			'title' => __("Maximum items", 'ct_theme'),
			'type' => 'text',
			'std' => 100
		),
		array(
			'id' => 'portfolio_index_items_cols',
			'title' => __("Number of columns", 'ct_theme'),
			'type' => 'select',
			'options' => array(2 => 2, 3 => 3, 4 => 4),
			'std' => 4
		),
		array(
			'id' => 'portfolio_index_show_filters',
			'title' => __("Show filters", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
		array(
			'id' => 'portfolio_index_show_title',
			'title' => __("Show titles", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
		array(
			'id' => 'portfolio_index_show_summary',
			'title' => __("Show summary", 'ct_theme'),
			'type' => 'select_show',
			'std' => 0
		),
		array(
			'id' => 'portfolio_index_order',
			'title' => __("Ordering works by order attribute", 'ct_theme'),
			'type' => 'select_show',
			'std' => 0
		),
		array(
			'id' => ctPortfolioTypeBase::OPTION_SLUG,
			'title' => __("Portfolio index page slug", 'ct_theme'),
			'type' => 'text',
			'desc' => __('Slug is used to generate portfolio url like /SLUG/portfolio-item', 'ct_theme')
		),
	)
);
$sections[] = array(
	'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_151_edit.png',
	'title' => __('Single', 'ct_theme'),
	'group' => __("Portfolio", 'ct_theme'),
	'desc' => __("Setup single post settings", 'ct_theme'),
	'fields' => array(
		array(
			'id' => 'portfolio_single_page_title',
			'title' => __("Portfolio page title", 'ct_theme'),
			'type' => 'text',
			'std' => __('Our work', 'ct_theme')
		),
		array(
			'id' => 'portfolio_single_show_breadcrumbs',
			'title' => __("Show breadcrumbs", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
		array(
			'id' => 'portfolio_single_show_title',
			'title' => __("Title", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
		array(
			'id' => 'portfolio_single_show_image',
			'title' => __("Image", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
		array(
			'id' => 'portfolio_single_show_client',
			'title' => __("Client", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
		array(
			'id' => 'portfolio_single_show_venue',
			'title' => __("Venue", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
		array(
			'id' => 'portfolio_single_show_date',
			'title' => __("Date", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
		array(
			'id' => 'portfolio_single_show_cats',
			'title' => __("Categories", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
		array(
			'id' => 'portfolio_single_show_content',
			'title' => __("Summary", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),
		array(
			'id' => 'portfolio_single_show_other_projects',
			'title' => __("Other projects", 'ct_theme'),
			'type' => 'select_show',
			'std' => 1
		),


		array(
			'id' => 'portfolio_single_show_comments',
			'title' => __("Comments", 'ct_theme'),
			'type' => 'select_show',
			'std' => 0
		),
		array(
			'id' => 'portfolio_single_show_comment_form',
			'title' => __("Comment form", 'ct_theme'),
			'type' => 'select_show',
			'std' => 0
		),
	)
);
