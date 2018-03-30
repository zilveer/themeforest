<?php
/**
 * WP Job Manager - Tags
 */

class Listify_WP_Job_Manager_Tags extends Listify_Integration {

    public function __construct() {
        $this->integration = 'wp-job-manager-tags';
        $this->includes = array(
            'widgets/class-widget-job_listing-tags.php',
        );

        parent::__construct();
    }

    public function setup_actions() {
        global $job_manager_tags;

        add_filter( 'job_filter_tag_cloud', array( $this, 'job_filter_tag_cloud' ) );
        add_filter( 'job_manager_settings', array( $this, 'settings' ), 11 );

        add_action( 'widgets_init', array( $this, 'widgets_init' ) );

        remove_filter( 'the_job_description', array( $job_manager_tags, 'display_tags' ) );
    }

    public function widgets_init() {
        register_widget( 'Listify_Widget_Listing_Tags' );
    }

    public function job_filter_tag_cloud( $atts ) {
        $atts[ 'separator' ] = '';
        $atts[ 'topic_count_text_callback' ] = array( $this, 'topic_count_text_callback' );

        return $atts;
    }

    public function topic_count_text_callback( $count ) {
        return sprintf( _n( '%s listing', '%s listings', $count, 'listify' ), number_format_i18n( $count ) );
    }

    public function settings( $fields ) {
        $settings = $fields[ 'job_listings' ][1];

        foreach ( $settings as $key => $value ) {
            if ( 'job_manager_enable_tag_archive' == $value[ 'name' ] ) {
                unset( $fields[ 'job_listings' ][1][ $key ] );
            }
        }

        return $fields;
    }

}

$GLOBALS[ 'listify_job_manager_tags' ] = new Listify_WP_Job_Manager_Tags();
