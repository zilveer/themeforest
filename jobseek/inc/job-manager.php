<?php

/* Login redirects
-------------------------------------------------------------------------------------------------------------------*/

add_filter( 'submit_job_form_login_url', 'jobseek_wc_login_page' ); // post a job
add_filter( 'job_manager_job_dashboard_login_url', 'jobseek_wc_login_page' ); // job dashboard
add_filter( 'submit_resume_form_login_url', 'jobseek_wc_login_page' ); // submit resume
add_filter( 'resume_manager_candidate_dashboard_login_url', 'jobseek_wc_login_page' ); // candidate dashboard
add_filter( 'job_manager_alerts_login_url', 'jobseek_wc_login_page' ); // alerts
add_filter( 'job_manager_bookmark_form_login_url', 'jobseek_wc_login_page' ); // bookmarks

function jobseek_wc_login_page() {
	$wc_login_page = get_permalink( get_option('woocommerce_myaccount_page_id') );
    return get_permalink( get_option('woocommerce_myaccount_page_id') );
}

/* Wrap have an account
-------------------------------------------------------------------------------------------------------------------*/

add_filter('submit_job_form_show_signin', 'wrapAccountSigninJob');
function wrapAccountSigninJob() {
    echo '<div id="have-an-account">';
        get_job_manager_template( 'account-signin.php' );
    echo '</div>';
}

/* Hide filters by default
-------------------------------------------------------------------------------------------------------------------*/

function jobseek_job_manager_output_jobs_defaults( $defaults ) {
    $job_page = get_option('job_manager_jobs_page_id');
    if(!empty($job_page) && is_page($job_page)){
        $defaults[ 'show_filters' ] = false;
    }
    return $defaults;
}
add_filter( 'job_manager_output_jobs_defaults', 'jobseek_job_manager_output_jobs_defaults' );

/* Adding rate, hours, salary fields for jobs edit/submit frontend
-------------------------------------------------------------------------------------------------------------------*/

add_filter( 'submit_job_form_fields', 'jobseek_frontend_add_rate_field' );

function jobseek_frontend_add_rate_field( $fields ) {

	$currency = '';

	if( 
		( get_theme_mod('jobseek_enable_rate') != '0' || get_theme_mod('jobseek_enable_salary') != '0' )
		&&
		function_exists( 'get_woocommerce_currency_symbol' )
	) { 
		$currency = ' (' . get_woocommerce_currency_symbol() . ')';
	}

	if( get_theme_mod('jobseek_enable_rate') != '0' ) { 
		$fields['job']['rate_min'] = array(
			'label'       => esc_html__( 'Minimum rate/h', 'jobseek' ) . $currency,
			'type'        => 'text',
			'required'    => false,
			'placeholder' => esc_html__( 'e.g. 20','jobseek' ),
			'priority'    => 7
		);  
		$fields['job']['rate_max'] = array(
			'label'       => esc_html__( 'Maximum rate/h', 'jobseek' ) . $currency,
			'type'        => 'text',
			'required'    => false,
			'placeholder' => esc_html__( 'e.g. 50','jobseek' ),
			'priority'    => 8
		);
	}

	if( get_theme_mod('jobseek_enable_salary') != '0' ) {
		$fields['job']['salary_min'] = array(
			'label'       => esc_html__( 'Minimum Salary', 'jobseek' ) . $currency,
			'type'        => 'text',
			'required'    => false,
			'placeholder' => esc_html__( 'e.g. 20000','jobseek' ),
			'priority'    => 9
		);  
		$fields['job']['salary_max'] = array(
			'label'       => esc_html__( 'Maximum Salary', 'jobseek' ) . $currency,
			'type'        => 'text',
			'required'    => false,
			'placeholder' => esc_html__( 'e.g. 50000', 'jobseek' ),
			'priority'    => 10
		);
	}

	$fields['job']['hours'] = array(
		'label'       => esc_html__( 'Hours per week', 'jobseek' ),
		'type'        => 'text',
		'required'    => false,
		'placeholder' => esc_html__( 'e.g. 40', 'jobseek' ),
		'priority'    => 11
	);
	$fields['job']['apply_link'] = array(
		'label'       => esc_html__( 'External "Apply for Job" link', 'jobseek' ),
		'type'        => 'text',
		'required'    => false,
		'placeholder' => esc_html__( 'http://', 'jobseek' ),
		'priority'    => 12
	);    

	return $fields;
}

/**
 * Save the extra frontend fields
 */

function jobseek_job_manager_update_job_data( $job_id, $values ) {
	update_post_meta( $job_id, '_rate_min', $values[ 'job' ][ 'rate_min' ] );
	update_post_meta( $job_id, '_rate_max', $values[ 'job' ][ 'rate_max' ] );
	update_post_meta( $job_id, '_salary_min', $values[ 'job' ][ 'salary_min' ] );
	update_post_meta( $job_id, '_salary_max', $values[ 'job' ][ 'salary_max' ] );
	update_post_meta( $job_id, '_hours', $values[ 'job' ][ 'hours' ] );
	update_post_meta( $job_id, '_apply_link', $values[ 'job' ][ 'apply_link' ] );	
}

add_action( 'job_manager_update_job_data', 'jobseek_job_manager_update_job_data', 10, 2 );


/* Adding rate, hours, salary fields for jobs edit/submit backend
-------------------------------------------------------------------------------------------------------------------*/

add_filter( 'job_manager_job_listing_data_fields', 'jobseek_admin_add_rate_field' );

function jobseek_admin_add_rate_field( $fields ) {

	$currency = ' (' . get_woocommerce_currency_symbol() . ')';

	$fields['_hours'] = array(
	    'label'       => esc_html__( 'Hours per week', 'jobseek' ),
	    'type'        => 'text',
	    'placeholder' => 'e.g. 40',
	    'description' => ''
  	);

  	if( get_theme_mod('jobseek_enable_rate') != '0' ) { 
		$fields['_rate_min'] = array(
		    'label'       => esc_html__( 'Rate/h (minimum)', 'jobseek' ),
		    'type'        => 'text',
		    'placeholder' => esc_html__( 'e.g. 20', 'jobseek' ),
		    'description' => esc_html__('Put just a number','jobseek'),
		);    
		$fields['_rate_max'] = array(
		    'label'       => esc_html__( 'Rate/h (maximum) ', 'jobseek' ),
		    'type'        => 'text',
		    'placeholder' => esc_html__('e.g. 20','jobseek'),
		    'description' => esc_html__('Put just a number - you can leave it empty and set only minimum rate value ','jobseek'),
		); 
	}

	if( get_theme_mod('jobseek_enable_salary') != '0' ) { 
		$fields['_salary_min'] = array(
		    'label'       => esc_html__( 'Salary min', 'jobseek' ) . $currency,
		    'type'        => 'text',
		    'placeholder' => esc_html__('e.g. 20.000','jobseek'),
		    'description' => esc_html__('Put just a number','jobseek'),
		);   
		$fields['_salary_max'] = array(
		    'label'       => esc_html__( 'Salary max', 'jobseek' ) . $currency,
		    'type'        => 'text',
		    'placeholder' => esc_html__('e.g. 50.000','jobseek'),
		    'description' => esc_html__('Maximum of salary range you can offer - you can leave it empty and set only minimum salary ', 'jobseek'),
	  	); 	
  	}

  	$fields['_apply_link'] = array(
	    'label'       => esc_html__( 'External "Apply for Job" link', 'jobseek' ),
	    'type'        => 'text',
	    'placeholder' => esc_html__('http://','jobseek'),
	    'description' => esc_html__('If the job applying is done on external page, here\'s the place to put link to that page - it will be used instead of standard Apply form', 'jobseek'),
  	);

	return $fields;

}

/* Get Company Link
-------------------------------------------------------------------------------------------------------------------*/

function jobseek_get_company_link( $company_name ) {
    global $wp_rewrite;
    $slug = apply_filters( 'wp_job_manager_companies_company_slug', __( 'company', 'jobseek' ) );
    $company_name = rawurlencode( $company_name );

    if ( $wp_rewrite->permalink_structure == '' ) {
        $url = home_url( 'index.php?'. $slug . '=' . $company_name );
    } else {
        $url = home_url( '/' . $slug . '/' . trailingslashit( $company_name ) );
    }

    return '<a href="'.esc_url( $url ).'">';
}

/* Single job listing changes
-------------------------------------------------------------------------------------------------------------------*/

function jobseek_job_single() {

    remove_action( 'single_job_listing_start', 'job_listing_meta_display', 20 );
    remove_action( 'single_job_listing_start', 'job_listing_company_display', 30 );

    global $job_manager_bookmarks;

    if( !empty( $job_manager_bookmarks ) ) {
        remove_action( 'single_job_listing_meta_after', array( $GLOBALS['job_manager_bookmarks'], 'bookmark_form' ) );
        add_action( 'after_single_job_title', array( $GLOBALS['job_manager_bookmarks'], 'bookmark_form' ) );

        remove_action( 'single_resume_start', array( $GLOBALS['job_manager_bookmarks'], 'bookmark_form' ) );
        add_action( 'after_single_resume_title', array( $GLOBALS['job_manager_bookmarks'], 'bookmark_form' ) );
    }

}

add_filter( 'after_setup_theme', 'jobseek_job_single', 11 );