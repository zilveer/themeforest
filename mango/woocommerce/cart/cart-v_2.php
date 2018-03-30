<h2 class="title-border-tb big"><?php _e ( 'Products', 'woocommerce' ); ?></h2>
<ul class="shop_table cart cart-product-list">
    <?php do_action ( 'woocommerce_before_cart_contents' ); ?>

    <?php
	global $mango_settings;
    foreach ( WC ()->cart->get_cart () as $cart_item_key => $cart_item ) {
        $_product = apply_filters ( 'woocommerce_cart_item_product', $cart_item[ 'data' ], $cart_item, $cart_item_key );
        $product_id = apply_filters ( 'woocommerce_cart_item_product_id', $cart_item[ 'product_id' ], $cart_item, $cart_item_key );

        if ( $_product && $_product->exists () && $cart_item[ 'quantity' ] > 0 && apply_filters ( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
            ?>
            <li class="<?php echo esc_attr ( apply_filters ( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
                <div class="product">
                    <div class="product-top product-thumbnail">
                        <figure>
                            <?php
                            $thumbnail = apply_filters ( 'woocommerce_cart_item_thumbnail', $_product->get_image (), $cart_item, $cart_item_key );
                            $thumbnail = str_replace ( 'class="', 'class="product-image ', $thumbnail );
                            if ( !$_product->is_visible () ) {
                                echo $thumbnail;
                            } else {
                                printf ( '<a href="%s">%s</a>', esc_url ( $_product->get_permalink ( $cart_item ) ), $thumbnail );
                            }
                            ?>
                        </figure>
                    </div>
                    <div class="product-meta">
                        <?php echo $_product->get_categories ( ',', '<div class="product-cats">', '</div>' ); ?>

                        <h2 class="product-name product-title">
                            <?php
                            if ( !$_product->is_visible () ) {
                                echo apply_filters ( 'woocommerce_cart_item_name', $_product->get_title (), $cart_item, $cart_item_key ) . '&nbsp;';
                            } else {
                                echo apply_filters ( 'woocommerce_cart_item_name', sprintf ( '<a href="%s">%s </a>', esc_url ( $_product->get_permalink ( $cart_item ) ), $_product->get_title () ), $cart_item, $cart_item_key );
                            } ?>
                        </h2>
						
						<?php 	if(class_exists('WC_Vendors') ){
							if($mango_settings['mango_wcvendors_cart_soldby']){
							?>
						<div class="product-cats"><?php mango_wc_vendors_sold_by_meta(); ?></div>
                        <?php } }?>
                        <?php
                        mango_woo_cart_attributes ( $cart_item );
                        // Meta data
                        //echo "<p>".WC()->cart->get_item_data( $cart_item )."</p>";
                        // Backorder notification
                        if ( $_product->backorders_require_notification () && $_product->is_on_backorder ( $cart_item[ 'quantity' ] ) ) {
                            echo '<p class="backorder_notification">' . esc_html__ ( 'Available on backorder', 'woocommerce' ) . '</p>';
                        }
						if ( $mango_settings[ 'mango_show_price' ] ) {
                        ?>
                        <div class="product-price product-price-container">
                            <?php
                            echo apply_filters ( 'woocommerce_cart_item_price', WC ()->cart->get_product_price ( $_product ), $cart_item, $cart_item_key );
                            ?>
                        </div>
						<?php }?>
                        <div class="product-action clearfix">
                            <div class="product-quantity">
                                <?php
                                if ( $_product->is_sold_individually () ) {
                                    $product_quantity = sprintf ( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                                } else {
                                    $product_quantity = woocommerce_quantity_input ( array (
                                        'input_name' => "cart[{$cart_item_key}][qty]",
                                        'input_value' => $cart_item[ 'quantity' ],
                                        'max_value' => $_product->backorders_allowed () ? '' : $_product->get_stock_quantity (),
                                        'min_value' => '0'
                                    ), $_product, false );
                                }

                                echo apply_filters ( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
                                ?>
                            </div>

                            <?php
                            echo apply_filters ( 'woocommerce_cart_item_remove_link', sprintf ( '<a href="%s" class="btn btn-custom btn-sm remove cart2" title="%s">%s</a>', esc_url ( WC ()->cart->get_remove_url ( $cart_item_key ) ), __ ( 'Remove this item', 'woocommerce' ), __ ( "Remove", "woocommerce" ) ), $cart_item_key );
                            ?>
                            <input type="submit" class="button btn btn-custom2 border btn-sm cart2 update"
                                   name="update_cart" value="<?php _e ( 'Update Cart', 'woocommerce' ); ?>"/>
                        </div>
                    </div>
                </div>
            </li>
            <?php
        }
    }

    do_action ( 'woocommerce_cart_contents' );
    ?>
    <li>
        <div class="actionss">
            <?php if ( WC ()->cart->coupons_enabled () ) { ?>
                <div class="coupon">
                    <div class="form-group">
                        <label class="input-desc" for="coupon_code"><?php _e ( 'Coupon', 'woocommerce' ); ?>:</label>
                        <input type="text" name="coupon_code" class="input-text form-control input-sm" id="coupon_code"
                               value="" placeholder="<?php _e ( 'Coupon code', 'woocommerce' ); ?>"/>
                    </div>
                    <input type="submit" class="button btn btn-custom4 btn-md min-width-sm text-uppercase"
                           name="apply_coupon" value="<?php _e ( 'Apply Coupon', 'woocommerce' ); ?>"/>
                    <?php do_action ( 'woocommerce_cart_coupon' ); ?>
                </div>
            <?php } ?>
            <?php do_action ( 'woocommerce_cart_actions' ); ?>

            <?php wp_nonce_field ( 'woocommerce-cart' ); ?>
        </div>
    </li>

    <?php do_action ( 'woocommerce_after_cart_contents' ); ?>
</ul>