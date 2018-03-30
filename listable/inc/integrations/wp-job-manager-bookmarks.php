<?php
/**
 * Custom functions that deal with the integration of WP Job Manager Bookmarks.
 * See: https://wpjobmanager.com/add-ons/bookmarks/
 *
 * @package Listable
 */

// Display bookmark heart on listing archives
function listable_add_bookmark_heart_to_listing_card( $post ) {
	global $job_manager_bookmarks;

	if ( $job_manager_bookmarks !== null && method_exists( $job_manager_bookmarks, 'is_bookmarked' ) ) {
		$bookmark_state = '';

		if (  $job_manager_bookmarks->is_bookmarked( $post->ID ) ) {
			$bookmark_state = 'is--bookmarked';
		} ?>
		<div class="heart <?php echo $bookmark_state; ?>">
			<?php get_template_part( 'assets/svg/heart-svg' ); ?>
		</div>
	<?php }
}
add_action( 'listable_job_listing_card_image_top', 'listable_add_bookmark_heart_to_listing_card', 10, 1 );
