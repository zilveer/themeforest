<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}

?>

<?php
	// Availability
	$availability      = $product->get_availability();
	$availability_html = empty( $availability['availability'] ) ? '' : '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>';

	echo apply_filters( 'woocommerce_stock_html', $availability_html, $availability['availability'], $product );
?>

<?php if ( $product->is_in_stock() ) : ?>

<?php do_action('woocommerce_before_add_to_cart_form'); ?>

    <form class="cart" method="post" enctype='multipart/form-data'>
        <?php do_action('woocommerce_before_add_to_cart_button'); ?>

        <div class="simple-quantity">
            <?php
            // Availability
            $availability = $product->get_availability();

            if ($availability['availability']) :
                echo apply_filters( 'woocommerce_stock_html', '<p class="stock '.$availability['class'].'">'.$availability['availability'].'</p>', $availability['availability'] , $product );
            endif;

            if ( is_shop_enabled() && !$product->is_sold_individually() ) {

                $min_value = apply_filters( 'woocommerce_quantity_input_min', 1, $product );
                $max_value = apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product );

                woocommerce_quantity_input( array( 'min_value' => $min_value, 'max_value' => $max_value ) );
            }
            ?>
        </div>

        <?php if( yit_get_option('shop-detail-show-price') || ( is_shop_enabled() && yit_get_option('shop-detail-add-to-cart') ) ) : ?>
            <div class="woocommerce-price-and-add group">
                <?php if( yit_get_option('shop-detail-show-price') ): ?>
                    <div class="woocommerce-price"><?php wc_get_template( 'single-product/price.php' ); ?></div>
                <?php endif ?>

                <?php if ( is_shop_enabled() && yit_get_option('shop-detail-add-to-cart') && $product->is_in_stock() ) : ?>
                    <div class="woocommerce-add-to-cart">
                        <button type="submit" class="single_add_to_cart_button button alt"><?php echo apply_filters('single_add_to_cart_text', __('Add to cart', 'yit'), $product->product_type); ?></button>
                        <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />
                    </div>
                <?php endif; ?>
            </div>
        <?php endif ?>
        <?php do_action('woocommerce_after_add_to_cart_button'); ?>
	</form>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>
