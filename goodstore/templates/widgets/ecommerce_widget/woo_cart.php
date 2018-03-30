<?php global $woocommerce; ?>
<a class="widget-cart-contents" aria-haspopup="true" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'jawtemplates'); ?>">
    <span class="topbar-title-icon icon-bag-icon"></span>
    <span class="jaw_number_of_products"><?php echo $woocommerce->cart->cart_contents_count; ?></span>
    <span class="topbar-title-text">
        <?php _e('Bag', 'jawtemplates'); ?>
    </span>
</a>
<div class="top-bar-cart-content woocommerce">
    <?php echo '<div class="hide_cart_widget_if_empty">'; ?>
    <?php echo '<div class="widget_shopping_cart_content"></div>'; ?>
    <?php echo '</div>'; ?>
</div>