<?php global $mango_settings; ?>

<div class="table-responsive">

<table class="shop_table cart table cart-table" cellspacing="0">

    <thead>

    <tr>

        <th class="product-name"><?php _e( 'Product Name', 'woocommerce' ); ?></th>

        <th class="product-price"><?php _e( 'Unit Price', 'woocommerce' ); ?></th>

        <th class="product-quantity"><?php _e( 'Quantity', 'woocommerce' ); ?></th>

        <th class="product-subtotal"><?php _e( 'Subtotal', 'woocommerce' ); ?></th>

        <th class="product-remove">&nbsp;</th>

    </tr>

    </thead>

    <tbody>

    <?php do_action( 'woocommerce_before_cart_contents' ); ?>



    <?php

    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {

        $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

        $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );



        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

            ?>

            <tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">



                <td class="product-name">

                    <div class="product clearfix">

                        <div class="product-top">

                            <figure>

                            <?php

                            $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image("shop-image"), $cart_item, $cart_item_key );

                            $thumbnail = str_replace('class="','class="product-image ',$thumbnail);

                            if ( ! $_product->is_visible() ) { ?>

                                    <?php echo $thumbnail; ?>

                            <?php } else {

                            printf( '<a href="%s">%s</a>', esc_url( $_product->get_permalink( $cart_item ) ), $thumbnail );

                            }

                            ?>

                            </figure>

                        </div><!-- End .product-top -->

                        <?php echo $_product->get_categories( ',', '<div class="product-cats">','</div>' ); ?>

                        <h2 class="product-title">

                            <?php

                            if ( ! $_product->is_visible() ) {

                                echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';

                            } else {

                                echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s </a>', esc_url( $_product->get_permalink( $cart_item ) ), $_product->get_title() ), $cart_item, $cart_item_key );

                            } ?>

                        </h2>

						

						 <?php 	

						 if(class_exists('WC_Vendors') ){

								

						if($mango_settings['mango_wcvendors_cartpage_soldby']){

						?>

						<div class="product-cats"><?php mango_wc_vendors_sold_by_meta(); ?></div>

                         <?php } }?>

						

                        <?php

                        mango_woo_cart_attributes($cart_item);

						if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {

                        echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>';

						}

                    ?>

                    </div>

                </td>

<!--                product-price-->

                <td class="price-col">

                    <?php

                    echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );

                    ?>

                </td>

                <!-- product-quantity-->

                <td class="quantity-col">

                    <?php

                    if ( $_product->is_sold_individually() ) {

                        $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );

                    } else {

                        $product_quantity = woocommerce_quantity_input( array(

                            'input_name'  => "cart[{$cart_item_key}][qty]",

                            'input_value' => $cart_item['quantity'],

                            'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),

                            'min_value'   => '0'

                        ), $_product, false );

                    }



                    echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );

                    ?>

                </td>

                <!-- product-subtotal-->

                <td class="price-total-col">

                    <?php

                    echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );

                    ?>

                </td>

                <td class="product-remove">

                    <?php

                    echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" onclick="mango_refrash();" class="remove btn btn-custom btn-sm btn-close" title="%s"><i class="fa fa-times"></i></a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'woocommerce' ) ), $cart_item_key );

                    ?>

                </td>

            </tr>

        <?php

        }

    }



    do_action( 'woocommerce_cart_contents' );

    ?>

    <tr>

        <td colspan="5" class="actions">

            <?php if ( WC()->cart->coupons_enabled() ) { ?>

                <div class="coupon col-md-6">

                    <div class="form-group">

                        <label class="input-desc" for="coupon_code"><?php _e( 'Enter Your Coupon Code If You Have One.', 'woocommerce' ); ?></label>

                        <input type="text" name="coupon_code" class="input-text form-control input-sm" id="coupon_code" value="" placeholder="<?php _e( 'Coupon code', 'woocommerce' ); ?>" />

                    </div>

                    <input type="submit" class="button btn btn-custom4 btn-md min-width-sm text-uppercase" name="apply_coupon" value="<?php _e( 'Apply Coupon', 'woocommerce' ); ?>" />



                    <?php do_action( 'woocommerce_cart_coupon' ); ?>

                </div>

            <?php } ?>

            <div class="cart-action-container col-md-6 pull-right">

                <a href="<?php echo esc_url(get_permalink( woocommerce_get_page_id( 'shop' ) ) ); ?>" class="btn btn-default btn-border btn-sm text-uppercase min-width-md"><?php _e("CONTINUE SHOPPING",'woocommerce'); ?></a>

                <input type="submit" class="button btn btn-default btn-border btn-sm text-uppercase" name="update_cart" value="<?php _e( 'Update Cart', 'woocommerce' ); ?>" />

                <?php do_action( 'woocommerce_cart_actions' ); ?>

            </div>

            <?php wp_nonce_field( 'woocommerce-cart' ); ?>

        </td>

    </tr>



    <?php do_action( 'woocommerce_after_cart_contents' ); ?>

    </tbody>

</table>

    </div>