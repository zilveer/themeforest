<?php
/**
 * Template Name: Portfolio page 3 colums
 *
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage centum
 * @since centum 1.0
 */


get_header();

$showpost = ot_get_option('portfolio_showpost','6');
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$filters = get_post_meta($post->ID, 'portfolio_filters', true);

if(empty($filters)) {
	query_posts(array (
		'post_type' => 'portfolio',
		'paged' => $paged,
		'posts_per_page' => $showpost
	));
} else {
	query_posts(array (
		'post_type' => 'portfolio',
		'paged' => $paged,
		'posts_per_page' => $showpost,
		'tax_query' => array(
			array(
				'taxonomy' => 'filters',
				'field' => 'id',
				'terms' => $filters,
				'operator' => 'IN',
				'include_children' => false
			)
		)
	));
}

get_template_part('pftpl3col');


get_footer();

?>