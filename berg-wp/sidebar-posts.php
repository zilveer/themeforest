<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package berg-wp
 */

if (!is_active_sidebar('sidebar-3')) {
	return;
}
?>
<div id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-3' ); ?>
</div>