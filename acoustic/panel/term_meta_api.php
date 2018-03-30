<?php
/*
 * Term Meta API
 */

add_action( 'after_switch_theme', 'ci_term_meta_init' );
if ( ! function_exists( 'ci_term_meta_init' ) ):
function ci_term_meta_init() {
	$taxonomies = get_taxonomies( array(), 'objects' );
	foreach( $taxonomies as $taxonomy ) {
		$terms = get_terms( $taxonomy->name, array( 'hide_empty' => false ) );
		foreach( $terms as $term ) {
			$meta = ci_term_meta_get( $term->term_id );
			if( false === $meta ) {
				$meta = array();
			}

			$meta = apply_filters( 'ci_term_meta_init', $meta, $term, $taxonomy );
			if( false === $meta || ( is_array( $meta ) && count( $meta ) == 0 ) ) {
				continue;
			}

			ci_term_meta_set( $term->term_id, false, $meta );
		}
	}
}
endif;

if ( ! function_exists( 'ci_term_meta_fields' ) ):
function ci_term_meta_fields() {
	/*
	 * Themes should add their whitelisted fields by adding associative values in 'ci_term_meta_fields'
	 * e.g.:
	 * $fields['layout'] = array(
	 *      'form_name' => 'ci-term-meta-layout',
	 *      'default' => 'value',
	 *      'add_form_callback' => 'ci_theme_term_meta_add',
	 *      'edit_form_callback' => 'ci_theme_term_meta_edit',
	 *      'validate_callback' => 'ci_theme_term_meta_validate_layout',
	 *      'taxonomies' => array(
	 *          'category',
	 *          'post_tag',
	 *      ),
	 * );
	 */
	$fields = apply_filters( 'ci_term_meta_fields', array() );
	return $fields;
}
endif;

if( ! function_exists( 'ci_term_meta_get' ) ):
function ci_term_meta_get( $term_id, $key = false ) {
	$term_id = intval( $term_id );

	$pre = apply_filters( 'ci_pre_term_meta_get', false, $term_id, $key );
	if ( false !== $pre ) {
		return $pre;
	}

	$meta    = get_option( 'ci_term_meta_' . $term_id );
	$return  = false;

	if ( false === $key ) {
		$return = $meta;
	} elseif ( isset( $meta[ $key ] ) ) {
		$return = $meta[ $key ];
	}

	return apply_filters( 'ci_term_meta_get', $return, $meta, $term_id, $key );
}
endif;

if( ! function_exists( 'ci_term_meta_set' ) ):
function ci_term_meta_set( $term_id, $key, $value ) {
	$meta     = ci_term_meta_get( $term_id );
	$old_meta = $meta;

	do_action( 'ci_term_meta_update', $term_id, $key, $value, $meta );
	if( false === $key ) {
		$meta = $value;
	} else {
		if( false === $meta ) {
			$meta = array();
		}
		$meta[ $key ] = $value;
	}

	update_option( 'ci_term_meta_' . $term_id, apply_filters( 'ci_term_meta_set', $meta, $old_meta, $term_id, $key, $value ) );

	do_action( 'ci_term_meta_updated', $term_id, $key, $value, $meta, $old_meta );

	return $meta;
}
endif;

add_action( 'delete_term', 'ci_term_meta_delete' );
if( ! function_exists( 'ci_term_meta_delete' ) ):
function ci_term_meta_delete( $term_id, $key = false ) {
	$meta     = ci_term_meta_get( $term_id );
	$old_meta = $meta;

	do_action( 'ci_term_meta_delete', $term_id, $key, $meta );
	if ( false === $key ) {
		delete_option( 'ci_term_meta_' . $term_id );
	} elseif ( isset( $meta[ $key ] ) ) {
		unset( $meta[ $key ] );
		ci_term_meta_set( $term_id, false, $meta );
	}
	do_action( 'ci_term_meta_deleted', $term_id, $key, $meta, $old_meta );
}
endif;


add_action( 'init', 'ci_term_meta_register_form_fields' );
if( ! function_exists( 'ci_term_meta_register_form_fields' ) ):
function ci_term_meta_register_form_fields() {
	$taxonomies = get_taxonomies( array(), 'objects' );
	foreach( $taxonomies as $taxonomy ) {
		add_action( $taxonomy->name . '_add_form_fields', 'ci_term_meta_add_form_fields', 10 );
		add_action( $taxonomy->name . '_edit_form_fields', 'ci_term_meta_edit_form_fields', 10, 2 );
	}
}
endif;

if( ! function_exists( 'ci_term_meta_add_form_fields' ) ):
function ci_term_meta_add_form_fields( $taxonomy ) {
	$fields = ci_term_meta_fields();
	foreach ( $fields as $k => $v ) {
		if ( in_array( $taxonomy, $v['taxonomies'] ) && is_callable( $v['add_form_callback'], true, $callable ) ) {
			call_user_func( $callable, $taxonomy, $v['default'] );
		}
	}
}
endif;

if( ! function_exists( 'ci_term_meta_edit_form_fields' ) ):
function ci_term_meta_edit_form_fields( $term, $taxonomy ) {
	$fields = ci_term_meta_fields();
	foreach ( $fields as $k => $v ) {
		if ( in_array( $taxonomy, $v['taxonomies'] ) && is_callable( $v['edit_form_callback'], true, $callable ) ) {
			$value = ci_term_meta_get( $term->term_id, $k );
			call_user_func( $callable, $term, $taxonomy, $value );
		}
	}
}
endif;

add_action( 'create_term', 'ci_term_meta_create_form', 10, 3 );
if( ! function_exists( 'ci_term_meta_create_form' ) ):
function ci_term_meta_create_form( $term_id, $tt_id, $taxonomy ) {
	$fields = ci_term_meta_fields();
	foreach ( $fields as $k => $v ) {
		if ( in_array( $taxonomy, $v['taxonomies'] ) && isset( $_POST[ $v['form_name'] ] ) ) {
			$value = $v['default'];
			if ( is_callable( $v['validate_callback'], true, $callable ) ) {
				$action = 'create';
				$value  = call_user_func( $callable, $k, $_POST[ $v['form_name'] ], $term_id, $tt_id, $taxonomy, $action );
			}
			ci_term_meta_set( $term_id, $k, $value );
		}
	}
}
endif;

add_action( 'edit_term', 'ci_term_meta_edit_form', 10, 3 );
if( ! function_exists( 'ci_term_meta_edit_form' ) ):
function ci_term_meta_edit_form( $term_id, $tt_id, $taxonomy ) {
	$fields = ci_term_meta_fields();
	foreach ( $fields as $k => $v ) {
		if ( in_array( $taxonomy, $v['taxonomies'] ) && isset( $_POST[ $v['form_name'] ] ) ) {
			$value = $_POST[ $v['form_name'] ];
			if ( is_callable( $v['validate_callback'], true, $callable ) ) {
				$action = 'edit';
				$value  = call_user_func( $callable, $k, $_POST[ $v['form_name'] ], $term_id, $tt_id, $taxonomy, $action );
			}
			ci_term_meta_set( $term_id, $k, $value );
		}
	}
}
endif;
