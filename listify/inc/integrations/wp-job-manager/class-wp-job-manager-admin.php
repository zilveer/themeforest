<?php
/**
 * WP Job Manager - Admin
 *
 * @since 1.7.0
 * @package Listify
 * @subpackage Admin
 */

class Listify_WP_Job_Manager_Admin {

	/**
	 * WordPress hooks/filters.
	 *
	 * @since 1.7.0
	 * @return void
	 */
	public static function setup_actions() {
		add_filter( 'manage_edit-job_listing_columns', array( __CLASS__, 'columns' ), 20 );
	}

	/**
	 * Admin columns.
	 *
	 * Remove the `filled` column.
	 *
	 * @since 1.7.0
	 * @param array $columns
	 * @return array $columns
	 */
	public static function columns( $columns ) {
		unset( $columns[ 'filled' ] );

		return $columns;
	}

}

Listify_WP_Job_Manager_Admin::setup_actions();
