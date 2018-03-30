<?php
/**
 * The Sidebar containing the widget areas for WooCommerce
 *
 * @package Listify
 */

$defaults = array(
	'before_widget' => '<aside class="widget widget-product">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h3 class="widget-title widget-title-product %s">',
	'after_title'   => '</h3>',
	'widget_id'     => ''
);

if ( ! is_active_sidebar( 'widget-area-sidebar-shop' ) ) {
	return;
}
?>

	<div id="secondary" class="col-xs-12 col-md-4" role="complementary">

		<a href="#" data-toggle="woocommerce-filters" class="js-toggle-area-trigger"><?php _e( 'Toggle Filters', 'listify' ); ?></a>

		<div class="js-toggle-area content-box woocommerce-filters">

			<?php dynamic_sidebar( 'widget-area-sidebar-shop' ); ?>

		</div>

	</div><!-- #secondary -->
