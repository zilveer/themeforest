<?php
/**
 * Field Editor
 */

class Listify_WP_Job_Manager_Field_Editor extends Listify_Integration {

	public function __construct() {
		$this->includes = array();
		$this->integration = 'wp-job-manager-field-editor';

		parent::__construct();
	}

	public function setup_actions() {
		add_filter( 'job_manager_field_editor_admin_skip_fields', array( $this, 'skip_fields' ) );
	}

	public function skip_fields( $fields ) {
		$fields[] = 'job_hours';
		$fields[] = 'gallery_images'; // already added, but just because

		return $fields;
	}
}

$GLOBALS[ 'listify_job_manager_field_Editor' ] = new Listify_WP_Job_Manager_Field_Editor();
