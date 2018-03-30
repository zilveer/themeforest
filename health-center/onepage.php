<?php
/*
 * Template Name: One Page Menu
 */

function wpv_onepage_top_bar_layout() {
	return '';
}
add_filter('pre_option_wpv_top-bar-layout', 'wpv_onepage_top_bar_layout');

function wpv_onepage_body_class($class) {
	$class[] = 'no-sticky-header-animation';
	return $class;
}
add_filter('body_class', 'wpv_onepage_body_class');

get_template_part('page');