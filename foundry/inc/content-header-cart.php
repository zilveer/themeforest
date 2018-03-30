<?php 
	global $woocommerce;
	$cart_url = $woocommerce->cart->get_cart_url();
	$checkout_url = $woocommerce->cart->get_checkout_url();
?>

<div class="module widget-handle cart-widget-handle left">

    <a href="<?php echo esc_url($cart_url); ?>" class="cart">
        <i class="ti-bag"></i>
        <span class="label number"><span class="ebor-count"><?php echo htmlspecialchars_decode($woocommerce->cart->get_cart_contents_count()); ?></span></span>
        <span class="title"><?php _e('Shopping Cart','foundry'); ?></span>
    </a>
    
    <div class="function">
        <div class="widget">
        
            <h6 class="title"><?php _e('Shopping Cart','foundry'); ?></h6>
            <hr>
            
            <ul class="cart-overview">
            
	            <?php foreach ($woocommerce->cart->cart_contents as $cart_item_key => $cart_item) : ?>
	            
	            	<?php $_product = $cart_item['data']; ?>
	            	
	                <li>
	                    <a href="<?php echo get_permalink($cart_item['product_id']); ?>">
	                        <?php echo get_the_post_thumbnail($cart_item['product_id'], 'shop_thumbnail'); ?>
	                        <div class="description">
	                            <span class="product-title"><?php echo apply_filters('woocommerce_cart_widget_product_title', $_product->get_title(), $_product); ?></span>
	                            <span class="price number"><?php echo woocommerce_price($_product->get_price()); ?></span>
	                        </div>
	                    </a>
	                </li>
	                
	            <?php endforeach; ?>

            </ul>
            
            <hr>
            
            <div class="cart-controls">
                <a class="btn btn-sm btn-filled" href="<?php echo esc_url($checkout_url); ?>"><?php _e('Checkout','foundry'); ?></a>
                <div class="list-inline pull-right">
                    <span class="cart-total"><?php _e('Total','foundry'); ?>: </span>
                    <span class="number ebor-number"><?php echo htmlspecialchars_decode($woocommerce->cart->get_cart_total()); ?></span>
                </div>
            </div>
            
        </div>
    </div>
    
</div>