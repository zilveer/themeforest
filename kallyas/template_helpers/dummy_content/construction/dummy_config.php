<?php
/**
 * Update the homepage
 */
$homepage = get_page_by_title( "Homepage" );
if(isset( $homepage ) && $homepage->ID) :
	update_option("show_on_front", "page"); /* Set to static front page */
	update_option("page_on_front", $homepage->ID); /* Front Page */
endif;
