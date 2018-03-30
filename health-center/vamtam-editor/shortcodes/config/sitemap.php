<?php
return array(
	"name" => "Sitemap",
	'icon' => array(
		'char' => WPV_Editor::get_icon('list'),
		'size' => '30px',
		'lheight' => '45px',
		'family' => 'vamtam-editor-icomoon',
	),
	"value" => "sitemap",
	'controls' => 'size name clone edit delete',
	'class' => 'slim',
	"options" => array(
		array(
			'name' => __('General', 'health-center'),
			'type' => 'separator',
		),
			array(
				"name" => __("Filter", 'health-center') ,
				"id" => "shows",
				"default" => array(),
				"options" => array(
					"pages" => __("Pages", 'health-center') ,
					"categories" => __("Categories", 'health-center') ,
					"posts" => __("Posts", 'health-center') ,
					"portfolios" => __("Portfolios", 'health-center') ,
				) ,
				"type" => "multiselect",
			) ,

			array(
				"name" => __("Limit", 'health-center') ,
				"desc" => __("Sets the number of items to display.<br>leaving this setting as 0 displays all items.", 'health-center') ,
				"id" => "number",
				"default" => 0,
				"min" => 0,
				"max" => 200,
				"type" => "range"
			) ,

			array(
				"name" => __("Depth", 'health-center') ,
				"desc" => __("This parameter controls how many levels in the hierarchy are to be included. <br> 0: Displays pages at any depth and arranges them hierarchically in nested lists<br> -1: Displays pages at any depth and arranges them in a single, flat list<br> 1: Displays top-level Pages only<br> 2, 3 … Displays Pages to the given depth", 'health-center') ,
				"id" => "depth",
				"default" => 0,
				"min" => - 1,
				"max" => 5,
				"type" => "range"
			) ,

		array(
			'name' => __('Posts and portfolios', 'health-center'),
			'type' => 'separator',
		),
			array(
				"name" => __("Show comments", 'health-center') ,
				"id" => "show_comment",
				"desc" => '',
				"default" => true,
				"type" => "toggle"
			) ,
			array(
				"name" => __("Specific post categories", 'health-center') ,
				"id" => "post_categories",
				"default" => array() ,
				"target" => 'cat',
				"type" => "multiselect",
			) ,
			array(
				"name" => __("Specific posts", 'health-center') ,
				"desc" => __("The specific posts you want to display", 'health-center') ,
				"id" => "posts",
				"default" => array() ,
				"target" => 'post',
				"type" => "multiselect",
			) ,
			array(
				"name" => __("Specific portfolio categories", 'health-center') ,
				"id" => "portfolio_categories",
				"default" => array() ,
				"target" => 'portfolio_category',
				"type" => "multiselect",
			) ,

		array(
			'name' => __('Categories', 'health-center'),
			'type' => 'separator',
		),
			array(
				"name" => __("Show Count", 'health-center') ,
				"id" => "show_count",
				"desc" => __("Toggles the display of the current count of posts in each category.", 'health-center') ,
				"default" => true,
				"type" => "toggle"
			) ,
			array(
				"name" => __("Show Feed", 'health-center') ,
				"id" => "show_feed",
				"desc" => __("Display a link to each category's <a href='http://codex.wordpress.org/Glossary#RSS' target='_blank'>rss-2</a> feed.", 'health-center') ,
				"default" => true,
				"type" => "toggle"
			) ,
			array(
			'name' => __('Title', 'health-center') ,
			'desc' => __('The column title is placed just above the element.', 'health-center'),
			'id' => 'column_title',
			'default' => '',
			'type' => 'text'
		) ,
		array(
			'name' => __('Title Type (optional)', 'health-center') ,
			'id' => 'column_title_type',
			'default' => 'single',
			'type' => 'select',
			'options' => array(
				'single' => __('Title with divider next to it', 'health-center'),
				'double' => __('Title with divider below', 'health-center'),
				'no-divider' => __('No Divider', 'health-center'),
			),
		) ,
	) ,
);
