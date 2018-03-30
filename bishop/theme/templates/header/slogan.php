<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$show_slogan = YIT_Layout()->show_slogan;
$slogan = YIT_Layout()->slogan;
$subslogan = YIT_Layout()->sub_slogan;

if( empty( $show_slogan ) || $show_slogan == 'no' ){

    if ( function_exists( 'WC' ) && ( ( is_cart() && ( sizeof( WC()->cart->get_cart() ) != 0 ) ) || ( is_checkout() && !is_account_page() ) || is_order_received_page() ) ) {

        $slogan_class = 'yith-checkout-single';
        $show_slogan = 'yes';

        ob_start();
        ?>
        <span <?php if ( is_cart() ) { ?> class="current"<?php } ?> ><?php _e( 'Shopping Bag ', 'yit' ); ?></span>
        <span <?php if ( ( is_checkout() && !is_account_page() ) && ! is_order_received_page() ) { ?> class="current"<?php } ?> ><?php _e( 'Checkout Details ', 'yit' ); ?></span>
        <span <?php if ( is_order_received_page() ) { ?> class="current"<?php } ?> ><?php _e( 'Order Complete', 'yit' ); ?></span>
        <?php
        $slogan = ob_get_clean();

    } elseif( is_404() ) {

        $show_slogan = 'yes';
        $slogan = apply_filters( 'yit_slogan_404', __("[ops.] it seems you are lost...",'yit') );
    }
}

// Exceptions
if ( function_exists( 'WC' ) && is_page( get_option( 'woocommerce_myaccount_page_id' ) ) ) {
	$show_slogan = 'yes';
	$slogan = __( 'LOGIN / REGISTER', 'yit' );
}

if ( empty($show_slogan) || $show_slogan == 'no' || empty( $slogan ) ) {
    return;
}
?>

<!-- START SLOGAN -->
<div id="slogan" <?php if( isset( $slogan_class ) ): echo 'class="' .$slogan_class . '"'; endif; ?> >
    <div class="container">

        <h2><?php echo yit_decode_title( $slogan ) ?></h2>
        <p><?php echo yit_decode_title( $subslogan ) ?></p>

    </div>
</div>
<!-- END SLOGAN -->

