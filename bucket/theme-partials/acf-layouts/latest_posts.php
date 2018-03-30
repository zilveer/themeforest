<?php
/**
 * Latest Posts Component
 * Fields :
 * @number_of_posts number
 * @pagination radio (enable / disable)
 * @section_title string
 * @sidebar radio (enable / disable)
 */


//set some variables to pass to the content-blog.php loaded below
global $wp_query, $showed_posts_ids;
$wp_query->query_vars['thumbnail_size'] = 'blog-medium';

$paged = (get_query_var('paged')) ? get_query_var('paged') : '';
if( empty($paged)){
	$paged = (get_query_var('page')) ? get_query_var('page') : 1;
}

if( empty($paged)){
	$paged = 1;
}

$number_of_posts = get_sub_field('number_of_posts');

$args = array(
	'paged' => $paged,
	'posts_per_page' => $number_of_posts,
	'order' => 'DESC',
	'orderby' => 'date',
	'ignore_sticky_posts' => false,
);

$posts_source = get_sub_field('posts_source');
$offset = get_sub_field('offset');

if ( is_numeric($offset) && $offset > 0 ) {
	//we need to paginate ourselves because WP will ignore paging (paged) when offset is present
	$args['offset'] = $offset + ($paged - 1) * $number_of_posts;
}

if (get_post_meta(wpgrade::lang_post_id(get_the_ID()), '_bucket_prevent_duplicate_posts', true) == 'on') {
	//exclude the already showed posts from the current block loop
	if (!empty($showed_posts_ids)) {
		$args['post__not_in'] = $showed_posts_ids;
	}
}

switch ( $posts_source ) :

	case 'featured' :
		/** In this case return only posts marked as featured */
		$args['meta_query'] = array(
			'relation' => 'AND',
			array(
				'key' => wpgrade::prefix() . 'featured_post',
				'value' => 'on',
				'compare' => '='
			)
		);
		break;

	case 'latest' :
		/** Return the latest posts only */
		$args['order'] = 'DESC';
		$args['orderby'] = 'date';
		break;

	case 'latest_by_cat' :
		/** Return posts from selected categories */
		$categories = get_sub_field('posts_source_category');
		$catarr = array();
		if(!empty($categories)) {
			foreach ($categories as $key => $value) {
				$catarr[] = (int) $value;
			}
		}

		$args['category__in'] = $catarr;
		break;

	case 'latest_by_format' :
		/** Return posts with the selected post format */
		$formats = get_sub_field('posts_source_post_formats');
		$terms = array();
		if (!isset($args['tax_query'])) {
			$args['tax_query'] = array();
		}
		foreach ( $formats as $key => &$format) {
			if ($format == 'standard') {
				//if we need to include the standard post formats
				//then we need to include the posts that don't have a post format set
				$all_post_formats = get_theme_support('post-formats');
				if (!empty($all_post_formats[0]) && count($all_post_formats[0])) {
					$allterms = array();
					foreach ($all_post_formats[0] as $format2) {
						$allterms[] = 'post-format-'.$format2;
					}

					$args['tax_query']['relation'] = 'AND';
					$args['tax_query'][] = array(
						'taxonomy' => 'post_format',
						'terms' => $allterms,
						'field' => 'slug',
						'operator' => 'NOT IN'
					);
				}
			} else {
				$terms[] = 'post-format-' . $format;
			}
		}

		if ( !empty($terms) ) {
			$args['tax_query'][] = array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => $terms,
				'operator' => 'IN'
			);
		}
		break;

	case 'latest_by_reviews':
		$args['meta_query'] = array(
			'relation' => 'AND',
			array(
				'key' => 'enable_review_score',
				'value' => '1',
				'compare' => '='
			)
		);
		break;
	default : ;
endswitch;

$latest_query = new WP_Query( $args );

if ( get_sub_field('sidebar') == 'enable' ) {
	$has_sidebar = true;
} else {
	$has_sidebar = false;
}

$blog_layout = get_sub_field('posts_format');

if ( $blog_layout == 'masonry' ) {
	$grid_class = 'class="grid masonry ' . ($has_sidebar ? '' : 'fullwidth') . '" data-columns';
} else {
	$grid_class = 'class="classic"';
}

if ($latest_query->have_posts()):


    if ( $has_sidebar ): ?>
        <div class="grid">
            <div class="grid__item  two-thirds  palm-one-whole">
    <?php endif; ?>
		<div class="heading  heading--main">
			<h2 class="hN"><?php the_sub_field('section_title'); ?></h2>
		</div>
        <div <?php echo $grid_class ?>><!--
            <?php while($latest_query->have_posts()): $latest_query->the_post();  ?>
                --><div><?php get_template_part('theme-partials/post-templates/content-'. $blog_layout); ?></div><!--
            <?php endwhile;
			wp_reset_postdata(); ?>
     --></div>
    <?php

	if ( get_sub_field('pagination') == 'enable' ){
		echo wpgrade::pagination($latest_query);
	}

	if ( $has_sidebar ): ?>
            </div><!--
         --><div class="grid__item  one-third  palm-one-whole  sidebar">
                <?php get_sidebar(); ?>
            </div>
        </div>
    <?php endif;

endif;

wp_reset_query();