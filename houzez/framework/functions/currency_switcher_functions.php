<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 11/08/16
 * Time: 8:16 PM
 * Since 1.3.0
 */

/*-----------------------------------------------------------------------------------*/
// Get Base Currency | @return mixed|string|void
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'houzez_get_base_currency' ) ) {

    function houzez_get_base_currency() {

        $base_currency = houzez_option('houzez_base_currency');
        if ( empty( $base_currency ) ) {
            $base_currency = 'USD';
        }

        return $base_currency;
    }
}

/*-----------------------------------------------------------------------------------*/
// Get Supported Currencies | @return array
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'houzez_supported_currencies' ) ) {

    function houzez_supported_currencies() {

        $supported_currencies_array = array();

        $supported_currencies = houzez_option('houzez_supported_currencies');
        if ( ! empty( $supported_currencies ) ) {
            $supported_currencies_array = explode( ',', $supported_currencies );
        }

        // fall back
        if ( empty( $supported_currencies ) || empty( $supported_currencies_array ) ) {
            $supported_currencies_array = array(
                'AUD', 'CAD', 'CHF', 'EUR', 'GBP', 'HKD', 'JPY', 'NOK', 'SEK', 'USD'
            );
        }

        return $supported_currencies_array;
    }
}

/*-----------------------------------------------------------------------------------*/
// Get Current Currency | @return mixed|string|void
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'houzez_get_current_currency' ) ) {

    function houzez_get_current_currency() {

        if ( isset( $_COOKIE[ "houzez_current_currency" ] ) ) {
            $temp_current_currency = $_COOKIE[ "houzez_current_currency" ];
            if ( currency_exists( $temp_current_currency ) ) {    // validate current currency
                $current_currency = $temp_current_currency;
            }
        }

        if ( empty( $current_currency ) ) {
            $current_currency = houzez_get_base_currency();
        }

        return $current_currency;
    }
}

/*-----------------------------------------------------------------------------------*/
// Ajax Currency Switch
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'houzez_switch_currency' ) ) {

    function houzez_switch_currency()
    {

        if (isset($_POST['switch_to_currency'])):

            $expiry_period = houzez_option('houzez_currency_expiry');

            $nonce = $_POST['security'];
            if (!wp_verify_nonce($nonce, 'houzez_switch_currency_nonce')) {
                echo json_encode(array(
                    'success' => false,
                    'message' => __('Unverified Nonce!', 'houzez')
                ));
                wp_die();
            }

            /*
            * wp-currencies plugin is required - https://wordpress.org/plugins/wp-currencies/
            * ----------------------------------------------------------------------------------*/
            if (class_exists('WP_Currencies')) {

                $switch_to_currency = $_POST['switch_to_currency'];

                // expiry time
                $expiry_period = intval($expiry_period);
                if (!$expiry_period) {
                    $expiry_period = 60 * 60;   // one hour
                }
                $expiry = time() + $expiry_period;

                // save cookie
                if (currency_exists($switch_to_currency) && setcookie('houzez_current_currency', $switch_to_currency, $expiry, '/')) {
                    echo json_encode(array(
                        'success' => true
                    ));
                } else {
                    echo json_encode(array(
                        'success' => false,
                        'message' => __("Failed to updated cookie !", 'houzez')
                    ));
                }

            } else {
                echo json_encode(array(
                    'success' => false,
                    'message' => __('wp-currencies plugin is missing !', 'houzez')
                ));
            }

        else:
            echo json_encode(array(
                    'success' => false,
                    'message' => __("Invalid Request !", 'houzez')
                )
            );
        endif;

        die;

    }

    add_action('wp_ajax_nopriv_houzez_switch_currency', 'houzez_switch_currency');
    add_action('wp_ajax_houzez_switch_currency', 'houzez_switch_currency');
}