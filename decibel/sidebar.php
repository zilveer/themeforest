<?php
/**
 * The Sidebar containing the main widget areas.
 */
if ( wolf_should_display_sidebar() ) : // see includes/functions.php ?>
	<div id="secondary" class="sidebar-container sidebar-main" role="complementary">
		<div class="sidebar-inner">
			<div class="widget-area">
				<?php get_template_part( 'partials/sidebar', 'content' ); ?>
			</div><!-- .widget-area -->
		</div><!-- .sidebar-inner -->
	</div><!-- #secondary .sidebar-container -->
<?php endif; ?>
