<?php

if( !function_exists('thb_related_posts') ) {
	/**
	 * Display a list of the related posts.
	 */
	function thb_related_posts() {
		global $post;
		
		$id = thb_get_page_ID();
		$post_type = $post->post_type;

		$show = thb_get_post_meta($id, $post_type . '_related');

		if( empty($show) ) {
			return;
		}

		$num = thb_get_post_meta($id, $post_type . '_related_number');
		$thumb = thb_get_post_meta($id, $post_type . '_related_thumb');

		$args = thb_related_posts_query();
		$args['posts_per_page'] = empty($num) ? 3 : (int) $num;

		$posts = get_posts( $args );

		thb_get_subtemplate('backpack/blog', dirname(__FILE__), 'related-posts', array(
			'posts' => $posts,
			'thumb' => $thumb
		));
	}
}