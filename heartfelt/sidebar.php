<?php
/**
 * The Sidebar containing the main widget areas.
 *
 */
?>

<div id="secondary" class="widget-area large-3 columns" role="complementary">
	
	<?php if ( ! dynamic_sidebar( 'sidebar' ) ) : ?>

		<aside id="search" class="widget">
			<h3 class="widget-title"><?php _e( 'No Widgets Yet', 'heartfelt' ); ?></h3>
			<p>Add widgets to the sidebar in Appearance > Widgets > Inner Sidebar</p>
		</aside><!-- .widget -->

	<?php endif; // end sidebar widget area ?>

</div><!-- #secondary -->