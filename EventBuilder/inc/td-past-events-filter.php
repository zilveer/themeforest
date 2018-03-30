<?php

function tdPastEventsFilterForm() {

  	if ( isset( $_POST['tdPastEventsFilter_nonce'] ) && wp_verify_nonce( $_POST['tdPastEventsFilter_nonce'], 'tdPastEventsFilter_html' ) ) {

  		ob_start();

  		$content_type = $_POST['content_type'];

  		if($content_type == "grid-full-width") {

			get_template_part( 'partials/part-filter-past-events-grid-full-width' );

		} elseif($content_type == "map") {

			get_template_part( 'partials/part-filter-past-events-map' );

		} elseif($content_type == "grid-sidebar") {

			get_template_part( 'partials/part-filter-past-events-grid-sidebar' );

		} elseif($content_type == "list-sidebar") {

			get_template_part( 'partials/part-filter-past-events-list' );

		}
        //=========================================

		$response = ob_get_contents();

	} else {

		$response = 0;

  	}

  	die(); // this is required to return a proper result

}
add_action( 'wp_ajax_tdPastEventsFilterForm', 'tdPastEventsFilterForm' );
add_action( 'wp_ajax_nopriv_tdPastEventsFilterForm', 'tdPastEventsFilterForm' );
