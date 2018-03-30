<?php
/**
 * The Sidebar for the pages.
 */

$sidebar_name = 'sidebar-page';

if ( function_exists( 'bp_is_blog_page' ) && ! bp_is_blog_page() ) { $sidebar_name = 'sidebar-buddypress'; }
if ( function_exists( 'is_bbpress' ) && is_bbpress() ) { $sidebar_name = 'sidebar-buddypress'; }
if ( function_exists( 'is_woocommerce' ) && ( is_cart() || is_checkout() ) ) { $sidebar_name = 'sidebar-woocommerce'; }

?>

	<div id="sidebar" class="one-third column last">

		<div id="sidebar-inner">

			<?php if ( ! dynamic_sidebar( $sidebar_name ) ) : ?>

				<!-- No widgets -->

			<?php endif; ?>

		</div><!-- #sidebar-inner -->

	</div><!-- #sidebar -->