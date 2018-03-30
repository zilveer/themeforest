<?php
/*
 * Blog shortcode
 */

function ch_blog_posts($atts, $content=null) {
	global $wp_filter;
	global $ch_blog_image_layout;

	$the_content_filter_backup = $wp_filter['the_content'];
	extract(shortcode_atts(array(
				'count'      => '5', // posts per page
				'category'   => '', // posts category
				'show_image' => 'true', // show image for blog posts?
				'paging'     => 'true', // show pagination
				'layout'     => 'with_full_image', // 'with_side_image', 'with_full_image'
				'show_date'  => 'true', // false, true
				'paged'      => '',
				'show_tags'  => 'true', // false, true
				'show_cat'   => 'true'  // false, true
			), $atts));

	$query = array(
		'posts_per_page' => (int)$count,
		'post_type'      => 'post',
	);

	if($paged)
		$query['paged'] = $paged;

	if($category)
		$query['cat'] = $category;

	if ($paging == 'true') {
		$query['paged'] = get_query_var('paged');
	}
	
	$ch_blog_image_layout = $layout;
	$from_shortcode       = true;

	ob_start();
	query_posts($query);

	include locate_template(array('loop.php'));

	// Show pagination
	if ($paging == 'true' && !is_search()) {
		?><div class="clearer"></div><?php
		if(function_exists('wp_pagenavi')) {
			wp_pagenavi();
		}
	}
	$output = ob_get_contents();
	ob_end_clean();

	wp_reset_query();
	wp_reset_postdata();
	$wp_filter['the_content'] = $the_content_filter_backup;
	return $output;
}
add_shortcode('blog', 'ch_blog_posts');