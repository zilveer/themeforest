<?php
/**
 * This file contains functions related to Real Estate Search
 */


if ( ! function_exists( 'load_location_script' ) ) {
	/**
	 * Load Location Related Script
	 */
	function load_location_script() {

		if ( ! is_admin() ) {

			$locations_order = array(
				'orderby' => 'count',
				'order' => 'desc',
			);

			$order = get_option( 'theme_locations_order' );
			if ( $order == 'true' ) {
				$locations_order[ 'orderby' ] = 'name';
				$locations_order[ 'order' ] = 'asc';
			}

			// all property city terms
			$all_locations = get_terms(
				'property-city',
				array(
					'hide_empty' => false,
					'orderby' => $locations_order[ 'orderby' ],
					'order' => $locations_order[ 'order' ],
				)
			);

			// re-indexing city terms
			$all_locations = array_values( $all_locations );

			// select boxes names
			$location_select_names = inspiry_get_location_select_names();

			// number of select boxes based on theme option
			$location_select_count = inspiry_get_locations_number();

			// location parameters in request, if any
			$locations_in_params = array();

			if ( is_page_template( 'template-submit-property.php' ) && isset( $_GET[ 'edit_property' ] ) ) {

				$edit_property_id = intval( trim( $_GET[ 'edit_property' ] ) );
				$target_property = get_post( $edit_property_id );

				if ( ! empty( $target_property ) && ( $target_property->post_type == 'property' ) ) {

					$location_terms = get_the_terms( $edit_property_id, 'property-city' );

					if ( $location_terms && ! is_wp_error( $location_terms ) ) {

						$existing_location_term = $location_terms[ 0 ];

						if ( $existing_location_term->term_id ) {

							$existing_location_ancestors = get_ancestors( $existing_location_term->term_id, 'property-city' );
							$location_term_depth = count( $existing_location_ancestors );

							if ( $location_term_depth >= $location_select_count ) {

								$existing_location_ancestors = array_reverse( $existing_location_ancestors );
								for ( $i = 0; $i < ( $location_select_count - 1 ); $i++ ) {
									$current_ancestor = get_term_by( 'id', $existing_location_ancestors[ $i ], 'property-city' );
									$locations_in_params[ $location_select_names[ $i ] ] = $current_ancestor->slug;
								}

								// For last select box
								$locations_in_params[ $location_select_names[ $location_select_count - 1 ] ] = $existing_location_term->slug;

							} else if ( $location_term_depth < $location_select_count ) {

								$existing_location_ancestors = array_reverse( $existing_location_ancestors );
								for ( $i = 0; $i < $location_term_depth; $i++ ) {
									$current_ancestor = get_term_by( 'id', $existing_location_ancestors[ $i ], 'property-city' );
									$locations_in_params[ $location_select_names[ $i ] ] = $current_ancestor->slug;
								}

								// For last select box
								$locations_in_params[ $location_select_names[ $location_term_depth ] ] = $existing_location_term->slug;

							}

						}

					}

				}
			}

			if ( 0 == count( $locations_in_params ) ) {
				foreach ( $location_select_names as $location_name ) {
					if ( isset( $_GET[ $location_name ] ) ) {
						$locations_in_params[ $location_name ] = $_GET[ $location_name ];
					}
				}
			}

			/* combine all data into one */
			$location_data_array = array( 'any' => __( 'Any', 'framework' ), 'all_locations' => $all_locations, 'select_names' => $location_select_names, 'select_count' => $location_select_count, 'locations_in_params' => $locations_in_params, );

			/* provide location data array before custom script */
			wp_localize_script( 'custom', 'locationData', $location_data_array );

		}
	}

	add_action( 'after_location_fields', 'load_location_script' );
}


if ( ! function_exists( 'advance_search_options' ) ) {
	/**
	 * Advance search options (List boxes listing in advance-search.php)
	 *
	 * @param $taxonomy_name
	 */
	function advance_search_options( $taxonomy_name ) {
		$taxonomy_terms = get_terms( $taxonomy_name );
		$searched_term = '';

		if ( $taxonomy_name == 'property-city' ) {
			if ( ! empty( $_GET[ 'location' ] ) ) {
				$searched_term = $_GET[ 'location' ];
			}
		}

		if ( $taxonomy_name == 'property-type' ) {
			if ( ! empty( $_GET[ 'type' ] ) ) {
				$searched_term = $_GET[ 'type' ];
			}
		}

		if ( $taxonomy_name == 'property-status' ) {
			if ( ! empty( $_GET[ 'status' ] ) ) {
				$searched_term = $_GET[ 'status' ];
			}
		}

		if ( ! empty( $taxonomy_terms ) ) {
			foreach ( $taxonomy_terms as $term ) {
				if ( $searched_term == $term->slug ) {
					echo '<option value="' . $term->slug . '" selected="selected">' . $term->name . '</option>';
				} else {
					echo '<option value="' . $term->slug . '">' . $term->name . '</option>';
				}
			}
		}

		if ( $searched_term == 'any' || empty( $searched_term ) ) {
			echo '<option value="any" selected="selected">' . __( 'Any', 'framework' ) . '</option>';
		} else {
			echo '<option value="any">' . __( 'Any', 'framework' ) . '</option>';
		}
	}
}


if ( ! function_exists( 'advance_hierarchical_options' ) ) {
	/**
	 * Advance hierarchical options
	 *
	 * @param $taxonomy_name
	 */
	function advance_hierarchical_options( $taxonomy_name ) {
		$taxonomy_terms = get_terms( $taxonomy_name, array( 'hide_empty' => false, 'parent' => 0 ) );
		$searched_term = '';

		if ( $taxonomy_name == 'property-city' ) {
			if ( ! empty( $_GET[ 'location' ] ) ) {
				$searched_term = $_GET[ 'location' ];
			}
		}

		if ( $taxonomy_name == 'property-type' ) {
			if ( ! empty( $_GET[ 'type' ] ) ) {
				$searched_term = $_GET[ 'type' ];
			}
		}

		// Generate options
		generate_hirarchical_options( $taxonomy_name, $taxonomy_terms, $searched_term );

		if ( $searched_term == 'any' || empty( $searched_term ) ) {
			echo '<option value="any" selected="selected">' . __( 'Any', 'framework' ) . '</option>';
		} else {
			echo '<option value="any">' . __( 'Any', 'framework' ) . '</option>';
		}
	}
}


if ( ! function_exists( 'generate_hirarchical_options' ) ) {
	/**
	 * Generate Hierarchical Options
	 *
	 * @param $taxonomy_name
	 * @param $taxonomy_terms
	 * @param $searched_term
	 * @param string $prefix
	 */
	function generate_hirarchical_options( $taxonomy_name, $taxonomy_terms, $searched_term, $prefix = " " ) {
		if ( ! empty( $taxonomy_terms ) ) {
			foreach ( $taxonomy_terms as $term ) {
				if ( $searched_term == $term->slug ) {
					echo '<option value="' . $term->slug . '" selected="selected">' . $prefix . $term->name . '</option>';
				} else {
					echo '<option value="' . $term->slug . '">' . $prefix . $term->name . '</option>';
				}
				$child_terms = get_terms( $taxonomy_name, array( 'hide_empty' => false, 'parent' => $term->term_id ) );

				if ( ! empty( $child_terms ) ) {
					// recursive call
					generate_hirarchical_options( $taxonomy_name, $child_terms, $searched_term, "- " . $prefix );
				}
			}
		}
	}
}


if ( ! function_exists( 'generate_id_based_hirarchical_options' ) ) {
	/**
	 * Generate ID Based Hirarchical Options
	 *
	 * @param $taxonomy_name
	 * @param $taxonomy_terms
	 * @param $target_term_id
	 * @param string $prefix
	 */
	function generate_id_based_hirarchical_options( $taxonomy_name, $taxonomy_terms, $target_term_id, $prefix = " " ) {
		if ( ! empty( $taxonomy_terms ) ) {
			foreach ( $taxonomy_terms as $term ) {
				if ( $target_term_id == $term->term_id ) {
					echo '<option value="' . $term->term_id . '" selected="selected">' . $prefix . $term->name . '</option>';
				} else {
					echo '<option value="' . $term->term_id . '">' . $prefix . $term->name . '</option>';
				}
				$child_terms = get_terms( $taxonomy_name, array( 'hide_empty' => false, 'parent' => $term->term_id ) );

				if ( ! empty( $child_terms ) ) {
					// recursive call
					generate_id_based_hirarchical_options( $taxonomy_name, $child_terms, $target_term_id, "- " . $prefix );
				}
			}
		}
	}
}


if ( ! function_exists( 'numbers_list' ) ) {
	/**
	 * Numbers loop
	 *
	 * @param $numbers_list_for
	 */
	function numbers_list( $numbers_list_for ) {
		$numbers_array = array( 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 );
		$searched_value = '';

		if ( $numbers_list_for == 'bedrooms' ) {
			if ( isset( $_GET[ 'bedrooms' ] ) ) {
				$searched_value = $_GET[ 'bedrooms' ];
			}
		}

		if ( $numbers_list_for == 'bathrooms' ) {
			if ( isset( $_GET[ 'bathrooms' ] ) ) {
				$searched_value = $_GET[ 'bathrooms' ];
			}
		}

		if ( ! empty( $numbers_array ) ) {
			foreach ( $numbers_array as $number ) {
				if ( $searched_value == $number ) {
					echo '<option value="' . $number . '" selected="selected">' . $number . '</option>';
				} else {
					echo '<option value="' . $number . '">' . $number . '</option>';
				}
			}
		}

		if ( $searched_value == 'any' || empty( $searched_value ) ) {
			echo '<option value="any" selected="selected">' . __( 'Any', 'framework' ) . '</option>';
		} else {
			echo '<option value="any">' . __( 'Any', 'framework' ) . '</option>';
		}
	}
}


if ( ! function_exists( 'min_prices_list' ) ) {
	/**
	 * Minimum Prices
	 */
	function min_prices_list() {

		$min_price_array = array( 1000, 5000, 10000, 50000, 100000, 200000, 300000, 400000, 500000, 600000, 700000, 800000, 900000, 1000000, 1500000, 2000000, 2500000, 5000000 );

		/* Get values from theme options and convert them to an integer array */
		$minimum_price_values = get_option( 'theme_minimum_price_values' );
		if ( ! empty( $minimum_price_values ) ) {
			$min_prices_string_array = explode( ',', $minimum_price_values );
			if ( is_array( $min_prices_string_array ) && ! empty( $min_prices_string_array ) ) {
				$new_min_prices_array = array();
				foreach ( $min_prices_string_array as $string_price ) {
					$integer_price = doubleval( $string_price );
					if ( $integer_price > 1 ) {
						$new_min_prices_array[] = $integer_price;
					}
				}
				if ( ! empty( $new_min_prices_array ) ) {
					$min_price_array = $new_min_prices_array;
				}
			}
		}

		$minimum_price = '';
		if ( isset( $_GET[ 'min-price' ] ) ) {
			$minimum_price = doubleval( $_GET[ 'min-price' ] );
		}

		if ( ! empty( $min_price_array ) ) {
			foreach ( $min_price_array as $price ) {
				if ( $minimum_price == $price ) {
					echo '<option value="' . $price . '" selected="selected">' . get_custom_price( $price ) . '</option>';
				} else {
					echo '<option value="' . $price . '">' . get_custom_price( $price ) . '</option>';
				}
			}
		}

		if ( $minimum_price == 'any' || empty( $minimum_price ) ) {
			echo '<option value="any" selected="selected">' . __( 'Any', 'framework' ) . '</option>';
		} else {
			echo '<option value="any">' . __( 'Any', 'framework' ) . '</option>';
		}

	}
}


if ( ! function_exists( 'min_prices_for_rent_list' ) ) {
	/**
	 * Minimum Prices For Rent Only
	 */
	function min_prices_for_rent_list() {

		$min_price_for_rent_array = array( 500, 1000, 2000, 3000, 4000, 5000, 7500, 10000, 15000, 20000, 25000, 30000, 40000, 50000, 75000, 100000 );

		/* Get values from theme options and convert them to an integer array */
		$minimum_price_values_for_rent = get_option( 'theme_minimum_price_values_for_rent' );
		if ( ! empty( $minimum_price_values_for_rent ) ) {
			$min_prices_string_array = explode( ',', $minimum_price_values_for_rent );
			if ( is_array( $min_prices_string_array ) && ! empty( $min_prices_string_array ) ) {
				$new_min_prices_array = array();
				foreach ( $min_prices_string_array as $string_price ) {
					$integer_price = doubleval( $string_price );
					if ( $integer_price > 1 ) {
						$new_min_prices_array[] = $integer_price;
					}
				}
				if ( ! empty( $new_min_prices_array ) ) {
					$min_price_for_rent_array = $new_min_prices_array;
				}
			}
		}

		$minimum_price = '';
		if ( isset( $_GET[ 'min-price' ] ) ) {
			$minimum_price = doubleval( $_GET[ 'min-price' ] );
		}

		if ( ! empty( $min_price_for_rent_array ) ) {
			foreach ( $min_price_for_rent_array as $price ) {
				if ( $minimum_price == $price ) {
					echo '<option value="' . $price . '" selected="selected">' . get_custom_price( $price ) . '</option>';
				} else {
					echo '<option value="' . $price . '">' . get_custom_price( $price ) . '</option>';
				}
			}
		}

		if ( $minimum_price == 'any' || empty( $minimum_price ) ) {
			echo '<option value="any" selected="selected">' . __( 'Any', 'framework' ) . '</option>';
		} else {
			echo '<option value="any">' . __( 'Any', 'framework' ) . '</option>';
		}

	}
}


if ( ! function_exists( 'max_prices_list' ) ) {
	/**
	 * Maximum Prices
	 */
	function max_prices_list() {

		$max_price_array = array( 5000, 10000, 50000, 100000, 200000, 300000, 400000, 500000, 600000, 700000, 800000, 900000, 1000000, 1500000, 2000000, 2500000, 5000000, 10000000 );

		/* Get values from theme options and convert them to an integer array */
		$maximum_price_values = get_option( 'theme_maximum_price_values' );
		if ( ! empty( $maximum_price_values ) ) {
			$max_prices_string_array = explode( ',', $maximum_price_values );
			if ( is_array( $max_prices_string_array ) && ! empty( $max_prices_string_array ) ) {
				$new_max_prices_array = array();
				foreach ( $max_prices_string_array as $string_price ) {
					$integer_price = doubleval( $string_price );
					if ( $integer_price > 1 ) {
						$new_max_prices_array[] = $integer_price;
					}
				}
				if ( ! empty( $new_max_prices_array ) ) {
					$max_price_array = $new_max_prices_array;
				}
			}
		}

		$maximum_price = '';
		if ( isset( $_GET[ 'max-price' ] ) ) {
			$maximum_price = doubleval( $_GET[ 'max-price' ] );
		}

		if ( ! empty( $max_price_array ) ) {
			foreach ( $max_price_array as $price ) {
				if ( $maximum_price == $price ) {
					echo '<option value="' . $price . '" selected="selected">' . get_custom_price( $price ) . '</option>';
				} else {
					echo '<option value="' . $price . '">' . get_custom_price( $price ) . '</option>';
				}
			}
		}

		if ( $maximum_price == 'any' || empty( $maximum_price ) ) {
			echo '<option value="any" selected="selected">' . __( 'Any', 'framework' ) . '</option>';
		} else {
			echo '<option value="any">' . __( 'Any', 'framework' ) . '</option>';
		}
	}
}


if ( ! function_exists( 'max_prices_for_rent_list' ) ) {
	/**
	 * Maximum Price For Rent Only
	 */
	function max_prices_for_rent_list() {

		$max_price_for_rent_array = array( 1000, 2000, 3000, 4000, 5000, 7500, 10000, 15000, 20000, 25000, 30000, 40000, 50000, 75000, 100000, 150000 );

		/* Get values from theme options and convert them to an integer array */
		$maximum_price_for_rent_values = get_option( 'theme_maximum_price_values_for_rent' );
		if ( ! empty( $maximum_price_for_rent_values ) ) {
			$max_prices_string_array = explode( ',', $maximum_price_for_rent_values );
			if ( is_array( $max_prices_string_array ) && ! empty( $max_prices_string_array ) ) {
				$new_max_prices_array = array();
				foreach ( $max_prices_string_array as $string_price ) {
					$integer_price = doubleval( $string_price );
					if ( $integer_price > 1 ) {
						$new_max_prices_array[] = $integer_price;
					}
				}
				if ( ! empty( $new_max_prices_array ) ) {
					$max_price_for_rent_array = $new_max_prices_array;
				}
			}
		}

		$maximum_price = '';
		if ( isset( $_GET[ 'max-price' ] ) ) {
			$maximum_price = doubleval( $_GET[ 'max-price' ] );
		}

		if ( ! empty( $max_price_for_rent_array ) ) {
			foreach ( $max_price_for_rent_array as $price ) {
				if ( $maximum_price == $price ) {
					echo '<option value="' . $price . '" selected="selected">' . get_custom_price( $price ) . '</option>';
				} else {
					echo '<option value="' . $price . '">' . get_custom_price( $price ) . '</option>';
				}
			}
		}

		if ( $maximum_price == 'any' || empty( $maximum_price ) ) {
			echo '<option value="any" selected="selected">' . __( 'Any', 'framework' ) . '</option>';
		} else {
			echo '<option value="any">' . __( 'Any', 'framework' ) . '</option>';
		}
	}
}


if ( ! function_exists( 'inspiry_get_location_titles' ) ) :
	/**
	 * Get location titles
	 *
	 * @return array Location titles
	 */
	function inspiry_get_location_titles() {

		$location_select_titles = array(
			__( 'Main Location', 'framework' ),
			__( 'Child Location', 'framework' ),
			__( 'Grand Child Location', 'framework' ),
			__( 'Great Grand Child Location', 'framework' )
		);

		// override select boxes titles based on theme options data
		for ( $i = 1; $i <= 4; $i++ ) {
			$temp_location_title = get_option( 'theme_location_title_' . $i );
			if ( $temp_location_title ) {
				$location_select_titles[ $i - 1 ] = $temp_location_title;
			}
		}

		return $location_select_titles;
	}
endif;


if ( ! function_exists( 'inspiry_get_locations_number' ) ) :
	/**
	 * Return number of location boxes required in search form
	 *
	 * @return int number of locations
	 */
	function inspiry_get_locations_number() {
		$location_select_count = intval( get_option( 'theme_location_select_number' ) );
		if ( ! ( $location_select_count > 0 && $location_select_count < 5 ) ) {
			$location_select_count = 1;
		}
		return $location_select_count;
	}
endif;


if ( ! function_exists( 'inspiry_get_location_select_names' ) ) :
	/**
	 * Return location select names
	 *
	 * @return mixed|void
	 */
	function inspiry_get_location_select_names() {
		$location_select_names = array( 'location', 'child-location', 'grandchild-location', 'great-grandchild-location' );
		return apply_filters( 'inspiry_location_select_names', $location_select_names );
	}
endif;


if ( ! function_exists( 'real_homes_search' ) ) {
	/**
	 * Properties Search Filter
	 *
	 * @param $search_args
	 * @return mixed
	 */
	function real_homes_search( $search_args ) {

		$tax_query = array();   // taxonomy query array
		$meta_query = array();  // meta query qrray

		/* Keyword Based Search */
		if ( isset ( $_GET[ 'keyword' ] ) ) {
			$keyword = trim( $_GET[ 'keyword' ] );
			if ( ! empty( $keyword ) ) {
				$search_args[ 's' ] = $keyword;
			}
		}

		/* property type taxonomy query */
		if ( ( ! empty( $_GET[ 'type' ] ) ) && ( $_GET[ 'type' ] != 'any' ) ) {
			$tax_query[] = array(
				'taxonomy' => 'property-type',
				'field' => 'slug',
				'terms' => $_GET[ 'type' ]
			);
		}

		// property location taxonomy query
		$location_select_names = inspiry_get_location_select_names();
		$locations_count = count( $location_select_names );
		for ( $l = $locations_count - 1; $l >= 0; $l-- ) {
			if ( isset( $_GET[ $location_select_names[ $l ] ] ) ) {
				$current_location = $_GET[ $location_select_names[ $l ] ];
				if ( ( ! empty ( $current_location ) ) && ( $current_location != 'any' ) ) {
					$tax_query[] = array(
						'taxonomy' => 'property-city',
						'field' => 'slug',
						'terms' => $current_location
					);
					break;
				}
			}
		}

		/* property feature taxonomy query */
		if ( isset( $_GET[ 'features' ] ) ) {
			$required_features_slugs = $_GET[ 'features' ];
			if ( is_array( $required_features_slugs ) ) {

				$slugs_count = count( $required_features_slugs );
				if ( $slugs_count > 0 ) {

					/* build an array of existing features slugs to validate required feature slugs */
					$existing_features_slugs = array();
					$existing_features = get_terms( 'property-feature', array( 'hide_empty' => false ) );
					$existing_features_count = count( $existing_features );
					if ( $existing_features_count > 0 ) {
						foreach ( $existing_features as $feature ) {
							$existing_features_slugs[] = $feature->slug;
						}
					}

					foreach ( $required_features_slugs as $feature_slug ) {
						if ( in_array( $feature_slug, $existing_features_slugs ) ) {  // validate slug
							$tax_query[] = array(
								'taxonomy' => 'property-feature',
								'field' => 'slug',
								'terms' => $feature_slug
							);
						}
					}
				}
			}
		}

		/* property status taxonomy query */
		if ( ( ! empty( $_GET[ 'status' ] ) ) && ( $_GET[ 'status' ] != 'any' ) ) {
			$tax_query[] = array(
				'taxonomy' => 'property-status',
				'field' => 'slug',
				'terms' => $_GET[ 'status' ]
			);
		}

		/* Property Bedrooms Parameter */
		if ( ( ! empty( $_GET[ 'bedrooms' ] ) ) && ( $_GET[ 'bedrooms' ] != 'any' ) ) {
			$meta_query[] = array(
				'key' => 'REAL_HOMES_property_bedrooms',
				'value' => $_GET[ 'bedrooms' ],
				'compare' => '>=',
				'type' => 'DECIMAL'
			);
		}

		/* Property Bathrooms Parameter */
		if ( ( ! empty( $_GET[ 'bathrooms' ] ) ) && ( $_GET[ 'bathrooms' ] != 'any' ) ) {
			$meta_query[] = array(
				'key' => 'REAL_HOMES_property_bathrooms',
				'value' => $_GET[ 'bathrooms' ],
				'compare' => '>=',
				'type' => 'DECIMAL'
			);
		}

		/* Property ID Parameter */
		if ( isset( $_GET[ 'property-id' ] ) && ! empty( $_GET[ 'property-id' ] ) ) {
			$property_id = trim( $_GET[ 'property-id' ] );
			$meta_query[] = array(
				'key' => 'REAL_HOMES_property_id',
				'value' => $property_id,
				'compare' => 'LIKE',
				'type' => 'CHAR'
			);
		}

		/* Logic for Min and Max Price Parameters */
		if ( isset( $_GET[ 'min-price' ] ) && ( $_GET[ 'min-price' ] != 'any' ) && isset( $_GET[ 'max-price' ] ) && ( $_GET[ 'max-price' ] != 'any' ) ) {
			$min_price = doubleval( $_GET[ 'min-price' ] );
			$max_price = doubleval( $_GET[ 'max-price' ] );
			if ( $min_price >= 0 && $max_price > $min_price ) {
				$meta_query[] = array(
					'key' => 'REAL_HOMES_property_price',
					'value' => array( $min_price, $max_price ),
					'type' => 'NUMERIC',
					'compare' => 'BETWEEN'
				);
			}
		} elseif ( isset( $_GET[ 'min-price' ] ) && ( $_GET[ 'min-price' ] != 'any' ) ) {
			$min_price = doubleval( $_GET[ 'min-price' ] );
			if ( $min_price > 0 ) {
				$meta_query[] = array(
					'key' => 'REAL_HOMES_property_price',
					'value' => $min_price,
					'type' => 'NUMERIC',
					'compare' => '>='
				);
			}
		} elseif ( isset( $_GET[ 'max-price' ] ) && ( $_GET[ 'max-price' ] != 'any' ) ) {
			$max_price = doubleval( $_GET[ 'max-price' ] );
			if ( $max_price > 0 ) {
				$meta_query[] = array(
					'key' => 'REAL_HOMES_property_price',
					'value' => $max_price,
					'type' => 'NUMERIC',
					'compare' => '<='
				);
			}
		}


		/* Logic for Min and Max Area Parameters */
		if ( isset( $_GET[ 'min-area' ] ) && ! empty( $_GET[ 'min-area' ] ) && isset( $_GET[ 'max-area' ] ) && ! empty( $_GET[ 'max-area' ] ) ) {
			$min_area = intval( $_GET[ 'min-area' ] );
			$max_area = intval( $_GET[ 'max-area' ] );
			if ( $min_area >= 0 && $max_area > $min_area ) {
				$meta_query[] = array(
					'key' => 'REAL_HOMES_property_size',
					'value' => array( $min_area, $max_area ),
					'type' => 'NUMERIC',
					'compare' => 'BETWEEN'
				);
			}
		} elseif ( isset( $_GET[ 'min-area' ] ) && ! empty( $_GET[ 'min-area' ] ) ) {
			$min_area = intval( $_GET[ 'min-area' ] );
			if ( $min_area > 0 ) {
				$meta_query[] = array(
					'key' => 'REAL_HOMES_property_size',
					'value' => $min_area,
					'type' => 'NUMERIC',
					'compare' => '>='
				);
			}
		} elseif ( isset( $_GET[ 'max-area' ] ) && ! empty( $_GET[ 'max-area' ] ) ) {
			$max_area = intval( $_GET[ 'max-area' ] );
			if ( $max_area > 0 ) {
				$meta_query[] = array(
					'key' => 'REAL_HOMES_property_size',
					'value' => $max_area,
					'type' => 'NUMERIC',
					'compare' => '<='
				);
			}
		}


		/* if more than one taxonomies exist then specify the relation */
		$tax_count = count( $tax_query );
		if ( $tax_count > 1 ) {
			$tax_query[ 'relation' ] = 'AND';
		}

		/* if more than one meta query elements exist then specify the relation */
		$meta_count = count( $meta_query );
		if ( $meta_count > 1 ) {
			$meta_query[ 'relation' ] = 'AND';
		}

		if ( $tax_count > 0 ) {
			$search_args[ 'tax_query' ] = $tax_query;
		}

		/* if meta query has some values then add it to base home page query */
		if ( $meta_count > 0 ) {
			$search_args[ 'meta_query' ] = $meta_query;
		}

		/* Sort By Price */
		if ( ( isset( $_GET[ 'min-price' ] ) && ( $_GET[ 'min-price' ] != 'any' ) ) || ( isset( $_GET[ 'max-price' ] ) && ( $_GET[ 'max-price' ] != 'any' ) ) ) {
			$search_args[ 'orderby' ] = 'meta_value_num';
			$search_args[ 'meta_key' ] = 'REAL_HOMES_property_price';
			$search_args[ 'order' ] = 'ASC';
		}

		return $search_args;
	}

	add_filter( 'real_homes_search_parameters', 'real_homes_search' );
}


