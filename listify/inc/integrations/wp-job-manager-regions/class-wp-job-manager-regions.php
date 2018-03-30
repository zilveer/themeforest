<?php
/**
 * WP Job Manager - Predefined Regions
 */

class Listify_WP_Job_Manager_Regions extends listify_Integration {

	public function __construct() {
		$this->includes = array();
		$this->integration = 'wp-job-manager-regions';

		parent::__construct();
	}

	public function setup_actions() {
		$regions = wp_job_manager_regions();

		remove_filter( 'the_job_location', array( $regions->template, 'the_job_location' ), 10, 2 );
	}
}

$GLOBALS[ 'listify_job_manager_regions' ] = new Listify_WP_Job_Manager_Regions();
