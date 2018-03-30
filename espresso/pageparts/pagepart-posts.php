<?php

global $section_title;
$post_category = get_post_meta($post->ID,'_post_category',true);
$post_count = get_post_meta($post->ID,'_post_count',true);

$all_posts = array(
	'post_type' => 'post',
    'posts_per_page' => $post_count
);

if (!$post_category) {
	$category_list = array();
	$post_cats = get_categories(array('type' => 'post','taxonomy' => 'category','hide_empty' => 0));
	if ($post_cats):
		foreach($post_cats as $post_cat){
			$post_category_array[] = $post_cat->term_id;
		}
		$all_posts['category__in'] = $post_category_array;
	endif;	
} else {
	$term = get_term($post_category,'category');
	$all_posts['category_name'] = $term->slug;
}

query_posts($all_posts);
$temp_count = 0; $total_count = 0;

if ( have_posts() ) : ?>

	<section id="homepage-recent-posts" class="homepage-block">
		<div class="shell clearfix">
			<h2 class="centered"><span><?php echo $section_title; ?></span></h2>
			<div class="widget">
				<?php while ( have_posts() ) : the_post(); global $post; $temp_count++; $total_count++;
					get_template_part('singlerow','post');
					if ($temp_count == 3 && $total_count != $post_count){ echo '<div class="cl"></div>'; $temp_count = 0; }
				endwhile; ?>
			</div>
		</div>
	</section><?php
	
endif;

wp_reset_query();