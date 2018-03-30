<?php
/**
 * WP Job Manager Products
 */

class Listify_WP_Job_Manager_Products extends Listify_Integration {

	public function __construct() {
		$this->includes = array();
		$this->integration = 'wp-job-manager-products';

		parent::__construct();
	}

	public function setup_actions() {
		add_action( 'widgets_init', array( $this, 'widgets_init' ) );
	}

	public function widgets_init() {
		$widgets = array(
			'job_listing-products.php',
			'job_listing-products-main.php'
		);

		foreach ( $widgets as $widget ) {
			include_once( listify_Integration::get_dir() . 'widgets/class-widget-' . $widget );
		}

		register_widget( 'Listify_Widget_Listing_Products' );
		register_widget( 'Listify_Widget_Listing_Products_Main' );
	}
}

$GLOBALS[ 'listify_job_manager_products' ] = new Listify_WP_Job_Manager_Products();
