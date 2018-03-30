<?php
/**
 * Template Name: Creative page Template
 *
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage trizzy
 * @since trizzy 1.0
 */


get_header();

$slider = get_post_meta($post->ID, 'pp_page_layer', true);
if($slider) {
        echo '<div class="container fullwidth-element home-slider">';    putRevSlider($slider); echo "</div>";
}

$showpost = ot_get_option('pp_portfolio_showpost','6');
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
		'posts_per_page' => 12,
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

get_template_part('pftpldyn');

wp_reset_query();
 while (have_posts()) : the_post(); ?>
    <!-- Post -->
    <div  id="post-<?php the_ID(); ?>" <?php post_class('container'); ?> >
        <div class="sixteen columns">
          <?php the_content() ?>
        </div>
    </div>
<?php endwhile; // End the loop. Whew.

get_footer();

?>