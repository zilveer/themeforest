<?php

/* Counter Up
-------------------------------------------------------------------------------------------------------------------*/

if (!function_exists('counterup_item')) {
	function counterup_item( $atts, $content = null) {

		global $wpdb;

	    extract( shortcode_atts( array(
	        "value"    => "",
	        "number"   => "",
	        "title"    => "",
	        "el_class" => ""
	    ), $atts ) );

	    switch ( $value ) {
	    	case 'jobs':
				$count = wp_count_posts( 'job_listing' );
				$number = $count->publish;
	    		break;

	    	case 'resumes':
	    		if( class_exists( 'WP_Resume_Manager' ) ) {
					$count = wp_count_posts( 'resume' );
					$number = $count->publish;
				} else {
					$number = 0;					
				}
	    		break;

	    	case 'filled':
				$number = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->postmeta WHERE meta_key = '_filled' AND meta_value = '1'" );
				$number = count( array_unique( $number ) );
				break;
	    	
	    	case 'companies':
				$number =  $wpdb->get_col( "SELECT pm.meta_value FROM {$wpdb->postmeta} pm LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id WHERE pm.meta_key = '_company_name' AND p.post_status = 'publish' AND p.post_type = 'job_listing'" );
				$number = count( array_unique( $number ) );
				break; 

	    	case 'users':
				$number = count_users();
				$number = $number['total_users'];
				break;

	    }

	    if( !empty( $el_class ) ) {
		    $output = '<div class="counter ' . $el_class . '">';
	    } else {
		    $output = '<div class="counter">';
	    }

	    	if( !empty( $number ) ) {
	    		$output .= '<div class="number">' . $number . '</div>';
	    	} else {
	    		$output .= '<div class="number">0</div>';	    		
	    	}

	    	if( !empty( $title ) ) {
	    		$output .= '<div class="description">' . $title . '</div>';
	    	}

	    $output .= '</div>';

	    return $output;

	}

}

add_shortcode('counterup_item', 'counterup_item');