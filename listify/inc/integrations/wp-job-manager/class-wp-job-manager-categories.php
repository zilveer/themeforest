<?php

class Listify_WP_Job_Manager_Categories {

	public function __construct() {
		if ( ! get_theme_mod( 'categories-only', true ) ) {
			return;
		}

		add_action( 'init', array( $this, 'register_post_types' ), 11 );
		add_filter( 'body_class', array( $this, 'body_class' ) );
		add_filter( 'manage_edit-job_listing_columns', array( $this, 'columns' ), 11 );
		add_filter( 'submit_job_form_fields', array( $this, 'remove_type_field' ) );
		add_filter( 'job_manager_get_listings_args', array( $this, 'clear_types' ) );
	}

	public function register_post_types() {
		if ( ! listify_theme_mod( 'categories-only', true ) ) {
			return;
		}

		register_taxonomy( 'job_listing_type', array() );
	}

	public function body_class( $classes ) {
		$classes[] = 'wp-job-manager-categories-only';

		return $classes;
	}

	public function columns( $columns ) {
		unset( $columns[ 'job_listing_type' ] );

		return $columns;
	}

	public function remove_type_field( $fields ) {
		unset( $fields[ 'job' ][ 'job_type' ] );

		return $fields;
	}

	public function clear_types( $args ) {
		$args[ 'job_types' ] = array();

		return $args;
	}

}
