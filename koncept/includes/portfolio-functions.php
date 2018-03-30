<?php

// This file contains functions for the custom portfolios available with this theme.

/*---------------------------------
	Navigation Buttons
------------------------------------*/

function krown_nav_buttons( $taxonomy = 'portfolio_category', $page_id = null, $back_text = '' ){

	if ( $page_id != null ) {

	    global $wp_rewrite;
	    if ( $wp_rewrite->permalink_structure == '' ) {
	        $archive = '&id=' . $page_id;
	    } else {
	        $archive = '?id=' . $page_id;
	    }

    } else {
    	$archive = '';
    }

	if ( get_option( 'krown_portfolio_unlimited', 'disabled' ) == 'disabled' ) {
		$archive = '';
	}

	$cats_excluded = array();
	$cats_included = get_post_meta( $page_id, 'folio_cats', true );

	if ( $cats_included == 'all' || $cats_included == '' ) {

		$cats_excluded = '';

	} else {

		$cats_all = get_categories( array( 'taxonomy'=>$taxonomy ) );

		if ( ! empty( $cats_included ) ) {
			foreach ( $cats_all as $cat ) {
				if ( ! in_array( $cat->term_id, $cats_included ) ){
					array_push( $cats_excluded, $cat->cat_ID );
				}
			}
		}

		$cats_excluded = implode(',', $cats_excluded);

	}

	$next_post = krown_get_adjacent_post( false, $cats_excluded, false, $taxonomy );
	$prev_post = krown_get_adjacent_post( false, $cats_excluded, true, $taxonomy );
	$close_post = isset( $_GET['id'] ) ? $_GET['id'] : get_option( 'krown_portfolio_page', '' );

	$html = '';

	if ( ! empty( $next_post ) ) {
		$html .= '<a class="btn-prev" href="' . get_permalink( $next_post->ID ) . $archive . '">' . krown_svg( 'arrow_left' ) . '</a>';
	} else {
		$html .= '<a class="btn-prev" style="opacity: 0 !important">' . krown_svg( 'arrow_left' ) . '</a>';
	}

	$html .= '<a class="btn-close" href="' . get_permalink( $close_post ) . '">' . $back_text . '</a>';

	if ( ! empty( $prev_post ) ) {
		$html .= '<a class="btn-next" href="' . get_permalink( $prev_post->ID ) . $archive . '">' . krown_svg( 'arrow_right' ) . '</a>';
	} else {
		$html .= '<a class="btn-next" style="opacity: 0 !important">' . krown_svg( 'arrow_right' ) . '</a>';
	}

	echo $html;

}

/*---------------------------------
	Additional Functions
------------------------------------*/

function krown_portfolio_the_permalink( $url, $id, $return = false ) {
	if ( ! $return )
		echo $url . ( strpos( $url, '?' ) ? '&' : '?' ) . 'id=' . $id;
	else
		return $url . ( strpos( $url, '?' ) ? '&' : '?' ) . 'id=' . $id;
}

function krown_get_adjacent_post( $in_same_term = false, $excluded_terms = '', $previous = true, $taxonomy = 'category' ) {

	global $post, $wpdb;

	if ( ( ! $post = get_post() ) || ! taxonomy_exists( $taxonomy ) ) 
		return null; 

	$current_post_date = $post->post_date;

	$join = '';
	$posts_in_ex_terms_sql = ''; 
	if ( $in_same_term || ! empty( $excluded_terms ) ) { 
		$join = " INNER JOIN $wpdb->term_relationships AS tr ON p.ID = tr.object_id INNER JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id"; 

		if ( $in_same_term ) {
			if ( ! is_object_in_taxonomy( $post->post_type, $taxonomy ) ) 
				return '';
			$term_array = wp_get_object_terms( $post->ID, $taxonomy, array( 'fields' => 'ids' ) ); 
			$join .= $wpdb->prepare( " AND tt.taxonomy = %s AND tt.term_id IN (" . implode( ',', array_map( 'intval', $term_array ) ) . ")", $taxonomy ); 
		}

		$posts_in_ex_terms_sql = $wpdb->prepare( "AND tt.taxonomy = %s", $taxonomy ); 
		if ( ! empty( $excluded_terms ) ) { 
			if ( ! is_array( $excluded_terms ) ) { 
				if ( false !== strpos( $excluded_terms, ' and ' ) ) { 
					_deprecated_argument( __FUNCTION__, '3.3', sprintf( __( 'Use commas instead of %s to separate excluded terms.', 'krown' ), "'and'" ) ); 
					$excluded_terms = explode( ' and ', $excluded_terms ); 
				} else {
					$excluded_terms = explode( ',', $excluded_terms );
				}
			}

			$excluded_terms = array_map( 'intval', $excluded_terms ); 
				
			if ( ! empty( $term_array ) ) { 
				$excluded_terms = array_diff( $excluded_terms, $term_array );
				$posts_in_ex_terms_sql = ''; 
			}

			if ( ! empty( $excluded_terms ) ) { 
				$posts_in_ex_terms_sql = $wpdb->prepare( " AND tt.taxonomy = %s AND tt.term_id NOT IN (" . implode( $excluded_terms, ',' ) . ')', $taxonomy ); 
			}
		}
	}

	$adjacent = $previous ? 'previous' : 'next';
	$op = $previous ? '<' : '>';
	$order = $previous ? 'DESC' : 'ASC';

	$join  = apply_filters( "get_{$adjacent}_post_join", $join, $in_same_term, $excluded_terms ); 
	$where = apply_filters( "get_{$adjacent}_post_where", $wpdb->prepare( "WHERE p.post_date $op %s AND p.post_type = %s AND p.post_excerpt NOT like 'link' AND p.post_status = 'publish' $posts_in_ex_terms_sql", $current_post_date, $post->post_type), $in_same_term, $excluded_terms ); 
	$sort  = apply_filters( "get_{$adjacent}_post_sort", "ORDER BY p.post_date $order LIMIT 1" );

	$query = "SELECT p.ID FROM $wpdb->posts AS p $join $where $sort"; 
	
	$query_key = 'adjacent_post_' . md5( $query ); 
	$result = wp_cache_get( $query_key, 'counts' ); 
	if ( false !== $result ) {
		if( $result )
			$result = get_post( $result );
		return $result;
	}

	$result = $wpdb->get_var( $query );
	if (null === $result )
		$result = '';

	wp_cache_set( $query_key, $result, 'counts');

	if ( $result ) 
		$result = get_post( $result );

	return $result;

}

if ( ! function_exists( 'get_new_permalink' ) ) {

	// This function creates a special permalink (the one with the ?id, helping for unlimited portfolios)

	function get_new_permalink( $page_id = null, $post_id = null, $cats = null ) {

		if ( get_option( 'krown_portfolio_unlimited', 'disabled' ) == 'disabled' ) {
			$page_id = null;
		}

		if ( $page_id == null || empty( $cats ) ) {
			return get_permalink( $post_id );
		} else {

		    global $wp_rewrite;
		    if ( $wp_rewrite->permalink_structure == '' ) {
		        return get_permalink( $post_id ) . '&id=' . $page_id;
		    } else {
		        return get_permalink( $post_id ) . '?id=' . $page_id;
		    }

		}

	}

}


?>