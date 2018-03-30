<?php
global $_theme_layouts;

function _get_sidebar_list() {
	$sidebars = get_registered_sidebars();
	return array('disable' => __('Disable sidebar', TEMPLATENAME)) + $sidebars;
}

$config = array(
	'title' => __('Layout options', TEMPLATENAME),
	'id' => 'posts_view_opt',
	'pages' => array('post', 'page'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
);
$options = array(
	array(
		'name' => __('Template layout', TEMPLATENAME),
		'desc' => __('Select a layout for this post.', TEMPLATENAME),
		'id' => 'layout',
		'default' => '',
		'type' => 'select',
		'empty' => __('Default', TEMPLATENAME),
		'options' => $_theme_layouts,
	),
	array(
		'name' => __('Select a side bar', TEMPLATENAME),
		'desc' => __('Select a side bar for this post.', TEMPLATENAME),
		'id' => 'side_bar',
		'default' => '',
		'type' => 'select',
		'empty' => __('Default', TEMPLATENAME),
		'options_callback' => '_get_sidebar_list',
	),
	array(
		'name' => __('Select a bottom bar', TEMPLATENAME),
		'desc' => __('Select a bottom bar for this post.', TEMPLATENAME),
		'id' => 'bottom_bar',
		'default' => '',
		'type' => 'select',
		'empty' => __('Default', TEMPLATENAME),
		'options_callback' => '_get_sidebar_list',
	),
);
new metaboxesGenerator($config,$options);