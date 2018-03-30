<?php
/**
 * The Sidebar containing the widget areas for WooCommerce
 *
 * @package Listify
 */

if ( ! is_active_sidebar( 'widget-area-sidebar-product' ) ) {
	return;
}

$defaults = array(
	'before_widget' => '<aside class="widget widget-product">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h3 class="widget-title widget-title-product %s">',
	'after_title'   => '</h3>',
	'widget_id'     => ''
);
?>
	<div id="secondary" class="widget-area col-md-4 col-sm-5 col-xs-12" role="complementary">
		<?php dynamic_sidebar( 'widget-area-sidebar-product' ); ?>
	</div><!-- #secondary -->
