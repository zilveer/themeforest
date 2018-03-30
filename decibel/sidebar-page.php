<?php
/**
 * The Sidebar containing the page widget areas.
 */
if ( is_active_sidebar( 'sidebar-page' ) ) : ?>
	<div id="secondary" class="sidebar-container sidebar-page">
		<div class="sidebar-inner">
			<div class="widget-area">
				<?php dynamic_sidebar( 'sidebar-page' ); ?>
			</div><!-- .widget-area -->
		</div><!-- .sidebar-inner -->
	</div><!-- #secondary .sidebar-container -->
<?php endif; ?>