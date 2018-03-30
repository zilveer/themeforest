<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
add_action('after_setup_theme', 'dfd_eight_setup_theme');

// Add new item
function dfd_news_page_slider_slides_format($formats) {
	$formats = array(
		7 => __('Single with navbar', 'dfd'),
		8 => __('Single without navbar', 'dfd')
	);
    return $formats;
}