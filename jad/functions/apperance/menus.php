<?php

add_filter('nav_menu_css_class', 'sg_nav_menu_css_class', 10, 2);
add_filter('page_css_class', 'sg_page_css_class', 10, 2);
add_action('init', 'sg_register_menus');

function sg_register_menus()
{
	register_nav_menus(
		array(
			'main_navigation' => __('Main Navigation', SG_TDN),
		)
	);
}

function sg_nav_menu_css_class($classes = array(), $menu_item = false)
{
	if (in_array('current-menu-item', $menu_item->classes) OR in_array('current-menu-parent', $menu_item->classes)) {
		if ($menu_item->menu_item_parent == 0) {
			$classes[] = 'current';
		}
	}
	return $classes;
}

function sg_page_css_class($classes = array(), $page = null)
{
	if (in_array('current_page_item', $classes) OR in_array('current_page_parent', $classes)) {
		if ($page->post_parent == 0) $classes[] = 'current';
	}
	return $classes;
}

function sg_page_menu($args = array())
{
	$defaults = array('title_li' => '');
	$args = wp_parse_args($args, $defaults);
	$args = apply_filters('wp_page_menu_args', $args);

	echo '<ul class="' . $args['menu_class'] . '">';
	wp_list_pages($args);
	echo '</ul>';
}

function sg_none_menu($args = array())
{

}