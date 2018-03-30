<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package quote
 */

if ( ! is_active_sidebar( 'sidebar' ) ) {
	return;
}
?>

<div id="main-sidebar" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar' ); ?>
</div><!-- #secondary -->
