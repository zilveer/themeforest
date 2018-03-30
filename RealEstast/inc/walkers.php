<?php
/**
 * Cleaner walker for wp_nav_menu()
 *
 * Walker_Nav_Menu (WordPress default) example output:
 *   <li id="menu-item-8" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-8"><a href="/">Home</a></li>
 *   <li id="menu-item-9" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9"><a href="/sample-page/">Sample Page</a></l
 *
 * Roots_Nav_Walker example output:
 *   <li class="menu-home"><a href="/">Home</a></li>
 *   <li class="menu-sample-page"><a href="/sample-page/">Sample Page</a></li>
 */

class PGL_Walker_Nav_Menu extends Walker_Nav_Menu {
	function check_current($classes) {
		return preg_match('/(current[-_])|active|dropdown/', $classes);
	}

	function start_lvl(&$output, $depth = 0, $args = array()) {
		$output .= "\n<ul class=\"dropdown-menu\">\n";
	}

	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		global $pgl_options;
		$item_html = '';
		if($item->menu_order == 1){
			$item->classes[]='first';
			if($pgl_options->option('show_home_icon')){
				$item->title = '<i class="fa fa-home"></i>';
			}
		}
		parent::start_el($item_html, $item, $depth, $args);
		if (stristr($item_html, 'li class="divider')) {
			$item_html = preg_replace('/<a[^>]*>.*?<\/a>/iU', '', $item_html);
		}
		elseif (stristr($item_html, 'li class="dropdown-header')) {
			$item_html = preg_replace('/<a[^>]*>(.*)<\/a>/iU', '$1', $item_html);
		}

		$item_html = apply_filters('pgl_wp_nav_menu_item', $item_html);
		$output .= $item_html;
	}

	function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
		$element->is_dropdown = ((!empty($children_elements[$element->ID]) && (($depth + 1) < $max_depth || ($max_depth === 0))));

		if ($element->is_dropdown) {
			$element->classes[] = 'dropdown';
		}

		parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
	}
}

add_filter('nav_menu_item_id', '__return_null');

/**
 * Clean up wp_nav_menu_args
 *
 * Remove the container
 * Use PGL_Walker_Nav_Menu() by default
 */
function pgl_nav_menu_args($args = '') {
	$pgl_nav_menu_args['container'] = false;

	if (!$args['items_wrap']) {
		$pgl_nav_menu_args['items_wrap'] = '<ul class="%2$s">%3$s</ul>';
	}

	return array_merge($args, $pgl_nav_menu_args);
}
add_filter('wp_nav_menu_args', 'pgl_nav_menu_args');

function pgl_nav_menu_item_wpml($nav_menu){
	$nav_menu = str_replace(array('sub-menu','menu-item-language '), array('dropdown-menu','dropdown '), $nav_menu);
	return $nav_menu;
}
add_filter('wp_nav_menu', 'pgl_nav_menu_item_wpml');