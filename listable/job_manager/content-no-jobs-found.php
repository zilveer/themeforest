<?php
/**
* The template for displaying the WP Job Manager no found message
*
* @package Listable
*/

if ( defined( 'DOING_AJAX' ) ) : ?>
	<li class="no_job_listings_found"><?php esc_html_e( 'There are no listings matching your search.', 'listable' ); ?></li>
<?php else : ?>
	<p class="no_job_listings_found"><?php esc_html_e( 'There are no listings matching your search.', 'listable' ); ?></p>
<?php endif; ?>