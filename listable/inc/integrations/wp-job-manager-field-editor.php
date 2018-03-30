<?php
// Add filter to call our custom function when setting up dropdown of output locations
add_filter( 'field_editor_output_options', 'listable_wpjmfe_output_options', 15, 2 );

/**
 * Add Custom Auto Output Locations for WPJM
 *
 * This custom function will add to the end of an array, a new set of output locations
 * that will be visible in the WP Job Manager Field Editor auto output dropdown.
 *
 * To keep things organized, you should add a separator as the first:
 *
 * $my_output_locations = array(
 *     'single_job_listing_my_separator' => '---' . __( 'My Separator' ),
 *     'single_job_listing_listable_loc_1' => __( 'Single Job Listing Location 1' ),
 * );
 *
 * And then you MUST merge the new array you created, with the existing one:
 *
 * $output_options = array_merge( $output_options, $my_output_options );
 *
 * Then return the merged array:
 *
 * return $output_options'
 *
 * If you're using WP Job Manager Field Editor version 1.3.8 or older, you will need to manually modify the file
 * located at /plugins/wp-job-manager-field-editor/classes/auto-output.php on line #62, change this:
 *
 * add_action( 'plugins_loaded', array( $this, 'add_actions' ) );
 *
 * to this
 *
 * add_action( 'after_theme_setup', array( $this, 'add_actions' ) );
 *
 * Then make sure you have added your custom output to the template file, where you want it to output, like this:
 *
 * do_action( 'single_job_listing_listable_below_header' );
 *
 * @param   array   $output_options     Array of default output locations
 * @param   string  $list_field_group   Type of field group the options are for (job, company, or resume_fields)
 *
 * @return array
 */
function listable_wpjmfe_output_options( $output_options, $list_field_group ) {

	$my_output_options = array(
		'single_job_listing_listable_social_icons'    => '---' . esc_html__( "Listable Social Icons" ),
		'listable_single_job_listing_before_social_icons' => esc_html__( 'Before Social Icons' ),
		'listable_single_job_listing_after_social_icons' => esc_html__( 'After Social Icons' )
	);
	// We MUST merge the new array with the old one
	$output_options = array_merge( $output_options, $my_output_options );

	return $output_options;
}