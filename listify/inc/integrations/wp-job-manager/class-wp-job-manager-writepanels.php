<?php
if ( ! class_exists( 'WP_Job_Manager_Writepanels' ) ) {
	include( JOB_MANAGER_PLUGIN_DIR . '/includes/admin/class-wp-job-manager-writepanels.php' );
}

class Listify_WP_Job_Manager_Writepanels extends WP_Job_Manager_Writepanels {

	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
	}

	public function add_meta_boxes() {
		add_meta_box( 'listify_business_hours', __( 'Hours of Operation', 'listify' ), array( $this, 'business_hours' ), 'job_listing', 'side', 'low' );
	}

	public function business_hours( $post ) {
		global $post;

		do_action( 'listify_writepanels_business_hours', $post );
	}

}
