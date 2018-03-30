<a href="<?php echo get_option('shopping_cart_url'); ?>"><?php _e('Shopping Cart', ETHEME_DOMAIN); ?></a> <?php if(wpsc_cart_item_count() > 0): ?>- <span class="dark-span"><?php printf( _n('%d item', '%d items', wpsc_cart_item_count(), ETHEME_DOMAIN), wpsc_cart_item_count() ); ?></span> <?php endif; ?>
<div class="cart-popup">
    <?php if(wpsc_cart_item_count() > 0): ?>
        <p class="recently-added"><?php _e('Recently added item(s)', ETHEME_DOMAIN); ?></p>
        <div class="products-small">
            <?php $count = 5; ?>
            <?php $counter = 0; ?>
    		<?php while(wpsc_have_cart_items()): wpsc_the_cart_item(); $counter++; if($counter < ($count+1)) {?>   
                <div class="product-item">
                    <form action="" method="post" class="adjustform">
    					<input type="hidden" name="quantity" value="0" />
    					<input type="hidden" name="key" value="<?php echo wpsc_the_cart_item_key(); ?>" />
    					<input type="hidden" name="wpsc_update_quantity" value="true" />
                        <button type="submit" class="delete-btn"><span>delete</span></button>
    				</form>            
                    <a href="<?php echo wpsc_cart_item_url(); ?>" class="product-image">
                        <img src="<?php echo wpsc_cart_item_image(50, 50); ?>" alt="" width="50" height="50" />
                    </a>
                    <h5><a href="<?php echo wpsc_cart_item_url(); ?>"><?php echo wpsc_cart_item_name(); ?></a></h5>
                    <div class="qty">
                        <span class="price"><?php echo wpsc_cart_item_price(); ?></span> (<?php _e('Quantity', ETHEME_DOMAIN); ?>: <?php echo wpsc_cart_item_quantity(); ?>)
                    </div>
                    <div class="clear"></div>
                </div> 	
    		<?php } endwhile; ?> 
        </div>
        <div class="totals">
            <?php _e('Total', ETHEME_DOMAIN); ?>: <span class="price"><?php echo wpsc_cart_total_widget( false, false ,false ); ?></span>
        </div>
        
        <form action='' method='post' class='wpsc_empty_the_cart fl-l'>
            <input type='hidden' name='wpsc_ajax_action' value='empty_cart' />
    		<a href="<?php echo esc_url( htmlentities(add_query_arg('wpsc_ajax_action', 'empty_cart', remove_query_arg('ajax')), ENT_QUOTES, 'UTF-8') ); ?>" class="button emptycart" title="<?php _e('Empty Cart', ETHEME_DOMAIN); ?>"><span><?php _e('Empty Cart', ETHEME_DOMAIN); ?></span></a>
        </form>
                
        <a href="<?php echo get_option('shopping_cart_url'); ?>" class="button active fl-r"><span><?php _e('Checkout', ETHEME_DOMAIN); ?></span></a>
    <?php else: ?>
    	<p class="empty">
    		<?php _e('Your shopping cart is empty', ETHEME_DOMAIN); ?><br />
    		<a target="_parent" href="<?php echo get_option('product_list_url'); ?>" class="visitshop" title="<?php _e('Visit Shop', ETHEME_DOMAIN); ?>"><?php _e('Visit the shop', ETHEME_DOMAIN); ?></a>	
    	</p>
    <?php endif; ?>
    
    
    <?php
        wpsc_google_checkout();
    ?>
</div>