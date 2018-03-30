<?php 
if ( ! is_active_sidebar( 'Header Sidebar' ) ) return; 

$classes = '';
if ( ! yit_get_option('responsive-show-header-widgets') ) $classes .= ' hidden-phone';

$show_cart        = yit_get_option('show-header-woocommerce-cart');
$show_cart_widget = yit_get_option('show-header-woocommerce-cart-widget');
$show_search      = yit_get_option('show-header-search');
if( ! is_shop_installed() || ! is_shop_enabled() ) $show_cart = $show_cart_widget = false;

if ( ! $show_cart && ! $show_cart_widget && ! $show_search ) $classes .= ' double';
?>
	<!-- START HEADER SIDEBAR -->
	<div id="header-sidebar" class="group<?php echo $classes ?>">                                                     
		<?php dynamic_sidebar( 'Header Sidebar' ); ?>
	</div>