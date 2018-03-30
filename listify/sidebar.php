<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Listify
 */

if ( ! is_active_sidebar( 'widget-area-sidebar-1' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area col-md-4 col-sm-5 col-xs-12" role="complementary">
	<?php dynamic_sidebar( 'widget-area-sidebar-1' ); ?>
</div><!-- #secondary -->
