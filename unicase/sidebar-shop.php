<?php
/**
 * The sidebar containing the shop sidebar widget area and product filters widget area
 *
 * @package Unicase
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<aside class="sidebar sidebar-shop">
	<?php
	if ( ! is_active_sidebar( 'shop-sidebar-1' ) ) {
		if ( function_exists( 'unicase_default_shop_widgets' ) ) {
			unicase_default_shop_widgets();
		}
	} else {
		dynamic_sidebar( 'shop-sidebar-1' );
	}
	?>
</aside><!-- /.sidebar -->