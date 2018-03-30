<?php

class Listify_WP_Job_Manager_Alerts extends Listify_Integration {

    public function __construct() {
        $this->includes = array();
        $this->integration = 'wp-job-manager-alerts';

        parent::__construct();
    }

    public function setup_actions() {
        global $job_manager_alerts;
        remove_action( 'single_job_listing_end', array( $job_manager_alerts, 'single_alert_link' ) );
        add_action( 'single_job_listing_meta_start', array( $job_manager_alerts, 'single_alert_link' ), 40 );

        add_action( 'wp_enqueue_scripts', array( $this, 'dequeue_styles' ), 20 );
    }

    public function dequeue_styles() {
        wp_dequeue_style( 'job-alerts-frontend' );
    }

}

$GLOBALS[ 'listify_job_manager_alerts' ] = new Listify_WP_Job_Manager_Alerts();
