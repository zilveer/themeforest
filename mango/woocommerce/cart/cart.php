<?php
/**
 * Cart Page
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.3.8
 */

if ( !defined ( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $mango_settings, $cart_ver;
do_action ( 'woocommerce_before_cart' );
$cart_ver = mango_cart_version (); 
 ?>

<?php if ( $cart_ver == "v_1" ) {
    $class = "col-md-12";

} else {
    $class = "col-md-9";

} ?>
    <div class="row">
    <div class="<?php echo esc_attr($class); ?>">
        <?php wc_print_notices (); ?>
        <form action="<?php echo esc_url ( WC ()->cart->get_cart_url () ); ?>" method="post">

            <?php do_action ( 'woocommerce_before_cart_table' ); ?>
            <?php get_template_part ( "woocommerce/cart/cart" , $cart_ver ); ?>
            <?php do_action ( 'woocommerce_after_cart_table' ); ?>

        </form>
    </div>
<?php if ( $cart_ver == "v_1" ) { ?>
    </div>
    <?php $c = "row"; ?>
<?php } elseif ( $cart_ver == "v_2" ) { ?>
    <div class="sm-margin visible-sm visible-xs"></div>
    <?php $c = "col-md-3"; ?>
<?php } ?>

    <div class="cart-collaterals <?php echo esc_attr($c); ?>">

        <?php do_action ( 'woocommerce_cart_collaterals' );
        ///woocommerce_cart_totals();
        ?>
    </div>
<?php do_action ( 'woocommerce_after_cart' );
if( $cart_ver=='v_2'){ ?> </div>  <?php  } ?>