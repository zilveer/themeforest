<?php
/**
 * WP Job Manager
 */

class Listify_WP_Job_Manager_Bookmarks extends Listify_Integration {

	public function __construct() {
		$this->includes = array();
		$this->integration = 'wp-job-manager-bookmarks';

		parent::__construct();
	}

	public function setup_actions() {
		global $job_manager_bookmarks;

		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ), 20 );
		add_action( 'listify_content_job_listing_before', array( $job_manager_bookmarks, 'bookmark_form' ), 100 );

		add_filter( 'job_manager_bookmark_form_login_url', array( $this, 'login_url' ) );
	}

	public function wp_enqueue_scripts() {
		wp_dequeue_style( 'wp-job-manager-bookmarks-frontend' );
		wp_deregister_script( 'wp-job-manager-bookmarks-bookmark-js' );

		wp_register_script( 'wp-job-manager-bookmarks-bookmark-js', listify_Integration::get_url() . 'js/wp-job-manager-bookmarks.min.js', array( 'jquery', 'listify' ), JOB_MANAGER_BOOKMARKS_VERSION, true );

		wp_enqueue_script( 'wp-job-manager-bookmarks-bookmark-js' );
	}

	public function login_url( $url ) {
		if ( ! class_exists( 'WooCommerce' ) ) {
			return $url;
		}

		return get_permalink( wc_get_page_id( 'myaccount' ) );
	}
}

$GLOBALS[ 'listify_job_manager_bookmarks' ] = new Listify_WP_Job_Manager_Bookmarks();
