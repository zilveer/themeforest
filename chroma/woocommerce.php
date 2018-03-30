<?php get_header(); ?>

<?php

  //Get Cart URL
  global $woocommerce;

  $cart_url = $woocommerce->cart->get_cart_url();
  $cart_count = $woocommerce->cart->get_cart_contents_count();
  $checkout_url = $woocommerce->cart->get_checkout_url();

?>

<!-- Start Page -->
<section class="shop container">

  <!-- <div class="shop_actions">
    <a href="<?php echo $cart_url; ?>">
      <span class="typicons-shopping-cart"></span>
      <?php _e("View Cart", "framework" ); ?> (<?php echo $cart_count; ?>)
    </a>
  </div> -->
	
	<div class="page_content">
	    
    <?php woocommerce_content(); ?>

  	<div class="clear"></div>
  </div>
	
</section>

<?php get_footer(); ?>