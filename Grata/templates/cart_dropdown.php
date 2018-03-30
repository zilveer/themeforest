<?php
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    global $woocommerce;
	$cart_subtotal = (empty($woocommerce->cart->cart_contents_total))?0:$woocommerce->cart->cart_contents_total;
	$link = $woocommerce->cart->get_cart_url();;
    ?><!-- CART -->
<div class="w-cart<?php if ($cart_subtotal) echo ' has_items'; ?>">
    <a class="w-cart-link" href="<?php echo $link; ?>">
        <i class="fa fa-shopping-cart"></i>
        <span class="w-cart-quantity"><?php echo $woocommerce->cart->cart_contents_count; ?></span>
    </a>
    <div class="w-cart-notification">
        <span class="product-name"><?php echo __('Product', 'us'); ?></span> <?php echo __('was successfully added to your cart', 'us'); ?>
    </div>
    <div class="w-cart-dropdown">
        <?php the_widget('WC_Widget_Cart'); ?>
    </div>
</div><?php
}