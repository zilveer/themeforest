<?php
/*
 * Staff shortcode
 */

function ch_staff_shortcode($atts, $content=null) {
	global $wp_filter;
	global $ch_blog_image_layout;

	$the_content_filter_backup = $wp_filter['the_content'];
	extract(shortcode_atts(array(
				'count'   => '5', // posts per page
				'paging'  => 'true', // show pagination
				'paged'   => '',
				'post_id' => '',
				'parent'  => '',
				'order'   => 'DESC',
				'orderby' => 'date',
			), $atts));

	$query = array(
		'posts_per_page' => (int)$count,
		'post_type'      => 'ch_staff',
	);

	if($paged) {
		$query['paged'] = $paged;
	}

	if($post_id) {
		$query['p'] = $post_id;
	}

	if($parent && empty($post_id)) {
		$query['post_parent'] = $parent;
	}

	if ($paging == 'true') {
		$query['paged'] = get_query_var('paged');
	}

	if ($orderby) {
		$query['orderby'] = $orderby;
	}

	if ($order) {
		$query['order'] = $order;
	}


	ob_start();
	query_posts($query);

	include locate_template(array('staff.php'));

	// Show pagination
	if ($paging == 'true' && !is_search()) {
		?><div class="clearfix"></div><?php
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
add_shortcode('staff', 'ch_staff_shortcode');
?>