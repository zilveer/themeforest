<?php
/*
Template Name: Vertical Slider
*/

/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package berg-wp
 */
get_header(); 

$categories = get_post_meta(get_the_id());

if (isset($categories['restaurant_categories'][0])) {
	$categories = maybe_unserialize($categories['restaurant_categories'][0]);
} else {
	$categories = '';
}
?>
<ul class="page-control hidden-xs"></ul>
<section id="restaurant" class="main main-section no-intro-padding">
<?php
global $slideCount;
$slideCount = 0;

if (is_array($categories)) {
	foreach ($categories as $cat) :

		$the_query = new WP_Query(array(
			'post_type' => 'berg_restaurant',
			'posts_per_page' => -1,
			'tax_query' => array(array(
				'taxonomy' => 'berg_restaurant_categories',
				'terms' => $cat,
				'field' => 'term_id'
			))
		));

		if ($the_query->have_posts()) {
			while ($the_query->have_posts()) {
				$the_query->the_post(); 

				if (has_post_format('video')) {
					get_template_part('restaurant', 'video');
				} else {
					get_template_part('restaurant', 'standard');
				}

				$slideCount++;
			}
		}

	endforeach;
 } else {
	get_template_part('empty', 'restaurant');
}
?>
</section>
<?php get_template_part('footer'); ?>