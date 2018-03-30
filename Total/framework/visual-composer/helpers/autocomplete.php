<?php
/**
 * VC Autocomplete Functions
 *
 * @package Total WordPress Theme
 * @subpackage VC Functions
 * @version 3.5.0
 */

/**
 * Suggest terms for autocomplete
 *
 * @since 2.1.0
 */
function vcex_suggest_terms( $search_string ) {
	$terms_list = array();
	$taxonomies = get_taxonomies( array( 'public' => true ), 'objects' );
	foreach( $taxonomies as $taxonomy ) {
		$terms = get_terms( $taxonomy->name,
			array(
				'hide_empty' => false,
				'search'     => $search_string,
		) );
		if ( $terms ) {
			foreach ( $terms as $term ) {
				$terms_list[] = array(
					'label'    => $term->name,
					'value'    => $term->slug,
					'group_id' => $taxonomy->labels->name,
					'group'    => $taxonomy->labels->name,
				);
			}
		}
	}
	return $terms_list;
}

/**
 * Renders terms for autocomplete
 *
 * @since 2.1.0
 */
function vcex_render_terms( $data ) {
	return $data; // No way around it, must show slug :(
}

/**
 * Suggest users for autocomplete
 *
 * @since 3.0.0
 */
function vcex_suggest_users( $search_string ) {
	$users_list = array();
	$users = get_users(
		array(
			'search' => $search_string .'*',
		)
	);
	foreach ( $users as $user ) {
		$users_list[] = array(
			'label' => esc_html( $user->display_name ),
			'value' => $user->ID,
		);
	}
	return $users_list;
}

/**
 * Renders users for autocomplete
 *
 * @since 2.1.0
 */
function vcex_render_users( $data ) {
	$user = $data['value'];
	$user_data = get_userdata( $user );
	if ( is_object( $user_data ) ) {
		$label = ! empty( $user_data->nickname ) ? $user_data->nickname : $user_data->name;
		return array(
			'value' => $user,
			'label' => $label,
		);
	} else{
		return false;
	}
}

/**
 * Suggest taxonomies for autocomplete
 *
 * @since 3.0.0
 */
function vcex_suggest_taxonomies( $search_string ) {
	$taxonomies_list = array();
	$taxonomies = get_taxonomies( array(
		'public' => true
	) );
	foreach ( $taxonomies as $taxonomy ) {
		$tax = get_taxonomy( $taxonomy );
		$label = $tax->labels->name;
		if ( stripos( $label, $search_string ) !== false) {
			$taxonomies_list[] = array(
				'label' => $label,
				'value' => $taxonomy,
			);
		}
	}
	return $taxonomies_list;
}

/**
 * Renders taxonomies for autocomplete
 *
 * @since 2.1.0
 */
function vcex_render_taxonomies( $data ) {
	$value = $data['value'];
	$tax   = get_taxonomy( $value );
	if ( is_object( $tax ) && ! empty( $tax->labels->name ) ) {
		return array(
			'label' => $tax->labels->name,
			'value' => $value,
		);
	}
	return $data;
}

/**
 * Suggest categories for autocomplete
 *
 * @since 2.1.0
 */
function vcex_suggest_categories( $search_string ) {
	$categories = array();
	$get_terms = get_terms(
		'category',
		array(
			'hide_empty' => false,
			'search'     => $search_string,
	) );
	if ( $get_terms ) {
		foreach ( $get_terms as $term ) {
			$categories[] = array(
				'label' => $term->name,
				'value' => $term->term_id,
			);
		}
	}
	return $categories;
}

/**
 * Renders categories for autocomplete
 *
 * @since 2.1.0
 */
function vcex_render_categories( $data ) {
	$value = $data['value'];
	$category = get_term_by( 'term_id', intval( $value ), 'category' );
	if ( is_object( $category ) ) {
		return array(
			'label' => $category->name,
			'value' => $value,
		);
	}
	return $data;
}

/**
 * Suggest Portfolio Categories for autocomplete
 *
 * @since 2.1.0
 */
function vcex_suggest_portfolio_categories( $search_string ) {
	$portfolio_categories = array();
	$get_terms = get_terms(
		'portfolio_category',
		array(
			'hide_empty' => false,
			'search'     => $search_string,
	) );
	if ( $get_terms ) {
		foreach ( $get_terms as $term ) {
			if ( $term->parent ) {
				$parent = get_term( $term->parent, 'portfolio_category' );
				$label = $term->name .' ('. $parent->name .')';
			} else {
				$label = $term->name;
			}
			$portfolio_categories[] = array(
				'label' => $label,
				'value' => $term->term_id,
			);
		}
	}
	return $portfolio_categories;
}

/**
 * Renders Portfolio Categories for autocomplete
 *
 * @since 2.1.0
 */
function vcex_render_portfolio_categories( $data ) {
	$value = $data['value'];
	$term = get_term_by( 'term_id', intval( $value ), 'portfolio_category' );
	if ( is_object( $term ) ) {
		if ( $term->parent ) {
			$parent = get_term( $term->parent, 'portfolio_category' );
			$label = $term->name .' ('. $parent->name .')';
		} else {
			$label = $term->name;
		}
		return array(
			'label' => $label,
			'value' => $value,
		);
	}
	return $data;
}

/**
 * Suggest Staff Categories for autocomplete
 *
 * @since 2.1.0
 */
function vcex_suggest_staff_categories( $search_string ) {
	$staff_categories = array();
	$get_terms = get_terms(
		'staff_category',
		array(
			'hide_empty' => false,
			'search'     => $search_string,
	) );
	if ( $get_terms ) {
		foreach ( $get_terms as $term ) {
			if ( $term->parent ) {
				$parent = get_term( $term->parent, 'staff_category' );
				$label = $term->name .' ('. $parent->name .')';
			} else {
				$label = $term->name;
			}
			$staff_categories[] = array(
				'label' => $label,
				'value' => $term->term_id,
			);
		}
	}
	return $staff_categories;
}

/**
 * Renders Staff Categories for autocomplete
 *
 * @since 2.1.0
 */
function vcex_render_staff_categories( $data ) {
	$value = $data['value'];
	$term = get_term_by( 'term_id', intval( $value ), 'staff_category' );
	if ( is_object( $term ) ) {
		if ( $term->parent ) {
			$parent = get_term( $term->parent, 'staff_category' );
			$label = $term->name .' ('. $parent->name .')';
		} else {
			$label = $term->name;
		}
		return array(
			'label' => $label,
			'value' => $value,
		);
	}
	return $data;
}

/**
 * Suggest Testimonials Categories for autocomplete
 *
 * @since 2.1.0
 */
function vcex_suggest_testimonials_categories( $search_string ) {
	$testimonials_categories = array();
	$get_terms = get_terms(
		'testimonials_category',
		array(
			'hide_empty' => false,
			'search'     => $search_string,
	) );
	if ( $get_terms ) {
		foreach ( $get_terms as $term ) {
			if ( $term->parent ) {
				$parent = get_term( $term->parent, 'testimonials_category' );
				$label = $term->name .' ('. $parent->name .')';
			} else {
				$label = $term->name;
			}
			$testimonials_categories[] = array(
				'label' => $label,
				'value' => $term->term_id,
			);
		}
	}
	return $testimonials_categories;
}

/**
 * Renders Testimonials Categories for autocomplete
 *
 * @since 2.1.0
 */
function vcex_render_testimonials_categories( $data ) {
	$value = $data['value'];
	$term = get_term_by( 'term_id', intval( $value ), 'testimonials_category' );
	if ( is_object( $term ) ) {
		if ( $term->parent ) {
			$parent = get_term( $term->parent, 'testimonials_category' );
			$label = $term->name .' ('. $parent->name .')';
		} else {
			$label = $term->name;
		}
		return array(
			'label' => $label,
			'value' => $value,
		);
	}
	return $data;
}

/**
 * Suggest Product Categories for autocomplete
 *
 * @since 2.1.0
 */
function vcex_suggest_product_categories( $search_string ) {
	$product_categories = array();
	$get_terms = get_terms(
		'product_cat',
		array(
			'hide_empty' => false,
			'search'     => $search_string,
	) );
	if ( $get_terms ) {
		foreach ( $get_terms as $term ) {
			if ( $term->parent ) {
				$parent = get_term( $term->parent, 'product_cat' );
				$label = $term->name .' ('. $parent->name .')';
			} else {
				$label = $term->name;
			}
			$product_categories[] = array(
				'label' => $label,
				'value' => $term->term_id,
			);
		}
	}
	return $product_categories;
}

/**
 * Renders Product Categories for autocomplete
 *
 * @since 2.1.0
 */
function vcex_render_product_categories( $data ) {
	$value = $data['value'];
	$term = get_term_by( 'term_id', intval( $value ), 'product_cat' );
	if ( is_object( $term ) ) {
		if ( $term->parent ) {
			$parent = get_term( $term->parent, 'product_cat' );
			$label = $term->name .' ('. $parent->name .')';
		} else {
			$label = $term->name;
		}
		return array(
			'label' => $label,
			'value' => $value,
		);
	}
	return $data;
}

/**
 * Suggest Staff Members for autocomplete
 *
 * @since 2.1.0
 */
function vcex_suggest_staff_members( $search_string ) {
	$staff_members = array();
	$staff_ids = get_posts( array(
		'posts_per_page' => -1,
		'post_type'      => 'staff',
		's'              => $search_string,
		'fields'         => 'ids',
	) );
	if ( ! empty( $staff_ids ) ) {
		foreach ( $staff_ids as $id ) {
			$staff_members[] = array(
				'label' => get_the_title( $id ),
				'value' => $id,
			);
		}
	}
	wp_reset_postdata();
	return $staff_members;
}

/**
 * Suggest Staff Members for autocomplete
 *
 * @since 2.1.0
 */
function vcex_render_staff_members( $data ) {
	return array(
		'label' => get_the_title( $data['value'] ),
		'value' => $data['value'],
	);
}