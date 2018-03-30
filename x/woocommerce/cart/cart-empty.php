<?php

// =============================================================================
// WOOCOMMERCE/CART/CART-EMPTY.PHP
// -----------------------------------------------------------------------------
// @version 2.0.0
// =============================================================================

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

wc_print_notices();

?>

<div class="x-cart-empty">

  <p class="cart-empty">
    <?php _e( 'Your cart is currently empty.', '__x__' ) ?>
  </p>

  <?php do_action( 'woocommerce_cart_is_empty' ); ?>

  <p class="return-to-shop">
    <a class="button wc-backward" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
      <?php _e( 'Return To Shop', '__x__' ) ?>
    </a>
  </p>

</div>