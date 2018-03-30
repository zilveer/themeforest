<?php
/**
 * My Addresses
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$customer_id = get_current_user_id();
?>

<?php if (get_option('woocommerce_ship_to_billing_address_only')=='no') : ?>

    <div class="col2-set addresses">

        <div class="col-1">

<?php endif; ?>

            <header class="title">
                <h2><?php _e('Billing Address', 'yit'); ?></h2>
                <a href="<?php echo wc_get_endpoint_url( 'edit-address', 'billing' ); ?>" class="edit"><?php _e('Edit', 'yit'); ?></a>
            </header>
            <address>
                <?php
                    $address = array(
                        'first_name' 	=> get_user_meta( $customer_id, 'billing_first_name', true ),
                        'last_name'		=> get_user_meta( $customer_id, 'billing_last_name', true ),
                        'company'		=> get_user_meta( $customer_id, 'billing_company', true ),
                        'address_1'		=> get_user_meta( $customer_id, 'billing_address_1', true ),
                        'address_2'		=> get_user_meta( $customer_id, 'billing_address_2', true ),
                        'city'			=> get_user_meta( $customer_id, 'billing_city', true ),
                        'state'			=> get_user_meta( $customer_id, 'billing_state', true ),
                        'postcode'		=> get_user_meta( $customer_id, 'billing_postcode', true ),
                        'country'		=> get_user_meta( $customer_id, 'billing_country', true )
                    );

                    $formatted_address = WC()->countries->get_formatted_address( $address );

                    if (!$formatted_address) _e('You have not set up a billing address yet.', 'yit'); else echo $formatted_address;
                ?>
            </address>


<?php if (get_option('woocommerce_ship_to_billing_address_only')=='no' ) : ?>

        </div><!-- /.col-1 -->

        <div class="col-2">

            <header class="title">
                <h2><?php _e('Shipping Address', 'yit'); ?></h2>
                <a href="<?php echo wc_get_endpoint_url( 'edit-address', 'shipping' ); ?>" class="edit"><?php _e('Edit', 'yit'); ?></a>
            </header>
            <address>
                <?php
                    $address = array(
                        'first_name' 	=> get_user_meta( $customer_id, 'shipping_first_name', true ),
                        'last_name'		=> get_user_meta( $customer_id, 'shipping_last_name', true ),
                        'company'		=> get_user_meta( $customer_id, 'shipping_company', true ),
                        'address_1'		=> get_user_meta( $customer_id, 'shipping_address_1', true ),
                        'address_2'		=> get_user_meta( $customer_id, 'shipping_address_2', true ),
                        'city'			=> get_user_meta( $customer_id, 'shipping_city', true ),
                        'state'			=> get_user_meta( $customer_id, 'shipping_state', true ),
                        'postcode'		=> get_user_meta( $customer_id, 'shipping_postcode', true ),
                        'country'		=> get_user_meta( $customer_id, 'shipping_country', true )
                    );

                    $formatted_address = WC()->countries->get_formatted_address( $address );

                    if (!$formatted_address) _e('You have not set up a shipping address yet.', 'yit'); else echo $formatted_address;
                ?>
            </address>

        </div><!-- /.col-2 -->

    </div><!-- /.col2-set -->

<?php endif; ?>