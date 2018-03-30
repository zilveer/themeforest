<?php

/* Total Jobs
-------------------------------------------------------------------------------------------------------------------*/

if (!function_exists('total_jobs')) {
	function total_jobs( $atts, $content = null) {
		$count = wp_count_posts( 'job_listing' );
	    return $count->publish;
	}
}
add_shortcode('total_jobs', 'total_jobs');

/* Total Resumes
-------------------------------------------------------------------------------------------------------------------*/

if (!function_exists('total_resumes')) {
	function total_resumes( $atts, $content = null) {
		if( class_exists( 'WP_Resume_Manager' ) ) {
			$count = wp_count_posts( 'resume' );
		    return $count->publish;
		} else {
			return 0;
		}
	}
}
add_shortcode('total_resumes', 'total_resumes');

/* Total Jobs Filled
-------------------------------------------------------------------------------------------------------------------*/

if (!function_exists('total_jobs_filled')) {
	function total_jobs_filled( $atts, $content = null) {
		$count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->postmeta WHERE meta_key = '_filled' AND meta_value = '1'" );
	    return count( array_unique( $count ) );
	}
}
add_shortcode('total_jobs_filled', 'total_jobs_filled');

/* Total Companies
-------------------------------------------------------------------------------------------------------------------*/

if (!function_exists('total_companies')) {
	function total_companies( $atts, $content = null) {
		$count =  $wpdb->get_col( "SELECT pm.meta_value FROM {$wpdb->postmeta} pm LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id WHERE pm.meta_key = '_company_name' AND p.post_status = 'publish' AND p.post_type = 'job_listing'" );
		return count( array_unique( $count ) );
	}
}
add_shortcode('total_companies', 'total_companies');

/* Total Users
-------------------------------------------------------------------------------------------------------------------*/

if (!function_exists('total_users')) {
	function total_users( $atts, $content = null) {
		$count = count_users();
		return $count['total_users'];
	}
}
add_shortcode('total_users', 'total_users');

?>