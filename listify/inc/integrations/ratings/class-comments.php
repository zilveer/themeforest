<?php

class Listify_Comments {

	public function __construct() {
		add_action( 'pre_get_comments', array( $this, 'pre_get_comments' ) );
	}

	public static function get_sort_options() {
		$sorting = array(
			'date-desc' => __( 'Newest First', 'listify' ),
			'date-asc' => __( 'Oldest First', 'listify' ),
			'rating-desc' => __( 'Rating (High-Low)', 'listify' ),
			'rating-asc' => __( 'Rating (Low-High)', 'listify' ),
			//'popular' => __( 'Popular', 'listify' )
		);

		return $sorting;
	}

	public function pre_get_comments( $query ) {
		if ( ! is_singular( 'job_listing' ) ) {
			return;
		}

		$sort = isset( $_GET[ 'sort-comments' ] ) ? esc_attr( $_GET[ 'sort-comments' ] ) : 'date-desc';
		$allowed_keys = array_keys( self::get_sort_options() );

		if ( ! ( $sort && in_array( $sort, array_keys( $allowed_keys ) ) ) ) {
			return $query;
		}

		if ( listify_has_integration( 'wp-job-manager-reviews' ) ) {
			$key = 'review_average';
		} else {
			$key = 'rating';
		}

		if ( 'date-desc' == $sort ) {
			$query->query_vars[ 'order' ] = 'desc';
		} elseif( 'date-asc' == $sort ) {
			$query->query_vars[ 'order' ] = 'asc';
		} elseif( 'rating-desc' == $sort || 'rating-asc' == $sort ) {
			$direction = 'rating-desc' == $sort ? 'desc' : 'asc';

			$query->query_vars[ 'order' ] = $direction;
			$query->query_vars[ 'orderby' ] = 'meta_value_num';
			$query->query_vars[ 'meta_key' ] = $key;
		} elseif ( 'popular' == $sort ) {

		}

		// Run the meta query again because for some reason the hook fires too late.
		$query->meta_query = new WP_Meta_Query();
		$query->meta_query->parse_query_vars( $query->query_vars );
	}

}

new Listify_Comments;
