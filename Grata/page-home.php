<?php
/*
Template Name: One Page
*/
define('ONE_PAGE_HOME', TRUE);
get_header();

$wp_query = new WP_Query(array(
    'post_type' => 'us_main_page_section',
    'post__in'  => us_get_main_page_sections_order(),
    'posts_per_page' => -1,
    'orderby' => 'post__in',
    'post_status' => 'publish',
));

if ($wp_query->have_posts())
{
	while($wp_query->have_posts())
	{
		$wp_query->the_post();
		get_template_part('templates/main_page_section');
	}
}

get_footer();