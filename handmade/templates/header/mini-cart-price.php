<?php
global $g5plus_options;
$icon_shopping_cart_class = array('shopping-cart-wrapper', 'header-customize-item', 'with-price');
if ($g5plus_options['mobile_header_shopping_cart'] == '0') {
	$icon_shopping_cart_class[] = 'mobile-hide-shopping-cart';
}
?>
<div class="<?php echo join(' ', $icon_shopping_cart_class); ?>">
	<div class="widget_shopping_cart_content">
		<?php get_template_part('woocommerce/cart/mini-cart'); ?>
	</div>
</div>