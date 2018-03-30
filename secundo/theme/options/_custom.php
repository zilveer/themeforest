<?php
	$theme_data = wp_get_theme();
	$theme_uri = $theme_data->get('ThemeURI');
	$description = $theme_data->get('Description');
	$author = $theme_data->get('Author');
	$authorUri = $theme_data->get('AuthorURI');
	$version = $theme_data->get('Version');

$docs_uri = CT_THEME_DIR_URI.'/docs/index.html';

$theme_info = '<div class="ct_theme-section-desc">';
$theme_info .= '<p class="ct_theme-theme-data description theme-uri">' . __('<strong>Theme URL:</strong> ', 'ct_theme') . '<a href="' . $theme_uri . '" target="_blank">' . $theme_uri . '</a></p>';
$theme_info .= '<p class="ct_theme-theme-data description theme-author">' . __('<strong>Documentation:</strong> ', 'ct_theme') . '<a target="_blank" href="' . $docs_uri . '">' . $docs_uri . '</a></p>';
$theme_info .= '<p class="ct_theme-theme-data description theme-author">' . __('<strong>Author:</strong> ', 'ct_theme') .'<a target="_blank" href="'.$authorUri.'">'. $author . '</a></p>';
$theme_info .= '<p class="ct_theme-theme-data description theme-version">' . __('<strong>Version:</strong> ', 'ct_theme') . $version . '</p>';
$theme_info .= '<p class="ct_theme-theme-data description theme-description">' . $description . '</p>';
$theme_info .= '</div>';


$sections['theme_info'] = array(
	'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_195_circle_info.png',
	'title' => __('Theme Information', 'ct_theme'),
	'content' => $theme_info,
	'group' => __("General",'ct_theme'),
	'fields' => array(array(
		'type' => 'info',
		'id' => "general_info",
		'desc' => $theme_info
	))
);


//Setup custom links in the footer for share icons
$args['share_icons']['logo'] = array(
	'link' => 'http://themeforest.net/user/ThemeWoodmen/portfolio',
	'title' => __('Browse our portfolio', 'ct_theme'),
	'img' => CT_THEME_SETTINGS_MAIN_DIR_URI . '/img/themewoodmen-logo.png'
);
$args['share_icons']['docs'] = array(
	'link' => $docs_uri,
	'title' => __('Online documentation', 'ct_theme'),
	'style'=>'position:relative;top:-18px'
);
