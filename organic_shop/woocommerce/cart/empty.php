<?php
/**
 * Empty Cart Page
 */
?>

<p><?php _e('Your cart is currently empty.','qns' ) ?></p>

<?php do_action('woocommerce_cart_is_empty'); ?>

<p><a class="button2 buttonpad" href="<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>"><?php _e('&larr; Return To Shop','qns' ) ?></a></p>