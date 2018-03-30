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

$show_slogan             = YIT_Layout()->show_slogan;
$slogan                  = YIT_Layout()->slogan;
$subslogan               = YIT_Layout()->sub_slogan;
$slogan_color            = YIT_Layout()->slogan_color;
$subslogan_color         = YIT_Layout()->subslogan_color;


if( empty( $show_slogan ) || $show_slogan == 'no' ){

    if ( function_exists( 'WC' ) && ( ( is_cart() && ( sizeof( WC()->cart->get_cart() ) != 0 ) ) || is_checkout() || is_order_received_page() ) ) {

        $slogan_class = 'yith-checkout-single';
        $show_slogan = 'yes';

        ob_start();
        ?>
        <span class="slogan-cart<?php if ( is_cart() ) { ?> current <?php } ?>" ><?php _e( 'Shopping Bag ', 'yit' ); ?></span>
        <span class="slogan-checkout<?php if ( is_checkout() && ! is_order_received_page() ) { ?> current <?php } ?>"><?php _e( 'Checkout Details ', 'yit' ); ?></span>
        <span class="slogan-complete<?php if ( is_order_received_page() ) { ?> current <?php } ?> "><?php _e( 'Order Complete', 'yit' ); ?></span>
        <?php
        $slogan = ob_get_clean();

    }

}

if ( empty( $show_slogan ) || $show_slogan == 'no' ) {
    return;
}
?>

<!-- START SLOGAN -->
<div id="slogan" <?php if( isset( $slogan_class ) ): echo 'class="' .$slogan_class . '"'; endif; ?> >
    <div class="container">
        <div class="slogan-wrapper">
            <?php if( ! empty( $slogan ) ) : ?>
                <h2 <?php if( $slogan_color != '' ) : echo 'style="color: ' .$slogan_color . '"'; endif; ?> ><?php echo yit_decode_title( $slogan ) ?></h2>
            <?php endif; ?>
            <?php if( ! empty( $subslogan ) ) : ?>
                <p <?php if( $subslogan_color != '' ): echo 'style="color: ' .$subslogan_color . '"'; endif; ?> ><?php echo yit_decode_title( $subslogan ) ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- END SLOGAN -->

