<?php
if (!defined('ABSPATH')) exit();
/**
 * Template Name: -Theme Blog
 */

get_header();
get_template_part('content', 'header');

$meta_query_array = array();
if(!defined('ICL_LANGUAGE_CODE')){
	$meta_query_array[] = array(
		'key' => '_icl_lang_duplicate_of',
		'value' => '',
		'compare' => 'NOT EXISTS'
	);
}

if (is_front_page()) {
	$cur_page = get_query_var('page');
} else {
	$cur_page = get_query_var('paged');
}

$args = array(
	'post_type' => 'post',
	'paged' => $cur_page ? $cur_page : 1,
	'meta_query' => $meta_query_array,
);

global $wp_query;
$old_wp_query = $wp_query;
$wp_query = new WP_Query($args);

get_template_part('content', null);
get_template_part('content', 'pagenavi');

$wp_query = $old_wp_query;
wp_reset_postdata();

get_footer();