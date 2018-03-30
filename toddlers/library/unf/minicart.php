<?php global $unf_options;

       if (class_exists('Woocommerce')) {
		   global $woocommerce;
	        if ( ! is_cart() && ! is_checkout() ) { ?>
				<div class="minicart <?php if ( sizeof( $woocommerce->cart->cart_contents ) == 0 ) { echo "emptycart";} ?>">
					<div class="btn-group">
					  <a class="btn icon icon-basket" href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>" title="<?php _e('View your shopping cart', 'toddlers'); ?>">
					  <span id="cartcount" class="badge hello cart-count hidden-sm hidden-xs"><?php echo (int)$woocommerce->cart->cart_contents_count; ?></span>
					  </a>
					  <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
					    <span class="caret"></span>
					    <span class="sr-only"><?php _e("Mini Cart", "toddlers");?></span>
					  </button>
					 <div class="dropdown-menu"><?php the_widget( 'WC_Widget_Cart' ); ?></div>
					</div>
				</div>
				<?php
				} //if is not the checkout or cart page
				else
				{?>
				<div class="minicart backtoshop">
					<?php $shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );?>
					<a class="btn icon icon-basket" href="<?php echo esc_url($shop_page_url);?>"></a>
				</div>

				<?php }
		}	//if woocommerce exists
?>