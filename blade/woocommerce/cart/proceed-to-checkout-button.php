<?php
/**
 * Proceed to checkout button
 *
 * Contains the markup for the proceed to checkout button on the cart
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
echo '<a class="grve-btn grve-woo-btn grve-custom-btn grve-fullwidth-btn grve-bg-primary-1 grve-bg-hover-black" href="' . esc_url( WC()->cart->get_checkout_url() ) . '"><span>' . esc_html__( 'Proceed to Checkout', 'woocommerce' ) . '</span></a>';
	
//Omit closing PHP tag to avoid accidental whitespace output errors.
