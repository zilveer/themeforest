<?php
/**
 * Woocommerce sidebar 
 */
if ( is_active_sidebar( 'woocommerce' ) && 'sidebar' == wolf_get_theme_option( 'woocommerce_layout' ) && ! is_product() ) : ?>
	<div id="secondary-woocommerce" class="sidebar-container sidebar-shop">
		<div class="sidebar-inner">
			<div class="widget-area">
				<?php dynamic_sidebar( 'woocommerce' ); ?>
			</div><!-- .widget-area -->
		</div><!-- .sidebar-inner -->
	</div><!-- #secondary .sidebar-container -->
<?php endif; ?>