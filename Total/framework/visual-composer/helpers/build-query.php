<?php
/**
 * Used to build WP Queries for Visual Composer elements.
 *
 * @package Total WordPress Theme
 * @subpackage VC Functions
 * @version 3.3.0
 */

class VCEX_Query_Builder {
	public $args = array();
	public $atts = array();

	/**
	 * Class Constructor
	 *
	 * @since 2.0.0
	 * @param $atts
	 */
	public function __construct( $atts ) {

		// Get shortcode atts
		$this->atts = $atts;

		// Loop through shortcode atts and run class methods
		foreach ( $atts as $key => $value ) {
			$method = 'parse_' . $key;
			if ( method_exists( $this, $method ) ) {
				$this->$method( $value );
			}
		}

	}

	/**
	 * Posts In
	 *
	 * @since 2.0.0
	 */
	private function parse_posts_in( $value ) {
		if ( ! $value ) return;
		$this->args['post__in'] = $this->string_to_array( $value );
		$this->args['ignore_sticky_posts']  = true;
	}

	/**
	 * Offset
	 *
	 * @since 2.0.0
	 */
	private function parse_offset( $value ) {
		if ( ! $value ) return;
		$this->args['offset'] = $value;
	}

	/**
	 * Limit by Author
	 *
	 * @since 2.0.0
	 */
	private function parse_author_in( $value ) {
		
		if ( ! $value ) return;
		$this->args['author__in'] = $this->string_to_array( $value );
		$this->args['ignore_sticky_posts'] = true;
	}

	/**
	 * Show only items with thumbnails
	 *
	 * @since 2.0.0
	 */
	private function parse_thumbnail_query( $value ) {
		if ( 'true' == $value ) {
			$this->args['meta_query'] = array( array ( 'key' => '_thumbnail_id' ) );
		}
	}

	/**
	 * Count
	 *
	 * @since 2.0.0
	 */
	private function parse_count( $value ) {
		$value = $value ? $value : '-1';
		$this->args['posts_per_page'] = (int) $value;
	}

	/**
	 * Posts Per Page
	 *
	 * @since 2.0.0
	 */
	private function parse_posts_per_page( $value ) {
		$value = $value ? $value : '-1';
		$this->args['posts_per_page'] = (int) $value;
	}

	/**
	 * Pagination
	 *
	 * @since 2.0.0
	 */
	private function parse_pagination( $value ) {
		if ( 'true' == $value ) {
			if ( get_query_var( 'page' ) ) {
				$paged = get_query_var( 'page' );
			} elseif ( get_query_var( 'paged' ) ) {
				$paged = get_query_var( 'paged' );
			} else {
				$paged = 1;
			}
			$this->args['paged'] = $paged;
		} else {
			$this->args['no_found_rows'] = true;
		}
	}

	/**
	 * Ignore sticky posts
	 *
	 * @since 2.0.0
	 */
	private function parse_ignore_sticky_posts( $value ) {
		if ( 'true' == $value ) {
			$this->args['ignore_sticky_posts'] = true;
		}
	}

	/**
	 * Orderby
	 *
	 * @since 2.0.0
	 */
	private function parse_orderby( $value ) {
		$this->args['orderby'] = $value;
	}

	/**
	 * Orderby meta key
	 *
	 * @since 2.0.0
	 */
	private function parse_orderby_meta_key( $value ) {
		if ( ! $value ) return;
		if ( ! empty( $this->args['orderby'] ) && in_array( $this->args['orderby'], array( 'meta_value', 'meta_value_num' ) ) ) {
			$this->args['meta_key'] = $value;
		}
	}

	/**
	 * Order
	 *
	 * @since 2.0.0
	 */
	private function parse_order( $value ) {
		$this->args['order'] = $value;
	}

	/**
	 * Post Types
	 *
	 * @since 2.0.0
	 */
	private function parse_post_type( $value ) {
		$value = $value ? $value : 'post';
		$this->args['post_type'] = $this->string_to_array( $value );
	}

	/**
	 * Post Types
	 *
	 * @since 2.0.0
	 */
	private function parse_post_types( $value ) {
		$value = $value ? $value : 'post';
		$this->args['post_type'] = $this->string_to_array( $value );
	}

	/**
	 * Author
	 *
	 * @since 2.0.0
	 */
	private function parse_authors( $value ) {
		if ( ! $value ) return;
		$this->args['author'] = $value;
	}

	/**
	 * Products out of stock
	 *
	 * @since 2.0.0
	 */
	private function parse_exclude_products_out_of_stock( $value ) {
		if ( ! $value ) return;
		$this->args['meta_query'] = array(
			array(
				'key'     => '_stock_status',
				'value'   => 'outofstock',
				'compare' => 'NOT IN'
			),
		);
	}

	/**
	 * Featured products only
	 *
	 * @since 2.0.0
	 */
	private function parse_featured_products_only( $value ) {
		if ( ! $value ) return;
		$this->args['meta_key']   =  '_featured';
		$this->args['meta_value'] = 'yes';
	}

	/**
	 * Tax Query
	 *
	 * @since 2.0.0
	 */
	private function parse_tax_query( $value ) {

		// Return if set to false
		if ( 'false' == $value ) {
			return;
		}

		// Get defined tax query terms
		if ( 'true' == $value ) {
			$tax_query_taxonomy = isset ( $this->atts['tax_query_taxonomy'] ) ? $this->atts['tax_query_taxonomy'] : '';
			if ( taxonomy_exists( $tax_query_taxonomy ) ) {
				$tax_query_terms = isset ( $this->atts['tax_query_terms'] ) ? $this->string_to_array( $this->atts['tax_query_terms'] ) : '';
				if ( $tax_query_terms ) {
					$this->args['tax_query'] = array(
						'relation' => 'AND',
						array(
							'taxonomy' => $tax_query_taxonomy,
							'field'    => 'slug',
							'terms'    => $tax_query_terms,
						),
					);
				}
			}
		}

		// Generate tax query based on Include/Exclude categories
		else {

			// Get terms to include/excude
			$terms = $this->get_terms();

			// Return if no terms
			if ( empty( $terms ) ) {
				$this->args['tax_query'] = NULL;
			}

			// The tax query relation
			$this->args['tax_query'] = array(
				'relation' => 'AND',
			);

			// Get taxonomies
			$taxonomies = $this->get_taxonomies();

			// If Single taxonomy
			if ( '1' == count( $taxonomies ) ) {

				// Includes
				if ( ! empty( $terms['include'] ) ) {
					$this->args['tax_query'][] = array(
						'taxonomy' => $taxonomies[0],
						'field'    => 'id',
						'terms'    => $terms['include'],
						'operator' => 'IN',
					);
				}

				// Excludes
				if ( ! empty( $terms['exclude'] ) ) {
					$this->args['tax_query'][] = array(
						'taxonomy' => $taxonomies[0],
						'field'    => 'id',
						'terms'    => $terms['exclude'],
						'operator' => 'NOT IN',
					);
				}

			}

			// More then 1 taxonomy
			elseif ( $taxonomies ) {

				// Merge terms
				$merge_terms = array_merge( $terms['include'], $terms['exclude'] );

				// Loop through terms to build tax_query
				$get_terms = get_terms( $taxonomies, array(
					'include' => $merge_terms,
				) );
				foreach ( $get_terms as $term ) {
					$operator = in_array( $term->term_id, $terms['exclude'] ) ? 'NOT IN' : 'IN';
					$this->args['tax_query'][] = array(
						'field'    => 'id',
						'taxonomy' => $term->taxonomy,
						'terms'    => $term->term_id,
						'operator' => $operator,
					);
				}

			}

		}

	}

	/**
	 * Include Categories
	 *
	 * @since 2.0.0
	 */
	private function include_categories() {
		if ( empty( $this->atts['include_categories'] ) ) {
			return;
		}
		$taxonomies = $this->get_taxonomies();
		$taxonomy   = $taxonomies[0];
		return $this->sanitize_autocomplete( $this->atts['include_categories'], $taxonomy );
	}

	/**
	 * Exclude Categories
	 *
	 * @since 2.0.0
	 */
	private function exclude_categories() {
		if ( empty( $this->atts['exclude_categories'] ) ) return;
		$taxonomies = $this->get_taxonomies();
		$taxonomy   = $taxonomies[0];
		return $this->sanitize_autocomplete( $this->atts['exclude_categories'], $taxonomy );
	}

	/**
	 * Get taxonomies
	 *
	 * @since 2.0.0
	 */
	private function get_taxonomies() {
		if ( ! empty( $this->atts['taxonomy'] ) ) {
			return array( $this->atts['taxonomy'] );
		} elseif ( ! empty( $this->atts['post_type'] ) ) {
			$tax = wpex_get_post_type_cat_tax( $this->atts['post_type'] );
			if ( $tax ) {
				return $this->string_to_array( $tax );
			}
		} elseif( ! empty( $this->atts['taxonomies'] ) ) {
			return $this->string_to_array( $this->atts['taxonomies'] );
		}
	}

	/**
	 * Get the terms to include in the Query
	 *
	 * @since 2.0.0
	 */
	private function get_terms() {

		$terms = array(
			'include' => array(),
			'exclude' => array(),
		);

		// Include categories
		$include_categories = $this->include_categories();
		if ( ! empty( $include_categories ) ) {
			foreach ( $include_categories as $cat ) {
				$terms['include'][] = $cat;
			}
		}

		// Exclude categories
		$exclude_categories = $this->exclude_categories();
		if ( ! empty( $exclude_categories ) ) {
			foreach ( $exclude_categories as $cat ) {
				$terms['exclude'][] = $cat;
			}
		}

		// Return terms
		return $terms;
		
	}

	/**
	 * Converts a string to an Array
	 *
	 * @since 2.0.0
	 */
	private function string_to_array( $value ) {

		// Return if value is empty
		if ( ! $value ) {
			return;
		}

		// Return if already an array
		if ( is_array( $value ) ) {
			return $value;
		}

		// Define output array
		$array  = array();

		// Clean up value
		$items  = preg_split( '/\,[\s]*/', $value );

		// Create array
		foreach ( $items as $item ) {
			if ( strlen( $item ) > 0 ) {
				$array[] = $item;
			}
		}

		// Return array
		return $array;

	}

	/**
	 * Sanitizes autocomplete data and returns ID's of terms to include or exclude
	 *
	 * @since 2.0.0
	 */
	private function sanitize_autocomplete( $terms, $taxonomy ) {

		// Turn into array
		$terms  = preg_split( '/\,[\s]*/', $terms );
		$return = array();

		// Loop through data and turn slugs into ID's
		foreach( $terms as $term ) {

			// Check if is integer or slug
			$field = ( is_numeric( $term ) ) ? 'id' : 'slug';

			// Get taxonomy ID from slug
			$term_data = get_term_by( $field, $term, $taxonomy );

			// Add to new array if it's a valid term
			if ( $term_data ) {
				$return[] = $term_data->term_id;
			}

		}

		// Return array
		return $return;

	}

	/**
	 * This function actually builds and returns the Query
	 *
	 * @since 2.0.0
	 */
	public function build() {
		$this->args = apply_filters( 'vcex_grid_query', $this->args, $this->atts );
		return new WP_Query( $this->args );
	}

}

// Helper function runs the VCEX_Query_Builder class and returns the Query array 
function vcex_build_wp_query( $atts ) {
	$query_builder = new VCEX_Query_Builder( $atts );
	return $query_builder->build();
}