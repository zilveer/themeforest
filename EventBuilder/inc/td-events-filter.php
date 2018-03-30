<?php

function tdEventsFilterForm() {

  	if ( isset( $_POST['tdEventsFilter_nonce'] ) && wp_verify_nonce( $_POST['tdEventsFilter_nonce'], 'tdEventsFilter_html' ) ) {

  		ob_start();

  		$content_type = $_POST['content_type'];

  		if($content_type == "grid-full-width") {

			get_template_part( 'partials/part-filter-events-grid-full-width' );

		} elseif($content_type == "map") {

			get_template_part( 'partials/part-filter-events-map' );

		} elseif($content_type == "grid-sidebar") {

			get_template_part( 'partials/part-filter-events-grid-sidebar' );

		} elseif($content_type == "list-sidebar") {

			get_template_part( 'partials/part-filter-events-list' );

		}
        //=========================================

		$response = ob_get_contents();

	} else {

		$response = 0;

  	}

  	die(); // this is required to return a proper result

}
add_action( 'wp_ajax_tdEventsFilterForm', 'tdEventsFilterForm' );
add_action( 'wp_ajax_nopriv_tdEventsFilterForm', 'tdEventsFilterForm' );
