<?php
/**
 * Created by PhpStorm.
 * User: hoantv
 * Date: 2015-01-17
 * Time: 2:09 PM
 */
function zorka_result_product_search_callback() {
	if ( !class_exists( 'WooCommerce' ) ) {
		$newdata[] = array(
			'id'        => -1,
			'title'     => esc_html__('Sorry, WooCommerce is not installed! ','zorka'),
			'guid'      => '',
			'thumb'		=> '',
			'price'		=> ''
		);
		echo json_encode( $newdata );
		die();
	}
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
	$cate_id = $_REQUEST['cate_id'];

	if ( $keyword ) {
		$search_query = array(
			'search_prod_title' => $keyword,
			'order'     	=> 'DESC',
			'orderby'   	=> 'date',
			'post_status'	=> 'publish',
			'post_type' 	=> array('product'),
			'nopaging' => true,
		);

		if (isset($cate_id) && ($cate_id != -1)) {
			$search_query ['tax_query'] = array(array(
				'taxonomy' => 'product_cat',
				'terms' => array($cate_id),
				'include_children' => false,
			));
		}

		add_filter( 'posts_where', 'zorka_search_title_filter', 10, 2 );
		$search = new WP_Query( $search_query );
		remove_filter( 'posts_where', 'zorka_search_title_filter', 10, 2 );

		$newdata = array();
		if ($search && count($search->post) > 0) {
			foreach ( $search->posts as $post ) {
				$product = new WC_Product( $post->ID );
				$price = $product->get_price_html();

				$newdata[] = array(
					'id'        => $post->ID,
					'title'     => $post->post_title,
					'guid'      => get_permalink( $post->ID ),
					'thumb'		=> get_the_post_thumbnail( $post->ID, 'thumbnail' ),
					'price'		=> $price
				);
			}
		}
		else {
			$newdata[] = array(
				'id'        => -1,
				'title'     => esc_html__('Products not found. Please try again with different keywords.','zorka'),
				'guid'      => '',
				'thumb'		=> '',
				'price'		=> ''
			);
		}

		ob_end_clean();
		echo json_encode( $newdata );
	}
	die(); // this is required to return a proper result
}
add_action( 'wp_ajax_nopriv_result_search_product', 'zorka_result_product_search_callback' );
add_action( 'wp_ajax_result_search_product', 'zorka_result_product_search_callback' );