<?php
/**
 * Functions related to homepage
 */


if ( ! function_exists( 'selection_based_properties' ) ) {
	/**
	 * Homepage Properties Based on Selection
	 *
	 * @param $properties_args
	 * @return mixed
	 */
	function selection_based_properties( $properties_args ) {

		$types_for_homepage = get_option( 'theme_types_for_homepage' );
		$statuses_for_homepage = get_option( 'theme_statuses_for_homepage' );
		$cities_for_homepage = get_option( 'theme_cities_for_homepage' );

		$tax_query = array();

		if ( ! empty( $types_for_homepage ) && is_array( $types_for_homepage ) ) {
			$tax_query[] = array(
				'taxonomy' => 'property-type',
				'field' => 'slug',
				'terms' => $types_for_homepage
			);
		}

		if ( ! empty( $statuses_for_homepage ) && is_array( $statuses_for_homepage ) ) {
			$tax_query[] = array(
				'taxonomy' => 'property-status',
				'field' => 'slug',
				'terms' => $statuses_for_homepage
			);
		}

		if ( ! empty( $cities_for_homepage ) && is_array( $cities_for_homepage ) ) {
			$tax_query[] = array(
				'taxonomy' => 'property-city',
				'field' => 'slug',
				'terms' => $cities_for_homepage
			);
		}

		$tax_count = count( $tax_query );   // count number of taxonomies
		if ( $tax_count > 1 ) {
			$tax_query[ 'relation' ] = 'AND';  // add OR relation if more than one
		}

		if ( $tax_count > 0 ) {
			$properties_args[ 'tax_query' ] = $tax_query;   // add taxonomies query to home query arguments
		}

		return $properties_args;

	}
}


if ( ! function_exists( 'only_featured_properties' ) ) {
	/**
	 * Featured Properties on Homepage
	 *
	 * @param $properties_args
	 * @return mixed
	 */
	function only_featured_properties( $properties_args ) {

		$properties_args[ 'meta_query' ] = array(
			array(
				'key' => 'REAL_HOMES_featured',
				'value' => 1,
				'compare' => '=',
				'type' => 'NUMERIC'
			) );

		return $properties_args;

	}

	add_filter( 'real_homes_only_featured_properties', 'only_featured_properties' );
}


if ( ! function_exists( 'homepage_properties' ) ) {
	/**
	 * Homepage Properties
	 *
	 * @param $properties_args
	 * @return mixed|void
	 */
	function homepage_properties( $properties_args ) {

		/* Modify home query arguments based on theme options */
		$home_properties = get_option( 'theme_home_properties' );
		if ( ! empty( $home_properties ) && ( $home_properties == 'based-on-selection' ) ) {

			/* Properties Based on Selection from Theme Options */
			$properties_args = selection_based_properties( $properties_args );

		} elseif ( ! empty( $home_properties ) && ( $home_properties == 'featured' ) ) {

			/* Featured Properties on Homepage */
			$properties_args = apply_filters( 'real_homes_only_featured_properties', $properties_args );

		} else {

			/* Exclude Featured Properties If Enabled */
			$featured_properties = get_option( 'theme_exclude_featured_properties' );
			if ( ! empty( $featured_properties ) && $featured_properties == 'true' ) {
				$properties_args[ 'meta_query' ] = array(
					'relation' => 'OR',
					array(
						'key' => 'REAL_HOMES_featured',
						'compare' => 'NOT EXISTS',
					),
					array(
						'key' => 'REAL_HOMES_featured',
						'value' => 0,
						'compare' => '=',
						'type' => 'NUMERIC'
					));
			}

		}

		return $properties_args;

	}

	add_filter( 'real_homes_homepage_properties', 'homepage_properties' );
}


