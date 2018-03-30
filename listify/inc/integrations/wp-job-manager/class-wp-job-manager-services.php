<?php
/**
 *
 */

class Listify_WP_Job_Manager_Services extends listify_Integration {

	public function __construct() {
		$this->services = apply_filters( 'listify_wp_job_manager_services', array(
			'opentable', 'resurva'
		) );

		$this->includes = array();
		$this->integration = 'wp-job-manager';

		foreach ( $this->services as $service ) {
			$this->includes[] = 'services/class-wp-job-manager-service-' . $service . '.php';
		}

		parent::__construct();
	}

	public function setup_actions() {

	}

}