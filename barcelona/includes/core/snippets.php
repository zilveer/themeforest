<?php

/*
 * Add missing post metas in order to make posts visible while order by meta keys
 */
function barcelona_add_post_meta( $post_id ) {

	$barcelona_meta_view = get_post_meta( $post_id, '_barcelona_views' );
	$barcelona_meta_vote = get_post_meta( $post_id, '_barcelona_vote_up' );

	if ( empty( $barcelona_meta_view ) ) {
		add_post_meta( $post_id, '_barcelona_views', 0 );
	}

	if ( empty( $barcelona_meta_vote ) ) {
		add_post_meta( $post_id, '_barcelona_vote_up', 0 );
	}

}
add_action( 'save_post', 'barcelona_add_post_meta' );

/*
 * Prevent duplicate posts in category with featured posts
 */
function barcelona_category_pre_posts( $query ) {

	if ($query->is_search()) {
		$barcelona_search_post_types = barcelona_get_option('post_type_choices__search');
		$query->set('post_type', $barcelona_search_post_types);
	}

	if ( $query->is_main_query() && is_category() && ! is_admin() ) {

		$barcelona_cat = get_queried_object();
		$barcelona_fp_query = barcelona_get_featured_posts_query( $barcelona_cat->term_id, 'category' );

		if ( is_object( $barcelona_fp_query ) && property_exists( $barcelona_fp_query, 'prevent_duplication' ) && $barcelona_fp_query->prevent_duplication == 'on' ) {

			$barcelona_post_ids = array();

			if ( $barcelona_fp_query && $barcelona_fp_query->have_posts() ) {

				while ( $barcelona_fp_query->have_posts() ) {
					$barcelona_fp_query->the_post();
					$barcelona_post_ids[] = get_the_ID();
				}

			}

			$query->set( 'post__not_in', $barcelona_post_ids );

		}

	}

	return $query;

}
add_action( 'pre_get_posts', 'barcelona_category_pre_posts' );