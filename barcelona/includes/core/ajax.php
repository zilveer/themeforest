<?php

/*
 * Get module posts (Page builder modules)
 */
function barcelona_get_module_posts() {

	header('content-type:text/html; charset=utf-8');

	$barcelona_async = true;
	$barcelona_mod_post_meta = array( 'date' );

	if ( array_key_exists( 'barcelona_page_id', $_POST ) && is_numeric( $_POST['barcelona_page_id'] ) ) {
		$barcelona_modules = get_post_meta( $_POST['barcelona_page_id'], 'barcelona_mod', true );
		if ( is_array( $barcelona_modules ) ) {
			$barcelona_modules = array_values( $barcelona_modules );
		}
	}

	if ( array_key_exists( 'barcelona_paged', $_POST ) && is_numeric( $_POST['barcelona_paged'] ) ) {
		$paged = $_POST['barcelona_paged'];
	} else {
		$paged = 1;
	}

	if ( isset( $barcelona_modules ) && is_array( $barcelona_modules ) && is_numeric( $_POST['barcelona_module'] ) && $_POST['barcelona_module'] < count( $barcelona_modules ) ) {

		$barcelona_mod = $barcelona_modules[ $_POST['barcelona_module'] ];

		if ( $barcelona_mod['module_layout'] == 'a' ) {
			$barcelona_mod['max_number_of_posts'] = 3;
		} else if ( $barcelona_mod['module_layout'] == 'b' ) {
			$barcelona_mod['max_number_of_posts'] = 7;
		}

		$barcelona_q_params = array(
			'posts_per_page'        => $barcelona_mod['max_number_of_posts'],
			'post_type'             => 'post',
			'post_status'           => 'publish',
			'ignore_sticky_posts'   => false,
			'no_found_rows'         => false,
			'paged'                 => $paged
		);

		if ( is_numeric( $barcelona_mod['posts_offset'] ) ) {
			$barcelona_q_params['offset'] = ( ( $paged - 1 ) * $barcelona_mod['max_number_of_posts'] ) + $barcelona_mod['posts_offset'];
		}

		if ( array_key_exists( 'barcelona_post_not', $_POST ) && $_POST['barcelona_tab'] != 't1' ) {
			$barcelona_q_params['post__not_in'] = explode( ',', $_POST['barcelona_post_not'] );
		}

		/*
		 * Filter Posts by Category
		 */
		if ( ! empty( $barcelona_mod['filter_category'] ) && $_POST['barcelona_tab'] != 't1' ) {

			$barcelona_q_params['category__in'] = array_values( $barcelona_mod['filter_category'] );

		} else if ( $_POST['barcelona_tab'] == 't1' ) {

			if ( ! array_key_exists( 'barcelona_item_id', $_POST ) || ! is_numeric( $_POST['barcelona_item_id'] ) ) {
				exit;
			}

			$barcelona_q_params['cat'] = $_POST['barcelona_item_id'];

		}

		/*
		 * Filter Posts by Post IDs
		 */
		if ( ! empty( $barcelona_mod['filter_post'] )  ) {

			$barcelona_q_params['post__in'] = array_values( array_filter( array_map( function ( $v ) {

				$v = trim( $v );
				if ( ! is_numeric( $v ) || $v <= 0 ) {
					$v = false;
				}

				return $v;

			}, explode( ',', $barcelona_mod['filter_post'] ) ), function ( $v ) { return is_numeric( $v ); } ) );

		}

		/*
		 * Filter Posts by Tag Name
		 */
		if ( ! empty( $barcelona_mod['filter_tag'] ) ) {

			$barcelona_tag_names = array_filter( explode( ',', $barcelona_mod['filter_tag'] ) );

			if ( ! empty( $barcelona_tag_names ) ) {

				foreach( $barcelona_tag_names as $barcelona_tag ) {

					$barcelona_tag_term = get_term_by( 'name', trim( $barcelona_tag ), 'post_tag' );
					if ( $barcelona_tag_term ) {
						$barcelona_q_params['tag__in'][] = $barcelona_tag_term->term_id;
					}

				}

			}

		}

		/*
		 * Statistical Tabs Config
		 */
		if ( $_POST['barcelona_tab'] == 't2' ) {

			$barcelona_mod['order'] = 'desc';

			if ( ! array_key_exists( 'barcelona_item_id', $_POST ) ) {
				$_POST['barcelona_item_id'] = 0;
			}

			switch( $_POST['barcelona_item_id'] ) {
				case '2':
					$barcelona_mod['orderby'] = 'views';
					break;
				case '1':
					$barcelona_mod['orderby'] = 'comments';
					break;
				default:
					$barcelona_mod['orderby'] = 'date';
			}

		}

		/*
		 * Posts Ordering
		 */
		switch ( $barcelona_mod['orderby'] ) {
			case 'views':
				$barcelona_q_params['orderby'] = 'meta_value_num';
				$barcelona_q_params['meta_key'] = '_barcelona_views';
				break;
			case 'comments':
				$barcelona_q_params['orderby'] = 'comment_count';
				break;
			case 'votes':
				$barcelona_q_params['orderby'] = 'meta_value_num';
				$barcelona_q_params['meta_key'] = '_barcelona_vote_up';
				break;
			case 'random':
				$barcelona_q_params['orderby'] = 'rand';
				break;
			case 'posts':
				$barcelona_q_params['orderby'] = 'post__in';
				break;
			default:
				$barcelona_q_params['orderby'] = 'date';
		}

		$barcelona_q_params['order'] = ( $barcelona_mod['order'] != 'asc' ) ? 'DESC' : 'ASC';

	} else if (  array_key_exists( 'barcelona_posts_layout', $_POST ) && preg_match( '#^[a-z]{1}$#', $_POST['barcelona_posts_layout'] ) ) {

		if ( ! array_key_exists( 'barcelona_query', $_POST ) || ! is_array( $_POST['barcelona_query'] ) ) {
			$_POST['barcelona_query'] = array();
		}

		$barcelona_q_params = $_POST['barcelona_query'];

		$barcelona_q_params['paged'] = $paged;

		$barcelona_module_layout = $_POST['barcelona_posts_layout'];

		$barcelona_mod_post_meta = ( array_key_exists( 'barcelona_post_meta_choices', $_POST ) && is_array( $_POST['barcelona_post_meta_choices'] ) ) ? $_POST[ 'barcelona_post_meta_choices' ] : array();

	}

	if ( isset( $barcelona_q_params ) ) {

		$barcelona_q = new WP_Query( $barcelona_q_params );

		if ( isset( $barcelona_mod ) ) {

			if ( ! $barcelona_q->have_posts() ) {
				$barcelona_mod['module_layout'] = 'none';
			}

			if ( $barcelona_mod['module_layout'] == 'g' ) {

				if ( $barcelona_mod['g_show_overlay_always'] == 'on' ) {
					$barcelona_show_overlay = true;
				}

				if ( $barcelona_mod['g_is_autoplay'] == 'on' ) {
					$barcelona_is_autoplay = true;
				}

			}

			if ( array_key_exists( 'post_meta_choices', $barcelona_mod ) ) {
				$barcelona_mod_post_meta = $barcelona_mod['post_meta_choices'];
			}

			$barcelona_module_layout = $barcelona_mod['module_layout'];

		}

		if ( isset( $barcelona_module_layout ) ) {
			include( locate_template( 'includes/modules/module-' . $barcelona_module_layout . '.php' ) );
		}

	}

	exit;

}
add_action( 'wp_ajax_barcelona_pb', 'barcelona_get_module_posts' );
add_action( 'wp_ajax_nopriv_barcelona_pb', 'barcelona_get_module_posts' );

/*
 * Vote post or comment
 */
function barcelona_vote() {

	$barcelona_vote_type = isset( $_REQUEST['barcelona_vote_type'] ) ? sanitize_key( $_REQUEST['barcelona_vote_type'] ) : 'post';
	$barcelona_nonce_key = 'barcelona-'. $barcelona_vote_type .'-vote';
	$barcelona_comment_id = $barcelona_post_id = false;

	if ( $barcelona_vote_type == 'comment' ) {
		list( $barcelona_comment_id, $barcelona_post_id ) = explode( '_', $_REQUEST['barcelona_post_id'] );
	} else {
		$barcelona_post_id = $_REQUEST['barcelona_post_id'];
	}

	if ( is_user_logged_in() && ! wp_verify_nonce( $_REQUEST['barcelona_nonce'], $barcelona_nonce_key ) ) {
		exit;
	}

	if ( ! is_user_logged_in() && is_numeric( $barcelona_post_id ) && get_post_meta( $barcelona_post_id, 'barcelona_'. $barcelona_vote_type .'_voting_login_req', true ) == 'on' ) {
		die('0');
	}

	header('content-type:application/json; charset=utf-8');

	$output = array(
		'status' => false
	);

	if ( is_numeric( $barcelona_post_id ) && in_array( $_REQUEST['barcelona_type'], array( 'up', 'down' ) ) ) {

		$output['status'] = true;

		$barcelona_meta_key = '_barcelona_vote_'. $_REQUEST['barcelona_type'];

		$barcelona_vote_count = ( $barcelona_vote_type == 'post' ) ? get_post_meta( $barcelona_post_id, $barcelona_meta_key, true ) : get_comment_meta( $barcelona_comment_id, $barcelona_meta_key, true );
		if ( empty( $barcelona_vote_count ) ) {
			$barcelona_vote_count = 0;
		}

		$barcelona_vote_count += 1;

		if ( $barcelona_vote_type == 'post' ) {
			update_post_meta( $barcelona_post_id, $barcelona_meta_key, $barcelona_vote_count );
		} else if ( $barcelona_vote_type == 'comment' ) {
			update_comment_meta( $barcelona_comment_id, $barcelona_meta_key, $barcelona_vote_count );
		}

		$output[ 'vote_'. $_REQUEST['barcelona_type']  ] = intval( $barcelona_vote_count );

	} else {

		$output['error'] = 'invalid_request';

	}

	$output = json_encode( $output );

	die( $output );

}
add_action( 'wp_ajax_barcelona_vote', 'barcelona_vote' );
add_action( 'wp_ajax_nopriv_barcelona_vote', 'barcelona_vote' );