<?php
global $zorka_data;
?>
<?php if ( class_exists( 'WooCommerce' )  && isset($zorka_data['show-mini-cart']) && $zorka_data['show-mini-cart'] ):?>
	<div class="shopping-cart-wrapper">
		<div class="widget_shopping_cart_content">
			<?php get_template_part('woocommerce/cart/mini-cart'); ?>
		</div>
	</div>
<?php endif;?>