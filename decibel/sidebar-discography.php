<?php
/**
 * The Sidebar containing the page widget areas.
 */
if ( is_active_sidebar( 'sidebar-discography' ) ) : ?>
	<div id="secondary" class="sidebar-container sidebar-discography">
		<div class="sidebar-inner">
			<div class="widget-area">
				<?php dynamic_sidebar( 'sidebar-discography' ); ?>
			</div><!-- .widget-area -->
		</div><!-- .sidebar-inner -->
	</div><!-- #secondary .sidebar-container -->
<?php endif; ?>
