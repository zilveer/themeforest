<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

foreach( $available_variations as $key => $val ) :
    if ( empty( $val['price_html'] ) ) {
        $same_price = true;
    } else {
        $available_variations[$key]["price_html"] = '<span class="price-label">'.__('Price', 'yit').': </span>'.$val["price_html"];
    }
endforeach;

$attribute_keys = array_keys( $attributes );

do_action('woocommerce_before_add_to_cart_form');

if( apply_filters( 'show_variable_price', isset( $same_price ) && $same_price ) ) wc_get_template( 'single-product/price.php' );
?>

    <form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->id ); ?>" data-product_variations="<?php echo esc_attr( json_encode( $available_variations ) ) ?>">
    <?php do_action( 'woocommerce_before_variations_form' ); ?>

    <div class="variations group">
        <?php foreach ( $attributes as $attribute_name => $options ) : ?>
            <div class="variation_container">
                    <label for="<?php echo sanitize_title( $attribute_name ); ?>"><?php echo wc_attribute_label( $attribute_name ); ?></label>
                    <?php
                    $selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) : $product->get_variation_default_attribute( $attribute_name );
                    wc_dropdown_variation_attribute_options( array( 'options' => $options, 'attribute' => $attribute_name, 'product' => $product, 'selected' => $selected ) );
                    echo end( $attribute_keys ) === $attribute_name ? '<a class="reset_variations" href="#">' . __( 'Clear selection', 'yit' ) . '</a>' : '';
                    ?>
            </div>
            <?php endforeach;?>
    </div>

    <?php do_action('woocommerce_before_add_to_cart_button'); ?>

    <div class="single_variation_wrap" >
        <?php do_action( 'woocommerce_before_single_variation' ); ?>

        <div class="variations_button for_quantity">
            <?php if ( is_shop_enabled() ) woocommerce_quantity_input(); ?>
        </div>

        <?php if( yit_get_option('shop-detail-show-price') || (is_shop_enabled() && yit_get_option('shop-detail-add-to-cart')) ) : ?>
        <div class="woocommerce-price-and-add group">

                <?php

                    remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );

                    if( yit_get_option('shop-detail-show-price') ) {

                      /**
                       * woocommerce_single_variation hook. Used to output the cart button and placeholder for variation data.
                       * @since 2.4.0
                       * @hooked woocommerce_single_variation - 10 Empty div for variation data.
                       * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
                       */
                      do_action( 'woocommerce_single_variation' );

                     }

                ?>

                <?php if( is_shop_enabled() && yit_get_option('shop-detail-add-to-cart') ) : ?>
                <div class="variations_button">
                    <input type="hidden" name="variation_id" value="" />
                    <button type="submit" class="single_add_to_cart_button button alt"><?php echo apply_filters('single_add_to_cart_text', __('Add to cart', 'yit'), $product->product_type); ?></button>
                </div>
                <?php endif ?>
            <?php //</div> ?>
        </div>
        <?php endif ?>

        <input type="hidden" name="add-to-cart" value="<?php echo $product->id; ?>" />
        <input type="hidden" name="product_id" value="<?php echo esc_attr( $product->id ); ?>" />


        <?php do_action( 'woocommerce_after_single_variation' ); ?>
    </div>

    <?php do_action('woocommerce_after_add_to_cart_button'); ?>

    <?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php do_action('woocommerce_after_add_to_cart_form'); ?>

<?php
wc_enqueue_js( "

    jQuery('form.variations_form').on( 'woocommerce_variation_select_change', function( event, variation ) {
        jQuery('.variations_form .stock').remove();
    } );
" );
?>