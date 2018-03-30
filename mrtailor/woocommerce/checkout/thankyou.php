<?php
/**
 * Thankyou page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( $order ) : ?>

<div class="row">
	<div class="large-8 large-centered columns">
		<div class="thank_you_header text-center">

			<?php if ( $order->has_status( 'failed' ) ) : ?>
        
                <p><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction.', 'woocommerce' ); ?></p>
        
                <p><?php
                    if ( is_user_logged_in() )
                        _e( 'Please attempt your purchase again or go to your account page.', 'woocommerce' );
                    else
                        _e( 'Please attempt your purchase again.', 'woocommerce' );
                ?></p>
        
                <p>
                    <a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', 'woocommerce' ) ?></a>
                    <?php if ( is_user_logged_in() ) : ?>
                    <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ); ?>" class="button pay"><?php _e( 'My Account', 'woocommerce' ); ?></a>
                    <?php endif; ?>
                </p>
        
            <?php else : ?>
        
                <p><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), $order ); ?></p>
                
                <img class="thank_you_header_img_top" src="<?php echo get_template_directory_uri(); ?>/images/thank_you_header_img.png"  alt="login-image" />
        
                <ul class="order_details">
                    <li class="order">
                        <span class="title"><?php _e( 'Order:', 'woocommerce' ); ?></span>
                        <strong><?php echo $order->get_order_number(); ?></strong>
                    </li>
                    <li class="date">
                        <span class="title"><?php _e( 'Date:', 'woocommerce' ); ?></span>
                        <strong><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?></strong>
                    </li>
                    <li class="total">
                        <span class="title"><?php _e( 'Total:', 'woocommerce' ); ?></span>
                        <strong><?php echo $order->get_formatted_order_total(); ?></strong>
                    </li>
                    <?php if ( $order->payment_method_title ) : ?>
                    <li class="method">
                        <span class="title"><?php _e( 'Payment method:', 'woocommerce' ); ?></span>
                        <strong><?php echo $order->payment_method_title; ?></strong>
                    </li>
                    <?php endif; ?>
                </ul>
                <div class="clear"></div>
                
                <img class="thank_you_header_img_bottom" src="<?php echo get_template_directory_uri(); ?>/images/thank_you_header_img.png"  alt="login-image" />
        
            <?php endif; ?>
    
		</div><!-- .thank_you_header-->

		<div class="thank_you_bank_details">
			<?php do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id ); ?>
        </div><!-- .thank_you_bank_details-->

    </div><!-- .medium-10-->
</div><!--	.row	-->

<?php do_action( 'woocommerce_thankyou', $order->id ); ?>

<?php else : ?>

<div class="row">
	<div class="medium-10 medium-centered  large-8 large-centered text-center columns">
		<div class="thank_you_header">

			<p><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), null ); ?></p>
    
		</div>
    </div>
</div>

<?php endif; ?>