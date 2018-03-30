<?php
/**
 * The template for displaying when no job listings are found (in a loop).
 *
 * @package Listify
 */

$location = isset( $_REQUEST[ 'search_location' ] ) ? __( 'by expanding your search radius', 'listify' ) : '';
?>

<li class="no_job_listings_found col-xs-12">
	<div class="content-box">
		<?php printf( __( 'Perhaps try revising your search %1$s or <a href="%2$s">create a listing</a> instead!', 'listify' ), $location, job_manager_get_permalink( 'submit_job_form' ) ); ?>
	</div>
</li>
