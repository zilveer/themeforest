<?php
/**
 * The Sidebar for single listing items.
 *
 * @package Listify
 */

if ( ! is_active_sidebar( 'archive-job_listing' ) && ! has_action( 'listify_sidebar_archive_job_listing_after' ) ) {
	return;
}
?>
	<div id="secondary" class="widget-area col-sm-12 col-md-4" role="complementary">

		<?php do_action( 'listify_sidebar_archive_job_listing_before' ); ?>

		<?php if ( is_active_sidebar( 'archive-job_listing' ) ) : ?>
			<a href="#" data-toggle="#sidebar-archive-job_listing" class="js-toggle-area-trigger"><?php _e( 'Toggle Sidebar', 'listify' ); ?></a>

			<div id="sidebar-archive_job_listing" class="js-toggle-area content-box">
				<?php dynamic_sidebar( 'archive-job_listing' ); ?>
			</div>
		<?php endif ?>

		<?php do_action( 'listify_sidebar_archive_job_listing_after' ); ?>
	</div><!-- #secondary -->
