<?php
global $showed_posts_ids;
/**
 * Posts Grid Card Component
 * Fields available:
 * @posts_source select (featured / latest / latest_by_cat / latest_by_format / latest_by_reviews)
 * @number_of_posts number
 */

//set some variables to pass to the content-blog.php loaded below
global $wp_query;
$wp_query->query_vars['thumbnail_size'] = 'post-medium';

$number_of_posts = get_sub_field('number_of_posts');

$query_args = array(
	'posts_per_page' => $number_of_posts,
	'ignore_sticky_posts' => true,
);

if (get_post_meta(wpgrade::lang_post_id(get_the_ID()), '_bucket_prevent_duplicate_posts', true) == 'on') {
	//exclude the already showed posts from the current block loop
	if (!empty($showed_posts_ids)) {
		$query_args['post__not_in'] = $showed_posts_ids;
	}
}
$posts_source = get_sub_field('posts_source');

$offset = get_sub_field('offset');

if ( is_numeric($offset) && $offset > 0 ) {
	$query_args['offset'] = $offset;
}

switch ( $posts_source ) :

	case 'featured' :
		/** In this case return only posts marked as featured */
		$query_args['meta_query'] = array(
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
		$query_args['order'] = 'DESC';
		$query_args['orderby'] = 'date';
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
		
		$query_args['category__in'] = $catarr;
		break;
		
	case 'latest_by_format' :
		/** Return posts with the selected post format */
		$formats = get_sub_field('posts_source_post_formats');
		$terms = array();
		if (!isset($query_args['tax_query'])) {
			$query_args['tax_query'] = array();
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
					
					$query_args['tax_query']['relation'] = 'AND';
					$query_args['tax_query'][] = array(
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
			$query_args['tax_query'][] = array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => $terms,
				'operator' => 'IN'
			);
		}
		break;

	case 'latest_by_reviews':
		$query_args['meta_query'] = array(
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

$slides = new WP_Query( $query_args );
$index = 0;

if ($slides->have_posts()): ?>
    	<div class="posts-grid-cards grid fullwidth"><!--
        	<?php while($slides->have_posts()): $slides->the_post();
				//first let's remember the post id
				$showed_posts_ids[] = wpgrade::lang_post_id(get_the_ID());
				
        		//When there are more than 3 posts split them into groups of 3
				if($index++ % 3 == 0) { ?>
	 	--></div>
		<div class="posts-grid-cards grid fullwidth"><!--
				<?php } ?>
     		--><div class="grid__item lap-and-up-one-third"><?php get_template_part('theme-partials/post-templates/content-masonry'); ?></div><!--
        	<?php endwhile; wp_reset_postdata(); ?>
 	 	--></div>
<?php endif;

wp_reset_query();