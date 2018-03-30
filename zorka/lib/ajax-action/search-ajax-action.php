<?php
/**
 * Created by PhpStorm.
 * User: hoantv
 * Date: 2015-01-17
 * Time: 2:09 PM
 */
function zorka_result_search_callback() {
	ob_start();
	function zorka_search_title_filter( $where, &$wp_query ) {
		global $wpdb;
		if ( $keyword = $wp_query->get( 'search_prod_title' ) ) {
			$where .= ' AND ((' . $wpdb->posts . '.post_title LIKE \'%' . $wpdb->esc_like($keyword ) . '%\'';
			$where .= ' OR ' . $wpdb->posts . '.post_excerpt LIKE \'%' . $wpdb->esc_like($keyword ) . '%\'';
			$where .= ' OR ' . $wpdb->posts . '.post_content LIKE \'%' . $wpdb->esc_like($keyword ) . '%\'))';
		}
		return $where;
	}

	$keyword = $_REQUEST['keyword'];

	if ( $keyword ) {
		$search_query = array(
			'search_prod_title' => $keyword,
			'order'     	=> 'DESC',
			'orderby'   	=> 'date',
			'post_status'	=> 'publish',
			'post_type' 	=> array('post','product','portfolio'),
			'nopaging' => true,
		);
		add_filter( 'posts_where', 'zorka_search_title_filter', 10, 2 );
		$search = new WP_Query( $search_query );
		remove_filter( 'posts_where', 'zorka_search_title_filter', 10, 2 );

		$newdata = array();
		if ($search && count($search->post) > 0) {
			foreach ( $search->posts as $post ) {
				$shortdesc = $post->post_excerpt;
				$newdata[] = array(
					'id'        => $post->ID,
					'title'     => $post->post_title,
					'guid'      => get_permalink( $post->ID ),
					'date'      => mysql2date( 'M d Y', $post->post_date ),
					'shortdesc' => $shortdesc
				);
			}
		}
		else {
			$newdata[] = array(
				'id'        => -1,
				'title'     => esc_html__('Sorry, but nothing matched your search terms. Please try again with different keywords.','zorka'),
				'guid'      => '',
				'date'      => null,
				'shortdesc' => ''
			);
		}

		ob_end_clean();
		echo json_encode( $newdata );
	}
	die(); // this is required to return a proper result
}
add_action( 'wp_ajax_nopriv_result_search', 'zorka_result_search_callback' );
add_action( 'wp_ajax_result_search', 'zorka_result_search_callback' );