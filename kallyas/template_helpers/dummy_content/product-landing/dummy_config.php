<?php
/**
 * This file contains various tweaks for this export
 */

/* Set the proper homepage */
$homepage = get_page_by_title( 'Home' );
if(isset( $homepage ) && $homepage->ID) {
	update_option('show_on_front', 'page'); // Set to static frontpage
	update_option('page_on_front', $homepage->ID); // Front Page
}